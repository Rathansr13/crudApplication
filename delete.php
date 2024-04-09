<?php
include("db.php");

if(isset($_GET["deleteId"]))
{
    $id=$_GET["deleteId"];

    $sql = "delete from parts where id=$id";
    $result= mysqli_query($conn,$sql);
    if($result)
    {
       header("Location: homePage.php");
    }
    
}


?>