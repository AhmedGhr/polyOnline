<?php
define("serveur","localhost");
define("utilisateur","root");
define("mot_de_passe",'');
define("base","poly");
$email=$_POST['email'];
$pass=$_POST['pass'];
$bdd=mysqli_connect(serveur,utilisateur,mot_de_passe,base) or die(mysqli_connect_error());
$sql="SELECT * FROM admin WHERE email='$email' AND password='$pass'";
$resultat=mysqli_query($bdd,$sql);
if(mysqli_num_rows($resultat)==0){
    echo 'Utilisateur ou mot de passe incorrecte !!';
}
else{
   
    header('location:../usermanage/admin/teacher_list.php');
}

?>