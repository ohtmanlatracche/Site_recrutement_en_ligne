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


if (isset($_POST['cin']) && isset($_POST['email']) && isset($_POST['pass'])) {
  if (!empty($_POST['cin']) && !empty($_POST['pass']) && !empty($_POST['email'])) {


    $cin = htmlspecialchars($_POST['cin']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);




    $auth = $conn->prepare("SELECT * FROM candidat WHERE cin = ? AND email = ? AND pass = ?");
    $auth->execute(array($cin,$email, $pass));
    // Vérifier si la requête a réussi
    if ($auth) {

      $count = $auth->rowCount();

      if ($count >= 1) {
        echo "Vous êtes connecté avec succès!";
        

        $_SESSION['cin'] = $_POST['cin'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['pass'] = $_POST['pass'];
        if (isset($_POST['check'])) {
          setcookie('cin', $_POST['cin'], time() + 3600 * 24 * 30);
          setcookie('email', $_POST['email'], time() + 3600 * 24 * 30);
          setcookie('pass', $_POST['pass'], time() + 3600 * 24 * 30);
        }

        header("Location: espacecandidats.php");
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
      echo " <p style='color:red ;font-size:20px'>" . $erre . "</p>";
    }

    ?>
    <form method="POST" action="">
    <label for="cin">CIN</label>
      <input type="text" id="cin" name="cin" placeholder="Votre CIN" required value="<?php if(isset($_COOKIE['cin'])) echo $_COOKIE['cin'] ; ?>" >
      <br><br>
      <label for="username">Login</label>
      <input type="email" id="email" name="email" placeholder="Votre email"  value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email'] ; ?>">
      <br><br>
      <label for="password">Mot de passe</label>
      <input type="password" id="pass" name="pass" placeholder="Votre password" value="<?php if(isset($_COOKIE['pass'])) echo $_COOKIE['pass'] ; ?>">
      <br><br>
      <label for="check">Se souvenir de moi</label>
      <input type="checkbox" id="check" name="check" >
      <br><br>
      <input type="submit" value="Se connecter">
      <br>

      <p>Vous n'avez pas de compte ? <a class="button" href="registerC.php">Créer un compte</a></p>


    </form>

  </div>


</body>

</html>