<?php

use CRUD as GlobalCRUD;

 include 'header.php'; include 'connexio.php';?>



<?php


class CRUD extends Connexio
    {
       


        public function selectmodel()
        {

            //opcio2
            $stmt = Connexio::connectar()->prepare("SELECT nom from models");
            $stmt->execute();
            return $stmt->fetchAll();
        }


        public function selectmarca()
        {

            //opcio2
            $stmt = Connexio::connectar()->prepare("SELECT nom from marques");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function selectrans()
        {

            //opcio2
            $stmt = Connexio::connectar()->prepare("SELECT nom from transmissio");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function selectcarburant()
        {

            //opcio2
            $stmt = Connexio::connectar()->prepare("SELECT nom from carburant");
            $stmt->execute();
            return $stmt->fetchAll();
        }


        public function insert($mar,$mod, $any, $tra, $car, $descr, $foto)
        {

            // consulta del id del usuari connectat
            $stmt = Connexio::connectar()->prepare("SELECT * from usuaris where username ='". $_COOKIE['usuari']."'");
            $stmt->execute();
            $idusername = $stmt->fetchAll()[0]["idusuaris"];
            
            $stmt = Connexio::connectar()->prepare("INSERT INTO pujades (marca, model, any, transmissio, carburant, descripcio, usuaris_idusuaris, fotos, time) values (:mar, :mod, :any, :tra, :car, :descr, :user, :foto, NOW())");
            $stmt->bindParam(":mar", $mar, PDO::PARAM_STR);
            $stmt->bindParam(":mod", $mod, PDO::PARAM_STR);
            $stmt->bindParam(":any", $any, PDO::PARAM_STR);
            $stmt->bindParam(":tra", $tra, PDO::PARAM_STR);
            $stmt->bindParam(":car", $car, PDO::PARAM_STR);
            $stmt->bindParam(":foto", $foto, PDO::PARAM_STR);
            $stmt->bindParam(":descr", $descr, PDO::PARAM_STR);
            $stmt->bindParam(":user", $idusername, PDO::PARAM_STR);
            if ($stmt->execute())
            {
                return "CORRECTE";
            }
            else {
                return "ERROR";
            }
        }

    }

?>

<?php
        $cmd = new CRUD();

        if(isset($_POST["send"])){
            $marca = $_POST["marca"];
            $models = $_POST["model"];
            $any = $_POST["any"];
            $trans = $_POST["trans"];
            $combustible = $_POST["carburant"];
            $descripcio = $_POST["desc"];

            $mida = $_FILES["fitxer"]["size"];
            if ($mida > 1024 * 1024) {
                echo '<script language="javascript">alert("Imatge Massa Gran");</script>';
                return;
            }
            $res = move_uploaded_file($_FILES["fitxer"]["tmp_name"], "pujades/" . $_FILES["fitxer"]["name"]);
            if ($res) {
                $image = "pujades/" . $_FILES['fitxer']['name'];
                echo '<script language="javascript">alert("Guarda a PHP");</script>';
              } else {
                echo '<script language="javascript">alert("NO save php");</script>';
              }

            $cmd->insert($marca, $models, $any, $trans, $combustible, $descripcio, $image);
            echo '<script language="javascript">alert("Automobil inserit correctament");</script>';
        }


        if(isset($_COOKIE["usuari"])){

        
?>


<div id=logbox>
    <div id="register">
        <form method="POST" enctype="multipart/form-data">
            <div id="nameuser">
                <label>Marca</label><br>
                <select name="marca" value="marca">
                <?php         
                $cmd = new CRUD();
                $updatees = $cmd->selectmarca();  

                foreach ($updatees as $updates) {
                        echo '
                        <option value="' . $updates["nom"] . '">' . $updates['nom'] . '</option>';
                    }
                ?></select>
            </div><br>

            <div id="models">
                <label>Models</label><br>
                <select name="model" value="model">
                <?php         
                $cmd = new CRUD();
                $modelss = $cmd->selectmodel();  

                foreach ($modelss as $updates) {
                        echo '
                        <option value="' . $updates["nom"] . '">' . $updates['nom'] . '</option>';
                    }
                ?></select>
            </div><br>
            <div id="any">
                <label>Any</label>
                <input type="text" name="any" placeholder="Introdueixi l'any">
            </div>

            <div id="fitxer">
                <label>Imatge</label>
                <input type="file" name="fitxer" placeholder="Selecciona el fitxer">
            </div>

            <div id="transmissio">
                <label>Transmissio</label><br>
                <select name="trans" value="trans">
                <?php         
                $cmd = new CRUD();
                $transmissio = $cmd->selectrans();  
                foreach ($transmissio as $updates) {
                        echo '
                        <option value="' . $updates["nom"] . '">' . $updates['nom'] . '</option>';
                    }
                ?>
                </select>
            </div>
            <div id="Carburant">
                <label>Carburant</label><br>
                <select name="carburant" value="carburant">
                <?php         
                $cmd = new CRUD();
                $carburant = $cmd->selectcarburant();  

                foreach ($carburant as $updates) {
                        echo '
                        <option value="' . $updates["nom"] . '">' . $updates['nom'] . '</option>';
                    }
                ?></select>
            </div><br>
            <div id="descripcio">
                <label>Descripcio</label>
                <input type="text" name="desc" placeholder="Introdueixi descripcio">
            </div>
            <input type="submit" name="send" id="btsend" value="OK"><br>
        </form>

    </div>
</div>
<?php } 

else{
    echo '<script language="javascript">alert("Has de tenir la sessio iniciada");</script>';
}
?>

</body>


</html>
