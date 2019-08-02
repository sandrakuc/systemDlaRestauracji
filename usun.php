<! DOCTYPE html>
<html lang ="pl-PL">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css"/>
<title>Bar Pojedzone</title>
</head>
<body>
<div id="logo">
<br>
<center><a href="index.php"><button><img src="logo.png"></img></button></a>
<br>
<br>
</div>
<div id="glowna">
<center>
<br><br>
<?php
$link = mysqli_connect('localhost:3306', 'root', '')
or die("Nie można się połączyć");
mysqli_select_db($link, 'pojedzone')
or die ("Nie można wybrać bazy danych");
$zam=$_GET['zam_zest'];
$zestaw=$_GET['zestaw'];
$usun_z=mysqli_query($link, "DELETE FROM zam_zest WHERE id='$zam'");
$usun_s=mysqli_query($link, "DELETE FROM skomponowane_zestawy WHERE id_zestawu='$zestaw'");
if($usun_s && $usun_z) echo "<p>Potrawa została usunięta z zamówienia</p>";
else echo "<p>Nie udało się usunąć potrawy</p>";
mysqli_close($link);
?>

<a href="zobacz.php"><button value="Wstecz" id="szukajka">Wstecz</button></a>
</center>
</div>
</body>
</html>