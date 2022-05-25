<?php include 'connexio.php';
include 'header.php';
if (isset($_COOKIE["usuari"])) {
    class CRUD extends Connexio
    {
        public function insertlikecoment($user, $idpost, $like, $coment)
        {
            $stmt = Connexio::connectar()->prepare("INSERT INTO likeecoment (username, idpost, likess, comentari) VALUES (:user, :idpost, :likes, :coment)");
            $stmt->bindParam(":user", $user, PDO::PARAM_STR);
            $stmt->bindParam(":idpost", $idpost, PDO::PARAM_STR);
            $stmt->bindParam(":likes", $like, PDO::PARAM_STR);
            $stmt->bindParam(":coment", $coment, PDO::PARAM_STR);
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

        public function selectcoment($post)
        {
            $stmt = Connexio::connectar()->prepare("SELECT username, comentari FROM likeecoment WHERE idpost = :idpost");
            $stmt->bindParam(":idpost", $post, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function selectImgs($post)
        {
            $stmt = Connexio::connectar()->prepare("SELECT fotos FROM likeecoment right outer join pujades on idindex = idpost where idindex = :idpost  GROUP BY fotos");
            $stmt->bindParam(":idpost", $post, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }
    }
?>
    

    <?php
    $cmd = new CRUD();
    $idp = $cmd->selectTotalLikes($_SESSION["postid"]);
    $comentaris = $cmd->selectcoment($_SESSION["postid"]);
    $img = $cmd->selectImgs($_SESSION["postid"]);

    echo '<section class="post-list">
    <div class="imgcoment">
    <article class="post">
        <div class="post-header">
            <img class="post-img-1" src="' . $img["fotos"] . '">
        </div>
    <div class="coment">
    <div class="post-body">';
    foreach ($comentaris as $co) {
        echo '<p><b>' . $co["username"] . '</b>  ' . $co["comentari"] . '</p>';
    }
    echo '<form method="POST">
            <input type="checkbox" name="like"> LIKE
            <input type="text" placeholder=" enter a coment ..." name="com">
            <input type="submit" value=" SEND " name="likee" class="likee">
        </form></div></article>';

    
    ?>
<?php
    if (isset($_POST["likee"])) {
        $idpost = $_SESSION["postid"];
        $username = $_COOKIE["usuari"];
        $coment = $_POST["com"];
        $likee = $_POST["like"];
        if ($likee == true) {
            $lik = 1;
        } else {
            $lik = 0;
        }
        $cmd->insertlikecoment($username, $idpost, $lik, $coment);
        header('Location: cotxes.php');
    }
?>

<?php } else {
    header('Location: login.php');
}
?>