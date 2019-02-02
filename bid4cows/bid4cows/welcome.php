
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' type='text/css' href='images/profilestyle.css'>
<h2 style="text-align:center">My Profile</h2>
<?php session_start();   
?>

<div class="card">
  <img src='<?= $_SESSION['avatar']?>' alt="John" style="width:100%">
  <h1><?=$_SESSION['fullname'] ?></h1>
  <p class="title"><?= $_SESSION['username'] 

  ?></p>
   <p><a href="loginpage.php"><button>LOGIN
 </p></button></a>







































