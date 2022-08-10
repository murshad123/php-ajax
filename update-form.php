<?php
$con=mysqli_connect("localhost","root","","test") or die("Connection faild");

if(isset($_POST)){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $id=$_POST['updateId'];
 
    $query="UPDATE `ajax_data` SET `email`='".$email."',`password`='".$password."' WHERE id=".$id;
    $result=mysqli_query($con,$query);

    if($result){
    	echo $result;
    } else{

    	echo 0;
    }
    
}