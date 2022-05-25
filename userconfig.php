<?php include 'connexio.php';
include 'header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
if (isset($_COOKIE["usuari"])) {
	class CRUD extends Connexio
	{
		public function selectImgUser($user)
		{
			$stmt = Connexio::connectar()->prepare("SELECT idindex, UPPER(marca), UPPER(model), any, fotos, UPPER(transmissio), UPPER(carburant), descripcio, usuaris_idusuaris, time, idusuaris, UPPER(username) from pujades, usuaris where pujades.usuaris_idusuaris = usuaris.idusuaris and username = :username order by time desc");
			$stmt->bindParam(":username", $user, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function selectconfigUser($user)
		{
			$stmt = Connexio::connectar()->prepare("SELECT idusuaris, username, descripciouser, pff FROM usuaris WHERE username = :username");
			$stmt->bindParam(":username", $user, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		}

		public function updateConfigser($userdes, $pff, $user)
		{
			$stmt = Connexio::connectar()->prepare("UPDATE usuaris SET descripciouser = :userdes, pff = :pff WHERE username = :username");
			$stmt->bindParam(":userdes", $userdes, PDO::PARAM_STR);
			$stmt->bindParam(":pff", $pff, PDO::PARAM_STR);
			$stmt->bindParam(":username", $user, PDO::PARAM_STR);
			if ($stmt->execute()) {
				return "CORRECTE";
			} else {
				return "ERROR";
			}
		}

		public function updatePasword($newpass, $user)
		{
			$stmt = Connexio::connectar()->prepare("UPDATE usuaris SET contrasenya = :newpas WHERE username = :username");
			$stmt->bindParam(":newpas", $newpass, PDO::PARAM_STR);
			$stmt->bindParam(":username", $user, PDO::PARAM_STR);
			if ($stmt->execute()) {
				return "CORRECTE";
			} else {
				return "ERROR";
			}
		}
		public function selectTotalLikes($post)
        {
            $stmt = Connexio::connectar()->prepare("SELECT COUNT(likess) as likess FROM likeecoment WHERE likess = 1 AND idpost = :idpost");
            $stmt->bindParam(":idpost", $post, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }
	}
	$username = $_COOKIE["usuari"];
	$cmd = new CRUD();
	$configuser = $cmd->selectconfigUser($username);
	$imgsuser = $cmd->selectImgUser($username);
	$numposts = 0;
?>

	<section class="py-5 my-5">
		<div class="container" class="userconf">
			<h1 class="mb-5">Account Settings</h1>
			<div class="bg-white shadow rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
							<img src="<?php echo $configuser["pff"] ?>" alt="not found" class="shadow">
						</div>
						<h4 class="text-center"><?php echo $configuser["username"]; ?></h4>
					</div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i>
							Account
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i>
							Password
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#posts" role="tab" aria-controls="posts" aria-selected="false">
							<i class="fa fa-image text-center mr-1"></i>
							Posts
						</a>
					</div>
				</div>
				<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
						<h3 class="mb-4">Account Settings</h3>
						<form method="POST" enctype="multipart/form-data">
							<div class="row">
								<label>Profile Picture</label>
								<br>
								<input type="file" name="fitxer" placeholder="Select your porfile picture">
								<div class="col-md-12">
									<div class="form-group">
										<label>Bio</label>
										<input type="text" name="descrip" value="<?php echo $configuser["descripciouser"]; ?>">
									</div>
								</div>
							</div>
							<div>
								<input type="submit" class="btn btn-light" name="configsend" value="SEND">
							</div>
						</form>
						<?php if (isset($_POST["configsend"])) {
							$descripuser = $_POST["descrip"];
							$res2 = move_uploaded_file($_FILES["fitxer"]["tmp_name"], "pujades/" . $_FILES["fitxer"]["name"]);
							if ($res2) {
								$pfp = "pujades/" . $_FILES['fitxer']['name'];
							}
							$cmd->updateConfigser($descripuser, $pfp, $username);
							header("LOCATION:userconfig.php");
						} ?>
					</div>
					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<h3 class="mb-4">Password Settings</h3>
						<form method="POST">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>New password</label>
										<input type="password" class="form-control" name="newpas">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Confirm new password</label>
										<input type="password" class="form-control" name="confirmpas">
									</div>
								</div>
							</div>
							<div>
								<input type="submit" class="btn btn-primary" name="updatepas" value="UPDATE">
								<input type="submit" class="btn btn-light" value="CANCEL">
							</div>
						</form>
						<?php if (isset($_POST["updatepas"])) {
							$newpasword = $_POST["newpas"];
							$samepas = password_verify($newpasword, password_hash($_POST["confirmpas"], PASSWORD_DEFAULT));
							$newpas = password_hash($_POST["newpas"], PASSWORD_DEFAULT);
							if ($samepas == true){
								$cmd->updatePasword($newpas, $username);
							}
							else{
								echo '<script language="javascript">alert("nop");</script>';
							}
						} ?>
					</div>
					<div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
						<div>
							<table class="table align-middle table-hover" class="d-flex justify-content-center">
								<thead>
									<tr>
										<th scope="col" style="text-align: center; width: 10vw;">Last Post</th>
										<th scope="col" style="text-align: center">Descriptoin</th>
										<th scope="col" style="text-align: center; width: 8vw;">Likes</th>
										<th scope="col" style="text-align: center">Preview</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($imgsuser as $im) {
										$numposts++;
										$idp = $cmd->selectTotalLikes($im["idindex"]);
										echo '<tr>
									<th scope="row" style="text-align: center">' . $numposts . '</th>
									<td style="text-align: center">' . $im["descripcio"] . '</td>
									<td style="text-align: center">' . $idp["likess"] . '</td>
									<td style="text-align: center"><img class="post-img-2" src="' . $im["fotos"] . '"></td>
								</tr>';
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php
} else {
	header('Location: login.php');
}
?>

</body>

</html>