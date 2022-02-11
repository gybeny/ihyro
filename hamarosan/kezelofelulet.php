<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("location: /");
}



if(isset($_POST['kijelentkezes'])) {
    session_destroy();
    header("location: /");
}

function FetchMail() {
    $db = mysqli_connect('localhost', 'root', '', 'ihyroregistrations');
    $username = $_SESSION['username'];
    $results = $db->query("SELECT * FROM users WHERE username='$username'");
    if($results->num_rows > 0) {
        while($row = $results->fetch_assoc()) {
            return $row['email'];
        }
    }
  }
$username = $_SESSION['username'];



function FetchPassword() {
    $db = mysqli_connect('localhost', 'root', '', 'ihyroregistrations');
    $username = $_SESSION['username'];
    $results = $db->query("SELECT * FROM users WHERE username='$username'");
    if($results->num_rows > 0) {
        while($row = $results->fetch_assoc()) {
            return $row['password'];
        }
    }
  }

$regisztraltFelhasznalok = mysqli_connect('localhost', 'root', '', 'ihyroregistrations')->query("SELECT * FROM users")->num_rows;




?>
<!DOCTYPE html>
<html>
   <script>
  
   </script>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link href="main.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
      <title>iHyro.hu</title>
      <script type="text/javascript">






</script>
   </head>
   <style>
      h1, h2, h3, h4, h5, h6 {
        font-weight: 480;
      }

      html, body {
         width: 100%;
         height: 100%;
      }

      .vertical-center {
         margin: 0;
         position: absolute;
         top: 50%;
         -ms-transform: translateY(-50%);
         transform: translateY(-50%);
      }
   </style>
   <style>
body {font-family: Arial, Helvetica, sans-serif;}

.navbar {
  width: 100%;
  background-color: "text-gray-500";
  overflow: auto;
}

.navbar a {
  float: left;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background-color: #000;
}

.active {
  background-color: #3c3c41;
}

@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}
</style>
   <body class="bg-dark text-white" style="overflow: hidden;">
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iHyro</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <div class="navbar">

      <form method='POST' class="d-flex text-dark">
      <a class="active" href="#"><i class="fa fa-fw fa-home"></i>Kezelőfelület</a> 

</div>
      <button type="submit" name="kijelentkezes" value="kijelentkezes" style="background: none !important; border: none !important; box-shadow: none !important; outline: 0 !important;" class="fa fa-sign-out"></button>

      
 
      </form>
    </div>
  </div>
</nav>
      <div class="d-flex justify-content-center">
         <div class="row" style="width: 95%; margin-top: 50px;">
            <div class="mb-4 col-xl-3 col-md-6">
               <div class="card-widget text-white bg-dark h-100">
                  <div class="card-widget-body">
                     <div class="dot me-3 bg-indigo"></div>
                     <div class="text">
                        <h6 class="mb-0">Regisztrált Emberek</h6>
                        <span class="text-gray-500"><?php if(!empty($regisztraltFelhasznalok)) { echo $regisztraltFelhasznalok; } ?></span>
                     </div>
                  </div>
                  <div class="icon text-white bg-indigo">
                  <i class="fa fa-users" aria-hidden="true"></i>
                  </div>
               </div>
            </div>
 
            <div class="mb-4 col-xl-3 col-md-6">
               <div class="card-widget text-white bg-dark h-100">
                  <div class="card-widget-body">
                     <div class="dot me-3 bg-green"></div>
                     <div class="text">
                        <h6 class="mb-0">Neved</h6>
                        <span class="text-gray-500"><?php if(!empty($username)) { echo $username; } ?></span>
                     </div>
                  </div>
                  <div class="icon text-white bg-green">
                  <i class="fa fa-address-card" aria-hidden="true"></i>
                  </div>
               </div>
            </div>
        
                     
                  
             
            
     
      </div>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body>
</html>