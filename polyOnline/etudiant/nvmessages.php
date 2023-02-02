<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/connect.php');
if(!(isset($_SESSION['emailetudiant'])) and !(isset($_SESSION['passetudiant'])))
	{	
		session_destroy();
		header('location:login/studentLogin.php');

}
else{
	$etudiant=$_SESSION['emailetudiant'];
	$sql1="SELECT id  FROM feedback where status='1' AND reciver='$etudiant' ";
    $res1=mysqli_query($connect,$sql1);
	$count=0;
if(mysqli_num_rows($res1) > 0) 
{	
	while($row = mysqli_fetch_assoc($res1)) 
{
	$count=$count+1;
}
$_SESSION['countetudiant']=$count;
}	

$sql3="SELECT id  FROM feedback where reciver='$etudiant' ";
    $res3=mysqli_query($connect,$sql3);
	$total=0;
if(mysqli_num_rows($res3) > 0) 
{	
	while($row3 = mysqli_fetch_assoc($res3)) 
{
	$total=$total+1;
}
$_SESSION['totaletudiant']=$total;

}

 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Nouveau Message</title>

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

						<h2 class="page-title">Nouveau Message</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">List des Professeurs</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										       <th class="text-center">#</th>
											   <th class="text-center">Image</th>
											   <th class="text-center">Matiere</th>
												<th class="text-center">Nom</th>
												<th class="text-center">Email</th>
												<th class="text-center">Contacter</th>
										</tr>
									</thead>
									
									<tbody>

<?php 

$sql = "SELECT * from  prof";
$res=mysqli_query($connect,$sql);

$cnt=1;
if(mysqli_num_rows($res) > 0) 
{
	while($row = mysqli_fetch_assoc($res)) 
{							?>	
										<tr class="text-center">
											<td><?php echo htmlentities($cnt);?></td>
											<td><img src="/polyOnline/prof/images/<?php echo $row['image'];?>" style="width:60px; border-radius:50%;"/></td>
											<td><?php echo $row['mat'];?></td>
											<td><?php echo $row['nompr'];?></td>
											<td><?php echo $row['email'];?></td>
											<td>
<a href="sendreply.php?reply=<?php echo $row['email'];?>">&nbsp; <i class="fa fa-paper-plane"></i></a>&nbsp;&nbsp;
</td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
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
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
		</script>
</body>
</html>
<?php } ?>
