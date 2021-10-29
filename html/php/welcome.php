<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Ciao, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Benvenuto nella tua home.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-info">Reset Password</a>
        <a href="logout.php" class="btn btn-danger">Log Out</a>
		<a href="register.php" class="btn btn-warning">Registra nuovo Account</a>
		<a href="stato.php" class="btn btn-primary">Stato Caldaia</a>
    </p>
	<h1 class="my-5">Qui Potrai modificare la tua pianificazione.</h1>
	<p>
		<a href="/php/sett/lun.php" class="btn btn-outline-success">Lunedì</a>
        <a href="/php/sett/mar.php" class="btn btn-outline-success">Martedì</a>
		<a href="/php/sett/mer.php" class="btn btn-outline-success">Mercoledì</a>
		<a href="/php/sett/gio.php" class="btn btn-outline-success">Giovedì</a>
        <a href="/php/sett/ven.php" class="btn btn-outline-success">Venerdì</a>
		<a href="/php/sett/sab.php" class="btn btn-outline-success">Sabato</a>
		<a href="/php/sett/dom.php" class="btn btn-outline-success">Domenica</a>
	</p>
	<p>
		<img src="/img/caldaia.jpg" alt="Tepor">
	</p>
	
</body>
</html>