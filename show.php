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
//---------------------------------------------------------

//connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "school";

$conn = mysqli_connect($host,$user,$pass,$dbname);

//-----------------------------------------------

//show by id
if (isset ($_GET['show'])){
    $id = $_GET['show'];

    $select = "SELECT * FROM `student` WHERE id=$id";
    $s = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($s);
    $name = $row['name'];
    $image = $row['image'];
    $course = $row['course'];
    $grade = $row['grade'];


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/all.min.css">
</head>
<body>
    
<div class="card">
    <img src="./upload/<?php echo $image ?>" class="card-img" alt="">
  <div class="card-info">
  <h5 class="card-title">Name: <?php echo $name ?></h5>
  <h5 class="card-title">COURSE: <?php echo $course ?></h5>
  <h5 class="card-title">GRADE: <?php echo $grade ?></h5>
  </div>
  <div class="mt-3"><a href="./index.php" class="btn btn-dark">Back</a></div>
</div>

<script src="./bootstrap.bundle.min.js"></script>
<script src="./bootstrap.min.js"></script>
<script src="./fontawesome/all.min.js"></script>

</body>
</html>