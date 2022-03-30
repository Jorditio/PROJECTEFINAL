<?php 
class Connexio{
    public function connectar(){
        $link = new PDO("mysql:host=localhost;dbname=manifold","root","");
        return $link;
    }
}
?>