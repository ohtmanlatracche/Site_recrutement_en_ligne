<!DOCTYPE html>
<html>
<head>
	<title>Interface Admin</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
		}
		header {
			background-color: #333;
			color: #fff;
			padding: 20px;
			text-align: center;
		}
		nav {
			background-color: #f2f2f2;
			padding: 10px;
			text-align: center;
		}
		nav a {
			color: #333;
			text-decoration: none;
			padding: 10px;
		}
		nav a:hover {
			background-color: #ddd;
		}
	/* Style général pour les tableaux */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

/* Style pour l'en-tête du tableau */
thead {
  background-color: aqua;
}

/* Style pour les cellules de l'en-tête du tableau */
th {
  text-align: left;
  font-weight: bold;
  padding: 10px;
  border: 1.5px solid black;
}

/* Style pour les cellules du corps du tableau */
td {
  padding: 10px;
  border: 1.5px solid black;
}

/* Style pour les liens dans la colonne Action */
td a {
  color: #0096e6;
  text-decoration: none;
  font-weight: bold;
}

/* Style pour les survols de liens dans la colonne Action */
td a:hover {
  text-decoration: underline;
}

/* Style pour les sections Candidats, Recruteurs et Offres */
section {
  background-color: #fff;
  padding: 100px;
  border: 2px solid gray;
  margin-bottom: 20px;
  
}
#candidat , #offre {
    background-color: gainsboro;
}
#recruteur,#candidatures{
    background-color: antiquewhite;
}

	</style>
</head>
<body>
    
<header>
    <a href="#" class="logo"><span>R</span>ecrutement <span>O</span>Z<span>O</span>D</a>
    <div class="menuToggle" onclick="toggleMenu();"></div>
    <ul class="navbar">
        <li><a href="#candidat" onclick="toggleMenu();">Candidats</a></li>
        <li><a href="#recruteur" onclick="toggleMenu();">Recruteurs</a></li>
        <li><a href="#offre" onclick="toggleMenu();">Offres</a></li>
        <li><a href="#candidatures" onclick="toggleMenu();">Candidatures</a></li>

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
#admin {
	
	padding: 50px;
	text-align: center;
    margin-top: 80px;
    background: rgb(255,162,0);
    background: linear-gradient(0deg, rgba(255,162,0,1) 20%, rgba(45,144,253,1) 100%);
    opacity:90%;
    color: #000;
}

.admin-title {
	font-size: 48px;
	color: #333;
	text-transform: uppercase;
	letter-spacing: 4px;
	margin-bottom: 20px;
}


</style>
<section id="admin">
	<h2 class="admin-title">Admin</h2>
	<!-- Contenu de la section ici -->
</section>
<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=ozod;port=3306;charset=utf8", 'root', '',
     array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
  }
?>
	
    <section id="candidat">
		
		<h2>Candidat</h2>
		
		<table id="myTable" >
			<thead>
				<tr>
					<th>CIN <input type="text" name="" id="myInput" placeholder="name .." onkeyup="searchFun()" ></th>
					<th>Nom <input type="text" name="" id="myInput1" placeholder="name .." onkeyup="searchFun1()" ></th>
					<th>Prénom <input type="text" name="" id="myInput2" placeholder="name .." onkeyup="searchFun2()" ></th>
					<th>Email <input type="text" name="" id="myInput3" placeholder="name .." onkeyup="searchFun3()" ></th>
				</tr>
			</thead>
			<tbody>
			<?php 
		$contenu = $conn->prepare("SELECT * FROM candidat ");
		$contenu->execute();
		
		
			 while($ligne=$contenu -> fetch()){
		?>
				<tr>
					<td><?php echo $ligne['cin']; ?></td>
					<td><?php echo $ligne['lastname']; ?></td>
					<td><?php echo $ligne['firstname']; ?></td>
					<td><?php echo $ligne['email']; ?></td>
				</tr>
				
			</tbody>
			<?php } ?>
		</table>
	</section>
	<section id="recruteur">
	
		<h2>Recruteur</h2>
		<table id="myTable1">
			<thead>
				<tr>
					<th>CIN <input type="text" name="" id="myInput4" placeholder="name .." onkeyup="searchFun4()" ></th>
					<th>Nom <input type="text" name="" id="myInput5" placeholder="name .." onkeyup="searchFun5()" ></th>
					<th>Prénom <input type="text" name="" id="myInput6" placeholder="name .." onkeyup="searchFun6()" ></th>
					<th>Email <input type="text" name="" id="myInput7" placeholder="name .." onkeyup="searchFun7()" ></th>
				</tr>
			</thead>
			<tbody>
			<?php 
		$contenu = $conn->prepare("SELECT * FROM recruteur ");
		$contenu->execute();
		
		
			 while($ligne=$contenu -> fetch()){
		?>
				<tr>
					<td><?php echo $ligne['cin']; ?></td>
					<td><?php echo $ligne['lastname']; ?></td>
					<td><?php echo $ligne['firstname']; ?></td>
					<td><?php echo $ligne['email']; ?></td>
				</tr>
				
			</tbody>
			<?php } ?>
		</table>
	</section>
	<section id="offre">
		<h2>Offre</h2>
		<table id="myTable2">
        <thead>
				<tr>
					<th>ID Offre <input type="text" name="" id="myInput8" placeholder="name .." onkeyup="searchFun8()" ></th>
					<th>Titre <input type="text" name="" id="myInput9" placeholder="name .." onkeyup="searchFun9()" ></th>
					<th>Lieu <input type="text" name="" id="myInput10" placeholder="name .." onkeyup="searchFun10()" ></th>
					<th>ID Recrutement<input type="text" name="" id="myInput11" placeholder="name .." onkeyup="searchFun11()" ></th>
					<th>Action</th>
				</tr>
			</thead>
			<?php 
		$contenu = $conn->prepare("SELECT * FROM annonce ");
		$contenu->execute();
		
		
			 while($ligne=$contenu -> fetch()){
		?>
			<tbody>
			<tr>
					<td><?php echo $ligne['idof']; ?></td>
					<td><?php echo $ligne['titre']; ?></td>
					<td><?php echo $ligne['lieu']; ?></td>
					<td><?php echo $ligne['idr']; ?></td>
					<td>
						<form method="POST">
							<input type="text" placeholder="entrer idoffre" hidden name="idoffre"value="<?php echo $ligne['idof']; ?>" >
							<input type="submit" value="Entrer" name="supprimeroffre">
						</form>

					</td>
				</tr>
			</tbody>
			<?php } ?>
		</table>
	</section>
    <section id="candidatures">
	<h2>Candidatures</h2>
	<table id="myTable3">
		<thead>
			<tr>
				<th>Id candidature <input type="text" name="" id="myInput12" placeholder="name .." onkeyup="searchFun12()" ></th>
				<th>Nom <input type="text" name="" id="myInput13" placeholder="name .." onkeyup="searchFun13()" ></th>
				<th>Prénom <input type="text" name="" id="myInput14" placeholder="name .." onkeyup="searchFun14()" ></th>
				<th>Email <input type="text" name="" id="myInput15" placeholder="name .." onkeyup="searchFun15()" ></th>
				<th>Titre <input type="text" name="" id="myInput16" placeholder="name .." onkeyup="searchFun16()" ></th>
				<th>Entreprise <input type="text" name="" id="myInput17" placeholder="name .." onkeyup="searchFun17()" ></th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$contenu = $conn->prepare("SELECT * FROM candidature
		JOIN annonce WHERE candidature.ido = annonce.idof ");
		$contenu->execute();
		
		
			 while($ligne=$contenu -> fetch()){
		?>
				<tr>
					<td><?php echo $ligne['id']; ?></td>
					<td><?php echo $ligne['nom']; ?></td>
					<td><?php echo $ligne['prénom']; ?></td>
					<td><?php echo $ligne['emailc']; ?></td>
					<td><?php echo $ligne['titre']; ?></td>
					<td><?php echo $ligne['entreprise']; ?></td>
					<td><form method="POST">
							<input type="text" placeholder="entrer idcandidature" hidden name="idcandidature" value="<?php echo $ligne['id']; ?>">
							<input type="submit" value="Entrer" name="supprimercandidature">
						</form>
					</td>
					
				</tr>
				
			</tbody>
			<?php } ?>
	</table>
</section>






<section id="candidatures">
	<h2>Messages</h2>
	<table>
		<thead>
			<tr>
				<th>NOM</th>
                <th>Email</th>
                <th>Message</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$contenu = $conn->prepare("SELECT * FROM messages");
		$contenu->execute();
		
		
			 while($ligne=$contenu -> fetch()){
		?>
				<tr>
					
					<td><?php echo $ligne['nom']; ?></td>
					
					<td><?php echo $ligne['email']; ?></td>
					<td><?php echo $ligne['mess']; ?></td>
					
			
					
				</tr>
				
			</tbody>
			<?php } ?>
	</table>
</section>





<?php            
          if(isset($_POST['supprimercandidature'])) {

 


    $id = $_POST['idcandidature'];
    $sql = "DELETE FROM candidature WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}




	
    if(isset($_POST['supprimeroffre'])){
        $ido = $_POST['idoffre'];
        $sql = "DELETE FROM annonce WHERE idof = :idof";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idof', $ido);
        $stmt->execute();
    }
?>


<script>

	//table candidat 
const searchFun = () =>{
    let filter = document.getElementById('myInput').value.toUpperCase() ;

     let myTable = document.getElementById('myTable');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[0];
    
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


const searchFun1 = () =>{
    let filter = document.getElementById('myInput1').value.toUpperCase() ;

     let myTable = document.getElementById('myTable');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[1];
    
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
const searchFun2 = () =>{
    let filter = document.getElementById('myInput2').value.toUpperCase() ;

     let myTable = document.getElementById('myTable');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[2];
    
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
const searchFun3 = () =>{
    let filter = document.getElementById('myInput3').value.toUpperCase() ;

     let myTable = document.getElementById('myTable');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[3];
    
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


//table recruteur 

const searchFun4 = () =>{
    let filter = document.getElementById('myInput4').value.toUpperCase() ;

     let myTable = document.getElementById('myTable1');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[0];
    
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
const searchFun5 = () =>{
    let filter = document.getElementById('myInput5').value.toUpperCase() ;

     let myTable = document.getElementById('myTable1');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[1];
    
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
const searchFun6 = () =>{
    let filter = document.getElementById('myInput6').value.toUpperCase() ;

     let myTable = document.getElementById('myTable1');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[2];
    
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

const searchFun7 = () =>{
    let filter = document.getElementById('myInput7').value.toUpperCase() ;

     let myTable = document.getElementById('myTable1');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[3];
    
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
//table offre
const searchFun8 = () =>{
    let filter = document.getElementById('myInput8').value.toUpperCase() ;

     let myTable = document.getElementById('myTable3');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[0];
    
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

const searchFun9 = () =>{
    let filter = document.getElementById('myInput9').value.toUpperCase() ;

     let myTable = document.getElementById('myTable2');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[1];
    
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
const searchFun10= () =>{
    let filter = document.getElementById('myInput10').value.toUpperCase() ;

     let myTable = document.getElementById('myTable2');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[2];
    
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
const searchFun11 = () =>{
    let filter = document.getElementById('myInput11').value.toUpperCase() ;

     let myTable = document.getElementById('myTable2');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[3];
    
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

//table candidature
const searchFun12 = () =>{
    let filter = document.getElementById('myInput12').value.toUpperCase() ;

     let myTable = document.getElementById('myTable3');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[0];
    
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
const searchFun13 = () =>{
    let filter = document.getElementById('myInput13').value.toUpperCase() ;

     let myTable = document.getElementById('myTable3');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[1];
    
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
const searchFun14 = () =>{
    let filter = document.getElementById('myInput14').value.toUpperCase() ;

     let myTable = document.getElementById('myTable3');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[2];
    
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
const searchFun15 = () =>{
    let filter = document.getElementById('myInput15').value.toUpperCase() ;

     let myTable = document.getElementById('myTable3');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[3];
    
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
const searchFun16 = () =>{
    let filter = document.getElementById('myInput16').value.toUpperCase() ;

     let myTable = document.getElementById('myTable3');

     let tr = myTable.getElementsByTagName('tr');

     for(var i=0; i<tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[3];
    
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



