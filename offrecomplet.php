<?php
session_start();

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=localhost;dbname=ozod;port=3306;charset=utf8", 'root', '',
     array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
  }


  $_cinc = $_SESSION['cin'] ;



$sql = "SELECT nom, prénom, email, téléphone, age ,profil, domaine, 
formations_note,experiences_note,langues_note,skills_note,certificat_note,activité_note
 FROM infoscandidat WHERE cin = :cin";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':cin', $_cinc);
$stmt->execute();
// Stocker les données dans des variables
$resultat = $stmt->fetch(PDO::FETCH_ASSOC);
if ($resultat) {
    $nom = $resultat["nom"];
    $prénom = $resultat["prénom"];
    $email = $resultat["email"];
    $téléphone = $resultat["téléphone"];
    $age = $resultat["age"];
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
    $nom = "";
    $prénom = "";
    $email = "";
    $téléphone = "";
    $age = "";
 
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylepostuler.css">
    <title>Document</title>
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
    <?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=ozod;port=3306;charset=utf8", 'root', '',
     array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
  }

if(isset($_POST['envoyer'])){

        $ido = $_POST['ido']; 
    
        $auth = $conn->prepare("SELECT * FROM candidature WHERE idc = ? AND ido = ? ");
        $auth->execute(array($_cinc,$ido));
        // Vérifier si la requête a réussi
        if ($auth) {
    
          $count = $auth->rowCount();
    
          if ($count >= 1) {
    echo '<span style="color:red ;font-weight: bold;font-size:22px;margin-left:150px" > vous avez déjà postulé pour ce poste.</span>';
      }
       else{



// Récupération des données du formulaire
$experiences_nombre = $_POST['experiences_nombre'];
$experiences_duree = $_POST['experiences_duree'];
$experiences_note = $_POST['experiences_note'];
$formations_nombre = $_POST['formations_nombre'];
$formations_duree = $_POST['formations_duree'];
$formations_note = $_POST['formations_note'];
$langues_nombre = $_POST['langues_nombre'];
//$langues_duree = $_POST['langues_duree'];
$langues_note = $_POST['langues_note'];
$skills_nombre = $_POST['skills_nombre'];
//$skills_duree = $_POST['skills_duree'];
$skills_note = $_POST['skills_note'];
$certificat_nombre = $_POST['certificat_nombre'];
//$certificat_duree= $_POST['certificat_duree'];
$certificat_note = $_POST['certificat_note'];
$activité_nombre = $_POST['activité_nombre'];
$activité_duree = $_POST['activité_duree'];
$activité_note = $_POST['activité_note'];

// Calcul du score
$score = 0;
    if(isset($_POST['experiences_nombre']) && isset($_POST['experiences_duree']) && isset($_POST['experiences_note'])  
    && isset($_POST['formations_nombre'])  && isset($_POST['formations_duree']) 
   && isset($_POST['formations_note']) && isset($_POST['langues_nombre'])  
   && isset($_POST['langues_note'])  && isset($_POST['skills_nombre'])
    && isset($_POST['skills_note'])  && isset($_POST['certificat_nombre'])
   && isset($_POST['certificat_note'])  && isset($_POST['activité_nombre'])
   && isset($_POST['activité_duree']) && isset($_POST['activité_note'])){
if ($experiences_nombre >= 0 && $experiences_duree >= 0) {
	$score += $experiences_nombre * $experiences_duree * 2;
}

if ($formations_nombre >= 0 && $formations_duree >= 0) {
	$score += $formations_nombre * $formations_duree * 1.5;
}

if ($certificat_nombre >= 0 ) {
	$score += $certificat_nombre * 1.5;
}

if ($langues_nombre  >= 0) {
	$score += $langues_nombre * 1.2;
}

if ($skills_nombre >= 0) {
    $score += $skills_nombre *  1.3;
}
if ($activité_nombre >= 0 && $activité_duree>= 0) {
	$score += $activité_nombre * $activité_duree * 1;
}
   }
 




$idc = htmlspecialchars($_POST['idc']);
$ido = htmlspecialchars($_POST['ido']);
$nom = htmlspecialchars($_POST['nom']);
$prénom = htmlspecialchars($_POST['prénom']);
$email = htmlspecialchars($_POST['emailc']);
$téléphone = htmlspecialchars($_POST['téléphone']);
$age = htmlspecialchars($_POST['age']);

$domaine = htmlspecialchars($_POST['domaine']);
$profil = htmlspecialchars($_POST['profil']);
$experiences_note = htmlspecialchars($_POST['experiences_note']);
$formations_note = htmlspecialchars($_POST['formations_note']);
$langues_note = htmlspecialchars($_POST['langues_note']);
$skills_note = htmlspecialchars($_POST['skills_note']);
$certificat_note = htmlspecialchars($_POST['certificat_note']);
$activité_note = htmlspecialchars($_POST['activité_note']);



   

$insertionClient = $conn->prepare
('INSERT INTO candidature(idc,ido,nom,prénom,emailc,téléphone,age,domaine,profil,
  score,experiences_note,formations_note,langues_note,skills_note,certificat_note,activité_note)
  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$insertionClient->execute(array($idc,$ido,$nom,$prénom,$email,$téléphone,$age,$domaine,$profil,
$score,$experiences_note,$formations_note,$langues_note,$skills_note,$certificat_note,$activité_note));
echo "vous avez postulé avec succés ";
header("Location:mescondidatures.php");

}}}

?>
</header>
<form method="POST" action="" >

<div style="margin-bottom:60vh;border-radius: 10px darkgray;box-shadow: 0 0 15px rgba(0,0,0,0.2);width: 750px;margin-top: 20vh;">
    <table style="border-radius: 15px;border-spacing: 8px;">
    <tr>
            <td>CIN :</td>
            <td><input type="text" placeholder="CIN" class="a " style=" margin-top: 10px;" name="idc" required value="<?php echo $_cinc; ?>"></td>
        </tr>
        <tr>
            <td>idoffre:</td>
            <td><input type="text" placeholder="offre" class="a " style=" margin-top: 10px;" name="ido" required value="<?php echo $_POST['idoffre'] ; ?>"></td>
        </tr>
        <tr>
            <td>Nom :</td>
            <td><input type="text" placeholder="nom" class="a " style=" margin-top: 10px;" name="nom" required value="<?php echo $nom; ?>"></td>
        </tr>
        <tr>
            <td>Prénom :</td>
            <td><input type="text" placeholder="prénom" class="a" name="prénom" required value="<?php echo $prénom; ?>"></td>
        </tr>
        <tr>
            <td>Email :</td>
            <td><input type="email" placeholder="exemple@gmail.com"  class="a" name="emailc" required value="<?php echo $email; ?>"></td>
        </tr>
        <tr>
            <td>Téléphone :</td>
            <td><input type="tel" placeholder="06 00 00 00 00"  class="a" name="téléphone" required value="<?php echo $téléphone; ?>"></td>
        </tr>
        <tr>
            <td>Age :</td>
            <td><input type="integer"  class="a" name="age"  required style="border: 1.5px solid #000;width:20%" value="<?php echo $age; ?>"></td>
        </tr>




        <tr>
            <td>Domaine :</td>
            <td><select id="domaine" name="domaine" required  >
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
            <td><select id="profil" name="profil" required >
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
        
            <tr>
            <td>Documents :</td>
            <td><?php



$varpdf ="cv.pdf" ;
    $req = $conn->prepare("SELECT name,file_url FROM files WHERE cin= ? AND name =? ");
    $req->execute(array($_cinc,$varpdf));



    while($data = $req->fetch()){
        echo $data['name'].' : '.'<a href="'.$data['file_url'].'">Télécharger '.$data['name'].'</a><br>';
        break;
    }
?>    
           
            </td>
</tr>
        
        <tr style="text-align: center;margin-top: 30px;">
            <td style="padding-left: 200px;">
            <td><a href="#form">
<input type="submit" value="suivant" style="background-color: cornflowerblue;" name="suivant"></a></td>

        </tr>


    </table>
    
</div>


</head>




<h1>Formulaire de candidature</h1>
	<form method="post" action="">
		<table>
			<tr>
				<th>Champ </th>
				<th>Nombre</th>
				<th>Durée(en mois)</th>
				<th>Détails</th>
			</tr>
			<tr>
				<td>Expériences</td>
				<td><input type="number" name="experiences_nombre" min="0" required></td>
				<td><input type="number" name="experiences_duree"  min="0"required></td>
				<td><textarea name="experiences_note" placeholder="Citez vos expériences..."><?php echo $experiences_note ?></textarea></td>
			</tr>
			<tr>
				<td>Formations</td>
				<td><input type="number" name="formations_nombre"  min="0" required></td>
				<td><input type="number" name="formations_duree"   min="0"required></td>
				<td><textarea name="formations_note" placeholder="Citez vos formations ..." ><?php echo $formations_note ?></textarea></td>
			</tr>
			<tr>
				<td>Langues</td>
				<td><input type="number" name="langues_nombre"  min="0"required></td>
				<td style="background-color: silver;opacity:20%"></td> 
				<td><textarea name="langues_note" placeholder="Quelles sont les langues que vous maitrisez?"><?php echo $langues_note ?></textarea></td>
			</tr>
			<tr>
				<td>Skills</td>
				<td><input type="number" name="skills_nombre"  min="0" required></td>
				<td style="background-color: silver;opacity:20%"></td>
				<td><textarea name="skills_note" placeholder="Informez-nous de vos skills..."><?php echo $skills_note ?></textarea></td>
			</tr>
            <tr>
				<td>Certificats et Diplomes</td>
				<td><input type="number" name="certificat_nombre"  min="0" required></td>
                <td><input type="number" name="certificat_duree"   min="0" required></td>
                <td><textarea name="certificat_note" placeholder="Quels sont les diplomes et les certificats que vous possédez?"><?php echo $certificat_note ?></textarea></td>
			</tr>
			<tr>
			<tr>
				<td>Les activités para-universitaires</td>
				<td><input type="number" name="activité_nombre" min="0" ></td>
				<td><input type="number" name="activité_duree" min="0" ></td>
<td><textarea name="activité_note" placeholder="Quelles sont vos activités en dehors de vos études universitaires ?"><?php echo $activité_note ?></textarea></td>
</tr>
</table><br><br>
<input type="submit" value="Postuler" name="envoyer">
</form>

</body>
</html> 

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
</html>


