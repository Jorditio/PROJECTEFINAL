<?php include 'connexio.php'; ?>
<?php include 'header.php'; 
if (isset($_COOKIE["usuari"])){
class CRUD extends Connexio
{
  public function select()
  {
    $stmt = Connexio::connectar()->prepare("SELECT * from pujades, usuaris where pujades.usuaris_idusuaris = usuaris.idusuaris order by time desc");
    $stmt->execute();
    return $stmt->fetchAll();
  }
}

$cmd = new CRUD();
$fotos = $cmd->select();
echo '<section class="post-list">
<div class="content">';
foreach ($fotos as $fo) {
  echo '<article class="post">
      <div class="post-header">
          <img class="post-img-1" src="' . $fo["fotos"] . '">
          <div class="datas"> '.$fo["time"].'</div>
      </div>
      <div class="post-body">
          <span></span>
          <h2>'.$fo["nom"].'</h2>
          <p class="descripcion">'.$fo["descripcio"].' </p>
      </div>
  </article>';
}
echo '</div>
</section>';         
} else {
  header('Location: login.php');
}?>
<script src="main.js"></script>
</body>
</html>