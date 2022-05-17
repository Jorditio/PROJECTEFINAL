<?php include 'connexio.php'; include 'header.php';
if (isset($_COOKIE["usuari"])) {
    class CRUD extends Connexio
    {
      public function selectConfigUser($user)
      {
        $stmt = Connexio::connectar()->prepare("SELECT idindex, UPPER(marca), UPPER(model), any, fotos, UPPER(transmissio), UPPER(carburant), descripcio, usuaris_idusuaris, time, idusuaris, UPPER(username) from pujades, usuaris where pujades.usuaris_idusuaris = usuaris.idusuaris and username = :username order by time desc");
        $stmt->bindParam(":username", $user, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
      }
    }
    $username = $_COOKIE["usuari"];
    $cmd = new CRUD();

    
    $fotos = $cmd->selectConfigUser($username);
  echo '<section class="post-list">
<div class="content">';
  foreach ($fotos as $fo) {
    echo '<article class="post">
      <div class="post-header">
          <img class="post-img-1" src="' . $fo["fotos"] . '">
          <div class="overlay">
            <div class="text">
            <table>
              <tr>
                <th>Marca</th>
                <th>Model</th>
                <th>Transmissio</th>
                <th>Carburant</th>
              </tr>
              <tr>
                <td><p class="Marca">' . $fo["UPPER(marca)"] . ' </p></td>
                <td><p class="Model">' . $fo["UPPER(model)"] . ' </p></td>
                <td><p class="Transmissio">' . $fo["UPPER(transmissio)"] . ' </p></td>
                <td><p class="Carburant">' . $fo["UPPER(carburant)"] . ' </p></td>
              </tr>
            </table>
            </div>
          </div>
      </div>
      <div class="post-body">
          <span></span>
          <h2>' . $fo["UPPER(username)"] . '</h2>
          <p class="descripcion">' . $fo["descripcio"] . ' </p>
          <div class="datas">' . $fo["time"] . '</div>
      </div>
  </article>';
  }
  echo '</div>
</section>';
  } else {
    header('Location: login.php');
  }
?>
</body>
</html>