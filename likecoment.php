<?php include 'connexio.php';
include 'header.php';
$lik = 0;
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
    }
?>

    <form method="POST">
        <button onclick="<?php $lik++ ?>">LIKE</button>
        <br>
        <input type="text" placeholder="enter a coment ..." name="com">
        <input type="submit" value="SEND" name="likee">
    </form>

    <?php
    echo $_SESSION["postid"];
    if (isset($_POST["likee"])) {
        $idpost = $_SESSION["postid"];
        $username = $_COOKIE["usuari"];
        $coment = $_POST["com"];
        $cmd = new CRUD();
        $cmd->insertlikecoment($username, $idpost, $lik, $coment);
    }
    ?>

<?php } else {
    header('Location: login.php');
}
?>