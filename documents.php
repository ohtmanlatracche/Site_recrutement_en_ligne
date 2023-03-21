<?php 
session_start();
?>

<?php

try {
    $db = new PDO(
      "mysql:host=localhost;dbname=ozod;port=3306;charset=utf8",
      'root',
      '',
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
  } catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
  }
$_cinc =$_SESSION['cin'];

if (isset($_POST['envoyer'])){
 if(!empty($_FILES)){
    $file_name= $_FILES['fichier']['name'];
    $file_extension = strrchr($file_name,".");
    $file_temp_name = $_FILES['fichier']['tmp_name'];
    $file_dest = 'files/'.$file_name;
    $extensions_autorisees = array('.pdf','.PDF');

    if(in_array($file_extension,$extensions_autorisees)){
        if(move_uploaded_file($file_temp_name,$file_dest)){

            $req = $db->prepare('INSERT INTO files(name,file_url,cin) VALUES(?,?,?)');
            $req->execute(array($file_name,$file_dest,$_cinc));
          
    }else{
        echo 'Une erreur est survenue';
    }
 }else{
    echo 'seuls les fichiers PDF sont autorisées';}
 }}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styledocuments.css">
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
        <a href="interface1.php" class="btn-reserve"onclick="toggleMenu();">Home</a>
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
.fichier{
    margin-top: 120px;
}

</style>
   <section class="fichier">
    <h1>upload fichier</h1>
    <form method="post" enctype="multipart/form-data">
    <input type="file" name="fichier">
    <input type="submit" name="envoyer">
    </form>

    <h1>Fichiers PDF enregistrées</h1>
    <?php




    $req = $db->prepare("SELECT name,file_url FROM files WHERE cin= ? ");
    $req->execute(array($_cinc));



    while($data = $req->fetch()){
        echo $data['name'].' : '.'<a href="'.$data['file_url'].'">Télécharger '.$data['name'].'</a><br>';
        
    }
    ?>
   </section>
</body>
</html>