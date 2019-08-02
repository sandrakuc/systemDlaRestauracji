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
<?php
$link = mysqli_connect('localhost:3306', 'root', '')
or die("Nie można się połączyć");
mysqli_select_db($link, 'pojedzone')
or die ("Nie można wybrać bazy danych");
$sqll="select * from potrawy";
$last_order="select max(id_zamowienia) from zamowienia";
$zaw1=mysqli_query($link, $last_order);
while($r = mysqli_fetch_array($zaw1)){
	setcookie('order', serialize($r['max(id_zamowienia)']), time()+3600);
}
//$order = unserialize($_COOKIE['order']);
//echo $order;
setcookie('sqll', serialize($sqll), time()+3600);
mysqli_close($link);
?>
<center><p>Zapraszamy do złożenia zamówienia!</p> <br><br>
<form action="szukajka2.php" method="get">
<input name="szukajka" value="Szukaj potrawy..." style='width:300px; height: 40px; font-family: "Comic Sans MC", "Comic Sans", cursive; font-size:22px;' />
<input type="submit" name="szukaj" value="Wyszukaj" id="szukajka">
</form>
<form action="flirciara2.php" method="get">
<input type="checkbox" name="filtry[]" value="wegetarianska"/><span id="flirciara">Potrawy wegetariańskie</span><br>
<input type="checkbox" name="filtry[]" value="weganska" /><span id="flirciara">Potrawy wegańskie</span><br>
<input type="checkbox" name="filtry[]" value="bezglutenowa" /><span id="flirciara">Potrawy bezglutenowe</span><br>
<input type="submit" name="filtruj" value="Filtruj" id="szukajka">
</form>
<br>
<a href="zestawy.php"><button><img src="zestawy.jpg"><br>Zestawy</button></a>
<a href="miesne.php"><button><img src="schabowe.jpg"><br>Dania mięsne</button></a>
<a href="jarskie.php"><button><img src="bez_mincha.jpg"><br>Dania jarskie</button></a>
<br>
<a href="gorace.php"><button><img src="kawucha.jpg"><br>Napoje gorące</button></a>
<a href="zimne.php"><button><img src="lemoniada.jpg"><br>Napoje zimne</button></a>
<a href="alko.php"><button><img src="piwero.jpg"><br>Napoje alkoholowe</button></a>
<br>
<a href="zupy.php"><button><img src="zupa.jpg" valign="top"><br>Zupy</button></a>
<a href="desery.php"><button><img src="ciacho.jpg"><br>Desery</button></a>
<br>


</center>
</div>
</body>
</html>
