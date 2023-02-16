<?php

require_once 'navbar.php';
require_once 'config.php';
require_once 'init.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<form action='' method='POST'>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" name='email' class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">

  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name='password' class="form-control" id="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>

<?php

if($_POST){

$datas = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$req->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$req->execute();

if($req->rowCount() > 0){
  $user = $req->fetch(PDO::FETCH_ASSOC);

  if(password_verify($_POST['password'], $user['password'])) {

    $_SESSION['auth']['id'] = $user['id_membre'];
    $_SESSION['auth']['lastname'] = $user['lastname'];
    $_SESSION['auth']['firstname'] = $user['firstname'];
    $_SESSION['auth']['role'] = $user['role'];

    header('Location: profil.php');
  }else{
    echo 'Mot de passe incorrect';
  }
}else{
  echo "l'email n'existe pas";
}
}


?>