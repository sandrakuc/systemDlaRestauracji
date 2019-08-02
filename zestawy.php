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
<center><p>Zestawy</p> <br><br>
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
<?php
$link = mysqli_connect('localhost:3306', 'root', '')
or die("Nie można się połączyć");
mysqli_select_db($link, 'pojedzone')
or die ("Nie można wybrać bazy danych");
$sqll="select * from potrawy where kategoria='zestawy'";
setcookie('sqll', serialize($sqll), time()+3600);
$sql_zest1="select * from potrawy where kategoria='zestawy' and nazwa='Zestaw tradycyjny'";
$zaw1=mysqli_query($link, $sql_zest1);
$sql_podstawy1="select * from podstawy where czy_zestaw1=1";
$zaw2=mysqli_query($link, $sql_podstawy1);
$sql_zapychacze1="select * from zapychacze where czy_zestaw1=1";
$zaw3=mysqli_query($link, $sql_zapychacze1);
$sql_surowki1="select * from surowki where czy_zestaw1=1";
$zaw4=mysqli_query($link, $sql_surowki1);
$sql_zest2="select * from potrawy where kategoria='zestawy' and nazwa='Zestaw pieczen i ziemniaczki'";
$zaw5=mysqli_query($link, $sql_zest2);
$sql_podstawy2="select * from podstawy where czy_zestaw2=1";
$zaw6=mysqli_query($link, $sql_podstawy2);
$sql_zapychacze2="select * from zapychacze where czy_zestaw2=1";
$zaw7=mysqli_query($link, $sql_zapychacze2);
$sql_surowki2="select * from surowki where czy_zestaw2=1";
$zaw8=mysqli_query($link, $sql_surowki2);
$sql_zest3="select * from potrawy where kategoria='zestawy' and nazwa='Zestaw z gulaszem'";
$zaw9=mysqli_query($link, $sql_zest3);
$sql_podstawy3="select * from podstawy where czy_zestaw3=1";
$zaw10=mysqli_query($link, $sql_podstawy3);
$sql_zapychacze3="select * from zapychacze where czy_zestaw3=1";
$zaw11=mysqli_query($link, $sql_zapychacze3);
$sql_surowki3="select * from surowki where czy_zestaw3=1";
$zaw12=mysqli_query($link, $sql_surowki3);
$zmienna=null;
while($r = mysqli_fetch_array($zaw1)){
	echo "<br>
	<div id='zestaw'><img src='dane/".$r['zdjecie']."' align='left'>
	<div id='opis_zestawu' align='left'>".$r['nazwa']."
	<br>porcja: ".$r['ilosc']." ".$r['jednostka']." 
	<br>cena: ".$r['cena']."zł<br>
	<form method='get' action='dodaj.php'>
	<input type='hidden' name='id' value='".$r['id_potrawy']."'>
	<input type='hidden' name='cena' value='".$r['cena']."'>
	<input type='hidden' name='pieczywo' value='".$zmienna."'>
	ilość: <select name='ilosc' id='ilosc_porcji'>";
	for($i=1;$i<=20;$i++)
		echo "<option>".$i."</option>";
	echo "</select><br>
	<input type='submit' name='dodaj' value='Dodaj potrawe' id='szukajka'><br>
	Skomponuj po swojemu <br>
	<select name='podstawa' id='skomponuj'>";
	while($s1=mysqli_fetch_array($zaw2)){
	echo "
	<option value='".$s1['id_podstawy']."'>".$s1['nazwa']."</option>";
	}
	echo "</select><br>
	<select name='zapychacz' id='skomponuj'>";
	while($s2=mysqli_fetch_array($zaw3)){
	echo "
	<option value='".$s2['id_zapychacza']."'>".$s2['nazwa']."</option>";
	}
	echo "</select><br>
	<select name='surowka' id='skomponuj'>";
	while($s3=mysqli_fetch_array($zaw4)){
	echo "
	<option value='".$s3['id_surowki']."'>".$s3['nazwa']."</option>";
	}
	echo "</select>
<br>
</form>
</div></div>
";
};
while($r2 = mysqli_fetch_array($zaw5)){
	echo "<br>
	<div id='zestaw'><img src='dane/".$r2['zdjecie']."' align='left'>
	<div id='opis_zestawu' align='left'>".$r2['nazwa']."
	<br>porcja: ".$r2['ilosc']." ".$r2['jednostka']." 
	<br>cena: ".$r2['cena']."zł<br>
	<form method='get' action='dodaj.php'>
	<input type='hidden' name='id' value='".$r2['id_potrawy']."'>
	<input type='hidden' name='cena' value='".$r2['cena']."'>
	<input type='hidden' name='pieczywo' value='".$zmienna."'>
	ilość: <select name='ilosc' id='ilosc_porcji'>";
	for($i=1;$i<=20;$i++)
		echo "<option>".$i."</option>";
	echo "</select><br>
	<input type='submit' name='dodaj' value='Dodaj potrawe' id='szukajka'><br>
	Skomponuj po swojemu <br>
	<select name='podstawa' id='skomponuj'>";
	while($s4=mysqli_fetch_array($zaw6)){
	echo "
	<option value='".$s4['id_podstawy']."'>".$s4['nazwa']."</option>";
	}
	echo "</select><br>
	<select name='zapychacz' id='skomponuj'>";
	while($s5=mysqli_fetch_array($zaw7)){
	echo "
	<option value='".$s5['id_zapychacza']."'>".$s5['nazwa']."</option>";
	}
	echo "</select><br>
	<select name='surowka' id='skomponuj'>";
	while($s6=mysqli_fetch_array($zaw8)){
	echo "
	<option value='".$s6['id_surowki']."'>".$s6['nazwa']."</option>";
	}
	echo "</select>
<br>
</form>
</div></div>
";
};
while($r3 = mysqli_fetch_array($zaw9)){
	echo "<br>
	<div id='zestaw'><img src='dane/".$r3['zdjecie']."' align='left'>
	<div id='opis_zestawu' align='left'>".$r3['nazwa']."
	<br>porcja: ".$r3['ilosc']." ".$r3['jednostka']." 
	<br>cena: ".$r3['cena']."zł<br>
	<form method='get' action='dodaj.php'>
	<input type='hidden' name='id' value='".$r3['id_potrawy']."'>
	<input type='hidden' name='cena' value='".$r3['cena']."'>
	<input type='hidden' name='pieczywo' value='".$zmienna."'>
	ilość: <select name='ilosc' id='ilosc_porcji'>";
	for($i=1;$i<=20;$i++)
		echo "<option>".$i."</option>";
	echo "</select><br>
	<input type='submit' name='dodaj' value='Dodaj potrawe' id='szukajka'><br>
	Skomponuj po swojemu <br>
	<select name='podstawa' id='skomponuj'>";
	while($s7=mysqli_fetch_array($zaw10)){
	echo "
	<option value='".$s7['id_podstawy']."'>".$s7['nazwa']."</option>";
	}
	echo "</select><br>
	<select name='zapychacz' id='skomponuj'>";
	while($s8=mysqli_fetch_array($zaw11)){
	echo "
	<option value='".$s8['id_zapychacza']."'>".$s8['nazwa']."</option>";
	}
	echo "</select><br>
	<select name='surowka' id='skomponuj'>";
	while($s9=mysqli_fetch_array($zaw12)){
	echo "
	<option value='".$s9['id_surowki']."'>".$s9['nazwa']."</option>";
	}
	echo "</select>
<br>
</form>
</div></div>
";
};
mysqli_close($link);
?>

<br>
<a href="index.php"><button value="Wstecz" id="szukajka">Wstecz</button></a>
</center>
</div>
</body>
</html>
