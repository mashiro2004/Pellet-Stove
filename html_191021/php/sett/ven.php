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

// Query per prendere i dati da Venerdì
$sql = "SELECT * FROM venerdi";
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
// Cancello tutto da venerdì
$sqldel = "DELETE FROM venerdi";

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

$sqlins = "INSERT INTO venerdi (inizio1,inizio2,inizio3,fine1,fine2,fine3) VALUES ('$in1','$in2','$in3','$fi1','$fi2','$fi3')";
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
$sqlven = "SELECT * FROM venerdi";
$result = $conn->query($sqlven);
 
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
		//Prendo i dati di inizio e fine ed in seguito li inverto per darli in pasto al crontab nel formato corretto
		// Reverse inizio1
		$reviniziov1= substr($row["inizio1"], -2) . ' ' . substr($row["inizio1"], 0, -3);
       	// Reverse fine1
		$revfinev1= substr($row["fine1"], -2) . ' ' . substr($row["fine1"], 0, -3);
		// Reverse inizio2
		$reviniziov2= substr($row["inizio2"], -2) . ' ' . substr($row["inizio2"], 0, -3);
		// Reverse fine2
		$revfinev2= substr($row["fine2"], -2) . ' ' . substr($row["fine2"], 0, -3);
		// Reverse inizio3
		$reviniziov3= substr($row["inizio3"], -2) . ' ' . substr($row["inizio3"], 0, -3);
		// Reverse fine3
		$revfinev3= substr($row["fine3"], -2) . ' ' . substr($row["fine3"], 0, -3);
	      
    }
//echo $reviniziov1, ' ' , $revfinev1 . ' ' . $reviniziov2, ' ' , $revfinev2 . ' ' . $reviniziov3, ' ' , $revfinev3;

//Inserisco i dati crontab

shell_exec('crontab -l > /var/www/html/php/sett/file');
shell_exec('echo "\n" >> /var/www/html/php/sett/file');
$file = file('/var/www/html/php/sett/file');
$lines = array_map(function ($value) { return rtrim($value, PHP_EOL); }, $file);

//Eseguo i controllo e poi popolo il crontab
if ($reviniziov1 == '' || $reviniziov1 == ' ') {
   $lines[25] = '#25 - Venerdi Inizio';
} else {
   $lines[25] = $reviniziov1 . ' * * 5 /bin/sh /tmp/launch.sh';
}
if ($revfinev1 == '' || $revfinev1 == ' ') {
   $lines[26] = '#26 - Venerdi Fine';
} else {
   $lines[26] = $revfinev1 . ' * * 5 /bin/sh /tmp/launch.sh';
}
if ($reviniziov2 == '' || $reviniziov2 == ' ') {
   $lines[27] = '#27 - Venerdi Inizio';
} else {
   $lines[27] = $reviniziov2 . ' * * 5 /bin/sh /tmp/launch.sh';
}
if ($revfinev2 == '' || $revfinev2 == ' ') {
   $lines[28] = '#28 - Venerdi Fine';
} else {
   $lines[28] = $revfinev2 . ' * * 5 /bin/sh /tmp/launch.sh';
}
if ($reviniziov3 == '' || $reviniziov3 == ' ') {
   $lines[29] = '#29 - Venerdi Inizio';
} else {
   $lines[29] = $reviniziov3 . ' * * 5 /bin/sh /tmp/launch.sh';
}
if ($revfinev3 == '' || $revfinev3 == ' ') {
   $lines[30] = '#30 - Venerdi Fine';
} else {
   $lines[30] = $revfinev3 . ' * * 5 /bin/sh /tmp/launch.sh';
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
    <title>Venerdì</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-3"> </h1>
<p style="font-size:50px; color:green; "> Programmazione del venerdì </p>
<p>
<img src="../../img/calendario.jpg" alt="Calendario" width="125" height="150">
</p>
<h1 class="my-4"> Edita i campi con accensione e spegnimento </h1>

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
		<a href="/php/sett/lun.php" class="btn btn-outline-success">Lunedì</a>
		<a href="/php/sett/mar.php" class="btn btn-outline-success">Martedì</a>
		<a href="/php/sett/mer.php" class="btn btn-outline-success">Mercoledì</a>
        <a href="/php/sett/gio.php" class="btn btn-outline-success">Giovedì</a>
		<a href="/php/sett/sab.php" class="btn btn-outline-success">Sabato</a>
		<a href="/php/sett/dom.php" class="btn btn-outline-success">Domenica</a>
	</p>
		
</body>
</html>
