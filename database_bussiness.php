<?php
$con=mysqli_connect("localhost","root","","test") or die("Connection faild");
 

 $query="select * from ajax_data";
 $result=mysqli_query($con,$query) or die("SQL query faild");

    $table='<table class="table table table-dark">
            <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Email Id</th>
            <th scope="col">Password</th>
             <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>';
            $i=1;
         while ($row=mysqli_fetch_assoc($result))
           {
             $table.= '<tr>
             <th scop="row">'.$i.'</th>
             <td>'.$row['email'].'</td>
             <td>'.$row['password'].'</td>
             <td><button class="delete-data" data-id='.$row['id'].'>Delete</button>|<button class="edit-data" data-eid='.$row['id'].'>Edit</button></td>
             </tr>';
             $i++;        
            }

           $table.='</tbody>
           </table>';

           echo $table;

?>