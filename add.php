 <?php 
include "inc/header.php";
include "lib/Student.php";
?>
<?php 
$stu = new Student;
$cur_date = date("Y-m-d");
if($_SERVER['REQUEST_METHOD']== 'POST'){
	$name = $_POST['name'];
	$roll = $_POST['roll'];
	$insert_data = $stu->insert_data($name,$roll);
}
?>
<?php 
if(isset($insert_data)){
	echo $insert_data;
}
?>
 <div class="panel panel-default"> 
           <div class="panel-heading"> 
				<h2>
					
					<a class="btn btn-info " href="date_view.php">View All</a>
				</h2>
           </div>
           <div class="pane;-body"> 
             <div class="well text-center"> 
				<strong>Date: <?php  echo $cur_date; ?></strong>
             </div>
				<form action="" method="post">
					
						<table class="table table-striped"> 
							
						  <div class="form-group">
						     <label for="name">Student Name</label>
						     <input type="text" class="form-control" name="name" id="name" placeholder="Enter Student's Name"> 
						  </div>
						  <div class="form-group">
						     <label for="roll">Student Roll</label>
						     <input type="text" class="form-control" name="roll" id="roll"  placeholder="Enter Roll Number"> 
						  </div>
						  <div class="form-group">
						     
						     <input type="submit"  name="submit" value="Submit" class="btn btn-primary"> 
						  </div>
 						

						</table>
				</form>
           </div>

       </div>
<?php 
include "inc/footer.php";
?>