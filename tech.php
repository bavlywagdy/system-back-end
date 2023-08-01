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

//insert

if (isset($_POST['submit'])){
    $name =$_POST['name'];
    $email =$_POST['email'];
    $number =$_POST['number'];
    $salary =$_POST['salary'];

    if(empty($name)){
        echo "<div class ='text-center col-5 mx-auto fs-2 alter alter-danger'>ENTER Student NAME </div>";
      }else{

//query insert
$insert = "INSERT INTO  `teacher` VALUES (NULL,'$name','$email','$number','$salary')";

$insertconnection = mysqli_query($conn,$insert);
testmessage($insertconnection,"insert");
      }
}

//----------------------------------------------

//edit
$name="";
if (isset($_GET ['edit'])){
  $id = $_GET['edit'];
  $email =$_GET['edit'];
  $number =$_GET['edit'];
  $salary =$_GET['edit'];
  $show = "SELECT * FROM `teacher` WHERE id=$id";
  $ss = mysqli_query($conn,$show);
  $data = mysqli_fetch_assoc($ss);
  $name=$data['name'];

}
//-------------------------------------------
$select = "SELECT * FROM `teacher`";
//run
$s = mysqli_query($conn,$select);
//--------------------------------------------

//select by name

if (isset($_POST['search'])){
    $name = $_POST['name'];
    $search = "SELECT * FROM teacher WHERE name = '$name'";
    $f = mysqli_query ($conn , $search);
}
//------------------------------------------

//a-z

if (isset($_POST['asc'])){
    $asc = "SELECT * FROM teacher ORDER BY `name` ASC";
    $a = mysqli_query ($conn , $asc); 
}

//----------------------------------------------

//z-a

if (isset($_POST['desc'])){
    $desc = "SELECT * FROM teacher ORDER BY `name` DESC";
    $d = mysqli_query ($conn , $desc); 
}

//---------------------------------------------

//delete

if (isset ($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE FROM `teacher` WHERE id =$id";
    $d = mysqli_query($conn,$delete);
}

//delete all

if(isset ($_POST['delete-all'])){
    $delete_all = "TRUNCATE TABLE teacher";
    $d_all = mysqli_query($conn,$delete_all);
  }

//-------------------------------------------

auth(1);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./fontawesome/all.min.css">
</head>
<body>
    
<?php testmessage($conn,"connection");
?>

<div class="container text-center mb-4 mt-4">

<form method="post">
<div class="mb-3 d-flex col-8 mx-auto" role="search">
  <input type="search" class="form-control me-2" name ="name" placeholder="Search" aria-label="Search">
  <button class="btn btn-success  me-2" name="search" >Search</button>
</div>

<button class="btn btn-dark me-2 mx-auto" name = "asc">A-Z</button>
<button class="btn btn-dark me-2 mx-auto" name = "desc">Z-A</button>

</div>
</form>

<form method="post" enctype="multipart/form-data">
<div class="mb-3 col-8 mx-auto">
  <input type="text" class="form-control" name ="name" placeholder="NAME...." value="<?php echo $name ?>">
</div>


<div class="mb-3 col-8 mx-auto">
  <input type="text" class="form-control" name ="eamil" placeholder="EAMIL....">
</div>

<div class="mb-3 col-8 mx-auto">
  <input type="text" class="form-control" name ="number" placeholder="NUMBER....">
</div>

<div class="mb-3 col-8 mx-auto">
  <input type="text" class="form-control" name ="salary" placeholder="SALARY....">
</div>

<div class = "col-8 text-center mx-auto">
<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col1">EMAIL</th>
      <th scope="col">NUMBER</th>
      <th scope="col">SALARY</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>

  <?php 

if (isset ($_POST['asc'])):
foreach ($a as $data): ?>


<tr>
    <th><?php echo $data['id'] ?></th>
    <th><?php echo $data['name'] ?></th> 
    <th><?php echo $data['email']?></th>
    <th><?php echo $data['course'] ?></th>
    <th><?php echo $data['grade'] ?></th>
    <th><a href="./index.php?delete=<?php echo $data ['id']?>"><i class="fa-solid fa-trash text-danger mx-1"></i></a> <a href="./index.php?edit=<?php echo $data ['id']?>"><i class="fa-solid fa-pen-to-square text-info mx-1"></i></a> <a href="./show.php?show=<?php echo $data ['id']?>"><i class="fa-solid fa-eye "></i></a></th>
</tr>


<?php 
endforeach;

 elseif (isset ($_POST['desc'])) :
foreach ($d as $data): ?>


<tr>
    <th><?php echo $data['id'] ?></th>
    <th><?php echo $data['name'] ?></th> 
    <th><?php echo $data['email']?></th>
    <th><?php echo $data['course'] ?></th>
    <th><?php echo $data['grade'] ?></th>
    <th><a href="./index.php?delete=<?php echo $data ['id']?>"><i class="fa-solid fa-trash text-danger mx-1"></i></a> <a href="./index.php?edit=<?php echo $data ['id']?>"><i class="fa-solid fa-pen-to-square text-info mx-1"></i></a> <a href="./show.php?show=<?php echo $data ['id']?>"><i class="fa-solid fa-eye "></i></a></th>
</tr>



<?php 
endforeach;

elseif (isset ($_POST ['search'])) :

  foreach ($f as $data): ?>
    <tr>
        <th><?php echo $data ['id'] ?></th>
        <th><?php echo $data ['name'] ?></th>
        <th><?php echo $data['email']?></th>
        <th><?php echo $data['course'] ?></th>
        <th><?php echo $data['grade'] ?></th>
        <th><a href="./index.php?delete=<?php echo $data ['id']?>"><i class="fa-solid fa-trash text-danger mx-1"></i></a> <a href="./index.php?edit=<?php echo $data ['id']?>"><i class="fa-solid fa-pen-to-square text-info mx-1"></i></a> <a href="./show.php?show=<?php echo $data ['id']?>"><i class="fa-solid fa-eye "></i></a></th>

        
    </tr>
    

<?php endforeach;

  else :
    

    foreach ($s as $data): ?>
    <tr>
        <th><?php echo $data ['id'] ?></th>
        <th><?php echo $data ['name'] ?></th>
        <th><?php echo $data['email']?></th>
        <th><?php echo $data['number'] ?></th>
        <th><?php echo $data['salary'] ?></th>
        <th><a href="./index.php?delete=<?php echo $data ['id']?>"><i class="fa-solid fa-trash text-danger mx-1"></i></a> <a href="./index.php?edit=<?php echo $data ['id']?>"><i class="fa-solid fa-pen-to-square text-info mx-1"></i></a> <a href="./show.php?show=<?php echo $data ['id']?>"><i class="fa-solid fa-eye "></i></a></th>

        
    </tr>

<?php endforeach;

    endif; ?>

  </tbody>
</table>

<button name= "submit" class = "btn-submit ">SUBMIT</button>
<button name= "update" class = "btn-update ">UPDATE</button>
<button name= "update" class = "btn-delete ">DELETE ALL</button>

</div>
</form>

<script src="./bootstrap.bundle.min.js"></script>
<script src="./bootstrap.min.js"></script>
<script src="./fontawesome/all.min.js"></script>


</body>
</html>