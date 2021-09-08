
<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=No"/>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)" />
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta name="apple-mobile-web-app-title" content="Garage Control"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>

<link rel="stylesheet" href="jquery/jquery.mobile-1.4.0.min.css" />
<script src="jquery/jquery-1.10.2.js"></script>
<script src="jquery/jquery.mobile-1.4.0.min.js"></script>

<link rel="shortcut icon" href="favicon.png">
<link rel="apple-touch-icon" href="favicon.png">





</head>

<body>


<div data-role="page" id="pulse" >
<div data-role="header" data-position="fixed" data-theme="b" class="ui-btn-active" class="ui-state-persist" >
        <h1>Coop Control</h1>


</div>

<?php


// Setting the variables for validation
// you can change This_is_a_fake_salt to whatever you want
//set your passwrod to what you want

$thepass    =    "cluck";
$password_hash = md5($thepass.This_is_a_fake_salt);
$notlogged    =    "Password Required"; 
$errormsg    =    "The password is incorrect.";   
//$loc_action    =    $_SERVER['SCRIPT_NAME']; //this page
//$loc_succ    =    $_SERVER['SCRIPT_NAME']; // The dock to go to on success (don't go to another page, that would be bad.
//$loc_error    =    $PHP_SELF;    // The doc to go to on bad login. You can leave $PHP_SELF in most cases
$but_log    =    "Login";    // Text on the submit button




$pass        =    $_POST['pass'];
$logged        =    $_COOKIE['logged'];
$mod        =    $_POST['mod'];
// If there is no cookie and the user is not logging in, output the login form
if($logged != $password_hash&& $mod != "login") {

  echo '

<div style="text-align: center;">
<div data-role="content">

	    <br />
	<br />
    <b><center>'.$notlogged.'</b><center><p>
    <form name="login" action="'.$PHP_SELF.'" method="POST">
    <input type="password" name="pass">
    <input type="hidden" name="mod" value="login">
    <input type="submit" value="'.$but_log.'">
    </form>';
    // If there is a bad login, the error message will be displayed
    if($_GET['msg'] == "err") {
        echo '<p><font color="red">'.$errormsg.'</font>';
    }
    die;


}
// if the user is logging in
elseif($logged != $password_hash&& $mod == "login") {
    // check the password
    if($pass == $thepass) {
        // if the pass is correct, set the cookie and go to this page or do stuff
        //setcookie("logged", "1");
        setcookie("logged", $password_hash, time()+60*60*24*365, '/');
	//sleep(3);
	//header("Location: ".$PHP_SELF);
  	header("Refresh: 1; url=".$PHP_SELF);

} else {
        // On bad login reload
        header("Location:".$loc_err."?msg=err");
    }
   
}


//end of validatoin stuff do everyting you want after this
?>

<?php
//define variables for the GPIO pins
if (isset($_POST['Pin18']))
{
exec("sudo python /home/pi/gpiotoggle.py 18");
// it takes about 12 seconds to open and close the chicken coop door
sleep (12);
}
if (isset($_POST['Pin27']))
{
exec("sudo python /home/pi/gpiotoggle.py 27");
}
if (isset($_POST['Pin22']))
{
exec("sudo python /home/pi/gpiotoggle.py 22");
}

//see if the  door is open or closed via mag switch on GPIO 20
$state = exec("sudo python /home/pi/gpiostatus.py 20");
if  ($state == "1")
{
$state = "CLOSED" ;
$color = "red";
}
if ($state == "0" )
{
$state = "OPEN";
$color = "green";
}

?>

<!--display my form -->
<div data-role="content">

<div style="text-align: center;">
<div style="color:
<?php print $color; ?>
">
<h1>
<b>
<?php print $state; ?>
</b>
</h1>
</div>


<form target=_self method="POST">

<button name="Pin18">Door</button>
<!-- <button name="Pin27">Inside Light</button> >
<!-- <button name="Pin22">Outside Light</button> >

<!-- all done >

</div>
</form>

</body>
</html>
