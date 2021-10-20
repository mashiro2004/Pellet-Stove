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

// Query per prendere i dati da martedì
$sql = "SELECT * FROM martedi";
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
// Cancello tutto da martedì
$sqldel = "DELETE FROM martedi";

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

$sqlins = "INSERT INTO martedi (inizio1,inizio2,inizio3,fine1,fine2,fine3) VALUES ('$in1','$in2','$in3','$fi1','$fi2','$fi3')";
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
$sqlmar = "SELECT * FROM martedi";
$result = $conn->query($sqlmar);
 
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
		//Prendo i dati di inizio e fine ed in seguito li inverto per darli in pasto al crontab nel formato corretto
		// Reverse inizio1
		$reviniziom1= substr($row["inizio1"], -2) . ' ' . substr($row["inizio1"], 0, -3);
       	// Reverse fine1
		$revfinem1= substr($row["fine1"], -2) . ' ' . substr($row["fine1"], 0, -3);
		// Reverse inizio2
		$reviniziom2= substr($row["inizio2"], -2) . ' ' . substr($row["inizio2"], 0, -3);
		// Reverse fine2
		$revfinem2= substr($row["fine2"], -2) . ' ' . substr($row["fine2"], 0, -3);
		// Reverse inizio3
		$reviniziom3= substr($row["inizio3"], -2) . ' ' . substr($row["inizio3"], 0, -3);
		// Reverse fine3
		$revfinem3= substr($row["fine3"], -2) . ' ' . substr($row["fine3"], 0, -3);
	      
    }
//echo $reviniziom1, ' ' , $revfinem1 . ' ' . $reviniziom2, ' ' , $revfinem2 . ' ' . $reviniziom3, ' ' , $revfinem3;

//Inserisco i dati crontab

shell_exec('crontab -l > /var/www/html/php/sett/file');
shell_exec('echo "\n" >> /var/www/html/php/sett/file');
$file = file('/var/www/html/php/sett/file');
$lines = array_map(function ($value) { return rtrim($value, PHP_EOL); }, $file);

//Eseguo i controllo e poi popolo il crontab
if ($reviniziom1 == '' || $reviniziom1 == ' ') {
   $lines[7] = '# 7 - Martedi Inizio';
} else {
   $lines[7] = $reviniziom1 . ' * * 2 /bin/sh /tmp/launch.sh';
}
if ($revfinem1 == '' || $revfinem1 == ' ') {
   $lines[8] = '# 8 - Martedi Fine';
} else {
   $lines[8] = $revfinem1 . ' * * 2 /bin/sh /tmp/launch.sh';
}
if ($reviniziom2 == '' || $reviniziom2 == ' ') {
   $lines[9] = '# 9 - Martedi Inizio';
} else {
   $lines[9] = $reviniziom2 . ' * * 2 /bin/sh /tmp/launch.sh';
}
if ($revfinem2 == '' || $revfinem2 == ' ') {
   $lines[10] = '#10 - Martedi Fine';
} else {
   $lines[10] = $revfinem2 . ' * * 2 /bin/sh /tmp/launch.sh';
}
if ($reviniziom3 == '' || $reviniziom3 == ' ') {
   $lines[11] = '#11 - Martedi Inizio';
} else {
   $lines[11] = $reviniziom3 . ' * * 2 /bin/sh /tmp/launch.sh';
}
if ($revfinem3 == '' || $revfinem3 == ' ') {
   $lines[12] = '#12 - Martedi Fine';
} else {
   $lines[12] = $revfinem3 . ' * * 2 /bin/sh /tmp/launch.sh';
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
    <title>Martedì</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-3"> </h1>
<p style="font-size:50px; color:green; "> Programmazione del Martedì </p>
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
		<a href="/php/sett/mer.php" class="btn btn-outline-success">Mercoledì</a>
		<a href="/php/sett/gio.php" class="btn btn-outline-success">Giovedì</a>
        <a href="/php/sett/ven.php" class="btn btn-outline-success">Venerdì</a>
		<a href="/php/sett/sab.php" class="btn btn-outline-success">Sabato</a>
		<a href="/php/sett/dom.php" class="btn btn-outline-success">Domenica</a>
	</p>
	<a href="../welcome.php" class="btn btn-primary">Torna alla Home</a>
</body>
</html>
