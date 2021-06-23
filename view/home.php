<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hunting cloud</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    <?php  include 'CSS/hero.css';?>
    <?php  include 'CSS/style.css';?>
</style>
  
  <style>
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>



<div class="hero-image">
    <div class="hero-text">
        <h1>Hunting cloud</h1>
        <img src="../assets/deer.png" alt="ozadje"> 
        <h4 style="position:float;color:white; margin-bottom:50px">Aplikacija za lovce </h4>      
    </div>
</div>
 
<!--<div class="container">-->
    <div class="rest">    
    <button><a  href="<?= BASE_URL . "user/login" ?>"> Prijava</button>
    <button><a  href="<?= BASE_URL . "user/register" ?>"> Registracija </button>
    <form action="<?= BASE_URL . "user/guest" ?>" method="post">
            <button>Gost</button>
    </form>
    </div><br>
<!--</div>-->



</body>
</html>
