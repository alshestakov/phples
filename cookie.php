<?php
date_default_timezone_set('Europe/Kiev');
$secs = strtotime($end_date) - strtotime($current_date);

$current_date = date('d.m.Y H:i');
$start_date = date('d.m.Y') . ' 00:00';
$end_date = date('d.m.Y') . ' 02:00';

if((isset($_POST['send'])) && (!in_array($_POST['name'], $_COOKIE))) {
    $random = rand();
    setcookie("party{$random}", $_POST['name'], $secs);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookies Party</title>
</head>
<body>
   <p>Hello, welcome to our Cookies Party!</p>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="name">Your name</label>
    <input type="text" name="name" id="name" />
    <input type="submit" value="Send" name="send" />
    </form>
    <?php 
        
        if(in_array($_POST['name'], $_COOKIE)) {
            if(($current_date >= $start_date) && ($current_date <= $end_date)) {
                echo "<br/>You're part of our party!<br/>";
                foreach($_COOKIE as $key => $value) {
                    if(preg_match("/^party/", $key)) {
                        echo $value . "<br/>";
                    }
                } 
                echo "are partying with you!";
            } else {
                echo "<br/>The party time haven't come yet!";
            }
        } else {
            echo "<br/>You're not partying with us!<br/>"; 
        }
    ?> 
</body>
</html>