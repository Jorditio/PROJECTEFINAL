<?php include 'connexio.php'; include 'header.php';
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
        $stmt = Connexio::connectar()->prepare("SELECT idusuaris, username, descripciouser, pff FROM usuaris WHERE username = username = :username");
        $stmt->bindParam(":username", $user, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
      }
    }
    $username = $_COOKIE["usuari"];
    $cmd = new CRUD();

    $configuser = $cmd->selectconfigUser($username);

    echo '<form><div class="userconfig">
    <input type="file" name="pffuser" placeholder="Edita"><br>
    <label class="usernameconfig">'.$username.'</label>
    </div></form>';
  } else {
    header('Location: login.php');
  }
?>

</body>
</html>