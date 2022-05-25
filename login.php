<?php 
if (isset($_GET["logout"])) {
    setcookie("usuari", null);
    header('Location: index.php');
} ?>
<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<?php

class CRUD extends Connexio
    {
        public function selectlogin($username)
        {
            $stmt = Connexio::connectar()->prepare("SELECT username, contrasenya FROM usuaris where username = :username");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }
    }
?>

<div id=logbox>
    <div id="login">
        <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div id="user">
                <label>Username</label><br>
                <input type="text" name="username" placeholder="Enter Username"><br>
            </div>
            <div id="pass">
                <label>Password</label><br>
                <input type="password" name="password" placeholder="Enter Password"><br>
            </div>
            <input type="submit" name="send" id="btsend"><br>
        </form>
        <div id="forgot">
            <a href="register.php"><button id="forgot1">Don't have an account yet</button></a>
        </div>
    </div>
</div>



<?php
if(isset($_POST["send"])){
    $usuari = $_POST["username"];
    $password = $_POST["password"];
    $cmd = new CRUD();
    $registres = $cmd->selectlogin($usuari);
    $samepasword = password_verify($password, $registres["contrasenya"]);
    if($samepasword == true){
        setcookie("usuari", $usuari);
        header("LOCATION:cotxes.php");
    }
}

?>
</body>
</html>