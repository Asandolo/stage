<?php include("inc/pages/header.php"); 

$gid = $_GET["id"];


if (isset($_POST["ok"])) {
	extract($_POST);
	$ok = $bdd->prepare("UPDATE `entreprise` SET `statut` = 'success' WHERE `id` = ? ");
	$ok->execute(array($id));
}

if (isset($_POST["non"])) {
	extract($_POST);
	$ok = $bdd->prepare("UPDATE `entreprise` SET `statut` = 'danger' WHERE `id` = ? ");
	$ok->execute(array($id));
}

if (isset($_POST["pe"])) {
	extract($_POST);
	$ok = $bdd->prepare("UPDATE `entreprise` SET `statut` = 'warning' WHERE `id` = ? ");
	$ok->execute(array($id));
}

if (!isset($_GET["id"]) && empty($_POST["id"])) {
	header('location:index.php');
}

$s = $bdd->prepare("SELECT * FROM `entreprise` WHERE `id` = ?");
$s->execute(array($gid));
$ds=$s->fetch();
$n=$s->rowCount();
if($n==0){
	echo "<a href='index.php'>retour</a>
	<center><h1>Aucune fiche</h1></center>";
}
else {

?>
<style type="text/css">
	.lb{
		display: inline;
	}
</style>
<a href="index.php">retour</a>
<center><h1><?php echo $ds["nom"]." ".$ds["type"]." #".$ds["id"]; ?></h1></center>
<hr />
<h2>Coordonée :</h2>
<p><?php echo $ds["adresse"] ?><br />
<?php echo $ds["cp"]." ".$ds["ville"];?></p>
<p><?php echo $ds["tell"]." -- ".$ds["mail"];?>l</p>
<hr />
<h2>Contact</h2>
<p><?php echo $ds["contact_nom"]." ".$ds["contact_prenom"];?></p>
<p><?php echo $ds["contact_mail"] ?></p>
<hr />
<div>
<h2>Note :</h2>
	<?php echo $ds["note"]; ?>
</div>
<hr />
<center><p>
	<?php
	if ($ds["statut"] == "success") {
			echo "OK !";
		}
		elseif($ds["statut"] == "danger"){
			echo "<p class='text-danger'>Non ;(</p>";
		}
		elseif($ds["statut"] == "warning"){
			echo "<p class='text-warning'>Peut-être</p>";
		}	
		elseif($ds["statut"] == "non") {
			echo "<p class='text-success'>Pas de statut</p>";
		}
		else{
			echo "error";
		}
	?>
</p>

<?php 

					if ($ds["statut"] != "success") {
						?>
					<form class="lb" method="POST" action="">
						<input type="hidden" name="id" value="<?php echo $ds["id"]; ?>">
						<input type="submit" value="OK !" name="ok" class="btn btn-success" >
					</form>
						<?php
					}					
					if ($ds["statut"] != "warning") {
						?>
					<form class="lb" method="POST" action="">
						<input type="hidden" name="id" value="<?php echo $ds["id"]; ?>">
						<input type="submit" value="Peut-être" name="pe" class="btn btn-warning" >
					</form>
						<?php						
					}				
					if ($ds["statut"] != "danger") {
												?>
					<form class="lb" method="POST" action="">
						<input type="hidden" name="id" value="<?php echo $ds["id"]; ?>">
						<input type="submit" value="Non ;(" name="non" class="btn btn-danger" >
					</form>
						<?php
					}
					?>
					<div>
					<br />
					<a href="modif.php?id=<?php echo $ds["id"]; ?>" class="btn btn-primary">Modifier</a>
					</div>
</center>

<?php 

}
include("inc/pages/footer.php"); ?>