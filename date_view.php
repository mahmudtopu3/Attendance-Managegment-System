<?php 
error_reporting(0);
include "inc/header.php";
include "lib/Student.php";

?>

       <div class="panel panel-default"> 
           <div class="panel-heading"> 
				<h2>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="index.php">Add Attendence</a>
				</h2>
           </div>
           <div class="pane;-body"> 
             <div class="well text-center"> 
				<strong>Date: <?php  echo $cur_date; ?></strong>
             </div>
				<form action="" method="post">
					
						<table class="table table-striped"> 
							<tr> 
							  <th width="25%">Serial</th>
							  <th width="55%">Attendence Date</th>
							  <th width="20%">Action</th>
							  
							</tr>
							<?php 
							    $stu = new Student;
                                $get_date=$stu->getDateList();
                                if($get_date){
                                	$i=0;
                                	while($value=$get_date->fetch_assoc()){
                                		$i++;
                               
							?>
							<tr> 
                               <td><?php echo $i; ?></td>
                               <td><?php echo $value['atted_time']; ?></td>
                               <td> <a class="btn btn-primary" href="student_view.php?dt=<?php echo $value['atted_time']; ?>">View</a></td>
                               
							</tr>
						<?php 
								}
						     }
						?>
							

 						

						</table>
				</form>
           </div>

       </div>
<?php 
include "inc/footer.php";
?>