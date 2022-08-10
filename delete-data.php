<?php
$con=mysqli_connect("localhost","root","","test") or die("Connection faild");

if(isset($_POST)){
    $id=$_POST['id'];
 
    $query="DELETE FROM `ajax_data` WHERE id=".$id;

    $result=mysqli_query($con,$query);
    if($result){
    	echo $result;
    } else{

    	echo 0;
    }
    
}