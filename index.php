<?php include("inc/pages/header.php"); 

if (isset($_POST["sup"])) {
	extract($_POST);
	$del = $bdd->prepare("DELETE FROM `entreprise` WHERE `id` = ?");
	$del->execute(array($id));
}

if (isset($_POST["fin"])) {
	$del = $bdd->query("TRUNCATE `entreprise`");;
}

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

?>
<style type="text/css">
	.lb{
		display: inline;
	}
</style>
<h1>Outil de recherche de stage</h1>

<a href="new.php">Nouvelle entreprise</a>

<h2>Liste des entreprise :</h2>
<table class="table table-bordered">
	<tr class="success">
		<td>OK</td>
	</tr>
	<tr class="warning">
		<td>Peut-etre</td>
	</tr>
	<tr class="danger">
		<td>NON</td>
	</tr>
	<tr class="non">
		<td>Pas de statut</td>
	</tr>
</table>
		 <div class="col-lg-6">
    <form method="get" action="">
    <div class="input-group">
      <input type="text" class="form-control" name="q" placeholder="Recherche par id, nom ou type">
      <span class="input-group-btn">
        <input type="submit" value="Rechercher" class="btn btn-default" >
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
<table class="table table-bordered">
	<thead>
		<tr>
			<td>#</td><td>Nom</td><td>type</td><td>tel</td><td>Mail</td><td>Nom</td><td>Prenom</td><td>Mail</td><td>Actions</td>
		</tr>
	</thead>
	<tbody>
		<?php 	

			if (isset($_GET["q"])) {
					$q = $_GET["q"];

					if (empty($q)) {
						header('location:index.php');
					}

					$s = explode(" ", $q);
					$sql = "SELECT * FROM `entreprise`";
					
					$i = 0;
					foreach ($s as $mot) {
						if ($i == 0) {
								$sql.= " WHERE ";
							}
							else {
								$sql.= " OR ";
							}	
							$sql.= "id LIKE '%$mot%' OR nom LIKE '%$mot%' OR type LIKE '%$mot%';";

						$i++;

					}
					
					$en = $bdd->query($sql);
				}
				else {


		$en = $bdd->query("SELECT * FROM `entreprise` ORDER BY `nom` ASC");
	}
		$nb=$en->rowCount();

		if($nb == 0){
			?>
			<tr>
				<td colspan="9"><center>Pas d'entreprise</center></td>
			</tr>
			<?php
		}
		
		while($entreprise = $en->fetch()){
			?>
			<tr class="<?php echo $entreprise["statut"]; ?>">
				<td><?php echo $entreprise["id"]; ?></td>
				<td><?php echo $entreprise["nom"]; ?></td>
				<td><?php echo $entreprise["type"]; ?></td>
				<td><?php echo $entreprise["tell"]; ?></td>
				<td><?php echo $entreprise["mail"]; ?></td>
				<td><?php echo $entreprise["contact_nom"]; ?></td>
				<td><?php echo $entreprise["contact_prenom"]; ?></td>
				<td><?php echo $entreprise["contact_mail"]; ?></td>
				<td>
					<form class="lb" method="POST" action="">
						<input type="hidden" name="id" value="<?php echo $entreprise["id"]; ?>">
						<input type="submit" value="Suprimer" name="sub" class="btn btn-danger" >
					</form>
					<a href="fiche.php?id=<?php echo $entreprise['id']; ?>" class="btn btn-primary">fiche</a>
					<?php 
					if ($entreprise["statut"]!= "success") {
						?>
					<form class="lb" method="POST" action="">
						<input type="hidden" name="id" value="<?php echo $entreprise["id"]; ?>">
						<input type="submit" value="OK !" name="ok" class="btn btn-success" >
					</form>
						<?php
					}					
					if ($entreprise["statut"]!= "warning") {
						?>
					<form class="lb" method="POST" action="">
						<input type="hidden" name="id" value="<?php echo $entreprise["id"]; ?>">
						<input type="submit" value="Peut-être" name="pe" class="btn btn-warning" >
					</form>
						<?php						
					}				
					if ($entreprise["statut"]!= "danger") {
												?>
					<form class="lb" method="POST" action="">
						<input type="hidden" name="id" value="<?php echo $entreprise["id"]; ?>">
						<input type="submit" value="Non ;(" name="non" class="btn btn-danger" >
					</form>
						<?php
					}
					?>
				</td>
			</tr>
			<?php

		}

		?>

	</tbody>
</table>

<form method="POST" action="">
	<input type="submit" value="Fin de la recherche" name="fin">
</form>

<?php include("inc/pages/footer.php"); ?>