<?php include '../components/header2.php' ?>
<div class="mbajtsi-box">
    <div id="box-left">
        <h1>Contact Us</h1>
        <p class="contact1">For Event Inquiries, complete this form or email us with a little information about your day.</p>
        <p class="contact2">For all other inquiries, please leave your information to the right.</p>      
    </div>

    <div>
        <div id="log-error" class="llogaria-error hidden">
            <p id='msg'></p>
        </div>
        <form id="box-right" method="POST" action="../businessLogic/upload.php">
            <h2>Contact Us</h2>
            <hr class="divider">
            <label for="name">Name</label>
            <input id="nameC" type="text" name="name">
            <label for="name">Lastname</label>
            <input id="lastnameC" type="text" name="lastname">
            <label for="email">Email</label>
            <input id="emailC" type="email" name="email">
            <label for="message">Message</label>
            <textarea id="messageC" type="text" name="msg"></textarea>
            <input id="sendIt" type="submit" class="button" name="send-msg" value="Send">
        </form>
    </div>
</div>
<?php if (isset($_GET['messagesend']) && $_GET['messagesend'] == 'success') {
    echo '<script>alert("Your message was send successfully")</script>';
} ?>

<?php include '../components/footer.php' ?>