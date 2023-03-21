<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

  
.temoignage{
    
    margin-top: 120px;
}

.temoignage .contenu{
    display: flex;
    margin-top: 90px;
    margin-left: 0px;
    margin-right: 20px;
    width: 100%;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    flex-direction: row;
}

.temoignage .contenu .box{
    width: 500px;
    padding: 10px;
    margin-right: 10px;
    display: flex;
    flex-direction:row;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    background: rgb(93,102,251);
    background: linear-gradient(0deg, rgba(93,102,251,1) 20%, rgba(200,215,247,1) 100%);    margin-bottom: 20px; /* Ajout de la marge */
    margin-left: 40px;
    overflow: auto;
    margin-top:50px;
}

.temoignage .contenu .box .imbox{
    flex: 1;
    margin-right: 20px;

}

.temoignage .contenu .box .imbox img{
    max-width:  100%;
height: auto;
margin-bottom: 200px;

}

.temoignage .contenu .box .text{
    flex: 3;
}

.temoignage .contenu .box .text h3{
    color: #fb911f;
    margin-top: 20px;
    font-size: 1em;
    font-weight: 600;
}
.temoignage .contenu .box .text p {
margin: 0;
font-size: 16px;
line-height: 1.5;
font-weight: 500;
}
.postuler {
  background-color: #03a9f4;
  border: none;
  border-radius: 5px;
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
  color: #ffffff;
  cursor: pointer;
  font-size: 14px;
  margin-left: 60px;
  margin-right: 235px;
  padding: 8px;
  transition: background-color 0.3s ease-in-out;
}

.postuler:hover {
  background-color: #0390db;
}

@media only screen and (max-width: 1200px) {
  .temoignage .contenu .box {
    width: calc(50% - 15px); /* Modifier la largeur de chaque boîte */
  }
}
   </style>
   <section class="temoignage" id="temoignage">
    <div class="titre blanc">
    <div class="contenu">
       <?php

try {
  $conn = new PDO("mysql:host=localhost;dbname=ozod;port=3306;charset=utf8", 'root', '',
   array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
  echo 'Erreur de connexion: ' . $e->getMessage();
}


$_cinr = $_SESSION['cinr'] ;

$contenu = $conn->prepare("SELECT * FROM annonce WHERE idr = ? ");
$contenu->execute(array($_cinr));


     while($ligne=$contenu -> fetch()){
        ?>
      
      <div class="box">
            <div class="imbox">
                <img src="logoo.jpg" alt="">
            </div>
            <div class="text">
                <p class="titre" style=" font-family: sans-serif;
    font-size: 25px;
"><b><?php echo $ligne['titre'].'<br><br>';?></b></p>
<p style="font-size:20px;font-weight:800;color:blue"> <?php  echo 'Numéro offre :'.$ligne['idof'].'<br><br>'; ?></p>
                <p style="font-size:22px;font-weight:800;color:darkblue"><i> <?php echo $ligne['entreprise'].'<br>'; ?></i></p>
                <p style="font-size:18px;font-weight:800;color:darkblue"> <?php  echo $ligne['lieu'].'<br>'; ?></p>

<p style="font-size:15px;font-weight:800;color:darkblue"> <?php  echo $ligne['typeoffre'].'<br>'; ?></p>
<p style="font-size:15px;font-weight:800;color:darkblue"> <?php  echo 'Période :'.$ligne['durée'].'<br>'; ?></p>


<p style="font-size:15px;font-weight:800;color:"> <?php  echo $ligne['dateoffre'].'<br><br>'; ?></p>


<p style="font-size:13px;font-weight:800;color:black"> <?php  echo $ligne['descriptionoffre'].'<br><br>'; ?></p>


                    
                </p>
               
               <form  method="post" action="offrecomplet.php" >
                 <input type="number" name="idoffre" hidden value="<?php echo $ligne['idof']; ?>"    >
                <input  type="submit"    name="consulter" style=" background :#0390db " value="Consulter">
                
                </form>
            </div>
        </div>
        <?php  } ?>
    </div>
</div>
</section>
    
</body>
</html>



                       
                    </div>
                </swiper-slide>


            </swiper-container>

            <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>



</html>
</body>
</html>