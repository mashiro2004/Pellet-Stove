<?php
// Initializzzo la session
session_start();
 
// Redirect in caso di non login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
// Include file config
require_once "../cfgprg.php";

// Query per prendere i dati da lunedì
$sql = "SELECT * FROM lunedi";
$result = $conn->query($sql);

// Valorizzo le variabili per valorizzare i campi  di accensione e spegnimento 
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
       $inizio1 = $row["inizio1"];
	   $fine1=$row["fine1"];
	   $inizio2 = $row["inizio2"];
	   $fine2=$row["fine2"];
	   $inizio3 = $row["inizio3"];
	   $fine3=$row["fine3"];
    }
} 

// Alla pressione del tasto Salva
if (isset($_POST['salva']))
{
// Svuoto le veriabili sporche
$inizio1="";
$inizio2="";
$inizio3="";
$fine1="";
$fine2="";
$fine3="";
$in1="";
$in2="";
$in3="";
$fi1="";
$fi2="";
$fi3="";
// Cancello tutto da lunedì
$sqldel = "DELETE FROM lunedi";

	if (mysqli_query($conn, $sqldel)) 
	{
    
	} 

//Valorizzo le variabili dai campi di accensione e spegnimento in modo da usarle nella insert nel db

$in1 = $_POST['inizio1'];
$in2 = $_POST['inizio2'];
$in3 = $_POST['inizio3'];
$fi1 = $_POST['fine1'];
$fi2 = $_POST['fine2'];
$fi3 = $_POST['fine3'];

$sqlins = "INSERT INTO lunedi (inizio1,inizio2,inizio3,fine1,fine2,fine3) VALUES ('$in1','$in2','$in3','$fi1','$fi2','$fi3')";
if (mysqli_query($conn, $sqlins)) 
	{
		$inizio1 = $in1;
		$fine1=$fi1;
		$inizio2 = $in2;
		$fine2=$fi2;
		$inizio3=$in3;
		$fine3=$fi3;
	} 
	
// Riprendo i dati dal db per creare il crontab
$sqllun = "SELECT * FROM lunedi";
$result = $conn->query($sqllun);
 
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
		//Prendo i dati di inizio e fine ed in seguito li inverto per darli in pasto al crontab nel formato corretto
		// Reverse inizio1
		$reviniziol1= substr($row["inizio1"], -2) . ' ' . substr($row["inizio1"], 0, -3);
       	// Reverse fine1
		$revfinel1= substr($row["fine1"], -2) . ' ' . substr($row["fine1"], 0, -3);
		// Reverse inizio2
		$reviniziol2= substr($row["inizio2"], -2) . ' ' . substr($row["inizio2"], 0, -3);
		// Reverse fine2
		$revfinel2= substr($row["fine2"], -2) . ' ' . substr($row["fine2"], 0, -3);
		// Reverse inizio3
		$reviniziol3= substr($row["inizio3"], -2) . ' ' . substr($row["inizio3"], 0, -3);
		// Reverse fine3
		$revfinel3= substr($row["fine3"], -2) . ' ' . substr($row["fine3"], 0, -3);
	      
    }
echo $reviniziol1, ' ' , $revfinel1 . ' ' . $reviniziol2, ' ' , $revfinel2 . ' ' . $reviniziol3, ' ' , $revfinel3;

//Inserisco i dati crontab
//$output = shell_exec('crontab -r');
//$output = shell_exec('crontab -l');
//file_put_contents('/tmp/crontab.txt', $reviniziol1 . ' * * 1 /bin/sh /tmp/launch.sh'.PHP_EOL);
//file_put_contents('/tmp/crontab.txt', $revfinel1 . ' * * 1 /bin/sh /tmp/launch2.sh'.PHP_EOL, FILE_APPEND);
//file_put_contents('/tmp/crontab.txt', $reviniziol2 . ' ' . $hinlun1 . ' * * 1 /bin/sh /tmp/launch3.sh'.PHP_EOL, FILE_APPEND);
//file_put_contents('/tmp/crontab.txt', $revfinel2 . ' * * 1 /bin/sh /tmp/launch2.sh'.PHP_EOL, FILE_APPEND);
//file_put_contents('/tmp/crontab.txt', $reviniziol3 . ' * * 1 /bin/sh /tmp/launch.sh'.PHP_EOL);
//file_put_contents('/tmp/crontab.txt', $revfinel3 . ' * * 1 /bin/sh /tmp/launch2.sh'.PHP_EOL, FILE_APPEND);
//echo exec('crontab /tmp/crontab.txt');
shell_exec('crontab -l > /var/www/html/php/sett/file');
shell_exec('echo "\n" >> /var/www/html/php/sett/file');
$file = file('/var/www/html/php/sett/file');
$lines = array_map(function ($value) { return rtrim($value, PHP_EOL); }, $file);

//Eseguo i controllo e poi popolo il crontab
if ($reviniziol1 == '' || $reviniziol1 == ' ') {
   $lines[1] = '# 1 - Lunedi Inizio';
} else {
   $lines[1] = $reviniziol1 . ' * * 1 /bin/sh /tmp/launch.sh';
}
if ($revfinel1 == '' || $revfinel1 == ' ') {
   $lines[2] = '# 2 - Lunedi Fine';
} else {
   $lines[2] = $revfinel1 . ' * * 1 /bin/sh /tmp/launch.sh';
}
if ($reviniziol2 == '' || $reviniziol2 == ' ') {
   $lines[3] = '# 3 - Lunedi Inizio';
} else {
   $lines[3] = $reviniziol2 . ' * * 1 /bin/sh /tmp/launch.sh';
}
if ($revfinel2 == '' || $revfinel2 == ' ') {
   $lines[4] = '# 4 - Lunedi Fine';
} else {
   $lines[4] = $revfinel2 . ' * * 1 /bin/sh /tmp/launch.sh';
}
if ($reviniziol3 == '' || $reviniziol3 == ' ') {
   $lines[5] = '# 5 - Lunedi Inizio';
} else {
   $lines[5] = $reviniziol3 . ' * * 1 /bin/sh /tmp/launch.sh';
}
if ($revfinel3 == '' || $revfinel3 == ' ') {
   $lines[6] = '# 6 - Lunedi Fine';
} else {
   $lines[6] = $revfinel3 . ' * * 1 /bin/sh /tmp/launch.sh';
}
$lines = array_values($lines);
$content = implode(PHP_EOL, $lines);
file_put_contents('/var/www/html/php/sett/file', $content);
echo exec('crontab /var/www/html/php/sett/file');
#shell_exec('rm -rf /tmp/file');

} 

	
} 

?>

<!DOCTYPE html>
<html lang="en">
<script src="jquery.js"></script> 
<script src="moment.min.js"></script> 
<script src="combodate.js"></script> 
<head>
    <meta charset="UTF-8">
    <title>Lunedì</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-5"> Edita i campi con accensione e spegnimento </h1>

<!-- ########################### Inizio Pogrammazione Orario 1 ########################### -->
<form method="post">
<label for="html">Ora Inizio: </label>
<input type="text" id="inizio1" name="inizio1" data-format="HH:mm" data-template="HH : mm" value="<?php echo htmlentities($inizio1) ?>">
<span style="padding-right: 1em"></span>
<script>
$(function(){
    $('#inizio1').combodate({
        firstItem: 'name', 
        minuteStep: 1
    });  
});
</script>
<label for="html">Ora Fine: </label>
<input type="text" id="fine1" data-format="HH:mm" data-template="HH : mm" name="fine1" value="<?php echo htmlentities($fine1) ?>">

<script>
$(function(){
    $('#fine1').combodate({
        firstItem: 'name', 
        minuteStep: 1
    });  
});
</script>
<!-- ########################### Fine Pogrammazione Orario 1 ########################### -->
<br>
<!-- ########################### Inizio Pogrammazione Orario 2 ########################### -->
<label for="html">Ora Inizio: </label>
<input type="text" id="inizio2" data-format="HH:mm" data-template="HH : mm" name="inizio2" value="<?php echo htmlentities($inizio2) ?>">
<span style="padding-right: 1em"></span>
<script>
$(function(){
    $('#inizio2').combodate({
        firstItem: 'name', 
        minuteStep: 1
    });  
});
</script>
<label for="html">Ora Fine: </label>
<input type="text" id="fine2" data-format="HH:mm" data-template="HH : mm" name="fine2" value="<?php echo htmlentities($fine2) ?>">

<script>
$(function(){
    $('#fine2').combodate({
        firstItem: 'name', 
        minuteStep: 1
    });  
});
</script>
<!-- ########################### Fine Pogrammazione Orario 2 ########################### -->
<br>
<!-- ########################### Inizio Pogrammazione Orario 3 ########################### -->
<label for="html">Ora Inizio: </label>
<input type="text" id="inizio3" data-format="HH:mm" data-template="HH : mm" name="inizio3" value="<?php echo htmlentities($inizio3) ?>">
<span style="padding-right: 1em"></span>
<script>
$(function(){
    $('#inizio3').combodate({
        firstItem: 'name', 
        minuteStep: 1
    });  
});
</script>
<label for="html">Ora Fine: </label>
<input type="text" id="fine3" data-format="HH:mm" data-template="HH : mm" name="fine3" value="<?php echo htmlentities($fine3) ?>">

<script>
$(function(){
    $('#fine3').combodate({
        firstItem: 'name', 
        minuteStep: 1
    });  
});
</script>
<br><br>
<form method="post">
<button class="button" name="salva">Salva</button>
</form>
<!-- ########################### Fine Pogrammazione Orario 3 ########################### -->
</form>
</div>
    <h1 class="my-5">Modifica altro giorno della settimana.</h1>
	<p>
		<a href="/php/sett/mar.php" class="btn btn-outline-success">Martedì</a>
		<a href="/php/sett/mer.php" class="btn btn-outline-success">Mercoledì</a>
		<a href="/php/sett/gio.php" class="btn btn-outline-success">Giovedì</a>
        <a href="/php/sett/ven.php" class="btn btn-outline-success">Venerdì</a>
		<a href="/php/sett/sab.php" class="btn btn-outline-success">Sabato</a>
		<a href="/php/sett/dom.php" class="btn btn-outline-success">Domenica</a>
	</p>
		
</body>
</html>
