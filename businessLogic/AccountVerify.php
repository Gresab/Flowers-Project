<?php

include_once 'Admin.php';
include_once 'User.php';
require_once 'UserMapper.php';

session_start();

if (isset($_POST['login-btn'])) {
	$login = new LoginLogic($_POST);
	$login->verifyData();
} else if (isset($_POST['register-btn'])) {
	$register = new RegisterLogic($_POST);
	$register->insertData();
} else {
	header("Location:../views/index.php");
}

class LoginLogic
{

	private $email;
	private $password;

	public function __construct($formData)
	{
		$this->email = $formData['email'];
		$this->password = $formData['password'];
	}


	public function verifyData()
	{
		if ($this->emptyInputs($this->email, $this->password)) {
			$_SESSION['login-register-error'] = true;
			header("Location: ../views/llogaria.php?login=emptyfields");
		} else if ($this->correctInputs($this->email, $this->password)) {
			header("Location: ../views/index.php?login=success");
		} else {
			$_SESSION['login-register-error'] = true;
			header("Location: ../views/llogaria.php?login=error");
		}
	}

	private function emptyInputs($email, $password)
	{
		if (empty($email) || empty($password)) {
			return true;
		} else
			return false;
	}

	private function correctInputs($email, $password)
	{
		$mapper = new UserMapper();
		$user = $mapper->getUserByEmail($email);
		if ($user == null || count($user) == 0) {
			return false;
		} else if (password_verify($password, $user['password'])) {
			if ($user['role'] == 1) {
				$obj = new Admin($user['username'], $user['lastname	'], $user['email'], $user['password'], $user['role']);
				$obj->setSession();
			} else {
				$obj = new User($user['username'], $user['lastname'], $user['email'], $user['password'], $user['role']);
				$obj->setSession();
			}
			return true;
		} else
			return false;
	}
}


class RegisterLogic
{

	private $username;
	private $lastname;
	private $email;
	private $password;

	public function __construct($formData)
	{
		$this->username = $formData['register-username'];
		$this->lastname = $formData['register-lastname'];
		$this->email = $formData['register-email'];
		$this->password = $formData['register-password'];
	}

	public function insertData()
	{
		if ($this->emptyInputs($this->username, $this->lastname, $this->email, $this->password)) {
			$_SESSION['login-register-error'] = true;
			header("Location: ../views/llogaria.php?register=emptyfields");
		} else if ($this->verifyData() == false) {
			$_SESSION['login-register-error'] = true;
			header("Location: ../views/llogaria.php?register=error");
		} else {
			$user = new User($this->username, $this->lastname, $this->email, $this->password, 0);
			$mapper = new UserMapper();
			$mapper->insertUser($user);
			$login = new LoginLogic($this->email, $this->password);
			$login->verifyData();
		}
	}

	public function emptyInputs($username, $lastname, $email, $password)
	{
		if (empty($username) || empty($lastname) || empty($email) || empty($password))
			return true;
		else
			return false;
	}

	private function verifyData()
	{
		if ($this->emailExists())
			return false;
		else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
			return false;
		else if ($this->verifyPassword() == false)
			return false;
		else
			return true;
	}

	public function emailExists()
	{
		$mapper = new UserMapper();
		$userEmail = $mapper->getEmail($this->email);
		if ($userEmail == null || count($userEmail) == 0)
			return false;
		else if ($this->email == $userEmail['email'])
			return true;
	}

	public function verifyPassword()
	{
		// Minimum eight characters, at least one letter and one number:
		$regex = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
		if (preg_match($regex, $this->password))
			return true;
		else
			return false;
	}

	public function validEmailModification($id)
	{
		$mapper = new UserMapper();
		$emailList = $mapper->getConstraintEmail($id);
		foreach ($emailList as $email) {
			if ($email['email'] == $this->email)
				return false;
		}
		return true;
	}
}
