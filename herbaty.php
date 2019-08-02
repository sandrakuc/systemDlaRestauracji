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
<a href="zobacz.php"><button id="z1">Przejdź do koszyka</button></a>
</center>
</div>
<div id="glowna">
<br><br>
<center><p>Napoje gorące</p> <br><br>
<form action="szukajka.php" method="get">
<input name="szukajka" value="Szukaj potrawy..." style='width:300px; height: 40px; font-family: "Comic Sans MC", "Comic Sans", cursive; font-size:22px;' />
<input type="submit" name="szukaj" value="Wyszukaj" id="szukajka">
</form>
<form action="flirciara.php" method="get">
<input type="checkbox" name="filtry[]" value="wegetarianska"/><span id="flirciara">Potrawy wegetariańskie</span><br>
<input type="checkbox" name="filtry[]" value="weganska" /><span id="flirciara">Potrawy wegańskie</span><br>
<input type="checkbox" name="filtry[]" value="bezglutenowa" /><span id="flirciara">Potrawy bezglutenowe</span><br>
<input type="submit" name="filtruj" value="Filtruj" id="szukajka">
</form>
<br>
<?php
$link = mysqli_connect('localhost:3306', 'root', '')
or die("Nie można się połączyć");
mysqli_select_db($link, 'pojedzone')
or die ("Nie można wybrać bazy danych");
$sqll="select * from potrawy where kategoria='Napoje gorace' and podkategoria='herbaty'";
setcookie('sqll', serialize($sqll), time()+3600);
$zaw1=mysqli_query($link, $sqll);
$zmienna = null;
while($r = mysqli_fetch_array($zaw1)){
	echo "<div id='dania'>
	<img src='dane/".$r['zdjecie']."' align='left'>
	<div id='opis' align='left'>"
	.$r['nazwa']." <br>
	porcja: ".$r['ilosc']." ".$r['jednostka']." <br>
	cena: ".$r['cena']."zł<br>
	<form method='get' action='dodaj.php'>
	<input type='hidden' name='id' value='".$r['id_potrawy']."'>
	<input type='hidden' name='cena' value='".$r['cena']."'>
	<input type='hidden' name='podstawa' value='".$zmienna."'>
	<input type='hidden' name='zapychacz' value='".$zmienna."'>
	<input type='hidden' name='surowka' value='".$zmienna."'>
	<input type='hidden' name='pieczywo' value='".$zmienna."'>
	ilość: <select name='ilosc' id='ilosc_porcji'>";
	for($i=1;$i<=20;$i++)
		echo "<option>".$i."</option>";
	echo "</select><br>
	<input type='submit' name='dodaj' value='Dodaj potrawe' id='szukajka'></form>
	</div></div>";
};
mysqli_close($link);
?>
<a href="gorace.php"><button value="Wstecz" id="szukajka">Wstecz</button></a>
</center>
</div>
</body>
</html>
