<?php
    require 'database.php';

    if(!empty($_GET['reference']))
    {
        $reference = checkInput($_GET['reference']);
    }

    if(!empty($_POST)){
        $libelle = checkInput($_POST['libelle']);
        $quantite_minimale = checkInput($_POST['quantite_minimale']);
        $quantite_en_stock = checkInput($_POST['quantite_en_stock']);
        $db = Database::connect();
        $req = $db->prepare('UPDATE produit SET libelle = ?, quantite_minimale = ?, quantite_en_stock = ? WHERE reference = ?');
        $req->execute(array($libelle, $quantite_minimale, $quantite_en_stock, $reference));
        
        
        Database::disconnect();
        header('Location:index1.php');
    }

    else{
        $db = Database::connect();
        $req = $db->prepare("SELECT * FROM produit WHERE reference = ?");
        $req->execute(array($reference));
        $item = $req->fetch();
        $libelle = $item['libelle'];
        $quantite_minimale = $item['quantite_minimale'];
        $quantite_en_stock = $item['quantite_en_stock'];
        Database::disconnect();
    }

    function checkInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!Doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="design.css">
    </head>
    <body>
      

        <div class="container admin centrer">
            <h2>Modifier un produit</h2>
                
                <form action="<?php echo 'modifier.php?reference='. $reference;?>" method="POST">
                    <div class="form-group">
                        <label for="lb">Libelle</label>
                        <input type="text" name="libelle" class="form-control" id="lb" value="<?php echo $libelle; ?>">
                    </div>

                    <div class="form-group">
                        <label for="qm">Quantité Minimale</label>
                        <input type="number" name="quantite_minimale" class="form-control" id="qm" value="<?php echo $quantite_minimale; ?>">
                    </div>
                    <div class="form-group">
                        <label for="qs">Quantité en stock</label>
                        <input type="number" name="quantite_en_stock" class="form-control" id="qs" value="<?php echo $quantite_en_stock; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <!-- <button type="reset" class="btn btn-primary">Retablir</button> -->
                </form>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>