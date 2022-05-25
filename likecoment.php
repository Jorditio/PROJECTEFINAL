<?php include 'connexio.php';
include 'header.php';
if (isset($_COOKIE["usuari"])) {
    class CRUD extends Connexio
    {
        public function insertlikecoment($user, $idpost, $like, $coment)
        {
            $stmt = Connexio::connectar()->prepare("INSERT INTO likeecoment (username, idpost, likess, comentari) VALUES (:user, :idpost, :like, :coment)");
            $stmt->bindParam(":user", $user, PDO::PARAM_STR);
            $stmt->bindParam(":idpost", $idpost, PDO::PARAM_STR);
            $stmt->bindParam(":like", $like, PDO::PARAM_STR);
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
            $stmt = Connexio::connectar()->prepare("SELECT fotos FROM likeecoment, pujades WHERE idindex = idpost AND idindex = :idpost  GROUP BY idpost");
            $stmt->bindParam(":idpost", $post, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }
    }
?>
    <script src="likecoment.js"></script>
    <form method="POST">
        <input type="checkbox" name="like">
        <br>
        <input type="text" placeholder="enter a coment ..." name="com">
        <input type="submit" value="SEND" name="likee">
    </form>

    <?php
    $cmd = new CRUD();
    $idp = $cmd->selectTotalLikes($_SESSION["postid"]);
    $comentaris = $cmd->selectcoment($_SESSION["postid"]);
    $img = $cmd->selectImgs($_SESSION["postid"]);

    echo '<div class="imgcoment">
    <div class="imgss">
    <img class="post-img-1" src="' . $img["fotos"] . '" style="width: 20vw">
    </div>
    <div class="coment">';
    foreach ($comentaris as $co) {
        echo '<p><b>' . $co["username"] . '</b>  ' . $co["comentari"] . '</p>';
    }
    echo '</div>
    </div>';


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