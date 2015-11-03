<?php include("inc/pages/header.php"); 

$gid = $_GET["id"];

if (!isset($_GET["id"]) && empty($_POST["id"])) {
	header('location:index.php');
}

if (isset($_POST["u"])) {
	extract($_POST);

	$ne = $bdd->prepare("UPDATE `entreprise` SET `nom` = ?, `type` = ?, `tell` = ?, `mail` = ?, `adresse` = ?, `cp` = ?, `ville` = ?, `contact_nom` = ?, `contact_prenom` = ?, `contact_mail` = ?, `note` = ?");
	$ne->execute(array($nom,$type,$tell,$mail,$adresse,$cp,$ville,$cnom,$cprenom,$cmail,$note));
}

$s = $bdd->prepare("SELECT * FROM `entreprise` WHERE `id` = ?");
$s->execute(array($gid));
$ds=$s->fetch();
$n=$s->rowCount();
if($n==0){
	echo "<a href='index.php'>retour</a>
	<center><h1>Aucune Entreprise</h1></center>";
}
else {
?>
<a href="index.php">retour</a>
<h1>Modifier entreprise</h1>

<form method="POST" action="">
	<p><input type="text" value="<?php echo $ds['nom']; ?>" name="nom" placeholder="Nom"></p>
	<p><input type="text" value="<?php echo $ds['type']; ?>" name="type" placeholder="Type"></p>
	<p><input type="phone" value="<?php echo $ds['tell']; ?>" name="tell" placeholder="Téléphone"></p>
	<p><input type="email" value="<?php echo $ds['mail']; ?>" name="mail" placeholder="Mail entreprise"></p>
	<p><input type="text" value="<?php echo $ds['adresse']; ?>" name="adresse" placeholder="Adresse"></p>
	<p><input type="text" value="<?php echo $ds['cp']; ?>" name="cp" placeholder="code postal"></p>
	<p><input type="text" value="<?php echo $ds['ville']; ?>" name="ville" placeholder="ville"></p>
	<p><input type="text" value="<?php echo $ds['contact_nom']; ?>" name="cnom" placeholder="Nom contact"></p>
	<p><input type="text" value="<?php echo $ds['contact_prenom']; ?>" name="cprenom" placeholder="Prénom contact"></p>
	<p><input type="email" value="<?php echo $ds['contact_mail']; ?>" name="cmail" placeholder="Mail contact"></p>
	<p><textarea name="note" id="tinymce" placeholder="Notes"><?php echo $ds['note']; ?></textarea></p>
	<p><input type="submit" name="u" value="Ok !"></p>
</form>
<?php
}
include("inc/pages/footer.php"); ?>