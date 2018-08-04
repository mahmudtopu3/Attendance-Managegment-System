<?php 
//error_reporting(0);
include "inc/header.php";
include "lib/Student.php";

?>
<script type="text/javascript">
	$(document).ready(function(){
       $("form").submit(function(){
          var roll =true;
          $(':radio').each(function(){
           name = $(this).attr('name');
           if(roll && !$(':radio[name="' + name + '"]:checked').length){
           	 $('.alert').show();
           	roll = false;
           }
          });
          return roll;
       });

	});

</script>
<?php 
$stu = new Student;
date_default_timezone_set('Asia/Dhaka');
$cur_date = date("Y-m-d");
if($_SERVER['REQUEST_METHOD']== 'POST'){
	$attend = $_POST['attend'];

	$insert_attend = $stu->insert_attend($cur_date,$attend);
}
?>
<?php 
if(isset($insert_attend)){
	echo $insert_attend;
}
?>
    <div class='alert alert-danger' style ="display:none"><strong>Error !</strong>Student Missing</div>
       <div class="panel panel-default"> 
           <div class="panel-heading"> 
				<h2>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="date_view.php">View All</a>
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
							  <th width="25%">Name</th>
							  <th width="25%">Roll</th>
							  <th width="25%">Attendence</th>
							</tr>
							<?php 
                                $get_data=$stu->getData();
                                if($get_data){
                                	$i=0;
                                	while($value=$get_data->fetch_assoc()){
                                		$i++;
                               
							?>
							<tr> 
                               <td><?php echo $i; ?></td>
                               <td><?php echo $value['name']; ?></td>
                               <td><?php echo $value['roll']; ?></td>
                               <td>

                               	
                               	<input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="present"  > <span class="glyphicon glyphicon-ok "></span>
                               	<input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="absent" > <span class="glyphicon glyphicon-remove "></span>
                               </td>
							</tr>
						<?php 
								}
						     }
						?>
							<tr> 

							 <td> 
								<input type="submit" name="submit" value="Submit" class="btn btn-primary">
							 </td>
							</tr>

 						

						</table>
				</form>
           </div>

       </div>
<?php 
include "inc/footer.php";
?>