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
$i=0;
$link = mysqli_connect('localhost:3306', 'root', '')
or die("Nie można się połączyć");
mysqli_select_db($link, 'pojedzone')
or die ("Nie można wybrać bazy danych");
$podstawa=$_GET['podstawa'];
$zapychacz=$_GET['zapychacz'];
$surowka=$_GET['surowka'];
$pieczywo=$_GET['pieczywo'];
$potrawa=$_GET['id'];
$ilosc=$_GET['ilosc'];
$cena=$ilosc * $_GET['cena'];
if($pieczywo != null && $podstawa==null && $surowka==null && $zapychacz==null)
	$dodaj=mysqli_query($link, "INSERT INTO skomponowane_zestawy SET id_potrawy='$potrawa', id_pieczywa='$pieczywo', id_zapychacza=NULL, id_podstawy=NULL, id_surowki=NULL, ilosc='$ilosc', cena='$cena'");
else if($pieczywo == null && $podstawa !=null && $surowka != null && $zapychacz != null)
	$dodaj=mysqli_query($link, "INSERT INTO skomponowane_zestawy SET id_potrawy='$potrawa', id_pieczywa=NULL, id_zapychacza='$zapychacz', id_podstawy='$podstawa', id_surowki='$surowka', ilosc='$ilosc', cena='$cena'");
else if($pieczywo==null && $podstawa==null && $surowka==null && $zapychacz==null)
$dodaj=mysqli_query($link, "INSERT INTO skomponowane_zestawy SET id_potrawy='$potrawa', id_pieczywa=NULL, id_zapychacza=NULL, id_podstawy=NULL, id_surowki=NULL, ilosc='$ilosc', cena='$cena'");
$pobierz=mysqli_query($link, "SELECT max(id_zestawu) from skomponowane_zestawy");
while($r=mysqli_fetch_array($pobierz)){
	$zestaw=$r['max(id_zestawu)'];
}
$order = unserialize($_COOKIE['order']);
$powiaz=mysqli_query($link, "INSERT INTO zam_zest SET id_zestawu='$zestaw', id_zamowienia='$order'");
if($dodaj && $powiaz) {echo "<p>Potrawa została dodana do zamówienia</p>";}
else echo "<p>Nie udało się dodać potrawy</p>";
mysqli_close($link);
?>

<a href="javascript:history.back()"><button value="Wstecz" id="szukajka">Wstecz</button></a>
</center>
</div>
</body>
</html>