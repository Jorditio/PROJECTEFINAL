<?php include 'connexio.php'; ?>
<?php include 'header.php'; 
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
      </div>
      <div class="post-body">
          <span></span>
          <h2>'.$fo["nom"].'</h2>
          <p class="descripcion">'.$fo["descripcio"].' </p>
          <p> '.$fo["time"].'</p>
      </div>
  </article>';
}
echo '</div>
</section>';         
?>
<script src="main.js"></script>
</body>
</html>