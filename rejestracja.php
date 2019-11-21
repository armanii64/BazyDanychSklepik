<?php
session_start();

if (isset($_POST['email']))
{
	//udała sie walidacja
	$wszystko_OK=true;
	
	//poprawnosc imienia
	$imie = $_POST['imie'];
	$sprawdz = '/^[A-ZŁŚ]{1}+[a-ząęółśżźćń]+$/';
	if(!(preg_match($sprawdz, $imie)))
	{
		$wszystko_OK=false;
		$_SESSION['e_imie']="Podaj poprawne imie";
	}

	if(empty($_POST['imie']))
	{
		$wszystko_OK=false;
		$_SESSION['e_imie']="Musisz wypełnić wszystkie pola";
	}

	//poprawnosc nazwiska
	$nazwisko = $_POST['nazwisko'];
	if(!(preg_match($sprawdz, $nazwisko)))
	{
		$wszystko_OK=false;
		$_SESSION['e_nazwisko']="Podaj poprawne nazwisko";
	}

	if(empty($_POST['nazwisko']))
	{
		$wszystko_OK=false;
		$_SESSION['e_nazwisko']="Musisz wypełnić wszystkie pola";
	}
	
	//poprawnosc emailu
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
	{
		$wszystko_OK=false;
		$_SESSION['e_email']="Podaj właściwy email";
	}
	
	//poprawnosc hasla
	$haslo1 = $_POST['haslo1'];
	$haslo2 = $_POST['haslo2'];
	
	//dlugosc hasla
	if((strlen($haslo1)<5) || (strlen($haslo1)>20))
	{
		$wszystko_OK=false;
		$_SESSION['e_haslo']="Haslo musi miec dlugosc od 5 do 20 znaków";
	}
	
	if($haslo1!=$haslo2)
	{
		$wszystko_OK=false;
		$_SESSION['e_haslo']="Podane hasła różnią się";
	}
	
	$haslo_hash = md5($haslo1);
	
	// akceptacja regulaminu
	if(!isset($_POST['regulamin']))
	{
		$wszystko_OK=false;
		$_SESSION['e_regulamin']="Nie zapoznaleś sie z regulaminem. Przeczytaj go!";
	}
	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if($polaczenie->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			//czy email juz istnieje
			$rezultat = $polaczenie->query("SELECT id_klienci FROM klienci WHERE 'email'='$email'");
			
			if(!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_takich_maili = $rezultat->num_rows;
			if($ile_takich_maili>0)
			{
				$wszystko_OK=false;
				$_SESSION['e_email']="Ten adres email jest już używany";
			}
	
		if($wszystko_OK==true)
		{
			//wszystko dobrze user dodany
			if($polaczenie->query("INSERT INTO klienci(Imie, Nazwisko, haslo, email) VALUES ('$imie', '$nazwisko' ,'$haslo_hash','$email')"))
			{
				unset($_POST['imie']);
				unset($_POST['nazwisko']);
				unset($_POST['haslo1']);
				unset($_POST['haslo2']);
				unset($_POST['email']);
				$_SESSION['udanarejestracja']=true;
				header('Location: witamy.php');
			}
			else
			{
				throw new Exception($polaczenie->error);
			}
		}		
			$polaczenie->close();
		}
	}

	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Zarejestruj sie później!</span>';
		echo'<br /> Informacja deweloperska: ' .$e;
	}
}

?>

<!DOCTYPE html>
<head lang="pl">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title> Zarejestruj sie! </title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
	<style>
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>

<body>
	<!-- logo alledrogo -->
	<div id="sticky_menu">
		<ol>
				
			<li>
				<a href="#">
					<img src="images/logo.png" alt="logo" class="nav_img">
				</a>
			</li>
		</ol>
	</div>




												<!--Główny Container----->
	

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
<!-----------------------------------------XDDDDDD dalej nie wiem jak to przeniesc---->

	<link rel="stylesheet" href="rejestracja.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


<!-------------------------------------------Tu sie kończy mój wstyd---------->

	<div class="login-popup-wrap new_login_popup"> 
	
		<div id="container">
			<form method="post">
		<div class="login-popup-heading text-center">
            <h4><i class="fa fa-lock" aria-hidden="true"></i> Rejestracja </h4>                        
        </div>
<div class="form-group">        
	Imię: <br/> <input type="text" class="form-control name="imie" /><br/><br>
	</div>
	<?php
		if (isset($_SESSION['e_imie']))
		{
			echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
			unset($_SESSION['e_imie']);
		}
	?>

<div class="form-group">
	Nazwisko: <br/> <input type="text" class="form-control name="nazwisko" /><br/><br>
	</div>
	<?php
		if (isset($_SESSION['e_nazwisko']))
		{
			echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
			unset($_SESSION['e_nazwisko']);
		}
	?>
	
<div class="form-group">
	E-mail: <br/> <input type="text" class="form-control name="email" /><br/><br>
	</div>
	<?php
		if (isset($_SESSION['e_email']))
		{
			echo '<div class="error">'.$_SESSION['e_email'].'</div>';
			unset($_SESSION['e_email']);
		}
	?>
	
<div class="form-group">	
	Hasło: <br/> <input type="password" class="form-control name="haslo1" /><br/><br>
	</div>
	<?php
		if (isset($_SESSION['e_haslo']))
		{
			echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
			unset($_SESSION['e_haslo']);
		}
	?>
	
<div class="form-group">	
	Powtórz hasło: <br/> <input type="password" class="form-control name="haslo2" /><br/><br>
	</div>
	

	<label>
		<input type="checkbox" name="regulamin" /> Akceptuje regulamin
	</label><br/> 

	<?php
		if (isset($_SESSION['e_regulamin']))
		{
			echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
			unset($_SESSION['e_regulamin']);
		}
	?>
	<br>
	
	<div class="g-recaptcha" data-sitekey="6LcT1F4UAAAAAGhKBCSu8JukWJgqkha5AXA-HL6k"></div>
	
	<?php
		if (isset($_SESSION['e_bot']))
		{
			echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
			unset($_SESSION['e_bot']);
		}
	?>
	
	<br />
	
	<button type="submit" class="btn btn-default login-popup-btn" name="submit" value="1">Zarejestruj</button>
	
	</form>
	</div>
	
												<!-- STÓPKA -->
	<div id="footer">
		Copyright &copy; 2019
	</div>

</body>
</html>