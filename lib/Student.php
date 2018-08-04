<?php 
$file_path = realpath(dirname(__FILE__));
include_once($file_path.'/Database.php'); 
?>
<?php 

class Student{

    private $db;
	public function __construct(){
		$this->db=new Database;
	}

	public function getData(){
		$query= "Select * from tbl_student";
		$result=$this->db->select($query);
		return $result;

	}
	public function getDateList(){
		$query= "Select  distinct atted_time from tbl_attendence";
		$result=$this->db->select($query);
		return $result;

	}
	public function getAllData($dt){
		$query= "Select tbl_student.name, tbl_attendence.*
        from tbl_student INNER JOIN tbl_attendence ON tbl_student.roll = tbl_attendence.roll 
        Where atted_time = '$dt'
		";
		$result=$this->db->select($query);
		return $result;

	}
	public function insert_data($name,$roll){
 		$name = mysqli_real_escape_string($this->db->link,$name);
 		$roll = mysqli_real_escape_string($this->db->link,$roll);
 		if(empty($name)||empty($roll)){

 			$msg = "<div class='alert alert-danger'><strong>Error !</strong>Fields Must Not Be Empty</div>";
 			return $msg;
 		}
 		else{
 			$insert_query = "INSERT INTO tbl_student(name,roll) VALUES('$name','$roll')";
 			$insert_data  = $this->db->insert($insert_query);
 			$insert_query = "INSERT INTO tbl_attendence(roll) VALUES('$roll')";
 			$insert_data  = $this->db->insert($insert_query);

 			if($insert_data){
 				$msg = "<div class='alert alert-success'><strong>Success !</strong>Data Inserted</div>";
 			return $msg;
 			}
 			else{
 				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Data Insertion Failed</div>";
 			return $msg;
 			}
 		}

	}

	public function insert_attend($cur_date,$attend =array()){
      
		$query = "SELECT DISTINCT atted_time FROM tbl_attendence";
		$get_data = $this->db->select($query);
		while($result = $get_data->fetch_assoc()){
			 $db_date = $result['atted_time'];
			if($cur_date == $db_date){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Attendence Already Taken</div>";
 			return $msg;
 			
 			}
			}

           
			foreach ($attend as $atn_key => $atn_value) {
			   if($atn_value == "present")	{
			   	$data_query = "INSERT INTO tbl_attendence(roll,atted,atted_time)VALUES ('$atn_key','present',now())";
			   	$data_insert = $this->db->insert($data_query);
			   }
			   else if($atn_value == "absent"){
			   	$data_query = "INSERT INTO tbl_attendence(roll,atted,atted_time)VALUES ('$atn_key','absent',now())";
			   	$data_insert = $this->db->insert($data_query);

			   }
			}


			if($data_insert){
 				$msg = "<div class='alert alert-success'><strong>Success !</strong> Attendence Has Been Taken</div>";
 			return $msg;
 			}
 			else{
 				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Attendence Has Not Been Taken</div>";
 			return $msg;
 			}
 		


		}

		public function update_attend($dt,$attend = array())
		{
			foreach ($attend as $atn_key => $atn_value) {
			   if($atn_value == "present")	{
			   	 $update_query= "
					UPDATE tbl_attendence
					 SET atted  = 'present'
					WHERE roll = '".$atn_key."' AND 
					atted_time = '".$dt."' 
			   	 ";
			   	 $data_update = $this->db->update($update_query);
			   }
			   else if($atn_value == "absent"){
			   	 $update_query= "
					UPDATE tbl_attendence
					SET atted  = 'absent'
					WHERE roll = '".$atn_key."' AND 
					atted_time = '".$dt."' 
			   	 ";
			   	 $data_update = $this->db->update($update_query);
			   }
			   }
			   if($data_update){
 				$msg = "<div class='alert alert-success'><strong>Success !</strong> Attendence Has Been Updated</div>";
 			return $msg;
 			}
 			else{
 				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Attendence Has Not Been Updated</div>";
 			return $msg;
 			}
			}


			
		


	}



?>