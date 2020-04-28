
<?php
session_start();
error_reporting(0);
include ('config.php');
{
if(isset($_POST['add']))
{

$nomproduit=$_POST['nomproduitfield'];
$quantite=$_POST['quantitefield'];

$sql="INSERT INTO tableproduit(nomproduit,quantite) VALUES(:nomproduit,:quantite)";
$query=$dbh->prepare($sql);

$query ->bindparam(':nomproduit',$nomproduit,PDO::PARAM_STR);
$query ->bindparam(':quantite',$quantite,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['ajouter']="ajouter avec succees";

//header('location:index.php')
//echo "<script> alert('success');</script>";
header('location:ajouter.php');
echo "<script> alert('ajout succés);</script>";


}else{
$_SESSION['msg']=' il y a erreur';
//header('location:index.php');
echo "<script> alert('c'est invalid');</script>";
}


}


/*

<?php if($_SESSION['ajouter']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['ajouter']);?>
<?php echo htmlentities($_SESSION['ajouter']="");?>
</div>
</div>
<?php } ?>

------------------------------------------------------------------------
-----------------------------------------------------------------------
insert by URL
------------------------------------------------------------------------
----------------------------------------------------------------------

    $nomproduit=$_GET['nomproduit'];

    $con=mysqli_connect("localhost","root","","gestionproduit");
    
    

    $sql="INSERT INTO tableproduit(nomproduit) VALUES('".$nomproduit."')";
    $result=mysqli_query($con,$sql);
    echo "result: ".$result;

    mysqli_close($con);

*/
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- GOOGLE FONT -->
    <link href="assets/css/css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css "/>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"></head>
<body>


<form action="" role="form" method="post">

<div class="form-group">
    
<div class="label label-primary">
NOM produit:</div>
 <input type="text" name="nomproduitfield">




</div>
<div class="form-group">
    
<div class="label label-primary">
Quantité: </div>
 <input type="text" name="quantitefield">




</div>

<button type="submit" name="add" class="btn btn-success" >Ajouter</button>
<button class="btn btn-primary"><a href="search.php"> search</a></button>
<button type="submit" name="imprimer" class="btn btn-danger" >Imprimer</button>


</form>

<?php}?>


<table  border="1">
    
<thead>
<tr>
   <td>Id</td> 

<td>NOM PRODUIT</td>
<td>QUANTITE</td>
<td>Modifier</td>
<td>Supprimer</td>

</tr>


</thead>
<tbody>

    <?php 

$sql="SELECT * FROM tableproduit";
$query=$dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query-> rowcount()>0)
{
    foreach ($results as $result) {
?> <tr>
    <td><?php echo htmlentities($cnt) ; ?></td>
    <td><?php echo htmlentities($result->nomproduit);?></td>
<td><?php echo htmlentities($result->quantite);?></td>      
<td><a href="edit.php?editid=<?php echo htmlentities($result->id); ?>"> <button class="btn btn-primary">EDIT</button></a></td> <!-- envoi des valeurs de pageà autre  !-->
<td><a href="delete.php?delid=<?php echo htmlentities($result->id);?>" onclick="return confirm('are you sure to delete');""   ><button class="btn btn-warning">DELETE</button></a></td>


</tr>
<?php $cnt=$cnt+1; ?>


<?php }} ?>
   
</tbody>




</table>





























    <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
