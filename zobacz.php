<! DOCTYPE html>
<html lang ="pl-PL">
<head>
<meta charset="UTF-8">
<meta name="Refresh" content="no-cache"; url="zobacz.php">
<link rel="stylesheet" type="text/css" href="style.css"/>
<title>Bar Pojedzone</title>
</head>
<body>
<?php
echo "<div id='logo'>
<br>
<center><a href='index.php'><button><img src='logo.png'></img></button></a>
<br>
<br>
<form method='get' action='zatwierdz.php'>
<input type='submit' id='z2' value='Zatwierdź i zapłać'></center><br>
</div>
<div id='glowna'>
<center>
<br><br>";

$link = mysqli_connect('localhost:3306', 'root', '')
or die("Nie można się połączyć");
mysqli_select_db($link, 'pojedzone')
or die ("Nie można wybrać bazy danych");
$sqll="select * from potrawy";
setcookie('sqll', serialize($sqll), time()+3600);
$zmienna=null;
$order = unserialize($_COOKIE['order']);
$zestawy=mysqli_query($link, "SELECT zam_zest.id, skomponowane_zestawy.id_zestawu, id_potrawy, id_pieczywa, id_podstawy, id_surowki, id_zapychacza, ilosc, cena FROM zam_zest, skomponowane_zestawy WHERE zam_zest.id_zamowienia='".$order."' AND zam_zest.id_zestawu=skomponowane_zestawy.id_zestawu");
$kwota=mysqli_query($link, "SELECT sum(skomponowane_zestawy.cena) 
FROM zam_zest, skomponowane_zestawy 
WHERE zam_zest.id_zamowienia='".$order."' 
AND skomponowane_zestawy.id_zestawu=zam_zest.id_zestawu");
$cena=mysqli_fetch_array($kwota);
echo "
<input type='hidden' name='kwota' value='".$cena['sum(skomponowane_zestawy.cena)']."'>
</form>
<p>Oto Twoje zamowienie!</p> <br><br>
		<p>Razem ".$cena['sum(skomponowane_zestawy.cena)']." zł</p><br><br>";
$i=1;
while($r=mysqli_fetch_array($zestawy)){
	$zobacz=mysqli_query($link, "SELECT * FROM potrawy WHERE id_potrawy='".$r['id_potrawy']."'");
	while($s=mysqli_fetch_array($zobacz)){
		echo "<div id='zestaw'><img src='dane/".$s['zdjecie']."' align='left'>
		<div id='opis_zestawu' class='zobacz' align='left'>
		".$s['nazwa']."
		<br>porcja: ".$s['ilosc']." ".$s['jednostka']." 
		<br>cena: ".$s['cena']." zł<br>
		<form method='get' action='edytuj.php'>
		<input type='hidden' value='".$r['id_zestawu']."' name='zestaw'>
		<input type='hidden' value='".$s['cena']."' name='cena'>
		ilość: <select name='ilosc' id='ilosc_porcji'><br>";
		for($j=1;$j<=20;$j++){
			echo "<option";
			if($r['ilosc']==$j){
				echo " selected='selected'";
			}
			echo ">".$j."</option>";
		}
		echo "</select><br>";
		echo "<input type='submit' name='edytuj' value='Zatwierdź edycję' id='szukajka'><br><input style='visibility: hidden;' id='skomponuj'><br><input style='visibility: hidden;' id='skomponuj'><br>";
		if($s['kategoria']=='Zupy'){
			$p=mysqli_query($link, "SELECT * FROM pieczywo WHERE id_pieczywa='".$r['id_pieczywa']."'");
			$pieczywo=mysqli_fetch_array($p);
			$anypiecz=mysqli_query($link, "SELECT * FROM pieczywo");
			echo "<select name=pieczywo id='skomponuj'>";
			while($apiecz=mysqli_fetch_array($anypiecz)){
			echo "<option value='".$apiecz['id_pieczywa']."'";
			if($pieczywo['id_pieczywa']==$apiecz['id_pieczywa']) 
				echo "selected='selected'";
			echo ">".$apiecz['nazwa']."</option>";
			}
			echo "<option value='".$zmienna."'";
			if($pieczywo['id_pieczywa']==null)
				echo "selected='selected'";
			echo ">Brak</option>
			</select><br><span id='skomponuj'><br><span id='skomponuj'><br><span id='skomponuj'><br>
			<input type='hidden' value='".$zmienna."' name='podstawa'>
			<input type='hidden' value='".$zmienna."' name='zapychacz'>
			<input type='hidden' value='".$zmienna."' name='surowka'>";
			
		}
		else if($s['kategoria']=='Zestawy'){
			echo "<input type='hidden' value='".$zmienna."' name='pieczywo'>";
			$pods=mysqli_query($link, "SELECT * FROM podstawy WHERE id_podstawy='".$r['id_podstawy']."'");
			$podstawa=mysqli_fetch_array($pods);
			if($s['zdjecie']=="zestaw_1.jpg"){
				$anypodst=mysqli_query($link, "SELECT * FROM podstawy WHERE czy_zestaw1='1'");
				$anysur=mysqli_query($link, "SELECT * FROM surowki WHERE czy_zestaw1='1'");
				$anyzap=mysqli_query($link, "SELECT * FROM zapychacze WHERE czy_zestaw1='1'");
				
			}
			if($s['zdjecie']=="zestaw_2.jpg"){
				$anypodst=mysqli_query($link, "SELECT * FROM podstawy WHERE czy_zestaw2='1'");
				$anysur=mysqli_query($link, "SELECT * FROM surowki WHERE czy_zestaw2='1'");
				$anyzap=mysqli_query($link, "SELECT * FROM zapychacze WHERE czy_zestaw2='1'");
			}
			if($s['zdjecie']=="zestaw_3.jpg"){
				$anypodst=mysqli_query($link, "SELECT * FROM podstawy WHERE czy_zestaw3='1'");
				$anysur=mysqli_query($link, "SELECT * FROM surowki WHERE czy_zestaw3='1'");
				$anyzap=mysqli_query($link, "SELECT * FROM zapychacze WHERE czy_zestaw3='1'");
			}
			echo "<select name=podstawa id='skomponuj'>";
			while($apodst=mysqli_fetch_array($anypodst)){
			echo "<option value='".$apodst['id_podstawy']."'";
			if($podstawa['id_podstawy']==$apodst['id_podstawy']) 
				echo "selected='selected'";
			echo ">".$apodst['nazwa']."</option>";
			}
			echo "</select><br>";
			$zap=mysqli_query($link, "SELECT * FROM zapychacze WHERE id_zapychacza='".$r['id_zapychacza']."'");
			$zapychacz=mysqli_fetch_array($zap);
			echo "<select name=zapychacz id='skomponuj'>";
			while($azap=mysqli_fetch_array($anyzap)){
			echo "<option value='".$azap['id_zapychacza']."'";
			if($zapychacz['id_zapychacza']==$azap['id_zapychacza']) 
				echo "selected='selected'";
			echo ">".$azap['nazwa']."</option>";
			}
			echo "</select><br>";
			$sur=mysqli_query($link, "SELECT * FROM surowki WHERE id_surowki='".$r['id_surowki']."'");
			$surowka=mysqli_fetch_array($sur);
			echo "<select name=surowka id='skomponuj'>";
			while($asur=mysqli_fetch_array($anysur)){
			echo "<option value='".$asur['id_surowki']."'";
			if($surowka['id_surowki']==$asur['id_surowki']) 
				echo "selected='selected'";
			echo ">".$asur['nazwa']."</option>";
			}
			echo "</select><br>";
		}
		else{
		echo "
		<input type='hidden' value='".$zmienna."' name='pieczywo'>
		<input type='hidden' value='".$zmienna."' name='podstawa'>
		<input type='hidden' value='".$zmienna."' name='zapychacz'>
		<input type='hidden' value='".$zmienna."' name='surowka'>
		<br><input style='visibility: hidden;' id='skomponuj'></input><br><input type='hidden' id='skomponuj'></input><br><input type='hidden' id='skomponuj'></input>";
		}
		echo "</form>
		<form method='get' action='usun.php'>
		<input type='hidden' value='".$r['id']."' name='zam_zest'>
		<input type='hidden' value='".$r['id_zestawu']."' name='zestaw'>
		<input type='submit' name='usun' value='Usun potrawe' id='zakoncz'></form><br></span>
		</div></div>";
	}
}
mysqli_close($link);
?>
<center>
<a href="index.php"><button value="Wstecz" id="szukajka" align="center">Wyjdź z koszyka</button></a>
</center>
</div>
</body>
</html>