<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
	exit;
}
$output = shell_exec('/var/www/launcher/php_root');
$output2 = shell_exec('/bin/sh /var/www/launcher/record.sh');
$num = file_get_contents('http://192.168.4.200/php/num.php');
if ($num < 50) {
    $color='Red';
	$stato='SPENTA';
} else {
    $color='Green';
	$stato='ACCESA';
}



if (isset($_POST['scatta']))
{
	header("Refresh:0");
}

if (isset($_POST['tempup_x'], $_POST['tempup_y']))
{
	shell_exec('/bin/sh /var/www/launcher/h2oup.sh');
	}	
if (isset($_POST['tempd_x'], $_POST['tempd_y']))
{
	shell_exec('/bin/sh /var/www/launcher/h2odown.sh');
	}
if (isset($_POST['on_x'], $_POST['on_y']))
{
	shell_exec('/bin/sh /var/www/launcher/on.sh');
}
if (isset($_POST['potup_x'], $_POST['potup_y']))
{
	shell_exec('/bin/sh /var/www/launcher/potenzaup.sh');
}
if (isset($_POST['potd_x'], $_POST['potd_y']))
{
	shell_exec('/bin/sh /var/www/launcher/potenzadown.sh');
}
	
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stato Caldaia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>

    <h1 class="my-4">Ciao, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Benvenuto nello stato della tua Caldaia.</h1>
   
	<p>
	<p><font size="5">La Caldaia è </font>
	<font color="<?php echo htmlentities($color) ?>"; size="5"><?php echo htmlentities($stato) ?></font></p>
	
		<a href="welcome.php" class="btn btn-outline-success">Torna alla Home</a>
        
	</p>
	
	<p>
	
		<h3 class="my-3">Display della Caldaia</h3>
		<img src="/img/stato.jpg" alt="Stato">
	</p>
	<form method="post">
<button class="button" name="scatta">Scatta Foto Ora</button>
<h3 class="my-3">Comandi Manuali Caldaia.</h3>
<p>
<h4 class="my-3">Temperatura:</h4>
<input type="image" src="/img/tempup.png" name="tempup" alt="tempup"/ width="70" height="70" >
<input type="image" src="/img/tempdown.png" name="tempd" alt="tempd"/ width="70" height="70" >
</p>
<p>
<h4 class="my-3">On/Off:</h4>
<input type="image" src="/img/on.jpg" name="on" alt="on"/ width="70" height="70" >
</p>
<p>
<h4 class="my-3">Potenza:</h4>
<input type="image" src="/img/tempup.png" name="potup" alt="potup"/ width="70" height="70" >
<input type="image" src="/img/tempdown.png" name="potd" alt="potd"/ width="70" height="70" >
</p>
<a href="../php/welcome.php" class="btn btn-primary">Torna alla Home</a>
</form>
</body>
</html>