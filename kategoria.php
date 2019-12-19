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
	<link rel="stylesheet" type="text/css" href="css/kategoria.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Kategorie</title>
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
	<div id="container_produkt">
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

		<!-- MIĘSO ARMATNIE -->
		<div id="main">
			<?php
				Show_products();
			?>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
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

	//Function to show products in categories
	function Show_products()
	{	
		if($_GET['id_kategorie']==0)
		{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "sklep";
			$conn = new mysqli($servername, $username, $password, $dbname);
			$conn -> query("SET NAMES 'utf8'");
			if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}

			// ilośc wyswietlanych produktów na stronę
			$amout = 5;
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
			$start_from = ($page-1) * $amout;
			echo '<h1>Wszystkie produkty</h1>';
			$sql = "SELECT id_produkty, nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie, dostawa FROM produkty ORDER BY id_produkty ASC LIMIT $start_from, ".$amout;
			$result = $conn -> query($sql);
			if ($result -> num_rows > 0)
			{
		 		while($row = $result -> fetch_assoc())
		 		{
		 			//oferta dnia
					$sql_oferta_dnia = "SELECT poprzednia, id_produkty, data FROM oferta_dnia WHERE id_produkty=".$row["id_produkty"];
					$result_oferta = $conn -> query($sql_oferta_dnia);
					if ($result_oferta -> num_rows > 0)
					{
						while($row_oferta = $result_oferta -> fetch_assoc())
		 				{
				       		echo '<a href="produkt.php?id_produkty='.$row["id_produkty"].'" id="product_link"><div class="product_kat oferta_dnia">
					       		<div id="zdjecie"><img src="images/products/'.$row["zdjecie"].'" width="200" height="200" alt="product.png"></div>
					       		<div class="zawartosc">
					       			<table id="tabela">
							       		<tr>
							       			<th colspan="2"><div class="nazwa"><b>'.$row["nazwa"].'</b></div></th>
							       			<th><div id="stara_cena">Stara cena: <s>'.$row_oferta['poprzednia'].' PLN</s></div><br><div id="cena">Cena po rabacie: '.$row["cena"].' PLN<span id="gwiazdka">*</span></b></div><br>
							       			*Oferta ważna do '.substr($row_oferta['data'], 0,10).' lub do wyczerpania zapasów</th>
							       		</tr>
							       		<tr>
								       		<td><div class="rozmiar">Rozmiar: ';
								       		if(is_null($row["rozmiar"]))
								       		{
								       			echo 'Nie dotyczy';
								       		}else echo $row["rozmiar"];
								       		echo '</div></td>
								       		<td><div class="producent">Producent: '.$row['producent'].'</div></td>
								       		<td><span style="color:green;font-style:normal;">Dostawa: '.$row['dostawa'].' PLN</span></td>
							       		</tr>
						       		</table>
					       		</div>
			       			</div><a>';
				       	}
			       	}
			       	else
			       	{
			       		echo '<a href="produkt.php?id_produkty='.$row["id_produkty"].'" id="product_link"><div class="product_kat">
						       		<div id="zdjecie"><img src="images/products/'.$row["zdjecie"].'" width="200" height="200" alt="product.png"></div>
						       		<div class="zawartosc">
						       			<table id="tabela">
								       		<tr>
								       			<th colspan="2"><div class="nazwa"><b>'.$row["nazwa"].'</b></div></th>
								       			<th><div id="cena">Cena: '.$row["cena"].' PLN</b></div></th>
								       		</tr>
								       		<tr>
									       		<td><div class="rozmiar">Rozmiar: ';
									       		if(is_null($row["rozmiar"]))
									       		{
									       			echo 'Nie dotyczy';
									       		}else echo $row["rozmiar"];
									       		echo '</div></td>
									       		<td><div class="producent">Producent: '.$row['producent'].'</div></td>
									       		<td><span style="color:green;font-style:normal;">Dostawa: '.$row['dostawa'].' PLN</span></td>
								       		</tr>
							       		</table>
						       		</div>
				       			</div><a>';
			       	}
				}

				echo "<br><br><br><br>";
				$sql5 = "SELECT COUNT(id_produkty) AS total FROM produkty";
				$result5 = $conn->query($sql5);
				$row5 = $result5 -> fetch_assoc();
				$total_pages = ceil($row5["total"] / $amout);
				for ($i=1; $i<=$total_pages; $i++)
				{ 
					echo "<div class='strona'><a href='kategoria.php?id_kategorie=0&page=".$i."'>".$i."</a></div>";
				}

			} else { echo "Brak produktów we wszystkich kategoriach"; }
		}
		else
		{
			$id_kategorie = $_GET['id_kategorie'];
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "sklep";
			$conn = new mysqli($servername, $username, $password, $dbname);
			$conn -> query("SET NAMES 'utf8'");
			if ($conn -> connect_error) { die("Nie połączono z bazą danych: " . $conn -> connect_error);}


			// ilośc wyswietlanych produktów na stronę
			$amout = 5;
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
			$start_from = ($page-1) * $amout;

			$sql = "SELECT id_produkty, nazwa, opis, opinie_klientow, cena, dostepna_ilosc, producent, rozmiar, zdjecie, dostawa FROM produkty WHERE id_kategorie=$id_kategorie ORDER BY id_produkty ASC LIMIT $start_from, ".$amout;
			$sql1 = "SELECT id_kategorie, kategoria FROM kategorie WHERE id_kategorie=$id_kategorie";
			$result = $conn -> query($sql);
			$result1 = $conn -> query($sql1);
			$row1 = $result1 -> fetch_assoc();





			echo '<h1>'.$row1['kategoria'].'</h1>';
			if ($result -> num_rows > 0)
			{
		 		while($row = $result -> fetch_assoc())
		 		{
		 			//oferta dnia
					$sql_oferta_dnia = "SELECT poprzednia, id_produkty, data FROM oferta_dnia WHERE id_produkty=".$row["id_produkty"];
					$result_oferta = $conn -> query($sql_oferta_dnia);
					if ($result_oferta -> num_rows > 0)
					{
						while($row_oferta = $result_oferta -> fetch_assoc())
		 				{
							echo '<a href="produkt.php?id_produkty='.$row["id_produkty"].'" id="product_link"><div class="product_kat oferta_dnia">
					       		<div id="zdjecie"><img src="images/products/'.$row["zdjecie"].'" width="200" height="200" alt="product.png"></div>
					       		<div class="zawartosc">
					       			<table id="tabela">
							       		<tr>
							       			<th colspan="2"><div class="nazwa"><b>'.$row["nazwa"].'</b></div></th>
							       			<th><div id="stara_cena">Stara cena: <s>'.$row_oferta['poprzednia'].' PLN</s></div><br><div id="cena">Cena po rabacie: '.$row["cena"].' PLN<span id="gwiazdka">*</span></b></div><br>
							       			*Oferta ważna do '.substr($row_oferta['data'], 0,10).' lub do wyczerpania zapasów</th>
							       		</tr>
							       		<tr>
								       		<td><div class="rozmiar">Rozmiar: ';
								       		if(is_null($row["rozmiar"]))
								       		{
								       			echo 'Nie dotyczy';
								       		}else echo $row["rozmiar"];
								       		echo '</div></td>
								       		<td><div class="producent">Producent: '.$row['producent'].'</div></td>
								       		<td><span style="color:green;font-style:normal;">Dostawa: '.$row['dostawa'].' PLN</span></td>
							       		</tr>
						       		</table>
					       		</div>
			       			</div><a>';
			       		}
					}
					else
					{
						echo '<a href="produkt.php?id_produkty='.$row["id_produkty"].'" id="product_link"><div class="product_kat">
					       		<div id="zdjecie"><img src="images/products/'.$row["zdjecie"].'" width="200" height="200" alt="product.png"></div>
					       		<div class="zawartosc">
					       			<table id="tabela">
							       		<tr>
							       			<th colspan="2"><div class="nazwa"><b>'.$row["nazwa"].'</b></div></th>
							       			<th><div id="cena">Cena: '.$row["cena"].' PLN</b></div></th>
							       		</tr>
							       		<tr>
								       		<td><div class="rozmiar">Rozmiar: ';
								       		if(is_null($row["rozmiar"]))
								       		{
								       			echo 'Nie dotyczy';
								       		}else echo $row["rozmiar"];
								       		echo '</div></td>
								       		<td><div class="producent">Producent: '.$row['producent'].'</div></td>
								       		<td><span style="color:green;font-style:normal;">Dostawa: '.$row['dostawa'].' PLN</span></td>
							       		</tr>
						       		</table>
					       		</div>
			       			</div><a>';
					}

		       		
				}

				echo "<br><br><br><br>";
				$sql5 = "SELECT COUNT(id_produkty) AS total FROM produkty WHERE id_kategorie=$id_kategorie";
				$result5 = $conn->query($sql5);
				$row5 = $result5 -> fetch_assoc();
				$total_pages = ceil($row5["total"] / $amout);
				if($total_pages>1)
				{
					for ($i=1; $i<=$total_pages; $i++)
					{ 
						echo "<div class='strona'><a href='kategoria.php?id_kategorie=".$id_kategorie."&page=".$i."'>".$i."</a></div>";
					}
				}

			} else { echo "Brak produktów w podanej kategorii"; }
		}
	}
?>
