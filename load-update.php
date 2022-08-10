<?php
$con=mysqli_connect("localhost","root","","test") or die("Connection faild");


if(isset($_POST)){
    $id=$_POST['editId'];
  
    $query="select * from ajax_data where id ='".$id."'";

    $result=mysqli_query($con,$query);
    $numRows=mysqli_num_rows($result);

    if($numRows > 0){
      $result=mysqli_fetch_assoc($result);
    echo '<tr>
            <td>Email</td>
            <td><input type="email" name="email" id="edit_email" value="'.$result['email'].'">
            <input type="text" name="edit_id" id="edit_id" hidden value="'.$id.'">
            </td>

          </tr>
          <tr>
            <td>Password</td>
            <td><input type="password" name="password" id="edit_password" value="'.$result['password'].'"></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="submit" id="edit_submit" value="save"></td>
          </tr>';
    } else{

      echo 0;
    }
    

}