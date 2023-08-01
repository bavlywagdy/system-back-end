<?php 

session_start();

if (isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("location:login.php");

}


function auth($role1=null){
    if ($_SESSION['admin']){
        if ($_SESSION ['admin']['role']==1 || $_SESSION['admin']['role']==$role1){

        }else{
            header("location:index.php");
        }
    }else{
        header("location:login.php");
    }
}
//------------------------------------------------

//connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "school";

$conn = mysqli_connect($host,$user,$pass,$dbname);


?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand " href="#">SCHOOL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

      <?php if (isset($_SESSION['admin'])) : ?> 

      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
       
        
          <a class="nav-link" href="./index.php" role="button" aria-expanded="false">STUDENTS</a>

      </ul>
    </div>
    

    <?php if ($_SESSION['admin']['role']==1) : ?>

    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
       
        
          <a class="nav-link" href="./register.php" role="button" aria-expanded="false">REGISTER</a>

      </ul>
    </div>

    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
       
        
          <a class="nav-link" href="./tech.php" role="button" aria-expanded="false">TEACHERS</a>

      </ul>
    </div>
    <?php endif ; ?>

    <?php  endif; ?>

</div>

<div class="d-grid gap-2 d-md-flex justify-cont">

<?php if (isset($_SESSION['admin'])) : ?>

<form>
    <button name="logout" class="btn btn-danger">LOG OUT</button>
</form>
  </div>

<?php else : ?>

  <div>
    <a class="btn btn-success " href="./login.php">LOG IN</a>
  </div>
 
  <?php endif ; ?>
  
  
</nav>
