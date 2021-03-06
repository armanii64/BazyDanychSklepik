<?php
	session_start();
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$_SESSION['wyloguj'] = "Wyloguj";
		unset($_SESSION['zaloguj']);
	} else {
		$_SESSION['zaloguj'] = "Zaloguj";
		unset($_SESSION['wyloguj']);
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/koszyk.css">
		<link rel="stylesheet" type="text/css" href="css/hamburger.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="(max-width: 800px">

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<title>Ocena sklepu</title>
</head>
<style>
	.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
</style>

<body>
		 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	 <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<div class="topnav" id="myTopnav">

	   <a href="index.php" class="active">alledrogo</a>
	    
		<?php
						if (isset($_SESSION['zaloguj']))
						{
							echo '<a href="logowanie.php">'.$_SESSION['zaloguj'].'</a>';
						} else{
							echo '<a href="wyloguj.php">'.$_SESSION['wyloguj'].'</a>';
						}
		?>
	    <a href="koszyk.php">Koszyk</a>
		<a href="zamowienia.php">Zamówienia</a>
		<a href="ocena_produktu.php">Oceń produkt</a>
		<a href="ocena_sklepu.php">Oceń sklep</a>
		<a href="profil.php">Ustawienia</a>
		
		<a class="forma">
		  	<form action="wyszukaj.php" method="get" class="form_inline2">
						<input type="text" name="search_input" class="search_input" placeholder="Wyszukaj produkt...">
						<input type="submit" name="search_button" class="search_button" value="SZUKAJ">
			</form>
		</a>
	   
	  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
	    <i class="fa fa-bars"></i>
	  </a>
	</div> 
	
	<!-- GŁÓWNY CONTAINER -->
	<div id="container_koszyk">
		
		<h1>Oceń nas</h1>


		<!-- MIĘSO ARMATNIE -->
		<div id="koszyk_container">
				<div id="informacja1">
					Każda pozostawiona opinia klienta jest dla nas bardzo cenna. <br>
					Dzięki Waszym opiniom stale możemy ulepszać jakość naszych usług.
				</div>
			<br><br>

			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "sklep";
				$conn = new mysqli($servername, $username, $password, $dbname);
				$conn -> query("SET NAMES 'utf8'");
				if ($conn -> connect_error) {die("Nie połączono z bazą danych: " . $conn -> connect_error);}
				$id_klienci = $_SESSION['id_klienci'];
				$_SESSION['juz_oceniono'] = FALSE;
				$sql = "SELECT * FROM opinie WHERE id_klienci=$id_klienci";
				$result = $conn -> query($sql);
				while($row = $result -> fetch_assoc())
				{
					if($row['id_produkty']==0)
					{
						$_SESSION['juz_oceniono'] = TRUE;
					}
				}

				if((isset($_SESSION['juz_oceniono'])) && ($_SESSION['juz_oceniono']==TRUE))
				{
					$sql1 = "SELECT * FROM opinie WHERE id_klienci=$id_klienci and id_produkty=0";
					$result1 = @$conn -> query($sql1);
					if ($result -> num_rows > 0)
					{
						if($row1 = $result1 -> fetch_assoc())
						{
							echo '<h2>Już oceniłeś nasz sklep, dziękujemy!</h2><br>';
							echo '<div id="dziekujemy">Twoja ocena: <b>'.$row1['gwiazdka'].'/5</b><br>';
							echo 'Twoj komentarz: <b>'.$row1['opinia'].'</b></div>';
						}
					}
				}
				else
				{
					echo '<div id="formularz">
							<form action="addingOcena.php" method="post">

								Ocena:<br>
									<div id="gwiazdki">
										<input type="radio" name="ocena" value="5"><img src="images/oceny/gwiazdki5.png" alt="5gwiazdek"><br>
										<input type="radio" name="ocena" value="4"><img src="images/oceny/gwiazdki4.png" alt="4gwiazdek"><br>
										<input type="radio" name="ocena" value="3"><img src="images/oceny/gwiazdki3.png" alt="3gwiazdek"><br>
										<input type="radio" name="ocena" value="2"><img src="images/oceny/gwiazdki2.png" alt="2gwiazdek"><br>
										<input type="radio" name="ocena" value="1"><img src="images/oceny/gwiazdki1.png" alt="1gwiazdek"><br>
									</div>

								<br><span id="koment">Komentarz:</span><br>
								<textarea name="opis" cols="50" rows="3"></textarea><br><br>
								<input name="submit" id="dalej_btn" type=submit value="Dodaj">
							</form>
						</div>';
				}

			?>
		</div>
			<br><br><br><br>
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
	<script>
	/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
	/* to ten słynny hamburger*/
	function myFunction() {
	  var x = document.getElementById("myTopnav");
	  if (x.className === "topnav") {
	    x.className += " responsive";
	  } else {
	    x.className = "topnav";
	  }
	} 
	</script>
	
</body>
</html>
