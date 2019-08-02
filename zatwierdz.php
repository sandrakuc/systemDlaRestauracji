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
<center><button><img src="logo.png"></img></button>
<br>
<br>
<a href="index.php"><button id="z1">Zakończ!</button></a>
</div>
<div id="glowna">
<br><br>
<?php
$link = mysqli_connect('localhost:3306', 'root', '')
or die("Nie można się połączyć");
mysqli_select_db($link, 'pojedzone')
or die ("Nie można wybrać bazy danych");
$sqll="select * from potrawy";
setcookie('sqll', serialize($sqll), time()+3600);
$order = unserialize($_COOKIE['order']);
$kwota = $_GET['kwota'];
$neworder=$order+1;
$zaplata=mysqli_query($link, "UPDATE zamowienia SET naleznosc='$kwota' WHERE id_zamowienia='$order'");
$zakoncz=mysqli_query($link, "INSERT INTO zamowienia SET id_zamowienia='$neworder', naleznosc=NULL");
if($zaplata && $zakoncz){
echo "<center><p>Zamowienie zostało złożone!</p> <br><br>
<p>
Nr Twojego zamówienia: ".$order."<br>
Należność: ".$kwota."<br>
Prosimy o zapłatę należności przy kasie :)<br>
Kiedy na wyświetlaczu pojawi się odbiór Twojego zamówienia, prosimy je odebrać :)<br>
Życzymy smacznego :)<br>
</p>";
}
else{
	echo "<center><p> Ups! Coś poszło nie tak! :( <br>
	Proszę kliknąć przycisk \"Zakończ\" i spróbować złożyć zamówienie ponownie!";
}
mysqli_close($link);
?>

</center>
</div>
</body>
</html>