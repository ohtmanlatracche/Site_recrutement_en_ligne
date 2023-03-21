<?php
session_start();
?>
<?php
// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=localhost;dbname=ozod;port=3306;charset=utf8", 'root', '',
     array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
  }


$_cinc =$_POST['idcandidat'];


$sql = "SELECT nom, prénom, profil, emailc, téléphone, age,formations_note,experiences_note,langues_note,skills_note,certificat_note,activité_note 
FROM candidature WHERE idc = :idc";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idc', $_cinc);
$stmt->execute();
// Stocker les données dans des variables
$resultat = $stmt->fetch(PDO::FETCH_ASSOC);
if ($resultat) {
    $nom = $resultat["nom"];
    $prénom = $resultat["prénom"];
    $profil = $resultat["profil"];
    $email = $resultat["emailc"];
    $téléphone = $resultat["téléphone"];
    $age = $resultat["age"];
    $formations_note = $resultat["formations_note"];
    $experiences_note = $resultat["experiences_note"];
    $langues_note = $resultat["langues_note"];
    $skills_note = $resultat["skills_note"];
    $certificat_note = $resultat["certificat_note"];
    $activité_note = $resultat["activité_note"];
}

else {
    // La requête n'a renvoyé aucun résultat
    // Vous pouvez afficher un message ou affecter des valeurs par défaut
   
    $nom = "";
    $prénom = "";
    $profil = "";
    $email = "";
    $téléphone = "";
    $age = "";
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
    <title>Document</title>
</head>




<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>CV de Candidat</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .cv {
      max-width: 800px;
      margin: 0 auto;
    }
    h2 {
      color: blue;
      font-size: 1.5rem;
      margin-top: 2rem;
    }
    ul {
      list-style-type: none;
      padding: 0;
    }
    li {
      margin-bottom: 0.5rem;
    }
    label {
      font-weight: bold;
    }
    input[type="text"] {
      padding: 0.5rem;
      border-radius: 0.25rem;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      padding: 0.5rem 1rem;
      border-radius: 0.25rem;
      border: none;
      color: white;
      font-weight: bold;
      background-color: #3498DB;
      cursor: pointer;
    }
    .cv {
  border: 1px solid #ccc;
  padding: 1rem;
  margin-bottom: 2rem;
  background-color: beige;
  padding: 30px;
}
.down{
  padding: 40px;
  font-size: 30px;
}

 

  </style>
</head>
<body>
  <center><a href="#down" style="text-decoration:none;"><h1 style="color:antiquewhite;background-color:green;width:30%;" >Télécharger CV : 👇</h1></a></center>

  <div class="cv">
    <h1>CV de <?php echo $nom . ' ' . $prénom; ?></h1>
    <section>
      <h2 style="color:brown">Informations Personnelles :</h2>
      <ul>
        <li><strong>Profil :</strong> <?php echo $profil; ?></li>
        <li><strong>Email :</strong> <?php echo $email; ?></li>
        <li><strong>Téléphone :</strong> <?php echo $téléphone; ?></li>
        <li><strong>Age :</strong> <?php echo $age; ?></li>
      </ul>
    </section>
    <section>
      <h2>Formations :</h2>
      <p><?php echo $formations_note ?></p>
    </section>
    <section>
      <h2>Compétences :</h2>
      <p><?php echo $experiences_note ?></p>
    </section>
    <section>
      <h2>Langues :</h2>
      <p><?php echo $langues_note ?></p>
    </section>
    <section>
      <h2>Skills :</h2>
      <p><?php echo $skills_note ?></p>
    </section>
    <section>
      <h2>Activités para-universitaires :</h2>
      <p><?php echo $activité_note ?></p>
    </section>
    <section>
      <h2>Certificats et Diplômes :</h2>
      <p><?php echo $certificat_note ?></p>
    </section>
    <center>
    <section class="down" id="down">
    <h2 style="color:green;">Télécharger cv : </h2>

    <?php
if(isset($_POST['suivant'])){
$req = $conn->prepare("SELECT name,file_url FROM files WHERE cin= ? ");
$req->execute(array($_cinc));



while($data = $req->fetch()){
    echo '<a href="'.$data['file_url'].'">Télécharger '.$data['name'].'</a>';
    break;
}}
?>
    </section>
    </center>
  </div>

</body>
</html>



 



     
