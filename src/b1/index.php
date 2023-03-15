<?php
include_once("./models/classes/emailSender.php");
include_once("./models/classes/myEmailServer.php");


$emailServer = new MyEmailServer();
$emailSender = new EmailSender($emailServer);
$emailSender->send("chicong040202@gmail.com", "Test Email", "<h1>This is the title</h1>
<p>This is email content</p>");
