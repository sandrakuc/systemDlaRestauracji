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
$podstawa=$_GET['podstawa'];
$zapychacz=$_GET['zapychacz'];
$surowka=$_GET['surowka'];
$pieczywo=$_GET['pieczywo'];
$zestaw=$_GET['zestaw'];
$ilosc=$_GET['ilosc'];
$cena=$ilosc * $_GET['cena'];
if($pieczywo != null && $podstawa==null && $surowka==null && $zapychacz==null)
	$dodaj=mysqli_query($link, "UPDATE skomponowane_zestawy  SET id_pieczywa='$pieczywo', ilosc='$ilosc', cena='$cena' WHERE id_zestawu='$zestaw'");
else if($pieczywo == null && $podstawa !=null && $surowka != null && $zapychacz != null)
	$dodaj=mysqli_query($link, "UPDATE skomponowane_zestawy SET id_zapychacza='$zapychacz', id_podstawy='$podstawa', id_surowki='$surowka', ilosc='$ilosc', cena='$cena' WHERE id_zestawu='$zestaw'");
else if($pieczywo==null && $podstawa==null && $surowka==null && $zapychacz==null)
$dodaj=mysqli_query($link, "UPDATE skomponowane_zestawy SET  ilosc='$ilosc', cena='$cena' WHERE id_zestawu='$zestaw'");
if($dodaj) echo "<p>Potrawa została edytowana w zamówieniu</p>";
else echo "<p>Nie udało się edytować potrawy</p>";
mysqli_close($link);
?>

<a href="zobacz.php"><button value="Wstecz" id="szukajka">Wstecz</button></a>
</center>
</div>
</body>
</html>