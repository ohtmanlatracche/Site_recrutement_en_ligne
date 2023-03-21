<?php
session_start();
?>

<?php

try {
  $conn = new PDO(
    "mysql:host=localhost;dbname=ozod;port=3306;charset=utf8",
    'root',
    '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (Exception $e) {
  echo 'Erreur de connexion: ' . $e->getMessage();
}


if (isset($_POST['cinr']) &&isset($_POST['emailr']) && isset($_POST['passr'])) {
  if (!empty($_POST['cinr']) &&!empty($_POST['emailr']) && !empty($_POST['passr'])) {


    $cin = htmlspecialchars($_POST['cinr']);
    $email = htmlspecialchars($_POST['emailr']);
    $pass = htmlspecialchars($_POST['passr']);




    $auth = $conn->prepare("SELECT * FROM recruteur WHERE cin = ? AND  email = ? AND pass = ?");
    $auth->execute(array($cin,$email, $pass));
    // Vérifier si la requête a réussi
    if ($auth) {

      $count = $auth->rowCount();

      if ($count >= 1) {
        echo "Vous êtes connecté avec succès!";
        //declaration des variables qui vont etre dans tous les pages 

$_SESSION['cinr'] = $_POST['cinr'];
$_SESSION['emailr'] = $_POST['emailr'];
$_SESSION['passr'] = $_POST['passr'];
if (isset($_POST['check'])) {
  setcookie('cinr', $_POST['cinr'], time() + 3600 * 24 * 30);
  setcookie('emailr', $_POST['emailr'], time() + 3600 * 24 * 30);
  setcookie('passr', $_POST['passr'], time() + 3600 * 24 * 30);
}
        header("Location: espacerecruteur.php");
      } else {
        // L'utilisateur n'a pas été trouvé ou le mot de passe est incorrect
        $erre = "Nom d'utilisateur ou mot de passe incorrect.";
      }
    } else {
      // La requête a échoué
      echo "Erreur: ";
    }
  }
}

?>


<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire d'authentification</title>
  <link rel="stylesheet" href="style2.css" />
</head>

<body>
  <div class="container">
    <h1>Authentification</h1>


    <?php
    if (isset($erre)) {
      echo " <p style='color:red ;font-size:20px'>" . $erre . "</p>";}

    ?>
   <form method="POST" action="">
    <label for="cin">CIN</label>
      <input type="text" id="cinr" name="cinr" required value="<?php if(isset($_COOKIE['cinr'])) echo $_COOKIE['cinr'] ; ?>" >
      <br><br>
      <label for="username">Login</label>
      <input type="email" id="emailr" name="emailr" value="<?php if(isset($_COOKIE['emailr'])) echo $_COOKIE['emailr'] ; ?>">
      <br><br>
      <label for="password">Mot de passe</label>
      <input type="password" id="passr" name="passr" value="<?php if(isset($_COOKIE['passr'])) echo $_COOKIE['passr'] ; ?>">
      <br><br>
      <label for="check">Se souvenir de moi</label>
      <input type="checkbox" id="check" name="check" >
      <br><br>
      <input type="submit" value="Se connecter">
      <br>


      <p>Vous n'avez pas de compte ? <a class="button" href="registerR.php">Créer un compte</a></p>


    </form>

    



  </div>


</body>

</html>



