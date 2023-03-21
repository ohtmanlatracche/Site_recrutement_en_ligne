<?php
session_start();

?>



<?php

try {
  $conn = new PDO("mysql:host=localhost;dbname=ozod;port=3306;charset=utf8", 'root', '',
   array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
  echo 'Erreur de connexion: ' . $e->getMessage();
}


  if( isset($_POST['cin']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) 
  && isset($_POST['pass'])  && isset($_POST['confirm'])){
       if(!empty($_POST['cin']) &&!empty($_POST['pass']) && !empty($_POST['confirm']) && !empty($_POST['firstname'])
       && !empty($_POST['lastname']) && !empty($_POST['email']) ){
        

    $cin = htmlspecialchars($_POST['cin']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    $confirm = htmlspecialchars($_POST['confirm']);
    
    // Préparer la requête pour vérifier si l'email est déjà utilisé
$sql = "SELECT COUNT(*) as count FROM candidat WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);



    // Préparer la requête pour vérifier si l'email est déjà utilisé
    $sql1 = "SELECT COUNT(*) as countC FROM candidat WHERE cin = :cin";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(':cin', $cin);
    $stmt1->execute();
    $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);



// Vérifier le résultat de la requête et afficher un message d'erreur si nécessaire
if ($result1['countC'] > 0){
    echo '<span style="color:yellow ;font-weight: bold;font-size:22px;margin-left:150px" > votre CIN est déjà utilisé pour un autre compte.</span>';
} 
else 
{
  if ($result['count'] > 0){
    echo '<span style="color:yellow ;font-weight: bold;font-size:22px;margin-left:150px" > votre email est déjà utilisé pour un autre compte.</span>';
  }
  else{

      if( $pass!=$confirm){
      echo '<span style="color: red;font-weight: bold;font-size:22px;" >Les mots de passe ne sont pas identiques</span>';
       }
    else{


    $insertionClient = $conn->prepare('INSERT INTO candidat(cin,firstname,lastname,email,pass,confirm) VALUES(?,?,?,?,?,?)');
    $insertionClient->execute(array($cin,$firstname,$lastname,$email,$pass,$confirm));

    echo '<span style="color:green ;font-weight: bold;font-size:22px;margin-left:150px" > ✔️Votre compte a été crée avec succés !!</span>';
         }
      }
 }
}

else{
    echo '<span style="color: red;font-weight: bold;font-size:22px;margin-left:55px" >❌Attention, Tous Les Champs Sont Obligatoires !!</span>';
  }
}
  
?>



<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire d'inscription</title>
  <link rel="stylesheet" type="text/css" href="styleregister.css">
</head>

<body>
  <div class="container2">


  <center>
    <h1>
      Inscription
    </h1>
  </center>
  <form method="POST" action="" >
  <label for="cin">CIN</label>
    <input type="text" id="cin" name="cin">
    <br><br>
    <label for="firstname">Prénom</label>
    <input type="text" id="firstname" name="firstname">
    <br><br>
    <label for="lastname">Nom</label>
    <input type="text" id="lastname" name="lastname">
    <br><br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email">
    <br><br>
    <label for="password">Mot de passe</label>
    <input type="password" id="pass" name="pass">
    <br><br>
    <label for="confirm-password">Confirmer le mot de passe</label>
    <input type="password" id="confirm" name="confirm">
    <br><br>
    <input type="submit" value="S'inscrire">
    <br><br>
    <p>Vous avez déjà un compte ? <a class="button" href="AuthentificationC.php">Se
        connecter</a></p>
  </form>

  </div>

</body>

</html>