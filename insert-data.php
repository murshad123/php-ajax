<?php
$con=mysqli_connect("localhost","root","","test") or die("Connection faild");


if(isset($_POST)){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query="INSERT INTO `ajax_data`(`email`, `password`) VALUES ('$email','$password')";

    $result=mysqli_query($con,$query);
    if($result){
    	echo $result;
    } else{

    	echo 0;
    }
    

}