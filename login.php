<?php
session_start();
if (isset($_SESSION["login"]) || !empty($_SESSION["login"])) {
	header('location:index.php');

}

if (isset($_POST['go'])) {
		extract($_POST);

		$login = htmlspecialchars(htmlentities($login));

		if ($pass == "test") {
			
			$_SESSION["login"] = $login;
			header('location: index.php');
		}
		else {
			echo "NOP !";
		}
	}



?>
<!DOCTYPE html>
<html>
<head>
	<title>ADM LOGIN</title>
</head>
<body>

<form method="POST" action="">
	<input type="hidden" name="login" value="alexandre">
	<input type="password" name="pass">
	<input type="submit" name="go" value="C'est cool les grand boutton, non ? moi j'aime bien !">
</form>

<p>VOUS NE PASSEREZ PAS !</p>

</body>
</html>