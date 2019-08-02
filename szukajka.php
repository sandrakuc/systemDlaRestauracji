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
<center><p>Wyniki:</p> <br><br>
<br>
<?php
$link = mysqli_connect('localhost:3306', 'root', '')
or die("Nie można się połączyć");
mysqli_select_db($link, 'pojedzone')
or die ("Nie można wybrać bazy danych");
    $sqll = unserialize($_COOKIE['sqll']);
	$zapytka = $sqll." and nazwa like '%".$_GET['szukajka']."%'";
	$zmienna=null;
	$zaw1=mysqli_query($link, $zapytka);
	if(!($r= mysqli_fetch_array($zaw1))){
		echo "<p class='nonima'> Nie można znaleźć potrawy </p>";
	}
	while($r = mysqli_fetch_array($zaw1)){
		echo "<div id='zestaw'>
		<img src='dane/".$r['zdjecie']."' align='left'>
		<div id='opis_zestawu' class='zobacz' align='left'>
		".$r['nazwa']." <br>
		porcja: ".$r['ilosc']." ".$r['jednostka']." <br>
		cena: ".$r['cena']."zł<br>";
		echo "<form method='get' action='dodaj.php'>
		<input type='hidden' name='id' value='".$r['id_potrawy']."'>
		<input type='hidden' name='cena' value='".$r['cena']."'>
		ilość: <select name='ilosc' id='ilosc_porcji'>";
		for($i=1;$i<=20;$i++)
			echo "<option>".$i."</option>";
		echo "</select><br>
		<input type='submit' name='dodaj' value='Dodaj potrawe' id='szukajka'><br>";
		if($r['kategoria']=='Zestawy'){
		echo "<input type='hidden' value='".$zmienna."' name='pieczywo'>";
			if($r['zdjecie']=="zestaw_1.jpg"){
				$anypodst=mysqli_query($link, "SELECT * FROM podstawy WHERE czy_zestaw1='1'");
				$anysur=mysqli_query($link, "SELECT * FROM surowki WHERE czy_zestaw1='1'");
				$anyzap=mysqli_query($link, "SELECT * FROM zapychacze WHERE czy_zestaw1='1'");
				
			}
			if($r['zdjecie']=="zestaw_2.jpg"){
				$anypodst=mysqli_query($link, "SELECT * FROM podstawy WHERE czy_zestaw2='1'");
				$anysur=mysqli_query($link, "SELECT * FROM surowki WHERE czy_zestaw2='1'");
				$anyzap=mysqli_query($link, "SELECT * FROM zapychacze WHERE czy_zestaw2='1'");
			}
			if($r['zdjecie']=="zestaw_3.jpg"){
				$anypodst=mysqli_query($link, "SELECT * FROM podstawy WHERE czy_zestaw3='1'");
				$anysur=mysqli_query($link, "SELECT * FROM surowki WHERE czy_zestaw3='1'");
				$anyzap=mysqli_query($link, "SELECT * FROM zapychacze WHERE czy_zestaw3='1'");
			}
			echo "<select name=podstawa id='skomponuj'>";
			while($apodst=mysqli_fetch_array($anypodst)){
			echo "<option value='".$apodst['id_podstawy']."'>".$apodst['nazwa']."</option>";
			}
			echo "</select><br>";
			echo "<select name=zapychacz id='skomponuj'>";
			while($azap=mysqli_fetch_array($anyzap)){
			echo "<option value='".$azap['id_zapychacza']."'>".$azap['nazwa']."</option>";
			}
			echo "</select><br>";
			echo "<select name=surowka id='skomponuj'>";
			while($asur=mysqli_fetch_array($anysur)){
			echo "<option value='".$asur['id_surowki']."'>".$asur['nazwa']."</option>";
			}
			echo "</select><br>";
			echo "<br>";		
		}
		else if($r['kategoria']=='Zupy'){
			$anypiecz=mysqli_query($link, "SELECT * FROM pieczywo");
			echo "<select name=pieczywo id='skomponuj'>";
			while($apiecz=mysqli_fetch_array($anypiecz)){
			echo "<option value='".$apiecz['id_pieczywa']."'>".$apiecz['nazwa']."</option>";
			}
			echo "<option value='".$zmienna."'";
			echo ">Brak</option>
			</select><br><span id='skomponuj'><br><span id='skomponuj'><br><span id='skomponuj'><br>
			<input type='hidden' value='".$zmienna."' name='podstawa'>
			<input type='hidden' value='".$zmienna."' name='zapychacz'>
			<input type='hidden' value='".$zmienna."' name='surowka'>";		
		}
		else{
			echo "<input type='hidden' value='".$zmienna."' name='pieczywo'>
			<input type='hidden' value='".$zmienna."' name='podstawa'>
			<input type='hidden' value='".$zmienna."' name='zapychacz'>
			<input type='hidden' value='".$zmienna."' name='surowka'>
			<br><input style='visibility: hidden;' id='skomponuj'></input><br><input type='hidden' id='skomponuj'></input><br><input type='hidden' id='skomponuj'></input><br>";
		}
		echo "</form>
			</div></div>";
	};
mysqli_close($link);
?>
<br>
<a href="javascript:history.back()"><button value="Wstecz" id="szukajka">Wstecz</button></a>
</center>
</div>
</body>
</html>
