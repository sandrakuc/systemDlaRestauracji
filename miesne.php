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
<center><p>Dania mięsne</p> <br><br>
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
$sqll="select * from potrawy where kategoria='Dania miesne'";
setcookie('sqll', serialize($sqll), time()+3600);
mysqli_close($link);
?>
<br>
<a href="pierogi_miesne.php"><button><img src="podkategorie/pierogi_miesne.jpg"><br>Pierogi</button></a>
<a href="makarony_miesne.php"><button><img src="podkategorie/makarony_miesne.jpg"><br>Makarony</button></a>
<a href="inne_miesne.php"><button><img src="podkategorie/inne_miesne.jpg"><br>Inne potrawy</button></a>
<br>
<a href="index.php"><button value="Wstecz" id="szukajka">Wstecz</button></a>
</center>
</div>
</body>
</html>