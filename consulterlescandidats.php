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
 
?>

<!DOCTYPE html>
<html>

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
td,th,tr{
    border: #000 solid 1px;
    padding: 15px;
}
table{
    border-collapse: collapse;
    
}


</style>

    <body style="   font-family: Georgia, 'Times New Roman', Times, serif;
      font-size: 17px;
      font-weight:500; ">
    
    

            

    </div>



<section>
    <table id="table" class="table table-striped table-hover" style="width: 60vw;margin-left:220px;margin-top:30vh; ">
      <thead>
            <tr style=" background-color: aquamarine;">
            <th>idCandidature</th>
            <th>idCandidat</th>
                <th>idOffre</th>
                <th>Titre</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>email</th>
                <th>Profil<input type="text" name="" id="profil" placeholder="name .." onkeyup="searchFunp()" ></th>
                <th>domaine<input type="text" name="" id="domaine" placeholder="name .." onkeyup="searchFunpp()" ></th>
                <th>Note</th>
                <th>CV</th>
                <th>Action</th> 
                
            </tr>
        </thead>

        <tbody>
        <?php
//pour afficher le CV du candidat
 $_cinr = $_SESSION['cinr'] ;


$contenu = $conn->prepare("SELECT *
FROM candidature
JOIN annonce ON candidature.ido = annonce.idof
JOIN recruteur ON annonce.idr = recruteur.cin
WHERE recruteur.cin= ? 
order by ido , score DESC");

$contenu->execute(array($_cinr));

 while($ligne=$contenu -> fetch()){
?>           
              <td><?php echo $ligne['id']; ?></td>
              <td><?php echo $ligne['idc']; ?></td>
              <td><?php echo $ligne['ido']; ?></td>
              <td><?php echo $ligne['titre']; ?></td>
              <td><?php echo $ligne['nom'] ;?></td>
             <td><?php echo $ligne['prénom']; ?></td>
             <td><?php echo $ligne['emailc']; ?></td>
             <td><?php echo $ligne['profil'] ;?></td>
             <td><?php echo $ligne['domaine']; ?></td>
             <td><?php echo $ligne['score'];?></td>
             <td><a href="#cv">
                <form method="POST" action="CV.php">
                <input type="text"  hidden name="idcandidat" value="<?php echo $ligne['idc']; ?>">
               
             <input type="submit" value="voir cv" style="background-color: green;" name="suivant">
              
            </form></a> </td>
             <td> 
                <form method="POST">
                <input type="text" placeholder="Entrer idcandidature" hidden name="negative" value="<?php echo $ligne['id']; ?>">
               
             <input type="submit" value="Refuser" style="background-color: green;" name="refuser">
              
            </form>
                  <form method="POST">
                  <input type="text"placeholder="Entrer idcandidature" hidden name="positive" value="<?php echo $ligne['id']; ?>">
                 
                 
                  <input type="submit" value="Accepter" style="background-color: red ;" name="accepter">
               
                </form>
                 
              </td>
             
        </tbody>

        <?php } ?>   


  </div>
 </section>






  <script>
    const searchFunp = () =>{
    let filter = document.getElementById('profil').value.toUpperCase() ;

     let tableprof = document.getElementById('table');

     let tr = tableprof.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[7];
    
        if(td){
            let textvlaue = td.textContent || td.innerHTML;
        
            if(textvlaue.toUpperCase().indexOf(filter) > -1 ){

          tr[i].style.display = "";

            }else{
                tr[i].style.display = "none";
            }
        }
    
    }
}
const searchFunpp = () =>{
    let filter = document.getElementById('domaine').value.toUpperCase() ;

     let tableprof = document.getElementById('table');

     let tr = tableprof.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[8];
    
        if(td){
            let textvlaue = td.textContent || td.innerHTML;
        
            if(textvlaue.toUpperCase().indexOf(filter) > -1 ){

          tr[i].style.display = "";

            }else{
                tr[i].style.display = "none";
            }
        }
    
    }
}

    </script>
    
</body>
<?php            
          if(isset($_POST['accepter'])) {

 $idcandidature=$_POST['positive'];

 $contenu = $conn->prepare("SELECT *
 FROM candidature
 JOIN annonce ON candidature.ido = annonce.idof
 WHERE candidature.id= ? ");
 
 $contenu->execute(array($idcandidature));
 
 while($ligne=$contenu -> fetch()){
  $idoffre=$ligne['ido'];
  $idcandidat=$ligne['idc'];
  $titreoffre=$ligne['titre'];
  $lieu=$ligne['lieu'];
  $msg ="admis";
  
  $insertionClient = $conn->prepare('INSERT INTO reponse(idcandidature,idoffre,idcandidat,titreoffre,lieu,msg) VALUES(?,?,?,?,?,?)');
  $insertionClient->execute(array($idcandidature,$idoffre,$idcandidat,$titreoffre,$lieu,$msg));

 
          }
         
         
         
         
 }
 
if(isset($_POST['refuser'])) {
 
$idcandidature=$_POST['negative'];

$contenu = $conn->prepare("SELECT *
FROM candidature
JOIN annonce ON candidature.ido = annonce.idof
WHERE candidature.id= ? ");

$contenu->execute(array($idcandidature));

while($ligne=$contenu -> fetch()){
 $idoffre=$ligne['ido'];
 $idcandidat=$ligne['idc'];
 $titreoffre=$ligne['titre'];
 $lieu=$ligne['lieu'];
 $msg ="refusé";
 
 $insertionClient = $conn->prepare('INSERT INTO reponse(idcandidature,idoffre,idcandidat,titreoffre,lieu,msg) VALUES(?,?,?,?,?,?)');
 $insertionClient->execute(array($idcandidature,$idoffre,$idcandidat,$titreoffre,$lieu,$msg));

         }
}
?> 







</html>
