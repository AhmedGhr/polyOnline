<?php
error_reporting(0);
session_start();
if(!(isset($_SESSION['email'])) and !(isset($_SESSION['pass'])))
	{	
		session_destroy();
		header('location:login/studentLogin.php');

}
else{
	


$id=$_SESSION['idd'];
include('includes/connect.php');
$msg="";

if(isset($_POST['submit'])){
  {if((empty($_FILES['image']['name']))){
               
	$pass=$_POST['passwordconf'];      
	$imageold=$_POST['image'];
	$sql = "UPDATE etudiant SET password='$pass',image='$imageold' WHERE id={$id}";
	if (mysqli_query($connect, $sql)) {
		$msg="Mise a jour d'etudiant fait avec succés";    }
}
else if  (!empty($_FILES['image']['name'])){
    $file = $_FILES['image']['name'];
	$file_loc = $_FILES['image']['tmp_name'];
	$folder="images/";
	$extension = pathinfo($file, PATHINFO_EXTENSION);
	$filename = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];

	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',$new_file_name);
	$pass=$_POST['passwordconf'];
	  $image=$_POST['image'];
	  if (!in_array($extension,['jepg', 'png', 'jpg' ,'tiff'])) {
        $error="You file extension must be 'jepg', 'png', 'jpg' ,'tiff'";
    } elseif ($_FILES['image']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
        $error= "File too large!";
    } else {
	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$image=$final_file;
		}
$sql="UPDATE `etudiant` SET password='$pass' , image='$image' WHERE id='$id'";
if (mysqli_query($connect,$sql))
{ 
	$msg="mise a jour fait avec succées";
}
else
{
	$error="Erreur de mise a jour";
}
  }
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Document</title>
         <!-- Font awesome -->
	<link rel="stylesheet" href="usermanage/css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="usermanage/css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="usermanage/css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="usermanage/css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="usermanage/css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="usermanage/css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="usermanage/css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="usermanage/css/style.css">

  <style>

	.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

		</style>
</head>
<?php 
include('includes/connect.php');

include('includes/header.php');
$sql1="SELECT *  FROM etudiant where id='$id'";
$res1=mysqli_query($connect,$sql1);
if(mysqli_num_rows($res1) > 0) 
{
	while($row = mysqli_fetch_assoc($res1)) {

?>
<body>



	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title">Changer profile :<b> <?php echo $row['nom']; ?></b></h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
                  <?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<label class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="name" class="form-control" disabled value="<?php echo $row['nom'];?>">
</div>
<label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="email" name="email" class="form-control" disabled value="<?php echo $row['email'];?>">
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Image<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="file" name="image" class="form-control">
</div>

<label class="col-sm-2 control-label">Password.<span style="color:red" >*</span></label>
<div class="col-sm-4">
<input type="password" name="passwordconf" class="form-control" required value="<?php echo $row['password'];?>" >
</div>
</div>

<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<img src="images/<?php echo $row['image']?>" width="150px"/>
		<input type="hidden" name="image" value="<?php echo $row['image'];?>" >
	
</div>
</div>


<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
	</div>
</div>

</form>
									</div>
								</div>
							</div>
						</div>
						
					

					</div>
				</div>
				
			

			</div>
		</div>
	</div>
    
</body>
</html>
<!-- Loading Scripts -->
<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
            $('.errorWrap').slideUp("slow");
					}, 3000);
					});
	</script>

<?php }}}?>


