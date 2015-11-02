<?php include("inc/pages/header.php"); 

if (isset($_POST["n"])) {
	extract($_POST);

	$ne = $bdd->prepare("INSERT INTO `entreprise`  VALUES('',?,?,?,?,?,?,?,?,?,?,'non',?);");
	$ne->execute(array($nom,$type,$tell,$mail,$adresse,$cp,$ville,$cnom,$cprenom,$cmail,$note));
}
?>
<a href="index.php">retour</a>
<h1>Nouvelle entreprise</h1>

<form method="POST" action="">
	<p><input type="text" name="nom" placeholder="Nom"></p>
	<p><input type="text" name="type" placeholder="Type"></p>
	<p><input type="phone" name="tell" placeholder="Téléphone"></p>
	<p><input type="email" name="mail" placeholder="Mail entreprise"></p>
	<p><input type="text" name="adresse" placeholder="Adresse"></p>
	<p><input type="text" name="cp" placeholder="code postal"></p>
	<p><input type="text" name="ville" placeholder="ville"></p>
	<p><input type="text" name="cnom" placeholder="Nom contact"></p>
	<p><input type="text" name="cprenom" placeholder="Prénom contact"></p>
	<p><input type="email" name="cmail" placeholder="Mail contact"></p>
	<p><textarea name="note" id="tinymce" placeholder="Notes">Notes</textarea></p>
	<p><input type="submit" name="n" value="Ok !"></p>
</form>
<?php include("inc/pages/footer.php"); ?>