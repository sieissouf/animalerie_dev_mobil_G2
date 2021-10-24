<?php
    require 'landing.php';
?>

<!Doctype html>
<html lang="en">
    <head>
        <title>Catalogue produit</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="design.css">

        <script type="text/javascript">
            var clin = function(){
                if(document.getElementById('clignotte').style.visibility=='visible'){
                    document.getElementById('clignotte').style.visibility='hidden';
                }
                else{
                    document.getElementById('clignotte').style.visibility='visible';
                }
                };
                var periode = setInterval(clin,800);
        </script>
        
    </head>
    <body>
      
        <div class="container admin">
            
            <!-- <div class="row">
                <form action="verif.php" class="d" method="GET">
                    <input type="search" name="terme">
                    <input type="submit" name="s" value="Rechercher">
                </form>
            </div> -->
            <div class="row">
                <h2>Catalogue des produits <a href="view.php" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Ajouter un produit</a></h1>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Libellé</th>
                            <th>Quantité minimale</th>
                            <th>Quantité en stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            // Connexion a la base
                            try{
                            $bdd = new PDO('mysql:host=localhost; dbname=geekshop; charset=utf8', 'root', '');
                            }
                            catch(Exception $e){
                                die('Erreur :'.$e->getMessage());
                            }


                            // Lire les informations
                            $req = $bdd->query('SELECT * FROM produit ORDER BY reference DESC');
                                while($data = $req->fetch())
                                    {
                                        echo '<tr>';
                                            echo '<td>'.$data['libelle'].'</td>';
                                            echo '<td>'.$data['quantite_minimale'].'</td>';
                                            if($data['quantite_en_stock'] == 0){
                                                echo '<td class="alert alert-danger st" role ="alert" id="clignotte" style="visibility:visible;">Rupture de stock</td>';
                                            }
                                            else{
                                                echo '<td>'.$data['quantite_en_stock'].'</td>';
                                            }
                                            
                                            echo '<td width=300>';
                                            echo '<a class="btn btn-primary" href="view.php?reference='. $data['reference'] .'"><span class="glyphicon glyphicon-eye-open"></span>Voir</a>';
                                            echo '<a class="btn btn-primary" href="modifier.php?reference='. $data['reference'] .'"><span class="glyphicon glyphicon-pencil"></span>Modifier</a>';
                                            echo ' ';
                                            echo '<a class="btn btn-danger" href="supprimer.php?reference='. $data['reference'] .'"><span class="glyphicon glyphicon-remove"></span>Supprimer</a>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                            $req->closeCursor();
                        ?>            
                    </tbody>
                </table>
            </div>
        </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
