<?php 
include_once '../businessLogic/UserMapper.php';
include_once '../businessLogic/User.php';
require '../businessLogic/AccountVerify.php';
include '../components/header.php';

   
if(!empty($_SESSION['is_logged_in']) && isset($_SESSION['is_logged_in']) 
    && $_SESSION['is_logged_in'] == 1 && $_SESSION['role'] == 1){
        
    $errors = [];
    $mapper = new UserMapper();
    if(isset($_GET['action']) && $_GET['action'] == 'edit-user'){
        $user = $mapper->getUserById($_GET['user-id']);
    }

    if(isset($_POST['update-user-btn'])){
        $id = $_POST['id'];
        $username = $_POST['name'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $accverify = new RegisterLogic($username, $lastname, $email, $password);

        if($accverify->emptyInputs($username, $lastname, $email, $password)){
            $errors[] = "Please fill in all the inputs";
            $user = $mapper->getUserById($id);
        }else if($accverify->validEmailModification($id) == false){
            $errors[] = "Email is not vaid";
            $user = $mapper->getUserById($id);
        }else if($accverify->verifyPassword() == false){
            $errors[] = "Password should contain minimum eight characters, at least one letter and one number:";
            $user = $mapper->getUserById($id);
        } else {
            $updateuser = new User($username, $lastname, $email, $password, 0);
            $mapper->edit($updateuser, $id);
            header("Location: dashboard.php?action=view-users");
        }
    }
?>  
    <div class="edit-user-main">
        <?php if(count($errors)) {?>
            <div class="llogaria-error" style="width: 430px;">
                <?php foreach($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php }?>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" class="edit-user-card">
            <img src="../images/icons/user-circle-black.svg" alt="">
            <input readonly type="text" name="id" value="<?= $user['id'] ?>">
            <input type="text" name="username" value="<?= $user['username'] ?>">
            <input type="text" name="lastname" value="<?= $user['lastname'] ?>">
            <input type="email" name="email" value="<?= $user['email'] ?>">
            <input type="password" name="pass" value="<?= $user['password'] ?>">
            <input class="button" type="submit" name="update-user-btn" value="Save changes">
            <a href="dashboard.php?action=view-users">Cancel</a>
        </form>
    </div>

<?php } else {
    header("Location: index.php");
}
?>

<?php include '../components/footer.php'?>