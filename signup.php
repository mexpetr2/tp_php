<?php

require_once 'navbar.php';
require_once 'config.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<form action='' method='post' enctype="multipart/form-data">
<div class="form-check">
  <input class="form-check-input" type="radio" name="civility" id="civility1" value="M." checked>
  <label class="form-check-label" for="civility1">
    M.
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="civility" id="civility2" value="Mme">
  <label class="form-check-label" for="civility2">
    Mme
  </label>
</div>

  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" name='nom' id="nom" placeholder="Nom">
  </div>

  <div class="form-group">
    <label for="prenom">Prénom</label>
    <input type="text" class="form-control" name='prenom' id="prenom" placeholder="Prénom">
  </div>

  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" name='email' class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name='password' class="form-control" id="password" placeholder="Password">
  </div>

  <div class="form-group">
    <label for="confirm_password">Confirm password</label>
    <input type="password" name='confirm_password' class="form-control" id="confirm_password" placeholder="Confirm password">
  </div>

  <div class="form-group">
    <label for="date_naissance">Date de naisance</label>
    <input type="date" class="form-control" name='date_naissance' id="date_naissance" placeholder="Date de naissance">
  </div>

  <div class="form-group">
    <label for="adresse">Adresse</label>
    <input type="text" class="form-control" name='adresse' id="adresse" placeholder="Adresse">
  </div>

  <div class="form-group">
    <label for="code_postal">Code postal</label>
    <input type="number" class="form-control" name='code_postal' id="code_postal" placeholder="Code postal">
  </div>

  <div class="form-group">
    <label for="ville">Ville</label>
    <input ty
    pe="text" class="form-control" name='ville' id="ville" placeholder="Ville">
  </div>

  <div class="form-group">
    <label for="pays">Pays</label>
    <input type="text" class="form-control" name='pays' id="pays" placeholder="Pays">
  </div>

  <div class="form-group">
    <label for="presentation">Présentez-vous</label>
    <textarea class="form-control" id="presentation" name='presentation' placeholder="Présentez-vous"></textarea>
  </div>

  <div class="form-group">
    <label for="profile_picture">Photo de profile</label>
    <input type="file" class="form-control-file" name='profile_picture' id="profile_picture">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>

<?php 
if($_POST){
    if(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email'])&& isset($_FILES['profile_picture']) && isset($_POST['presentation']) && isset($_POST['pays']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['code_postal']) && isset($_POST['date_naissance']) && isset($_POST['confirm_password']) && isset($_POST['password'])){
        //if email used
        if($_POST['password'] === $_POST['confirm_password']){
            if($_POST['date_naissance'] < date('Y-m-d')){
                if(strlen($_POST['code_postal'])===5){
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        if(strlen($_POST['nom'])>=2 && strlen($_POST['nom'])<=100 && strlen($_POST['prenom'])>=2 && strlen($_POST['prenom'])<=100){
                            if(strlen($_POST['presentation'])>=10){
                                if($_FILES['profile_picture']['size'] <= 3000000){
                                    if(in_array(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION),['jpg', 'jpeg', 'png'])){
                                        $profilepicture = 'profile_picture_' . time() . '_' . uniqid() . '_' . $_FILES['profile_picture']['name'];

                                        define("CHEMIN", $_SERVER['DOCUMENT_ROOT'] . "/PHP/TP/");
                                        $img_dossier = CHEMIN . 'profil/' . $profilepicture;

                                        copy($_FILES['profile_picture']['tmp_name'], $img_dossier);

                                        define("URL", "http://localhost/PHP/TP/");
                                        $img_bdd = URL . 'profil/' . $profilepicture;

                                        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                                        $req = $pdo->prepare("INSERT INTO users (civility, lastname,firstname,email,password,birthdate,adress,postal_code,city,country,description,profile_picture) VALUES (:civility, :lastname,:firstname,:email,:password,:birthdate,:adress,:postal_code,:city,:country,:description,:profile_picture)");
                                        $req->bindParam(':civility', $_POST['civility'], PDO::PARAM_STR);
                                        $req->bindParam(':lastname', $_POST['nom'], PDO::PARAM_STR);
                                        $req->bindParam(':firstname', $_POST['prenom'], PDO::PARAM_STR);
                                        $req->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
                                        $req->bindParam(':password', $password, PDO::PARAM_STR);
                                        $req->bindParam(':birthdate', $_POST['date_naissance'], PDO::PARAM_STR);
                                        $req->bindParam(':adress', $_POST['adresse'], PDO::PARAM_STR);
                                        $req->bindParam(':postal_code', $_POST['code_postal'], PDO::PARAM_STR);
                                        $req->bindParam(':city', $_POST['ville'], PDO::PARAM_STR);
                                        $req->bindParam(':country', $_POST['pays'], PDO::PARAM_STR);
                                        $req->bindParam(':description', $_POST['presentation'], PDO::PARAM_STR);
                                        $req->bindParam(':profile_picture', $img_bdd, PDO::PARAM_STR);
                                        $req->execute();
                                    }else {
                                        echo 'Veuillez choisir une image valie';
                                    }
                                }else{
                                    echo 'Veuillez choisir une photo de moins de 3Mo';
                                }
                            }
                        }else{
                            echo 'Veuillez choisir un prénom et nom entre 2 et 100 caractère';
                        }
                    }else{
                        echo 'Veuillez choisir un email valide';
                    }
                }else{
                    echo 'Rentrer 5 chiffres dans le code postal ';
                }
            }else{
                echo 'Veuillez choisir une date de naissance valide';
            }
        }else{
            echo 'Les mots de passe ne correspondent pas';
        }
    }else {
        echo 'Veuillez renseigné tout les champs';
    }
}
?>