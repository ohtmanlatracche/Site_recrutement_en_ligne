<?php
session_start();
?>


<html>

<head>
    <meta charset="UTF-8">
    <title>mes condidatures</title>
    <link rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylecandidat.css">
   
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
tr,th,td{
    border: #000 solid 1px;
}

</style>

<body style="   font-family: Georgia, 'Times New Roman', Times, serif;
  font-size: 17px;
  font-weight:500;
">


<table class="table table-striped table-hover" style="width: 60vw;margin-left:220px;margin-top:30vh;">
  <thead>
        <tr style=" background-color: aquamarine;">
            <th>idOffre</th>
            <th>Titre</th>
            <th>Lieu</th>
            <th>idCandidature</th>
            <th>Domaine</th>
            <th>Prénom</th>
            <th>nom</th>
            <th>Email</th>
            <th>Réponse</th>
             <th><a href="mescondidatures.php">retour</a></th>
            
             
        </tr>
    </thead>

    <tbody>
    <?php

try {
$conn = new PDO("mysql:host=localhost;dbname=ozod;port=3306;charset=utf8", 'root', '',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
echo 'Erreur de connexion: ' . $e->getMessage();
}


$_cinc = $_SESSION['cin'] ;

$contenu = $conn->prepare("SELECT * FROM candidature WHERE idc = ? ");
$contenu->execute(array($_cinc));

while($ligne=$contenu -> fetch()){

    $contenu1 = $conn->prepare("SELECT * FROM annonce WHERE idof = ? ");
    $contenu1 ->execute(array($ligne['ido']));
    
    while($ligne1=$contenu1 -> fetch()){

?>
            <td><?php echo $ligne['ido']; ?></td>
            <td><?php echo $ligne1['titre']; ?></td>
            <td><?php echo $ligne1['lieu']; ?></td>
          <td><?php echo $ligne['id']; ?></td>
          <td><?php echo $ligne['domaine']; ?></td>
          <td><?php echo $ligne['nom']; ?></td>
          <td><?php echo $ligne['prénom']; ?></td>
          <td><?php echo $ligne['emailc']; ?></td>
          <td><form method="POST">
                <input type="text"  name="reponse" hidden value="<?php echo $ligne['id']; ?>">
                <input type="submit" value="Voir" style="background-color: green;" name="voir">
                </form>

               </td>
        <td><p>
        <?php if(isset($_POST['voir'])){
    $idcandidature=$_POST['reponse'];
    $contenu = $conn->prepare("SELECT *
FROM reponse
WHERE reponse.idcandidature= ? ");

$contenu->execute(array($idcandidature));
while($ligne=$contenu -> fetch()){
 $_POST['reponse'] = $ligne['msg'];
 echo $_POST['reponse'];
 
}


}  ?></p></td>
        
                   
    </tbody>
    <?php } }?> 
    
    


</table>

    </body>

</html>