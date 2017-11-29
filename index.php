<?php
include('html/index.html');
require 'db_access.php';
ini_set('memory_limit', '256M'); // augmente la capacite memoire du machin

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     if (isset($_POST['requete1'])) {
          if (isset($_POST['form_salaire_emp']) && $_POST['form_salaire_emp'] != NULL) {
               $stmt_requete1 = $bdd->query('SELECT    nom_employe, prenom_employe FROM Employe
                                             WHERE     salaire_employe >= ' . $_POST['form_salaire_emp']);
               echo "<table>";
               while ($donnees = $stmt_requete1->fetch()) { ?>
                    <tr><td>
                         <?php echo $donnees['nom_employe']. "</td><td>" . $donnees['prenom_employe']; ?>
                    </td></tr>
                    <?php
               }
               echo "</table>";
               $stmt_requete1->closeCursor();
          }
     } else if (isset($_POST['requete2'])) {
          if (isset($_POST['form_ville_recherchee']) && $_POST['form_ville_recherchee'] != NULL) {
               $stmt_requete2 = $bdd->query('SELECT    nom_market, nom_ville FROM Market, Ville
                                             WHERE     ville_market = id_ville
                                             AND       nom_ville = "' . $_POST['form_ville_recherchee'].'"');
               echo "<table>";
               while ($donnees = $stmt_requete2->fetch()) { ?>
                    <tr><td>
                         <?php echo $donnees['nom_market']. "</td><td>" . $donnees['nom_ville']; ?>
                    </td></tr>
                    <?php
               }
               echo "</table>";
               $stmt_requete2->closeCursor();
          }
     } else if (isset($_POST['requete3'])) {
          $stmt_requete3 = $bdd->query('SELECT    nom_market, nom_ville, nom_dirigeant, nom_societe FROM Market, Ville, Dirigeant, Societe
                                        WHERE     ville_market = id_ville
                                        AND       dirigeant_market = id_dirigeant
                                        AND       societe_market = id_societe');
          echo "<table>";
          while ($donnees = $stmt_requete3->fetch()) { ?>
               <tr><td>
                    <?php echo $donnees['nom_market']. "</td><td>" . $donnees['nom_ville']. "</td><td>" . $donnees['nom_dirigeant']. "</td><td>" . $donnees['nom_societe']; ?>
               </td></tr>
               <?php
          }
          echo "</table>";
          $stmt_requete3->closeCursor();
     } else if (isset($_POST['requete4'])) {
          $stmt_requete4 = $bdd->query('SELECT * FROM Client
                                        LEFT OUTER JOIN APaye ON id_client = APaye.client_apaye');
          echo "<table>";
          while ($donnees = $stmt_requete4->fetch()) { ?>
               <tr><td>
                    <?php echo $donnees['date_apaye']. "</td><td>" . $donnees['id_client']. "</td><td>" . $donnees['nom_client']. "</td><td>" . $donnees['prenom_client']; ?>
               </td></tr>
               <?php
          }
          echo "</table>";
          $stmt_requete4->closeCursor();
     }
}
?>
