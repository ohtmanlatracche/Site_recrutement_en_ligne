<?php
session_start();
?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    margin-left: 0px;
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
    font-size: 1em;
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

    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://kit.fontawesome.com/a61e7abe00.js" crossorigin="anonymous"></script>

</head>

<body style="padding: 0;margin: 0;background-color: rgb(212, 237, 229);" class="im">

<header>
    <a href="#" class="logo"><span>R</span>ecrutement <span>O</span>Z<span>O</span>D</a>
    <div class="menuToggle" onclick="toggleMenu();"></div>
    <ul class="navbar">
        <li><a href="deposerannonce.php" onclick="toggleMenu();">Deposer annonce</a></li>
        <li><a href="consulterlescandidats.php" onclick="toggleMenu();">Consulter candidats</a></li>
        <li><a href="offresrecruteur.php" onclick="toggleMenu();">Mes annonces</a></li>
        <a href="interface1.php" class="btn-reserve"onclick="toggleMenu();">Home</a>
    </ul>
</header>

    <div style="width: 60vw;height: 60vh;margin-top: 25vh;margin-bottom: 25vh;background: linear-gradient(90deg, rgba(2,246,255,1) 13%, rgba(56,152,158,1) 46%, rgba(0,212,255,1) 100%);
;margin-left: 18vw;border: 4px double white;border-radius: 15px;" class="tout">
        <center>
            <div style="margin-top: 30px;box-shadow: 0 2px 30px rgba(0,0,0.5);border-radius: 5px;" class="ss">
                <div style="border: 4px double white;border-radius: 35px;width: 25vw;" class="dd">

                    <a href="deposerannonce.php">
                        <h2>DEPOSER ANNNONCE</h2>
                    </a>
                </div>
        </center>
        <center>
            <div style="margin-top: 30px;box-shadow: 0 0 20px rgba(0,0,0.5);border-radius: 5px;" class="ss">
                <div class="dd" style="border: 4px double white;border-radius: 35px;width: 25vw;box-shadow: 0 0 10px rgba(0,0,0.5);">

                    <a href="consulterlescandidats.php">
                        <h2>CONSULTER CANDIDATS</h2>
                    </a>
                </div>
            </div>
        </center>
        <center>
            <div style="margin-top: 30px;box-shadow: 0 0 20px rgba(0,0,0.5);border-radius: 5px;" class="ss">
                <div class="dd" style="border: 4px double white;border-radius: 35px;width: 25vw;margin-top: 30px;box-shadow: 0 0 10px rgba(0,0,0.5);">

                    <a href="offresrecruteur.php">
                        <h2>MES ANNONCES</h2>
                    </a>
                </div>
            </div>
        </center>
      

      
    </div>

    </div>





    <script style="cursor: pointer;">
        $(document).ready(function() {
            $(".clc").hide();
            $(".clc").mouseleave(function() {
                $(".clc").hide();
            })

            $(".mode").click(function() {
                $(".clc").slideDown();
                $(this).css('backgroundColor', 'white');
                $(this).css('color', 'black');

            })

            $(".nui").click(function() {

                $("body").css('backgroundColor', 'black');
                $("body").css('color', 'white');
                $("h2").css('color', 'white');
                $("head").css('backgroundColor', 'black');




            })
            $(".ligh").click(function() {

                $(".im").attr("src", "e.jpg.jpg");
                $("body").css('backgroundColor', 'white');
                $("body").css('color', 'black');
                $("h2").css('color', 'black');

            })



        })
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

