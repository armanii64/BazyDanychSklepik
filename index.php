<?php
	session_start();
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$_SESSION['wyloguj'] = "Wyloguj";
		unset($_SESSION['zaloguj']);
	} else {
		$_SESSION['zaloguj'] = "Zaloguj";
		unset($_SESSION['wyloguj']);
	}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Alledrogo</title>
</head>

<body>
	<!-- STICKY MENU -->
	<div id="sticky_menu">
		<ol>
			<!-- logo alledrogo -->
			<li>
				<a href="index.php">
					<img src="images/logo.png" alt="logo" class="nav_img">
				</a>
			</li>

			<!-- wyszukiwanie -->
			<form action="wyszukaj.php" method="get" class="form_inline">
				<li>
					<input type="text" name="search_input" class="search_input" placeholder="Wyszukaj produkt...">
				</li>

				<li>
					<input style="display: inline;" type="submit" name="search_button" class="search_button" value="SZUKAJ">
				</li>
			</form>

			<!-- koszyk -->
			<li>
				<a href="koszyk.php">
					<span class="koszyk">
						<i class="fas fa-shopping-cart"></i>
					</span>
				</a>
			</li>

			<!-- DROPDOWN BUTTON -->
			<div class="dropdown">
				<span id="myBtn" class="dropbtn">Witaj, 
					<?php 
					if (isset($_SESSION['wyloguj']))
						{
							echo $_SESSION['imie'];
						} else {
							echo "zaloguj się";
						}
					?> 

					<div id="p1">
						<i class="fas fa-angle-down"></i>
					</div>
				</span>

				<!-- DROPDOWN CONTENT -->
	  			<div id="myDropdown" class="dropdown-content">
		    		<a href="zamowienia.php">Zamówienia</a>
					<a href="ocena_produktu.php">Oceń produkt</a>
					<a href="ocena_sklepu.php">Oceń sklep</a>
					<a href="profil.php">Ustawienia</a>
					<?php
						if (isset($_SESSION['zaloguj']))
						{
							echo '<a href="logowanie.php">'.$_SESSION['zaloguj'].'</a>';
						} else{
							echo '<a href="wyloguj.php">'.$_SESSION['wyloguj'].'</a>';
						}
					?>
	  			</div>
			</div>
		</ol>
	</div>
	
	<!-- GŁÓWNY CONTAINER -->
	<div id="container">

		<!-- MIĘSO ARMATNIE -->
		<div id="main">
			
			<!-- KATEGORIE -->
			<div id="categories">
				<br>

				<span class="kat"><b>Kategorie:</b></span>
				<br><br>
				<a href="kategoria.php?id_kategorie=1">Koszulki</a><br>
				<a href="kategoria.php?id_kategorie=2">Spodnie</a><br>
				<a href="kategoria.php?id_kategorie=3">Kubki</a><br>
				<a href="kategoria.php?id_kategorie=4">Długopisy</a><br>
				<a href="kategoria.php?id_kategorie=5">Bluzy</a><br>
				<a href="kategoria.php?id_kategorie=6">Naklejki</a><br>
				<a href="kategoria.php?id_kategorie=7">Ramki</a><br>
				<a href="kategoria.php?id_kategorie=8">RTV</a><br>
				<a href="kategoria.php?id_kategorie=9">AGD</a><br>
				<a href="kategoria.php?id_kategorie=10">Alkohol</a><br>
				<a href="kategoria.php?id_kategorie=11">Zabawki</a><br>
				<a href="kategoria.php?id_kategorie=0">Wszystko</a><br>

			</div>

			<br>

			<!-- SLIDER Z OFERTAMI -->
			<div class="daily_offers" id="offers1">
			<i class="fas fa-arrow-left" id="prevBtn"></i>
			<i class="fas fa-arrow-right" id="nextBtn"></i>
				<div class="slider">

					<img src="images/banners/promocja_swieta.png" id="lastClone" alt="" height="100%" width="100%">
					<img src="images/banners/black_friday.png" alt="" height="100%" width="100%">
					<img src="images/banners/darmowa_dostawa.png" alt="" height="100%" width="100%">
					<img src="images/banners/rabat_rtv.png" alt="" height="100%" width="100%">
					<img src="images/banners/promocja_swieta.png" alt="" height="100%" width="100%">
					<img src="images/banners/black_friday.png" id="firstClone" alt="" height="100%" width="100%">
				
				</div>
			</div>


			<br><br><br>
			<h1>WYRÓŻNIONE PRODUKTY:</h1>

			<!-- PRODUKTY NA GŁÓWNEJ -->
			<div id="products">
				<br>

				<a href="produkt.php?id_produkty=12"><div class="product"><?php Show_product(12);?></div></a>
				<a href="produkt.php?id_produkty=14"><div class="product"><?php Show_product(14);?></div></a>
				<a href="produkt.php?id_produkty=8"><div class="product"><?php Show_product(8);?></div></a>
				<a href="produkt.php?id_produkty=15"><div class="product"><?php Show_product(15);?></div></a>
				<a href="produkt.php?id_produkty=16"><div class="product"><?php Show_product(16);?></div></a>
				<a href="produkt.php?id_produkty=17"><div class="product"><?php Show_product(17);?></div></a>

			</div>

			<div id="why_us">
				<br><br>
				<h1>Dlaczego warto nam zaufać?</h1>

				<div class="why_us_content">
					<h3>Gwarancja jakości</h3>
					<br>
					Nasze produkty są bardzo dobre jakościowo, wykonane z dbałością o każdy szczegół. Podczas produkcji działamy zgodnie z ekologią. Robiąc u nas zakupy masz pewność, że zamówione produkty będą Ci służyły bardzo długo.
					<br><br>
					<img src="images/quality.png" alt="jakosc" height="35%" width="35%">
				</div>

				<div class="why_us_content">
					<h3>Darmowe zwroty do 14 dni</h3>
					<br>
					Nasza strona oferuje możliwość zwrotu zakupionego produktu do 14 dni od momentu otrzymania towaru bez potrzeby podania przyczyny zwrotu! Zwrot jest całkowicie darmowy, przesyłkę zwrotną pokrywamy my!
					<br><br>
					<img src="images/zwrot.png" alt="zwrot" height="35%" width="45%">
				</div>

				<div class="why_us_content">
					<h3>Opinie klientów</h3>
					<br>
					Jeśli jeszcze masz wątpliwości, zajrzyj do opinii naszych klientów, którzy zakupili już nasze produkty. Obiektywne opinie z pewnością pomogą Ci w podjęciu decyzji o opłacalności danych produktów. Dzięki opiniom jesteśmy w stanie dla Was stale ulepszać nasze produkty.
					<br><br>
					<img src="images/opinie.png" alt="zwrot" height="30%" width="75%">
				</div>
			</div>

			<div id="comentaries">
				<?php
					Show_opinion(5);
					Show_opinion(2);
					Show_opinion(4);
				?> 
			</div>
		</div>

		

	</div>

    <div id="centeredmenu">
	   <ul>
	      <li><a href="FAQ.php">FAQ</a></li>
	      <li><a href="kontakt.php">Kontakt</a></li>
	      <li><a href="regulamin.php">Regulamin</a></li>
	   </ul>
	</div>

	<div id="footer">
		Korzystanie z serwisu oznacza akceptację
		<a href="regulamin.php">
			regulaminu
		</a>
	</div>

	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<!-- STICKY MENU JS-->
	<script src="js/sticky_menu.js"></script>
	<!-- STICKY MENU WITAJ ZALOGUJ SIĘ JS-->
	<script src="js/dropdown_sticky.js"></script>
	<!-- SLIDER JS-->
	<script src="js/slider.js"></script>
	
</body>
</html>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sklep";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn -> query("SET NAMES 'utf8'");
	// Check connection
	if ($conn -> connect_error) {
		    die("Nie połączono z bazą danych: " . $conn -> connect_error);
		}

	$sql = "SELECT nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie FROM produkty";
	$sql1 = "SELECT * FROM opinie";
	$result = $conn -> query($sql);
	$result1 = $conn -> query($sql1);

	//Function to show product on main site
	function Show_product($id)
	{	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");
		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}

		$sql = "SELECT nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie FROM produkty WHERE id_produkty = $id";
		$result = $conn -> query($sql);
		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{
	       		echo '<img src="images/products/'.$row["zdjecie"].'" width="150" height="150" alt="product.png"><br>'.$row["nazwa"]." ".$row["rozmiar"].'<br><span style="color:#FF5A00"><b>KUP TERAZ: '.$row["cena"]." PLN</b></span>";
			}
		} else { echo "No results"; }
	}
	
	
	function Show_opinion($id)
	{	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sklep";
		require_once "connect.php";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn -> query("SET NAMES 'utf8'");

		if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}
		$sql = "SELECT id_opinie, id_produkty, id_klienci, gwiazdka, opinia FROM opinie WHERE id_opinie = $id";
		$result = $conn -> query($sql);
		if ($result -> num_rows > 0)
		{
	 		while($row = $result -> fetch_assoc())
	 		{
	       		echo '<img src="images/ocena.png"> Komentarz po zakupie: "'.$row["opinia"];
			}
		} else { echo "No results"; }
	}
?> 