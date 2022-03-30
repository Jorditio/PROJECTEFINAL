<?php include 'header.php'; include 'connexio.php';?>
<div id=logbox>
    <div id="register">
        <form method="POST">
            <div id="nameuser">
                <label>Full Name</label>
                <input type="text" name="fullname" placeholder="Enter your Name">
            </div>
            <div id="pass">
                <label>Password</label>
                <input type="password" name="password" pattern=".{6,}" placeholder="Enter Password">
                <label>Repeat Password</label>
                <input type="password" name="repassword" pattern=".{6,}" placeholder="Enter Password">
            </div>
            <div id="newuser">
                <label>Username</label>
                <input type="text" name="newusername" placeholder="Enter Username">
            </div>
            <div id="mail">
                <label>Mail</label>
                <input type="text" name="mail" placeholder="Enter your email">
            </div>
            <input type="submit" name="send" id="btsend"><br>
        </form>
        <div id="tolog">
            <label>Already have an account?<a href="login.php"><button id="login">LOG IN</button></a></label>
        </div>
    </div>
</div>

<?php

class CRUD extends Connexio
    {
        public function insert($e,$s, $x, $d)
        {
            $stmt = Connexio::connectar()->prepare("INSERT INTO usuari (correu, password, nom, datanaix) values (:e, :s, :x, :d)");
            $stmt->bindParam(":e", $e, PDO::PARAM_STR);
            $stmt->bindParam(":s", $s, PDO::PARAM_STR);
            $stmt->bindParam(":x", $x, PDO::PARAM_STR);
            $stmt->bindParam(":d", $d, PDO::PARAM_STR);
            if ($stmt->execute())
            {
                return "CORRECTE";
            }
            else {
                return "ERROR";
            }
        }

        public function select()
        {
            $stmt = Connexio::connectar()->prepare("SELECT idusuaris, nom, username, contrasenya, email FROM usuaris");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
    $cmd = new CRUD();
    if (isset($_POST["btsend"])){
        $fullname = $_POST["fullname"];
        $password = $_POST["password"];
        $repassword = $_POST["repassword"];
        $username = $_POST["newusername"];
        $mail = $_POST["mail"];

        echo 'polla';
    }
?>
</body>
</html>