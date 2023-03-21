<?php
session_start(); 

$_cinr=$_SESSION['cinr'];

?>

<?php

try {
  $conn = new PDO("mysql:host=localhost;dbname=ozod;port=3306;charset=utf8", 'root', '',
   array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
  echo 'Erreur de connexion: ' . $e->getMessage();
}

if(isset($_POST['Soumettre'])){


if(isset($_POST['titre']) && isset($_POST['descriptionoffre']) && isset($_POST['entreprise'])  && isset($_POST['lieu'])  && isset($_POST['typeoffre']) 
   && isset($_POST['dateoffre']) && isset($_POST['durée'])&& isset($_POST['idr'])){

    if(!empty($_POST['titre']) && !empty($_POST['descriptionoffre']) && !empty($_POST['entreprise'])
    && !empty($_POST['lieu']) && !empty($_POST['typeoffre']) && !empty($_POST['dateoffre']) && !empty($_POST['durée']) && !empty($_POST['idr'])){
        

    
    $titre = htmlspecialchars($_POST['titre']);
    $descriptionoffre = htmlspecialchars($_POST['descriptionoffre']);
    $entreprise = htmlspecialchars($_POST['entreprise']);
    $lieu = htmlspecialchars($_POST['lieu']);
    $typeoffre = htmlspecialchars($_POST['typeoffre']);
    $dateoffre = htmlspecialchars($_POST['dateoffre']);
    $durée = htmlspecialchars($_POST['durée']);
    $idr = htmlspecialchars($_POST['idr']);
    
   
    $insertionClient = $conn->prepare('INSERT INTO annonce(titre,descriptionoffre,entreprise,lieu,typeoffre,dateoffre,durée,idr) VALUES(?,?,?,?,?,?,?,?)');
    $insertionClient->execute(array($titre,$descriptionoffre,$entreprise,$lieu,$typeoffre,$dateoffre,$durée,$idr));
 
    $susu = "<span style='color: green;font-weight: bold;font-size:15px;margin-left:205px;' class='ddn'> informations bien enregistrées ✔️</span>";
}
  
  if(empty($_POST['titre']) || empty($_POST['descriptionoffre'])||empty($_POST['entreprise']) ||empty($_POST['lieu'])
  || empty($_POST['typeoffre']) || empty($_POST['dateoffre']) || empty($_POST['durée'])|| empty($_POST['idr']) ){

      
      $erre= "<span style='color: red;font-weight: bold;font-size:15px;margin-left:205px;' class='ddn'> ❌Attention, Tous Les Champs Sont Obligatoires !!</span>";
     
    }

 }}
  

?>




<html>
  <head>
    <link rel="website icon" type="png"
    href="recrutement-techno-mains-1000x516.jpg">
    <title>Créer une offre d'emploi</title>
    <style>
    body {
      padding: 0;
      margin: 0;
      background-color: #f4f4f4;
      font-family: Georgia, 'Times New Roman', Times, serif;
      font-size: 17px;
      font-weight:500;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

    }

    h1 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    select,
    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: none;
      box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #2E8B57;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background-color: lightgray;
    }

    .header h1 {
      margin: 0;

    }

    .header button {
      background-color: lightblue;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .menu {
      
      width: 200px;
      left: 0;
      bottom: 0;
      margin-top: 50px;
      margin-left: 30px;
      height: 535px;
      position:sticky;
      top: 74px;


    }

    .menu a {
      display: block;
      margin-bottom: 20px;
      background-color: lightblue;
      color: white;
      padding: 10px;
      text-decoration: none;
      border-radius: 5px;
     
    }

    .menu a:hover {
      background-color: blue;
    }
.oth{
  position:fixed;
  top: 100px;
}
    .main {
      margin-left: 140px;
      padding: 20px;
      margin-top: 100px;
    }
  </style>
  </head>
  <body>
  <header>
    <a href="#" class="logo"><span>R</span>ecrutement <span>O</span>Z<span>O</span>D</a>
    <div class="menuToggle" onclick="toggleMenu();"></div>
    <ul class="navbar">
    <li><a href="deposerannonce.php" onclick="toggleMenu();">Déposer annonce</a></li>
        <li><a href="consulterlescandidats.php" onclick="toggleMenu();">Consulter candidats </a></li>
        <li><a href="offresrecruteur.php" onclick="toggleMenu();">Mes annonces</a></li>
        <a href="espacerecruteur.php" class="btn-reserve"onclick="toggleMenu();">Home</a>
    </ul>
</header>

   <style>
          .dd:hover {
            width: 300px;
            background-color: antiquewhite;


        }

        .p:hover {
            font-size: large;
            border-radius: 15px;
            box-shadow: 2px 0 65px 10px inset rgb(114, 241, 103);
        }


        .ss:hover {
            width: 500px;
            background-color: rgb(26, 144, 184);


        }

        a {
            color: black;
            text-decoration: none;
        }

        input {
            border-radius: 5px;
        }

        a:hover {
            text-decoration-color: rgb(210, 68, 7);
            text-decoration: underline;

        }
    header{
    position: fixed;
    top: 0%;
    left: 0%;
    padding: 20px 10px;
    width: 100%;
    z-index: 1;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    transition: 0.5s;
    background: linear-gradient(90deg, rgba(192,191,208,1) 13%, rgba(25,72,210,1) 44%, rgba(0,212,255,1) 100%);
    font-family: 'poppins', sans-serif;
    scroll-behavior: smooth;
    
}

.logo{
    color: #353b68;
    font-weight: bold;
    font-size: 2em;
    text-decoration: none;
    margin-right: 70px;
    margin-left: -55px;
}
.logo span{
    color: #dd8221;
}

.navbar{
    display: flex;
    position: relative;
}
.navbar li{
    list-style: none;
}
.navbar a{
    color: #060606;
    text-decoration: none;
    margin-left: 30px;
    font-weight: 700;
    font-size: 1.1em;
}
.btn-reserve{
    padding: 10px 20px;
    background: #fb911f;
   margin-top: -10px;
   text-transform:uppercase ;
}

.btn-reserve:hover{
    background: #d87710;
    transition: ease-out;
}

header .navbar li a:hover{
    color: #fb911f;
    border-bottom: 2px solid #fb911f;
}
header.sticky{
    background: #fff;
    padding: 10px 10px;
    box-shadow: 0px 5px 20px rgba(0,0,0, 0.05);
}

header.sticky .logo{
    color: #000;
}

header.sticky .navbar li a {
    color: #000;
}

header.sticky li a:hover{
    color: #fb911f;
    border-bottom: 2px solid #fb911f;
} 

</style>
 
  
    <div class="main">
      <div class="container">
              <h1>Ajouter une annonce</h1><br>
              <form method="POST" action="">
                <div class="form-group">
                  <label for="titre">Titre :</label>
                  <input type="text" id="titre" name="titre">
                </div>

                <div class="form-group">
                  <label for="descriptionoffre">Description :</label>
                  <textarea id="descriptionoffre" name="descriptionoffre"></textarea>
                </div>
          
                <div class="form-group">
                  <label for="entreprise">Entreprise :</label>
                  <input type="text" id="entreprise" name="entreprise">
                </div>


                <div class="form-group">
                  <label for="lieu">Lieu :</label>
                  <input type="text" id="lieu" name="lieu">
                </div>
        
                <div class="form-group">
                  <label for="typeoffre">Type de contrat :</label>
                  <select id="typeoffre" name="typeoffre">
                    <option value="temps-plein">Temps plein</option>
                    <option value="Hybride">Hybride</option>
                    <option value="temps-partiel">Temps partiel</option>
                    <option value="à distance">A distance</option>
                    <option value="Temps partagé">Temps partagé</option>
                    <option value="stage">Stage</option>
                  </select>
                </div>
        
        
                <div class="form-group">
                  <label for="dateoffre">Date de l'annonce </label>
                  <input type="date" id="dateoffre" name="dateoffre">
                </div>
        
        
                <div class="form-group">
                  <label for="durée">Période :</label>
                  <input type="text" id="durée" name="durée">
                </div>
                <div class="form-group">
                  <label for="idr">Votre CIN :</label>
                  <input type="text" id="idr" name="idr" value="<?php echo $_cinr; ?>">
                </div>
        
                <div class="form-group">
                    <input type="submit" value="Soumettre" name="Soumettre">
                </div>
             
                    <?php
        
        if(isset($erre)){
            echo $erre;
        }
        if(isset($susu)){
            echo $susu;
        }
        ?>
        
              </form>
        
  </body>
 
</html>