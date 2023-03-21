<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=ozod;port=3306;charset=utf8", 'root', '',
     array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
  }
 
  if(isset($_POST["envoyer"])){

  if(isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['mess'])){
    if(!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['mess'])){


        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $mess = htmlspecialchars($_POST['mess']);
        $insertionClient = $conn->prepare('INSERT INTO messages(nom,email,mess) VALUES(?,?,?)');
        $insertionClient->execute(array($nom,$email,$mess));

        $susu = "<span style='color: green;font-weight: bold;font-size:15px;margin-left:20px;' class='ddn'> informations bien enregistrées ✔️</span>";}
    }
    if(empty($_POST['nom']) || empty($_POST['email']) ||empty($_POST['mess'])){
        $erre= "<span style='color: red;font-weight: bold;font-size:15px;margin-left:20px;' class='ddn'> ❌Attention, Tous Les Champs Sont Obligatoires !!</span>";
       }
    
       
    
  
      
    
    
    
  }
    
      
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleinterface1.css">
    <link rel = "preconnect" href = "https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Recrutement OZOD</title>
<body>
<header>
    <a href="#" class="logo"><span>R</span>ecrutement <span>O</span>Z<span>O</span>D</a>
    <div class="menuToggle" onclick="toggleMenu();"></div>
    <ul class="navbar">
        <li><a href="#banniere" onclick="toggleMenu();">Accueil</a></li>
        <li><a href="#candidat" onclick="toggleMenu();">Espace Candidat</a></li>
        <li><a href="#recruteur" onclick="toggleMenu();">Espace Recruteur</a></li>
        <li><a href="#temoignage" onclick="toggleMenu();">À propos de nous</a></li>
        <li><a href="#contact" onclick="toggleMenu();">Contact</a></li>
        <li><a href="#admin" onclick="toggleMenu();">Admin</a></li>

        <a href="#" class="btn-reserve"onclick="toggleMenu();">Home</a>
    </ul>
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

if (isset($_POST['Seconnecter'])){
if (isset($_POST['cinA']) && isset($_POST['emailA']) && isset($_POST['passA'])) {
  if (!empty($_POST['cinA']) && !empty($_POST['passA']) && !empty($_POST['emailA'])) {


    $cin = htmlspecialchars($_POST['cinA']);
    $email = htmlspecialchars($_POST['emailA']);
    $pass = htmlspecialchars($_POST['passA']);




    $auth = $conn->prepare("SELECT * FROM administrateur WHERE cin = ? AND email = ? AND pass = ?");
    $auth->execute(array($cin,$email, $pass));
    // Vérifier si la requête a réussi
    if ($auth) {

      $count = $auth->rowCount();

      if ($count >= 1) {
        echo "Vous êtes connecté avec succès!";
       
        header("Location: adminpage.php");
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
}
?>
</header>



<section class="banniere" id="banniere">
    <div class="contenu">
        <h2>Bienvenue</h2>
        <p>Vous êtes candidat et recherchez un emploi? <br>
            Vous êtes recruteur et offrez un emploi ? <br>
            Cette plateforme est dédiée pour vous <br>Inscrivez-vous et c'est parti!</p>
        <a href="AuthentificationC.php" class="btn1">Espace Candidat</a>
        <a href="AuthentificationR.php" class="btn2">Espace Recruteur</a>
    </div>
</section>





<section class="candidat" id="candidat">
    <div class="row">
        <div class="col50">
        <a href="AuthentificationC.php"  style="text-decoration: none;">
        <h2 class="titre-texte"><span>E</span>SPACE <span>C</span>ANDIDAT</h2></a>
            <p>Vous recherchez un emploi ? Retrouvez toutes les offres
                 d'emploi sur cette plateforme . Inscrivez- vous et postulez en ligne !
            </p>
        </div>
        <div class="col50">
            <div class="img">
            <a href="AuthentificationC.php"><img src="./images/candidat.png" alt="image"></a>
            </div>
        </div>
    </div>
</section>





<section class="recruteur" id="recruteur">
    <div class="row">
        <div class="col50">
           <a href="AuthentificationR.php"  style="text-decoration: none;"> <h2 class="titre-texte"><span>E</span>SPACE <span>R</span>ECRUTEUR</h2></a>
          

            <p>Vous souhaitez renforcer la performance de vos recrues ? Avec <b><i>OZOD</i></b> , détectez et retenez des talents
             qui vous ressemblent et qui seront inspirés et engagés en adhérant à votre culture d’entreprise.<br>
             85% des emplois de 2030 n'existent pas encore ! Le monde change, les méthodes de recrutement aussi. Avec nous, 
             identifiez des personnalités aptes à grandir dans le poste et à donner le meilleur d'elles-mêmes.
            </p>
        </div>
        <div class="col50">
            <div class="img">
            <a href="AuthentificationR.php"><img src="./images/recruteur.jpg" alt="image"></a>
            </div>
        </div>
    </div>
</section>
 <section class="temoignage" id="temoignage">
    <div class="titre blanc">
        <h2 class="titre-texte">NOTRE EQUIPE <span>O</span>Z<span>O</span>D</h2>
    </div>
    <div class="contenu">
        <div class="box">
            <div class="imbox">
                <img src="./images/jabiri.jfif" alt="">
            </div>
            <div class="text">
                <p>Jeune étudiant âgé de 20 ans inscrit en licence génie informatique à la fst de Settat</p>
                <h3>Othman Jabiri</h3>
            </div>
        </div>
        <div class="box">
            <div class="imbox">
                <img src="./images/zakaria.jfif" style=" height:100%;" alt="">
            </div>
            <div class="text">
                <p>Jeune étudiant âgé de 20 ans inscrit en licence génie informatique à la fst de Settat.</p>
                <h3>Zakaria Touyeb</h3>
            </div>
        </div>
        <div class="box">
            <div class="imbox">
                <img src="./images/latrache.jfif"alt="">
            </div>
            <div class="text">
                <p>Jeune étudiant âgé de 20 ans inscrit en licence génie informatique à la fst de Settat.</p>
                <h3>Othman Latrache</h3>
            </div>
        </div>
        <div class="box">
            <div class="imbox">
                <img src="./images/douha.jfif" alt="">
            </div>
            <div class="text">
                <p>Jeune étudiante âgée de 20 ans inscrite en licence génie informatique à la fst de Settat.</p>
                <h3>Douha Tissir</h3>
            </div>
        </div>
    </div>
 </section>
 <section class="contact" id="contact"  >
     <div class="titre noir" >
         <h2 class="titre-text"><span>C</span>ontactez <span>N</span>ous</h2>
     </div>

     <div class="contactform" style="margin-left:298px;">
         <h3>Envoyez un message</h3>
         <form method="POST" action="" >
         <div class="inputboite">
             <input type="text" placeholder="Nom" name="nom">
         </div>
         <div class="inputboite">
            <input type="text" placeholder="email" name="email">
         </div>
         <div class="inputboite">
            <textarea placeholder="message" name="mess"></textarea>
         </div>
         <div class="inputboite">
             <input type="submit" value="envoyer" name="envoyer">
         </div>
         </form>
     </div>
 </section>

 <section class="admin" id="admin"  >
     <div class="titre noir" >
         <h2 class="titre-text"><span>A</span>DMIN</h2>
     </div>

     <div class="contactform" style="margin-left:298px;">
         <h3>Authentification</h3>
         <form method="POST" >
         <div class="inputboite">
             <input type="text" placeholder="Cin" name="cinA">
         </div>
         <div class="inputboite">
             <input type="email" placeholder="email" name="emailA">
         </div>
         <div class="inputboite">
            <input type="password" placeholder="password" name="passA">
         </div>
         <div class="inputboite">
             <input type="submit" value="Se connecter" name="Seconnecter" >
         </div>
         </form>
     </div>
 </section>
 

 
         <?php
        
        if(isset($erre)){
            echo $erre;
        }
        if(isset($susu)){
            echo $susu;
        }
        ?>
         </form>

     </div>
 </section>
 <div class="copyright">
     <p>copyright 2023    <a href="#temoignage" onclick="toggleMenu();">   équipe O Z O D    </a>     Tous droits réservés</p>
 </div>
 <script type="text/javascript">
     window.addEventListener('scroll', function(){
         const header =document.querySelector('header');
         header.classList.toggle("sticky", window.scrollY > 0 );
     });

     function toggleMenu(){
         const tmenuToggle = document.querySelector('.menuToggle');
         const navbar = document.querySelector('.navbar');
         navbar.classList.toggle('active');
         menuToggle.classList.toggle('active');
     }
 </script>
</body>



</html>