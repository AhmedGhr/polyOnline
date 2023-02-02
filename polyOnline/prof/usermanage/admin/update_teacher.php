<?php
include 'connect.php';
 if($_GET['id'])
  $id=$_GET['id'];
 
$sql="SELECT * FROM prof WHERE id={$id}";
$res=mysqli_query($connect,$sql);
$row=mysqli_fetch_assoc($res);
$connect->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Document</title>
      <!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
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
<body>
<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
    <form  method="POST" action="update_teacher2.php">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $row['email'] ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required >
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Nom Et Prenom</label>
          <input type="text" class="form-control" name="nompr" required value="<?php echo $row['nompr'] ?>">
        </div>

        <div class="form-group">
          <label for="inputAddress">Telephone</label>
          <input type="number" max="99999999" class="form-control" name="tel" placeholder="1234 Main St" value="<?php echo $row['tel'] ?>">
        </div>
        
        <div class="form-row">
          
          <div class="form-group col-md-4">
            <label for="inputState">Matiere</label>
            <select name="mat" class="form-control" style="height:50px">
              <option selected>Math</option>
              <option >C</option>
              <option >Web Dev</option>
              <option >Python</option>
              <option >JEE</option>
              <option >JAVa</option>
              
            </select>
          </div>
         
        </div>
        <button type="submit" class="btn btn-primary">Mise a jour</button>
        </div>
        
      </form>
      </div>
      </div>
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
</body>
</html>