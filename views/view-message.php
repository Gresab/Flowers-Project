<?php 
    include '../components/header.php';
    require_once '../businessLogic/MessageMapper.php';

    if(!empty($_SESSION['is_logged_in']) && isset($_SESSION['is_logged_in']) 
        && $_SESSION['is_logged_in'] == 1 && $_SESSION['role'] == 1){

            $mapper = new MessageMapper();
            $msg = $mapper->getMessageById($_GET['msg_id']);
?>  
    <div class="view-message-main">
        <div class="message-card">
            <p><b>Message from:</b> <?= $msg['name'].' '.$msg['lastname']?></p>
            <p><b>Email: </b><?= $msg['email']?></p>
            <textarea disabled><?= $msg['msg']?></textarea>
                <?php if($msg['is_read'] == 0) 
                    echo "../businessLogic/modifications.php?action=set-read&msg-id=".$msg['id'];
                else if($msg['is_read'] == 1)
                    echo "../businessLogic/modifications.php?action=set-unread&msg-id=".$msg['id'];?>">
                <?php if($msg['is_read'] == 1) echo "Mark as unread"; else echo "Mark as read"?>
        </div>
    </div>
<?php } else {
    header("Location: ../views/index.php");
}
?>

<?php include '../components/footer.php'?>