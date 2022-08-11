<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajax</title>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<style type="text/css">
     .success-message{
     	background: #DEF1D8;
     	color: green;
     	padding: 10px;
     	margin: 10px;
     	display: none;
     	position: absolute;
     	right: 15px;
     	top: 15;

     }
     .error-message{

     	background: #EFDCDD;
     	color: red;
     	padding: 10px;
     	margin: 10px;
     	display: none;
     	position: absolute;
     	right: 15px;
     	top: 15;

     }

	.delete-data{
		background-color: red;
		color: #FFF;
		border: 0;
		padding: 4px 10px;
		border-radius: 3px;
		cursor: pointer;
	}

	.edit-data{
		background-color:gold;
		color: #FFF;
		border: 0;
		padding: 4px 10px;
		border-radius: 3px;
		cursor: pointer;
	}

	#modal{
		background: rgba(0, 0, 0, 0.7);
		position: fixed;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		z-index: 100;
		display: none;
		
	}

	#modal-form{
		background: #fff;
		width: 30%;
		position: relative;
		top: 20%;
		left: calc(50% - 15%);
		padding: 15px;
		border-radius: 4px;

	}

	#modal-form h2{
            margin: 0 0 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #000;

	}

	#close-btn{
		background: red;
		color: white;
		width: 30px;
		height: 30px;
		line-height: 30px;
		text-align: center;
		border-radius: 50%;
		position: absolute;
		top: -15px;
		right: -15px;
		cursor: pointer;
	}
</style>
</head>
<body class="container">
	<br>
	
		<form id="addForm">
			<div class="row">
			<div class="col-sm-5">
			<label for="exampleInputEmail1" class="form-label">Email address</label>
			<input type="email" class="form-control" id="email" aria-describedby="emailHelp">
			</div>
			<div class="col-sm-5">
			<label for="exampleInputPassword1" class="form-label">Password</label>
			<input type="password" class="form-control" id="password">
			</div>
			<div class="col-sm-2">
			<button type="submit" class="btn btn-primary save-data" style="margin-top: 30px;">Submit</button>
		    </div>
		   </div>
		</form>
		<br>
		<br>
		<div class="success-message"></div>	
		<div class="error-message"></div>	
		<div id ="modal">
			<div id="modal-form">
				<h2>Modal Form</h2>
				<table cellpadding="10px" width="100%" id="editData">
					
					
				</table>
				<div id="close-btn">X</div>
				
			</div>
			
		</div>
		<div class="users-data">

		</div>
	

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
     //Show Table
	function loadTable(){
		$.ajax({
     	url:"database_bussiness.php",
     	type:"POST",
     	success:function(data){
     	$(".users-data").html(data);

     	}
      });

	}
	//Save data
    $(".save-data").on("click",function(e){
    	e.preventDefault();
    	var email=$("#email").val();
    	var password=$("#password").val();
    	if(email=="" || password==""){

           $(".error-message").html("All fields are mandotry..!").slideDown();
           $(".success-message").slideUp();
    	} else{
    		$.ajax({
    		  url:"insert-data.php",
    		  type:"POST",
    		  data:{email:email,password:password},
    		  success:function(data){
    		  	if(data==1){
                 loadTable();
                 $("#addForm").trigger("reset");
                 $(".success-message").html("Data inserted successfully").slideDown();
                 $(".error-message").slideUp();
    		  	} else{

    		  	 $(".error-message").html("Data is not inserted").slideDown();
                 $(".success-message").slideUp();
    		  	}
                  
    		  }
    	});

    	}

    });

   //Delete Data
    $(document).on("click",".delete-data",function(){
    	if(confirm("Do you want to delete this record ?")){
    	var id=$(this).data("id");
    	var element=this;

    	$.ajax({
               url:"delete-data.php",
               type:"POST",
               data:{id:id},
               success:function(data){
               	if(data==1){
                 $(element).closest("tr").fadeOut();
    		  	} else{
    		  	 $(".error-message").text("Data is not delete");
    		  	}

               }
    	  });
      }
    });

    $(document).on("click",".edit-data",function(){

    	$("#modal").show();
    	var editId=$(this).data("eid");
    	$.ajax({
    		url:"load-update.php",
    		type:"post",
    		data:{editId:editId},
    		success:function(data){
                //alert(data);
                $("#editData").html(data);
    		}
    	})

    });

    $("#close-btn").on("click",function(){
         $("#modal").hide();    
             
    });

    $(document).on("click","#edit_submit",function(){
    	var updateId=$("#edit_id").val();
    	var email=$("#edit_email").val();
    	var password=$("#edit_password").val();
    	$.ajax({
    		url:"update-form.php",
    		type:"post",
    		data:{updateId:updateId,email:email,password:password},
    		success:function(data){
                $("#modal").hide(); 
                 loadTable(); 
                  $(".success-message").html("Data updated successfully").slideDown();
                 $(".success-message").slideUp(5000); 
    		}
    	});

    });

    loadTable(); 

	});
</script>

