<?php

	//para usar session variables hay que inicializar:
	session_start();

	if($_GET["logout"]==1 AND $_SESSION['id']) { session_destroy();

		$message="Has sido desconectado. Que tengas un buen dia!";
	}

	include("connection.php");

	
	if (mysqli_connect_error()) {

		die ("Could not connect to database");
	}

	//Si la variable submit tiene un valor = "signup" , intentamos registrar el nuevo user:
	if ($_POST['submit']=="Sign Up") {

	if (!$_POST['email']) $error.="<br />Please enter your email";
		else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL )) $error.="Please enter a valid email address";

		if (!$_POST['password']) $error.="<br />Please enter your password";
			else {

				if (strlen($_POST['password'])<8) $error.="<br />Please enter a password with at least 8 characters";

				if (!preg_match('`[A-Z]`', $_POST['password'])) $error.="<br />Please include at least one capital letter in your password";

			}



			if ($error) $error="There were error(s) in your signup details: ".$error;

				else {

					$query = "SELECT * FROM users WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'";

					$email=mysqli_real_escape_string($link, $_POST['email']);

					$password=$_POST['password'];

					

					$result = mysqli_query($link, $query);

					$result = mysqli_num_rows($result);

					if ($result) $error= "That email address is already registered. Do you want to log in?";
					else {


						$email_pass = md5(md5($_POST['email']).$_POST['password']) ; //hash de email + password + hash de nuevo
						$query = "INSERT INTO users (email, password) VALUES ('".$email."', '".$email_pass."')"; // insert con variables en valores

						//$hola = "INSERT INTO users (email, password) VALUES ('".$email."', '".md5(md5($_POST['email']).$_POST['password'])."')";

					

						mysqli_query($link, $query);

						echo "You have been signed up!";

						//trae el id del usuario que insertamos en la base recientemente 

						$_SESSION['id']=mysqli_insert_id($link);

						header("Location:mainpage.php");

					}
				}
	}

	//Si existe la variable POST Log In , lo intentamos loguear:
	if ($_POST["submit"]=="Log In") {

		$query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link,$_POST['loginemail'])."' AND password = '".md5(md5($_POST['loginemail']).$_POST['loginpassword'])."' LIMIT 1";

		$result = mysqli_query($link,$query);

		$row = mysqli_fetch_array($result);

		if($row) {

			//cargo la variable session con el id que trae de la base asi sabemos que user es
			$_SESSION['id']=$row['id'];

			header("Location:mainpage.php");

		} else {

			$error= "We could not find that email and password. Please try again.";
		}




	}




?>