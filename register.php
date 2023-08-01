<?php include("./navbar.php");
?>

<?php

function testmessage($condition,$message){
    if ($condition) {
        echo "<div class='alert alert-success col-5 mx-auto'>
        $message DONE
        </div>";
    }
    else{
        echo "<div class='alert alert-danger col-5 mx-auto'>
        $message FAILED
        </div>";
    }
    
};


function filter($value){
  $value= trim($value);
  $value = strip_tags($value);
  $value = htmlspecialchars($value);
  $value = stripslashes($value);
  return $value;
}
//------------------------------------------------

//connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "school";

$conn = mysqli_connect($host,$user,$pass,$dbname);

//-----------------------------------------------
//add admin


if (isset($_POST['send'])){
    $name =$_POST['name'];
    $password = $_POST['password']; 
    $role = $_POST['role']; 

if (empty($name)){
  echo "<div class ='text-center col-5 mx-auto fs-2 alter alter-danger'>ENTER ADMIN NAME </div>";
}else{

//query insert
$insert = "INSERT INTO  `admin` VALUES (NULL,'$name','$password',$role)";

$insertconnection = mysqli_query($conn,$insert);
//testmessage($insertconnection,"insert");
}
}

//---------------------------------------------
auth(1);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/all.min.css">
</head>
<body>
  <?php testmessage($insertconnection , "connection");
    ?>

<div class="form-box">
<form method="post" class="form" enctype="multipart/form-data">
    <span class="title">Add Admin</span>
    <span class="subtitle">Create a free account.</span>
    <div class="form-container">
      <input type="text" name="name" class="input" placeholder="Name...">
			<input type="text" name="password" class="input" placeholder="Password...">
			<input type="text" name="role" class="input" placeholder="Role...">
    </div>
    <button type="submit" name="send">Sign up</button>
</form>
<div class="form-section">
  <p>Have an account? <a href="./login.php">Log in</a> </p>
</div>
</div>

<script src="./bootstrap.min.js"></script>
<script src="./bootstrap.bundle.min.js"></script>
<script src="./fontawesome/all.min.js"></script>

</body>
</html>