<?php
     require 'config.php';
     try {
          $bdd = new PDO($dsn,$username,$password);
     }
     catch (Exception $e) {
          die('Erreur : ' . $e->getMessage());
     }

?>
