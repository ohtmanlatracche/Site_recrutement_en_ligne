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
if(isset($_POST["sauvegarder"]))
{

           if(isset($_POST['cin']) &&isset($_POST['nom']) && isset($_POST['prénom']) && isset($_POST['email']) && isset($_POST['téléphone']) 
  && isset($_POST['age'])  && isset($_POST['sexe']) && isset($_POST['adresse']) && isset($_POST['ville'])
  &&  isset($_POST['codepostal']) && isset($_POST['profil']) && isset($_POST['domaine']) &&isset($_POST['experiences_note']) && isset($_POST['formations_note']) && isset($_POST['langues_note']) 
  && isset($_POST['skills_note']) && isset($_POST['certificat_note']) && isset($_POST['activité_note']) ) 
    {
       if(!empty($_POST['cin']) && !empty($_POST['nom']) && !empty($_POST['prénom']) && !empty($_POST['email']) && !empty($_POST['téléphone'])
       && !empty($_POST['age']) && !empty($_POST['sexe']) && !empty($_POST['adresse']) && !empty($_POST['ville'])
       &&  !empty($_POST['codepostal'])&& !empty($_POST['profil'])&& !empty($_POST['domaine'])
       && !empty($_POST['experiences_note'])&& !empty($_POST['formations_note']) && !empty($_POST['langues_note'])   && !empty($_POST['skills_note'])
       && !empty($_POST['certificat_note'])   && !empty($_POST['activité_note']))
      {
        

   $cin = htmlspecialchars($_POST['cin']);
    $nom = htmlspecialchars($_POST['nom']);
    $prénom = htmlspecialchars($_POST['prénom']);
    $email = htmlspecialchars($_POST['email']);
    $téléphone = htmlspecialchars($_POST['téléphone']);  
    $age= htmlspecialchars($_POST['age']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $adresse = htmlspecialchars($_POST['adresse']);  
    $ville = htmlspecialchars($_POST['ville']);
    
    $codepostal = htmlspecialchars($_POST['codepostal']);
    $domaine = htmlspecialchars($_POST['domaine']);
$profil = htmlspecialchars($_POST['profil']);
$experiences_note = htmlspecialchars($_POST['experiences_note']);
$formations_note = htmlspecialchars($_POST['formations_note']);
$langues_note = htmlspecialchars($_POST['langues_note']);
$skills_note = htmlspecialchars($_POST['skills_note']);
$certificat_note = htmlspecialchars($_POST['certificat_note']);
$activité_note = htmlspecialchars($_POST['activité_note']);


    

  


    $insertionClient = $conn->prepare('INSERT INTO infoscandidat
    (nom,prénom,email,téléphone,age,sexe,adresse,ville,codepostal,cin ,domaine,profil,
    experiences_note,formations_note,langues_note,skills_note,certificat_note,activité_note) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insertionClient->execute(array($nom,$prénom,$email,$téléphone,$age,$sexe,$adresse,$ville,$codepostal,$cin,$domaine,$profil,
   $experiences_note,$formations_note,$langues_note,$skills_note,$certificat_note,$activité_note));

    $susu = "<span style='color: green;font-weight: bold;font-size:15px;margin-left:205px;' class='ddn'> informations bien enregistrées ✔️</span>";

}
   
}
}



// pour afficher les données qui ont été sauvegarder
$_cinc = $_SESSION['cin'] ;
$sql1 = "SELECT lastname,firstname, email FROM candidat WHERE cin = :cin";
$stmt1 = $conn->prepare($sql1);
$stmt1->bindParam(':cin', $_cinc);
$stmt1->execute();
// Stocker les données dans des variables
$resultat1 = $stmt1->fetch(PDO::FETCH_ASSOC);
if ($resultat1) {
    $nom = $resultat1["lastname"];
    $prénom = $resultat1["firstname"];
    $email = $resultat1["email"];
} else {
    // La requête n'a renvoyé aucun résultat
    // Vous pouvez afficher un message ou affecter des valeurs par défaut
    echo "Aucun résultat trouvé.";
    $nom = "";
    $prénom = "";
    $email = "";
}





$sql = "SELECT  téléphone, age,sexe, adresse, ville, codepostal,
profil, domaine, formations_note,experiences_note,langues_note,skills_note,certificat_note,activité_note FROM infoscandidat WHERE cin = :cin";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':cin', $_cinc);
$stmt->execute();
// Stocker les données dans des variables
$resultat = $stmt->fetch(PDO::FETCH_ASSOC);
if ($resultat) {
   
    $téléphone = $resultat["téléphone"];
    $age = $resultat["age"];
    $sexe = $resultat["sexe"];
    $adresse = $resultat["adresse"];
    $ville = $resultat["ville"];
    $codepostal = $resultat["codepostal"];
    $profil = $resultat["profil"];
    $domaine = $resultat["domaine"];
    $formations_note = $resultat["formations_note"];
    $experiences_note = $resultat["experiences_note"];
    $langues_note = $resultat["langues_note"];
    $skills_note = $resultat["skills_note"];
    $certificat_note = $resultat["certificat_note"];
    $activité_note = $resultat["activité_note"];
} else {
    // La requête n'a renvoyé aucun résultat
    // Vous pouvez afficher un message ou affecter des valeurs par défaut
    echo "Aucun résultat trouvé.";
   
    $téléphone = "";
    $age= "";
    $sexe = "";
    $adresse = ""; 
    $ville = "";
    $codepostal = ""; 
    $profil = ""; 
    $domaine = ""; 
    $formations_note ="";
    $experiences_note ="";
    $langues_note ="";
    $skills_note ="";
    $certificat_note ="";
    $activité_note ="";
}


  
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylecandidat.css">
    <title>Document</title>
    <script src="jquery-3.3.1.min.js"></script>
</head>

<body>
<header>
    <a href="#" class="logo"><span>R</span>ecrutement <span>O</span>Z<span>O</span>D</a>
    <div class="menuToggle" onclick="toggleMenu();"></div>
    <ul class="navbar">
        <li><a href="infospersoN.php" onclick="toggleMenu();">Informations</a></li>
        <li><a href="mescondidatures.php" onclick="toggleMenu();">Candidatures</a></li>
        <li><a href="offres.php" onclick="toggleMenu();">Offres</a></li>
        <li><a href="documents.php" onclick="toggleMenu();">Documents</a></li>
        <a href="espacecandidats.php" class="btn-reserve"onclick="toggleMenu();">Home</a>
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
.doc a{
    color: cornflowerblue;
}

</style>


      



        <form method="POST" action="" >
        <div class="form" style="margin-left:20vw;border-radius: 10px darkgray;box-shadow: 0 0 15px rgba(0,0,0,0.2);width: 750px;margin-top: 25vh;padding-top:1px;padding-left:10px;">
        
            <table style="border-radius: 15px;border-spacing: 8px;">
            <center><h2 class="titre1" style="margin-top:50px;margin-left:20px;margin-bottom:30px;">Informations personnelles :</h2></center>
            <tr>
            <td>Photo:</td>
<td><input type="file" id="photo" name="photo" onchange="afficherPhoto(event)">
<img id="image" src="#" alt="Aperçu de la photo sélectionnée" style="max-width: 100px; max-height: 200px;" />

<script>
// Vérifier si une image est déjà enregistrée dans le stockage local
if (localStorage.getItem("photo")) {
  var image = document.getElementById("image");
  image.src = localStorage.getItem("photo");
}

function afficherPhoto(event) {
  var input = event.target;
  var image = document.getElementById("image");
  var reader = new FileReader();
  reader.onload = function(){
    var dataURL = reader.result;
    image.src = dataURL;
    // Sauvegarder l'image dans le stockage local
    localStorage.setItem("photo", dataURL);
  };
  reader.readAsDataURL(input.files[0]);
}
</script>
</td>
    </tr>
            <tr>
            <td>CIN :</td>
            <td><input type="text" placeholder="cin" class="a " style=" margin-top: 10px;" name="cin" required value="<?php echo $_cinc ; ?>"></td>
        </tr>
                <tr>
                    <td>Nom :</td>
                    <td><input type="text" placeholder="nom" class="a " style=" margin-top: 10px;" name="nom" value="<?php echo $nom ; ?>"></td>
                </tr>
                <tr>
                    <td>Prénom :</td>
                    <td><input type="text" placeholder="prénom" class="a" name="prénom" value="<?php echo $prénom ; ?>"></td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td><input type="email" placeholder="exemple@gmail.com"  class="a" name="email" value="<?php echo $email ; ?>"></td>
                </tr>
                <tr>
                    <td>Téléphone :</td>
                    <td><input type="tel" placeholder="06 00 00 00 00"  class="a" name="téléphone" value="<?php echo $téléphone ; ?>"></td>
                </tr>
                <tr>
                    <td>Age :</td>
                    <td><input type="number"  class="a" name="age" value="<?php echo $age ; ?>"></td>
                </tr>

                <tr>
                    <td>Sexe :</td>
                    <td><input type="radio" name="sexe" value="homme"  id="man" style="margin-left: -50px;" required>
                        <label for="man">homme</label>
                        <input type="radio" name="sexe" value="femme" id="momen" required >
                        <label for="women">femme</label>
                    </td>
                    </tr>

                    <tr>
                    <td>Adresse :</td>
                    <td><input type="text" placeholder="adresse" class="a " style=" margin-top: 10px;" name="adresse" value="<?php echo $adresse; ?>"></td>
                </tr>

                <tr>
                    <td>Ville :</td>
                    <td><input type="text" placeholder="ville" class="a " style=" margin-top: 10px;" name="ville" value="<?php echo $ville ; ?>"></td>
                </tr>
                

                <tr>
                    <td>Code postal :</td>
                    <td><input type="number" placeholder="24000" class="a " style=" margin-top: 10px;" name="codepostal"value="<?php echo $codepostal ; ?>"></td>
                </tr>

           


            </table>
            <table style="border-radius: 15px;border-spacing: 8px;">
            <center><h2 class="titre2" style="margin-top:50px;margin-left:20px;margin-bottom:30px;">Documents joinées :</h2></center>
            <tr>
            <?php




$req = $conn->prepare("SELECT name,file_url FROM files WHERE cin= ? ");
$req->execute(array($_cinc));



while($data = $req->fetch()){
    echo $data['name'].' : '.'<a href="'.$data['file_url'].'">Télécharger '.$data['name'].'</a>';
}
?>
            </tr>

            </table>
                </td>
            </tr>

            </table>
            <table style="border-radius: 15px;border-spacing: 8px;">
            <center><h2 class="titre2" style="margin-top:50px;margin-left:20px;margin-bottom:30px;">Informations professionnelles :</h2></center>
            <tr>
            <td>Domaine :</td>
            <td><select id="domaine" name="domaine" style="margin-bottom:10px;" required  >
  <option value="Informatique">Informatique</option>
  <option value="Marketing">Marketing</option>
  <option value="Finance">Finance</option>
  <option value="Ressources Humaines">Ressources Humaines</option>
  <option value="Design">Design</option>
  <option value="Vente">Vente</option>
  <option value="Communication">Communication</option>
  <option value="Juridique">Juridique</option>
  <option value="Santé">Santé</option>
  <option value="Ingénierie">Ingénierie</option>
  <option value="Gestion de projet">Gestion de projet</option>
  <option value="Éducation">Éducation</option>
  <option value="Immobilier">Immobilier</option>
  <option value="Consulting">Consulting</option>
  <option value="Art">Art</option>
</select>

            </td>
            </tr>


            <tr>
            <td>Profil :</td>
            <td><select id="profil" name="profil" style="margin-bottom:10px;" required >
  <option value="Ingénieur">Ingénieur</option>
  <option value="Technicien">Technicien</option>
  <option value="Bac+2">Bac+2</option>
  <option value="Bac+3">Bac+3</option>
  <option value="Bac+5">Bac+5</option>
  <option value="Licence">Licence</option>
  <option value="Master">Master</option>
  <option value="Doctorat">Doctorat</option>
  <option value="Autre">Autre</option>

            </select>

            </td>
            </tr>
                <div class="area">
				<td>Expériences :</td>
				<td><textarea name="experiences_note" placeholder="Citez vos expériences..." ><?php echo $experiences_note ?></textarea></td>
                </div>
			</tr>
			<tr> 
                <div class="area">
				<td>Formations :</td>
				<td><textarea name="formations_note"  placeholder="Citez vos formations ..."><?php echo $formations_note ?></textarea></td>
                </div>
			</tr>
			<tr>
                <div class="area">
				<td>Langues :</td>
				<td><textarea name="langues_note" placeholder="Quelles sont les langues que vous maitrisez?"><?php echo $langues_note ?></textarea></td>
                </div>
			</tr>
			<tr>
                <div class="area">
				<td>Skills :</td>
				<td><textarea name="skills_note" placeholder="Informez-nous de vos skills..."><?php echo $skills_note ?></textarea></td>
                </div>
			</tr>
            <tr>
                <div class="area">
				<td>Certificats et Diplômes :</td>
                <td><textarea name="certificat_note"  placeholder="Quels sont les diplomes et les certificats que vous possédez?"><?php echo $certificat_note ?></textarea></td>
                </div>
			</tr>
			<tr>
                <div class="area">
				<td>Les activités para-universitaires :</td>
<td><textarea name="activité_note" placeholder="Quelles sont vos activités en dehors de vos études universitaires ?"><?php echo $activité_note  ?></textarea></td>
                </div>
</tr>


<tr style="text-align: center;margin-top: 30px;">
                    <td style="padding-left: 200px;">
                    <td> <input type="submit" value="sauvegarder" name="sauvegarder" class="button"></td>
                    <td> <input type="submit" value="modifier" name="modifier" class="button" ></td>

                </tr>






            </table>
            
            <?php
        
        if(isset($erre)){
            echo $erre;
        }
        if(isset($susu)){
            echo $susu;
        }
        ?>
        
        </div>




        </form>
       
</body>
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

        
<script>
        $(document).ready(function () {

          $(".ddn").click(function () {
                $(this).hide();

            })

        })
</script>
       

















</html>