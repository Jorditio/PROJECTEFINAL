<?php include 'header.php'; include 'connexio.php';?>



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
    }

?>


<div id=logbox>
    <div id="register">
        <form method="POST">
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
            <!-- <div id="any"> //////Foto
                <label>Any</label>
                <input type="text" name="any" placeholder="Introdueixi l'any">
            </div> -->
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
                ?></select>
            </div><br>
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
        <!-- <div id="tolog">
            <label>Already have an account?<a href="login.php"><button id="login">LOG IN</button></a></label>
        </div> -->
    </div>
</div>
</body>
</html>
