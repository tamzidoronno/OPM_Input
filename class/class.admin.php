
<?php
include(dirname(__FILE__).'/config2.php');
include(dirname(__FILE__).'/class.md.crypt.php');
class lawyerController
{
	public $db;
    private $debugmode = true; 
	
	public function __construct(){
       
        $this->db = $this->connection(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
       // $this->connectDb();
		
	}
    
    public function setDebug($status = false){
		$this->debugmode = 	$status;
	}
	
	private function debug($msg){
		if($this->debugmode)
		exit($msg);
	}
    
    private function connectDb(){
        $this->db = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
		if($this->db->errno):
			echo 'Database Connection Error';
			exit;
		endif;
		
		$this->db->query("SET NAMES 'utf8'");
		$this->db->query("SET CHARACTER SET utf8");
		$this->db->query("SET CHARACTER_SET_CONNECTION=utf8");
		$this->db->query("SET SQL_MODE = ''");
        
    }
    
    public function connection($hostname, $username, $password, $database){
		//$conetion_var ;
			if (!$conetion_var = mysqli_connect($hostname, $username, $password, $database)) {
				$this->debug('Error: Could not make a database connection using ' . $username . '@' . $hostname);
				
			}
			if($conetion_var){
				if (!mysqli_select_db($conetion_var, $database)) {
					$this->debug('Error: Could not connect to database ' . $database);
					return false;
				}
				else{				
					mysqli_query($conetion_var, "SET NAMES 'utf8'");
					mysqli_query($conetion_var, "SET CHARACTER SET utf8");
					mysqli_query($conetion_var, "SET CHARACTER_SET_CONNECTION=utf8");
					mysqli_query($conetion_var, "SET SQL_MODE = ''");
					return $conetion_var;
				}
			}
			else
			return false;
	}
	
	public function login($BA_No_Type, $BA_No, $Course_Type, $Course, $dob)
	{
		//$password = md5($this->db->real_escape_string($password));
		
		$sql = "SELECT * FROM `users` WHERE `BA_No_Type` = '". $this->db->real_escape_string($BA_No_Type) ."' AND `BA_No` = '". $this->db->real_escape_string($BA_No) ."'  AND `Course_Type` = '". $this->db->real_escape_string($Course_Type) ."'  AND `Course` = '". $this->db->real_escape_string($Course) ."'  AND `DoB` = '". $this->db->real_escape_string($dob) ."'   ";
		
		$query = $this->db->query($sql);
		
		$row_number = $query->num_rows;
	

		if($row_number == 1):
			$userInfo = $query->fetch_array();
			$user_id = $userInfo['id'];
			
			$_SESSION['login'] = 1;
			$_SESSION['id'] = $user_id;
			$_SESSION['group'] = $userInfo['usergroup'];
			
			
			return true;
			
		else:
		
			return false;
			
		endif;
	}
    
    public function logout(){
        if(isset($_SESSION['login']))
            unset($_SESSION['login']);
        if(isset($_SESSION['id']))
            unset($_SESSION['id']);
        if(isset($_SESSION['group']))
            unset($_SESSION['group']);
       
    }
    
    public function isLogin(){
        if(isset($_SESSION['id']) && $_SESSION['id'])
            return $_SESSION['id'];
        else
            return false; 
        
    }
	
	public function sessionBegin()
	{
		if(isset($_SESSION['login']))
			return $_SESSION['login'];
		else
			return false;
	}
	
	public function sessionEnd()
	{
		$_SESSION['login'] = false;
		
		session_destroy();
	}
	
	public function name($lawyer_id)
	{
		/*$sql = "SELECT * FROM `user_info` WHERE `user_id` = '".$lawyer_id."'";
		$lawyer_name_query = $this->db->query($sql);
		//$lawyer_name_array = $lawyer_name_query->fetch_array();
		if($lawyer_name_array)
		{
			$fullname = $lawyer_name_array['first_name'].' '.$lawyer_name_array['last_name'];
			return $fullname;
		}
		else
		{
			$no_name = "Unknown Name";
			return $no_name;
		}*/
		return 0;
	}
	
	public function lawyerInfo($lawyer_id){
		$sql = "SELECT a.*, b.email FROM `user_info` a LEFT JOIN `users` b on a.user_id=b.id WHERE a.user_id = '".$lawyer_id."'";
		$lawyer_query = $this->db->query($sql);
		$lawyer_info = $lawyer_query->fetch_object();
		
		return $lawyer_info;
	}
	
	public function adminInfo(){
		$sql = "SELECT a.*, b.email FROM `user_info` a LEFT JOIN `users` b on a.user_id=b.id WHERE b.usergroup = '1' LIMIT 1";
		$lawyer_query = $this->db->query($sql);
		$lawyer_info = $lawyer_query->fetch_object();
		
		return $lawyer_info;
	}
	
	public function addClient($dossier, $name, $phone, $lawyer_id, $r_date, $location, $recours, $aj, $convocation, $doc_last_date, $payment, $question, $cby, $m_date, $mby, $rdv, $attachment)
	{
		//$lawyer_id = $_SESSION['id'];
		$userGroup = $_SESSION['group'];

		$sql1 = "SELECT * FROM `clients` WHERE `name` = '".$name."' AND `phone` = '".$phone."'";
		$client_query = $this->db->query($sql1);
		$client_row = $client_query->num_rows;
			
		if($client_row == 1):
		
			$id_client = mysqli_fetch_array($client_query);
			$id = $id_client['id'];
			
			$sql3 = "INSERT INTO `case_info` (`client_id`, `lawyer_id`, `receive_date`, `location`, `recours`, `aj`, `convocation`, `doc_last_date`, `payment`, `question`, `status`, `created_date`, `created_by`, `modified`, `modified_by`, `dossier`, `rdv`) VALUES ('$id', '$lawyer_id', '$r_date', '$location', '$recours', '$aj', '$convocation', '$doc_last_date', '$payment', '$question', '1', 'NOW()', '$cby', '$m_date', '$mby', '$dossier', '$rdv)";
			
			
			$case_query = $this->db->query($sql3);
			$case_id = $this->db->insert_id;
			
			if ($attachment["error"] == 0){
				$fileName = $this->fileUpload($rdv);
				
				$sql4 = "UPDATE `case_info` SET
						`attachment` = '$fileName'
					WHERE id = $case_id
					";
				$case_query = $this->db->query($sql4);
			}
			if($userGroup!=1){
				$this->newClientNotify($case_id);
			}
			return $case_id;
		
		elseif($client_row == 0):
			$sql2 = "INSERT INTO `clients` (`name`, `phone`, `created_date`) VALUES ('$name', '$phone', 'NOW()')";
			$query = $this->db->query($sql2);
			$client_id = $this->db->insert_id;
			
			$sql3 = "INSERT INTO `case_info` (`client_id`, `lawyer_id`, `receive_date`, `location`, `recours`, `aj`, `convocation`, `doc_last_date`, `payment`, `question`, `status`, `created_date`, `created_by`, `modified`, `modified_by`, `dossier`, `rdv`) VALUES ('$client_id', '$lawyer_id', '$r_date', '$location', '$recours', '$aj', '$convocation', '$doc_last_date', '$payment', '$question', '1', 'NOW()', '$cby', '$m_date', '$mby', '$dossier', '$rdv')";
			
			$case_query = $this->db->query($sql3);
			$case_id = $this->db->insert_id;
			
			if ($attachment["error"] == 0){
				$fileName = $this->fileUpload($rdv);
				
				$sql4 = "UPDATE `case_info` SET
						`attachment` = '$fileName'
					WHERE id = $case_id
					";
				$case_query = $this->db->query($sql4);
			}
			if($userGroup!=1){
				$this->newClientNotify($case_id);
			}
			return $case_id;
		
		
		else:
			return false;
			
		endif;
	}
	
	public function editClient($case_id, $dossier, $client_id, $name, $phone, $lawyer_id, $r_date, $location, $recours, $aj, $convocation, $doc_last_date, $payment, $question, $cby, $m_date, $mby, $rdv, $attachment)
	{			
			$sql3 = "UPDATE `case_info` SET
				`dossier` = '$dossier',
				`client_id` = $client_id, 
				`lawyer_id` = '$lawyer_id', 
				`receive_date` = '$r_date', 
				`location` = '$location', 
				`recours` = '$recours', 
				`aj` = '$aj', 
				`convocation` = '$convocation', 
				`doc_last_date` = '$doc_last_date', 
				`payment` = '$payment', 
				`question` = '$question', 
				`status` = 1, 
				`modified` = '$m_date', 
				`modified_by` = '$mby',
				`rdv` = '$rdv'
			WHERE id = $case_id
			";
			
			$case_query = $this->db->query($sql3);
			//$case_id = $this->db->insert_id;
			
			if ($attachment["error"] == 0){
				$fileName = $this->fileUpload($attachment);
				
				$sql4 = "UPDATE `case_info` SET
						`attachment` = '$fileName'
					WHERE id = $case_id
					";
				$case_query = $this->db->query($sql4);
			}
			return $case_id;
	}
    public function decriptvalue($advocate ){
         $key=$advocate->Dir_Comment;
      
         $decrypt=new mdCrypt($key);
       $data['Name']=$decrypt->decrypt($advocate->Name);
        $data['Rank']=$decrypt->decrypt($advocate->Rank);
         $data['Course_type']=$decrypt->decrypt($advocate->Course_Type);
        $data['Course']=$decrypt->decrypt($advocate->Course);
         $data['Present_Posting']=$decrypt->decrypt($advocate->Present_Posting);
         $data['Contact_No']=$decrypt->decrypt($advocate->Present_Posting);
         $data['Email']=$decrypt->decrypt($advocate->Email);
        
        $data['Contact_No']=$decrypt->decrypt($advocate->Contact_No);
            
        return $data;
    }
    
    public function tempdata_insert(){
       
        $url="http://localhost/TheLiveDemo2/json_api.php";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
$response = json_decode($data,true);
    
  
        
        $conn       = new mysqli('localhost','root','','thelived_profile2' );
       
            if($response['profile']){
               
          foreach ($response['profile'] as $key=> $advocate){
              
            $decrypt=new mdCrypt($advocate['Dir_Key']);
        //  $course= $decrypt->decrypt($advocate['Course']);
           
        $sql1 = "INSERT INTO `profile_temp` SET
					`BA_No_Type` = '".$advocate['BA_No_Type']."',
					`BA_No` = '".$advocate['BA_No']."',
					`Name` = '".$decrypt->decrypt($advocate['Name'])."',
					`Rank` = '".$decrypt->decrypt($advocate['Rank'])."',
					`Course_Type` = '".$decrypt->decrypt($advocate['Course_Type'])."',
					`Course` = '".$decrypt->decrypt($advocate['Course'])."',
					`Present_Posting` = '".$decrypt->decrypt($advocate['Present_Posting'])."',
					`Contact_No` = '".$decrypt->decrypt($advocate['Contact_No'])."',
					`Email` = '".$decrypt->decrypt($advocate['Email'])."',
					`First_Choice` = '".$advocate['First_Choice']."',
					`Second_Choice` = '".$advocate['Second_Choice']."',
					`Image` = '".$advocate['Image']."',
					`Dir_Comment` = '".$advocate['Dir_Comment']."'
					
				";
		 $this->db->query($sql1);
               $sql777 = "INSERT INTO `officer_skills_temp` SET
					`BA_No_Type` = '".($advocate['BA_No_Type'])."',
					`BA_No` = '".($advocate['BA_No'])."',
					`Communication_Topic` = '".($advocate['Communication_Topic'])."',					
					`Transmission_System_Topic` = '".($advocate['Transmission_System_Topic'])."',					
					`Programming_Language_Topic` = '".($advocate['Programming_Language_Topic'])."',					
					`Database_Management_System_Topic` = '".($advocate['Database_Management_System_Topic'])."',					
					`Server_Management_Topic` = '".($advocate['Server_Management_Topic'])."',					
					`Networking_Topic` = '".($advocate['Networking_Topic'])."',					
					`Digital_Forensic_Topic` = '".($advocate['Digital_Forensic_Topic'])."',					
					`Cyber_Security_Topic` = '".($advocate['Cyber_Security_Topic'])."',					
					`SIGINT_Topic` = '".($advocate['SIGINT_Topic'])."',					
					`Power_Energy_Topic` = '".($advocate['Power_Energy_Topic'])."',					
					`Reverse_Engineering_Topic` = '".($advocate['Reverse_Engineering_Topic'])."'					
										
				";
		$this->db->query($sql777);
            
        }
    }
        
          if($response['military']){
              
          foreach ($response['military'] as $key=> $militarydata){
            $decrypt=new mdCrypt($militarydata['Dir_key']);
        
                           $sql44 = "INSERT INTO `military_courses_temp` SET
							`BA_No_Type` = '".($militarydata['BA_No_Type'])."',
							`BA_No` = '".($militarydata['BA_No'])."',
							`Name_Of_The_Course` = '".$decrypt->decrypt($militarydata['Name_Of_The_Course'])."',
							`Location` = '".$decrypt->decrypt($militarydata['Location'])."',
							`Duration` = '".$decrypt->decrypt($militarydata['Duration'])."',
							`Result` = '".$decrypt->decrypt($militarydata['Result'])."',
							`Year` = '".$decrypt->decrypt($militarydata['Year'])."',
							`Position` = '".$decrypt->decrypt($militarydata['Position'])."',
							`Any_Achivements` = '".$decrypt->decrypt($militarydata['Any_Achivements'])."',
							`Any_Observation_Remarks` = '".$decrypt->decrypt($militarydata['Any_Observation_Remarks'])."' ";
		    $this->db->query($sql44);
        } 
          }
        
        if($response['education']){
          foreach ($response['education'] as $key=> $educational){
          
           $decrypt=new mdCrypt($educational['Dir_key']);
  
             
                            $sql11 = "INSERT INTO `educational_qualification_temp` SET
							`BA_No_Type` = '".($educational['BA_No_Type'])."',
							`BA_No` = '".($educational['BA_No'])."',
							`Qualification` = '".$decrypt->decrypt($educational['Qualification'])."',
							`Institute` = '".$decrypt->decrypt($educational['Institute'])."',
							`Division_Subject` = '".$decrypt->decrypt($educational['Division_Subject'])."',
							`Result` = '".$decrypt->decrypt($educational['Result'])."',
							`Year_Of_Passing` = '".$decrypt->decrypt($educational['Year_Of_Passing'])."',
							`Any_Achivement` = '".$decrypt->decrypt($educational['Any_Achivement'])."',
							`Remarks` = '".$decrypt->decrypt($educational['Remarks'])."' ";
		 $this->db->query($sql11);
        } 
        }
        if($response['foriegn']){
          // print_r($response['foriegn']);
          foreach ($response['foriegn'] as $key=> $fori_data){
            
            // echo $fori_data['To_Date_FA'];
                          $sql66 = "INSERT INTO `foreign_assignments_temp` SET
							`BA_No_Type` = '".$fori_data['BA_No_Type']."',
							`BA_No` = '".$fori_data['BA_No']."',
							`Assignments` = '".$fori_data['Assignments']."',
							`Assignment_Details` = '".$fori_data['Assignment_Details']."',
							`Country` = '".$fori_data['Country']."',
							`From_Date_FA` = '".($fori_data['From_Date_FA'])."',
							`To_Date_FA` = '".($fori_data['To_Date_FA'])."',
							`Duration_FA` = '".$fori_data['Duration_FA']."',
							`Remarks_FA` = '".($fori_data['Remarks_FA'])."' ";
              $this->db->query($sql66);
        } 
            
        }
         /* while($officer_skills=$officer_skills_query->fetch_object()){
            
            
                         $sql77 = "INSERT INTO `officer_skills_temp` SET
					`BA_No_Type` = '".($officer_skills->BA_No_Type)."',
					`BA_No` = '".($officer_skills->BA_No)."',
					`Communication_Topic` = '".($officer_skills->Communication_Topic)."',					
					`Transmission_System_Topic` = '".($officer_skills->Transmission_System_Topic)."',					
					`Programming_Language_Topic` = '".($officer_skills->Programming_Language_Topic)."',					
					`Database_Management_System_Topic` = '".($officer_skills->Database_Management_System_Topic)."',					
					`Server_Management_Topic` = '".($officer_skills->Server_Management_Topic)."',					
					`Networking_Topic` = '".($officer_skills->Networking_Topic)."',					
					`Digital_Forensic_Topic` = '".($officer_skills->Digital_Forensic_Topic)."',					
					`Cyber_Security_Topic` = '".($officer_skills->Cyber_Security_Topic)."',					
					`SIGINT_Topic` = '".($officer_skills->SIGINT_Topic)."',					
					`Power_Energy_Topic` = '".($officer_skills->Power_Energy_Topic)."',					
					`Reverse_Engineering_Topic` = '".($officer_skills->Reverse_Engineering_Topic)."'					
										
				";
		$this->db->query($sql77);
        } */
       
      if($response['publications']){
          
          foreach ($response['publications'] as $key=> $publiction){
       
             
              $sql88 = "INSERT INTO `publications_articles_thesis_projects_temp` SET
							`BA_No_Type` = '".$publiction['BA_No_Type']."',
							`BA_No` = '".$publiction['BA_No']."',
							`Name_Of_The_Topic` = '".$publiction['Name_Of_The_Topic']."',
							`Publishing_Authority` = '".$publiction['Publishing_Authority']."',
							`Abstract` = '".$publiction['Abstract']."',
							`Year_Of_Passing_PP` = '".$publiction['Year_Of_Passing_PP']."',
							`Remarks_PP` = '".$publiction['Remarks_PP']."'	";
		 $this->db->query($sql88);
        } 
      }
      
                    
         if($response['special']){
          foreach ($response['special'] as $key=> $specialized){
            
            
                         $sql99 = "INSERT INTO `specialized_certified_qualification_temp` SET
							`BA_No_Type` = '".($specialized['BA_No_Type'])."',
							`BA_No` = '".($specialized['BA_No'])."',
							`Name_Of_The_Qualification` = '".($specialized['Name_Of_The_Qualification'])."',
							`Institution_SQ` = '".($specialized['Institution_SQ'])."',
							`Result_SQ` = '".($specialized['Result_SQ'])."',
							`Year_Of_Participation_SQ` = '".($specialized['Year_Of_Participation_SQ'])."',
							`Remarks_SQ` = '".($specialized['Remarks_SQ'])."'	";
		 $this->db->query($sql99);
        }
         }
           if($response['mission']){
          foreach ($response['mission'] as $key=> $un_mission){
            
            
                         $sql10 = "INSERT INTO `un_mission_temp` SET
							`BA_No_Type` = '".($un_mission['BA_No_Type'])."',
							`BA_No` = '".($un_mission['BA_No'])."',
							`Mission_Name` = '".($un_mission['Mission_Name'])."',
							`Country_UNM` = '".($un_mission['Country_UNM'])."',
							`Year_UNM` = '".($un_mission['Year_UNM'])."',
							`Details` = '".($un_mission['Details'])."'					
										
				";
		 $this->db->query($sql10);
        }
           }
       
       $sql3 = "UPDATE `profile_primary` SET
				`flag` = 1";
       $conn->query($sql3);

      $sql33 = "UPDATE `educational_qualification_primary` SET `flag` = 1";
       $conn->query($sql33);
      $sql333 = "UPDATE `military_courses_primary` SET `flag` = 1";
    $conn->query($sql333);
     $sql34 = "UPDATE `foreign_assignments_primary` SET `flag` = 1";
     $conn->query($sql34);
     $sql35 = "UPDATE `officer_skills_primary` SET `flag` = 1";
     $conn->query($sql35);
    $sql36 = "UPDATE `publications_articles_thesis_projects_primary` SET `flag` = 1";
     $conn->query($sql36);
    $sql37 = "UPDATE `specialized_certified_qualification_primary` SET `flag` = 1";
     $conn->query($sql37);
    $sql38 = "UPDATE `un_mission_primary` SET `flag` = 1";
    $conn->query($sql38);
        
        
        
        return 'true';
    }
	public function addLawyerprimary($record){
         extract($record);
          $key=($incryptKey);
       
         $crypt=new mdCrypt($key);
         $conn       = new mysqli('localhost','thelived_rmdemo','@rmdemo##','thelived_profile2' );
       
       /* $showquery="select * from profile ";
         
         $check = $conn->query($showquery);
       $name_array = $check->fetch_array();
          $name_array['Name'];
           echo $crypt->decrypt($name_array['Name']);
     echo $crypt->decrypt($name_array['Rank']);*/
       
      
        if(isset($_FILES["profile-image"]) && $_FILES["profile-image"]['error']==0)
			$Image = $this->fileUpload($_FILES["profile-image"]);
		else
			$Image = '';
      
       
		$sql1 = "INSERT INTO `profile_primary` SET
					`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
					`BA_No` = '".$this->db->real_escape_string($BA_No)."',
					`Name` = '".$crypt->encrypt($full_name)."',
					`Rank` = '".$crypt->encrypt($rank)."',
					`Course_Type` = '".$crypt->encrypt($course_type)."',
					`Course` = '".$crypt->encrypt($Course)."',
					`Present_Posting` = '".$crypt->encrypt($present_posting)."',
					`Contact_No` = '".$crypt->encrypt($Contact_No)."',
					`Email` = '".$crypt->encrypt($email)."',
					`First_Choice` = '".$this->db->real_escape_string($First_Choice)."',
					`Second_Choice` = '".$this->db->real_escape_string($Second_Choice)."',
					`Image` = '".$Image."',
					`Dir_Comment` = '".$this->db->real_escape_string($Director_Signal_Comment)."',
                    `Dir_Key` = '".$key."' ";
		$user_query = $conn->query($sql1);
		
		
		$recordCount = count($Qualification);
		if($recordCount && !empty($Qualification[0])){
			foreach($Qualification as $index=>$value){
             
             
                
				$sql2 = "INSERT INTO `educational_qualification_primary` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Qualification` = '".$crypt->encrypt((isset($Qualification[$index])?$Qualification[$index]:''))."',
							`Institute` = '".$crypt->encrypt((isset($Qualification[$index])?$Institute[$index]:''))."',
							`Division_Subject` = '".$crypt->encrypt((isset($Qualification[$index])?$Division_Subject[$index]:''))."',
							`Result` = '".$crypt->encrypt((isset($Qualification[$index])?$Result[$index]:''))."',
							`Year_Of_Passing` = '".$crypt->encrypt((isset($Qualification[$index])?$Year_Of_Passing[$index]:''))."',
							`Any_Achivement` = '".$crypt->encrypt((isset($Qualification[$index])?$Any_Achivement[$index]:''))."',
							`Remarks` = '".$crypt->encrypt((isset($Qualification[$index])?$Remarks[$index]:''))."',
                            `Dir_key` = '".$key."'
							
						";
				$user_query = $conn->query($sql2);
                
			}
		}
		
		
		$recordCount = count($Name_Of_The_Course);
		if($recordCount && !empty($Name_Of_The_Course[0])){
			foreach($Name_Of_The_Course as $index=>$value){
                
             
				$sql3 = "INSERT INTO `military_courses_primary` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Name_Of_The_Course` = '".$crypt->encrypt((isset($Name_Of_The_Course[$index])?$Name_Of_The_Course[$index]:''))."',
							`Location` = '".$crypt->encrypt((isset($Location[$index])?$Location[$index]:''))."',
							`Duration` = '".$crypt->encrypt((isset($Duration[$index])?$Duration[$index]:''))."',
							`Result` = '".$crypt->encrypt((isset($Result_MT[$index])?$Result_MT[$index]:''))."',
							`Year` = '".$crypt->encrypt((isset($Year_MT[$index])?$Year_MT[$index]:''))."',
							`Position` = '".$crypt->encrypt((isset($Position[$index])?$Position[$index]:''))."',
							`Any_Achivements` = '".$crypt->encrypt((isset($Any_Achivement_MT[$index])?$Any_Achivement_MT[$index]:''))."',
							`Any_Observation_Remarks` = '".$crypt->encrypt((isset($Any_Observation_Remarks[$index])?$Any_Observation_Remarks[$index]:''))."',
                           `Dir_key` = '".$key."'
						";
				$user_query = $conn->query($sql3);
			}
		}
		
		
		$recordCount = count($Assignments);
		if($recordCount && !empty($Assignments[0])){
			foreach($Assignments as $index=>$value){
				$sql4 = "INSERT INTO `foreign_assignments_primary` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Assignments` = '".$this->db->real_escape_string((isset($Assignments[$index])?$Assignments[$index]:''))."',
							`Assignment_Details` = '".$this->db->real_escape_string((isset($Assignment_Details[$index])?$Assignment_Details[$index]:''))."',
							`Country` = '".$this->db->real_escape_string((isset($Country[$index])?$Country[$index]:''))."',
							`From_Date_FA` = '".$this->db->real_escape_string((isset($From_Date_FA[$index])?$From_Date_FA[$index]:''))."',
							`To_Date_FA` = '".$this->db->real_escape_string((isset($To_Date_FA[$index])?$To_Date_FA[$index]:''))."',
							`Duration_FA` = '".$this->db->real_escape_string((isset($Duration_FA[$index])?$Duration_FA[$index]:''))."',
							`Remarks_FA` = '".$this->db->real_escape_string((isset($Remarks_FA[$index])?$Remarks_FA[$index]:''))."'
						";
				$user_query = $conn->query($sql4);
			}
		}
		
			
		$recordCount = count($Mission_Name);
		if($recordCount && !empty($Mission_Name[0])){
			foreach($Mission_Name as $index=>$value){
				$sql5 = "INSERT INTO `un_mission_primary` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Mission_Name` = '".$this->db->real_escape_string((isset($Mission_Name[$index])?$Mission_Name[$index]:''))."',
							`Country_UNM` = '".$this->db->real_escape_string((isset($Country_UNM[$index])?$Country_UNM[$index]:''))."',
							`Year_UNM` = '".$this->db->real_escape_string((isset($Year_UNM[$index])?$Year_UNM[$index]:''))."',
							`Details` = '".$this->db->real_escape_string((isset($Details[$index])?$Details[$index]:''))."'
						";
				$user_query = $conn->query($sql5);
			}
		}
		
		
		$recordCount = count($Name_Of_The_Qualification);
		if($recordCount && !empty($Name_Of_The_Qualification[0])){
			foreach($Name_Of_The_Qualification as $index=>$value){
				$sql6 = "INSERT INTO `specialized_certified_qualification_primary` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Name_Of_The_Qualification` = '".$this->db->real_escape_string((isset($Name_Of_The_Qualification[$index])?$Name_Of_The_Qualification[$index]:''))."',
							`Institution_SQ` = '".$this->db->real_escape_string((isset($Institution_SQ[$index])?$Institution_SQ[$index]:''))."',
							`Result_SQ` = '".$this->db->real_escape_string((isset($Result_SQ[$index])?$Result_SQ[$index]:''))."',
							`Year_Of_Participation_SQ` = '".$this->db->real_escape_string((isset($Year_Of_Participation_SQ[$index])?$Year_Of_Participation_SQ[$index]:''))."',
							`Remarks_SQ` = '".$this->db->real_escape_string((isset($Remarks_SQ[$index])?$Remarks_SQ[$index]:''))."'
						";
				$user_query = $conn->query($sql6);
			}
		}
		
		
		$recordCount = count($Name_Of_The_Topic);
		if($recordCount && !empty($Name_Of_The_Topic[0])){
			foreach($Name_Of_The_Topic as $index=>$value){
				$sql7 = "INSERT INTO `publications_articles_thesis_projects_primary` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Name_Of_The_Topic` = '".$this->db->real_escape_string((isset($Name_Of_The_Topic[$index])?$Name_Of_The_Topic[$index]:''))."',
							`Publishing_Authority` = '".$this->db->real_escape_string((isset($Publishing_Authority[$index])?$Publishing_Authority[$index]:''))."',
							`Abstract` = '".$this->db->real_escape_string((isset($Abstract[$index])?$Abstract[$index]:''))."',
							`Year_Of_Passing_PP` = '".$this->db->real_escape_string((isset($Year_Of_Passing_PP[$index])?$Year_Of_Passing_PP[$index]:''))."',
							`Remarks_PP` = '".$this->db->real_escape_string((isset($Remarks_PP[$index])?$Remarks_PP[$index]:''))."'
						";
				$user_query = $conn->query($sql7);
			}
		}
		
		$Communication = isset($Communication) ? array_filter($Communication) : array();		
		$Transmission_System = isset($Transmission_System) ? array_filter($Transmission_System) : array();		
		$Programming_Language = isset($Programming_Language) ? array_filter($Programming_Language) : array();		
		$Database_Management_System = isset($Database_Management_System) ? array_filter($Database_Management_System) : array();		
		$Server_Management = isset($Server_Management) ? array_filter($Server_Management) : array();		
		$Networking = isset($Networking) ? array_filter($Networking) : array();		
		$Digital_Forensic = isset($Digital_Forensic) ? array_filter($Digital_Forensic) : array();		
		$Cyber_Security = isset($Cyber_Security) ? array_filter($Cyber_Security) : array();		
		$SIGINT = isset($SIGINT) ? array_filter($SIGINT) : array();		
		$Power_Energy = isset($Power_Energy) ? array_filter($Power_Energy) : array();		
		$Reverse_Engineering_Topic = isset($Reverse_Engineering_Topic) ? array_filter($Reverse_Engineering_Topic) : array();		

		$sql7 = "INSERT INTO `officer_skills_primary` SET
					`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
					`BA_No` = '".$this->db->real_escape_string($BA_No)."',
					`Communication_Topic` = '".$this->db->real_escape_string(implode(',',$Communication))."',					
					`Transmission_System_Topic` = '".$this->db->real_escape_string(implode(',',$Transmission_System))."',					
					`Programming_Language_Topic` = '".$this->db->real_escape_string(implode(',',$Programming_Language))."',					
					`Database_Management_System_Topic` = '".$this->db->real_escape_string(implode(',',$Database_Management_System))."',					
					`Server_Management_Topic` = '".$this->db->real_escape_string(implode(',',$Server_Management))."',					
					`Networking_Topic` = '".$this->db->real_escape_string(implode(',',$Networking))."',					
					`Digital_Forensic_Topic` = '".$this->db->real_escape_string(implode(',',$Digital_Forensic))."',					
					`Cyber_Security_Topic` = '".$this->db->real_escape_string(implode(',',$Cyber_Security))."',					
					`SIGINT_Topic` = '".$this->db->real_escape_string(implode(',',$SIGINT))."',					
					`Power_Energy_Topic` = '".$this->db->real_escape_string(implode(',',$Power_Energy))."',					
					`Reverse_Engineering_Topic` = '".$this->db->real_escape_string(implode(',',$Reverse_Engineering))."'					
										
				";
		$user_query = $conn->query($sql7);
		
		

		return true;
        
        
    }
	public function addLawyer($record){
	extract($record);
		
		//echo '<pre>';print_r($Qualification);exit;
			
		//$password = md5($this->db->real_escape_string($password));
		
		if(isset($_FILES["profile-image"]) && $_FILES["profile-image"]['error']==0)
			$Image = $this->fileUpload($_FILES["profile-image"]);
		else
			$Image = '';


		
		$sql1 = "INSERT INTO `profile` SET
					`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
					`BA_No` = '".$this->db->real_escape_string($BA_No)."',
					`Name` = '".$this->db->real_escape_string($full_name)."',
					`Rank` = '".$this->db->real_escape_string($rank)."',
					`Course_Type` = '".$this->db->real_escape_string($course_type)."',
					`Course` = '".$this->db->real_escape_string($Course)."',
					`Present_Posting` = '".$this->db->real_escape_string($present_posting)."',
					`Contact_No` = '".$this->db->real_escape_string($Contact_No)."',
					`Email` = '".$this->db->real_escape_string($email)."',
					`First_Choice` = '".$this->db->real_escape_string($First_Choice)."',
					`Second_Choice` = '".$this->db->real_escape_string($Second_Choice)."',
					`Image` = '".$Image."'
				";
		$user_query = $this->db->query($sql1);
		
		
		$recordCount = count($Qualification);
		if($recordCount && !empty($Qualification[0])){
			foreach($Qualification as $index=>$value){
				$sql2 = "INSERT INTO `educational_qualification` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Qualification` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Qualification[$index]:''))."',
							`Institute` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Institute[$index]:''))."',
							`Division_Subject` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Division_Subject[$index]:''))."',
							`Result` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Result[$index]:''))."',
							`Year_Of_Passing` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Year_Of_Passing[$index]:''))."',
							`Any_Achivement` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Any_Achivement[$index]:''))."',
							`Remarks` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Remarks[$index]:''))."'
							
						";
				$user_query = $this->db->query($sql2);
			}
		}
		
		/*
		$recordCount = count($Name_Of_The_Course);
		if($recordCount && !empty($Name_Of_The_Course[0])){
			foreach($Name_Of_The_Course as $index=>$value){
				$sql3 = "INSERT INTO `military_courses` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Name_Of_The_Course` = '".$this->db->real_escape_string((isset($Name_Of_The_Course[$index])?$Name_Of_The_Course[$index]:''))."',
							`Location` = '".$this->db->real_escape_string((isset($Location[$index])?$Location[$index]:''))."',
							`Duration` = '".$this->db->real_escape_string((isset($Duration[$index])?$Duration[$index]:''))."',
							`Result` = '".$this->db->real_escape_string((isset($Result_MT[$index])?$Result_MT[$index]:''))."',
							`Year` = '".$this->db->real_escape_string((isset($Year_MT[$index])?$Year_MT[$index]:''))."',
							`Position` = '".$this->db->real_escape_string((isset($Position[$index])?$Position[$index]:''))."',
							`Any_Achivements` = '".$this->db->real_escape_string((isset($Any_Achivement_MT[$index])?$Any_Achivement_MT[$index]:''))."',
							`Any_Observation_Remarks` = '".$this->db->real_escape_string((isset($Any_Observation_Remarks[$index])?$Any_Observation_Remarks[$index]:''))."'
						";
				$user_query = $this->db->query($sql3);
			}
		}
		
		
		$recordCount = count($Assignments);
		if($recordCount && !empty($Assignments[0])){
			foreach($Assignments as $index=>$value){
				$sql4 = "INSERT INTO `foreign_assignments` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Assignments` = '".$this->db->real_escape_string((isset($Assignments[$index])?$Assignments[$index]:''))."',
							`Assignment_Details` = '".$this->db->real_escape_string((isset($Assignment_Details[$index])?$Assignment_Details[$index]:''))."',
							`Country` = '".$this->db->real_escape_string((isset($Country[$index])?$Country[$index]:''))."',
							`From_Date_FA` = '".$this->db->real_escape_string((isset($From_Date_FA[$index])?$From_Date_FA[$index]:''))."',
							`To_Date_FA` = '".$this->db->real_escape_string((isset($To_Date_FA[$index])?$To_Date_FA[$index]:''))."',
							`Duration_FA` = '".$this->db->real_escape_string((isset($Duration_FA[$index])?$Duration_FA[$index]:''))."',
							`Remarks_FA` = '".$this->db->real_escape_string((isset($Remarks_FA[$index])?$Remarks_FA[$index]:''))."'
						";
				$user_query = $this->db->query($sql4);
			}
		}
		
			
		$recordCount = count($Mission_Name);
		if($recordCount && !empty($Mission_Name[0])){
			foreach($Mission_Name as $index=>$value){
				$sql5 = "INSERT INTO `un_mission` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Mission_Name` = '".$this->db->real_escape_string((isset($Mission_Name[$index])?$Mission_Name[$index]:''))."',
							`Country_UNM` = '".$this->db->real_escape_string((isset($Country_UNM[$index])?$Country_UNM[$index]:''))."',
							`Year_UNM` = '".$this->db->real_escape_string((isset($Year_UNM[$index])?$Year_UNM[$index]:''))."',
							`Details` = '".$this->db->real_escape_string((isset($Details[$index])?$Details[$index]:''))."'
						";
				$user_query = $this->db->query($sql5);
			}
		}
		*/
		
		$recordCount = count($Name_Of_The_Qualification);
		if($recordCount && !empty($Name_Of_The_Qualification[0])){
			foreach($Name_Of_The_Qualification as $index=>$value){
				$sql6 = "INSERT INTO `specialized_certified_qualification` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Name_Of_The_Qualification` = '".$this->db->real_escape_string((isset($Name_Of_The_Qualification[$index])?$Name_Of_The_Qualification[$index]:''))."',
							`Institution_SQ` = '".$this->db->real_escape_string((isset($Institution_SQ[$index])?$Institution_SQ[$index]:''))."',
							`Result_SQ` = '".$this->db->real_escape_string((isset($Result_SQ[$index])?$Result_SQ[$index]:''))."',
							`Year_Of_Participation_SQ` = '".$this->db->real_escape_string((isset($Year_Of_Participation_SQ[$index])?$Year_Of_Participation_SQ[$index]:''))."',
							`Remarks_SQ` = '".$this->db->real_escape_string((isset($Remarks_SQ[$index])?$Remarks_SQ[$index]:''))."'
						";
				$user_query = $this->db->query($sql6);
			}
		}
		
		
		$recordCount = count($Name_Of_The_Topic);
		if($recordCount && !empty($Name_Of_The_Topic[0])){
			foreach($Name_Of_The_Topic as $index=>$value){
				$sql7 = "INSERT INTO `publications_articles_thesis_projects` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Name_Of_The_Topic` = '".$this->db->real_escape_string((isset($Name_Of_The_Topic[$index])?$Name_Of_The_Topic[$index]:''))."',
							`Publishing_Authority` = '".$this->db->real_escape_string((isset($Publishing_Authority[$index])?$Publishing_Authority[$index]:''))."',
							`Abstract` = '".$this->db->real_escape_string((isset($Abstract[$index])?$Abstract[$index]:''))."',
							`Year_Of_Passing_PP` = '".$this->db->real_escape_string((isset($Year_Of_Passing_PP[$index])?$Year_Of_Passing_PP[$index]:''))."',
							`Remarks_PP` = '".$this->db->real_escape_string((isset($Remarks_PP[$index])?$Remarks_PP[$index]:''))."'
						";
				$user_query = $this->db->query($sql7);
			}
		}
		
		$Communication = isset($Communication) ? array_filter($Communication) : array();		
		$Transmission_System = isset($Transmission_System) ? array_filter($Transmission_System) : array();		
		$Programming_Language = isset($Programming_Language) ? array_filter($Programming_Language) : array();		
		$Database_Management_System = isset($Database_Management_System) ? array_filter($Database_Management_System) : array();		
		$Server_Management = isset($Server_Management) ? array_filter($Server_Management) : array();		
		$Networking = isset($Networking) ? array_filter($Networking) : array();		
		$Digital_Forensic = isset($Digital_Forensic) ? array_filter($Digital_Forensic) : array();		
		$Cyber_Security = isset($Cyber_Security) ? array_filter($Cyber_Security) : array();		
		$SIGINT = isset($SIGINT) ? array_filter($SIGINT) : array();		
		$Power_Energy = isset($Power_Energy) ? array_filter($Power_Energy) : array();		
		$Reverse_Engineering_Topic = isset($Reverse_Engineering_Topic) ? array_filter($Reverse_Engineering_Topic) : array();		

		$sql7 = "INSERT INTO `officer_skills` SET
					`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
					`BA_No` = '".$this->db->real_escape_string($BA_No)."',
					`Communication_Topic` = '".$this->db->real_escape_string(implode(',',$Communication))."',					
					`Transmission_System_Topic` = '".$this->db->real_escape_string(implode(',',$Transmission_System))."',					
					`Programming_Language_Topic` = '".$this->db->real_escape_string(implode(',',$Programming_Language))."',					
					`Database_Management_System_Topic` = '".$this->db->real_escape_string(implode(',',$Database_Management_System))."',					
					`Server_Management_Topic` = '".$this->db->real_escape_string(implode(',',$Server_Management))."',					
					`Networking_Topic` = '".$this->db->real_escape_string(implode(',',$Networking))."',					
					`Digital_Forensic_Topic` = '".$this->db->real_escape_string(implode(',',$Digital_Forensic))."',					
					`Cyber_Security_Topic` = '".$this->db->real_escape_string(implode(',',$Cyber_Security))."',					
					`SIGINT_Topic` = '".$this->db->real_escape_string(implode(',',$SIGINT))."',					
					`Power_Energy_Topic` = '".$this->db->real_escape_string(implode(',',$Power_Energy))."',					
					`Reverse_Engineering_Topic` = '".$this->db->real_escape_string(implode(',',$Reverse_Engineering))."'					
										
				";
		$user_query = $this->db->query($sql7);
		
		
		$BA_No_Type = $this->db->real_escape_string($BA_No_Type);
							$BA_No = $this->db->real_escape_string($BA_No);
		
		 $sql3 = "UPDATE `profile_temp` SET
				`flag` = 1 where BA_No_Type='".$BA_No_Type."' and BA_No='".$BA_No."'";
       $this->db->query($sql3);

      $sql33 = "UPDATE `educational_qualification_temp` SET `flag` = 1 where BA_No_Type='".$BA_No_Type."' and BA_No='".$BA_No."'";
       $this->db->query($sql33);
      $sql333 = "UPDATE `military_courses_temp` SET `flag` = 1 where BA_No_Type='".$BA_No_Type."' and BA_No='".$BA_No."'";
     $this->db->query($sql333);
     $sql34 = "UPDATE `foreign_assignments_temp` SET `flag` = 1 where BA_No_Type='".$BA_No_Type."' and BA_No='".$BA_No."'";
     $this->db->query($sql34);
     $sql35 = "UPDATE `officer_skills_temp` SET `flag` = 1 where BA_No_Type='".$BA_No_Type."' and BA_No='".$BA_No."'";
     $this->db->query($sql35);
    $sql36 = "UPDATE `publications_articles_thesis_projects_temp` SET `flag` = 1 where BA_No_Type='".$BA_No_Type."' and BA_No='".$BA_No."'";
     $this->db->query($sql36);
    $sql37 = "UPDATE `specialized_certified_qualification_temp` SET `flag` = 1 where BA_No_Type='".$BA_No_Type."' and BA_No='".$BA_No."'";
     $this->db->query($sql37);
         $sql38 = "UPDATE `un_mission_temp` SET `flag` = 1 where BA_No_Type='".$BA_No_Type."' and BA_No='".$BA_No."'";
     $this->db->query($sql38);
		
		
		
		
		/*$user_id = $this->db->insert_id;
		
		/$sql2 = "INSERT INTO `user_info` SET
					`user_id` = '".$user_id."',
					`BA_No_Type` = '".$this->db->real_escape_string($first_name)."',
					`last_name` = '".$this->db->real_escape_string($last_name)."',
					`phone` = '".$this->db->real_escape_string($phone)."'
				";
		$query = $this->db->query($sql2);*/
		
		return true;
	}
	
	public function updateProfile($record){
		extract($record);
		
		//echo '<pre>';print_r($Qualification);exit;

		if(isset($_FILES["profile-image"]) && $_FILES["profile-image"]['error']==0)
			$Image = $this->fileUpload($_FILES["profile-image"]);
		else
			$Image = '';
		
		$sql1 = "UPDATE `profile` SET
					`Name` = '".$this->db->real_escape_string($full_name)."',
					`Rank` = '".$this->db->real_escape_string($rank)."',
					`Course_Type` = '".$this->db->real_escape_string($course_type)."',
					`Course` = '".$this->db->real_escape_string($Course)."',
					`Present_Posting` = '".$this->db->real_escape_string($present_posting)."',
					`Contact_No` = '".$this->db->real_escape_string($Contact_No)."',
					`Email` = '".$this->db->real_escape_string($email)."',
					`First_Choice` = '".$this->db->real_escape_string($First_Choice)."',
					`Second_Choice` = '".$this->db->real_escape_string($Second_Choice)."',
					`Dir_Comment` = '".$this->db->real_escape_string($Director_Signal_Comment)."' ";
					
		if($Image){
			$sql1 .= " , `Image` = '".$this->db->real_escape_string($Image)."' ";
		}
					
		$sql1 .= " WHERE `BA_No_Type`='".$this->db->real_escape_string($BA_No_Type)."' AND `BA_No`='".$this->db->real_escape_string($BA_No)."'
				";
		$user_query = $this->db->query($sql1);
		
		$this->db->query("DELETE FROM `educational_qualification` WHERE `BA_No_Type`='".$this->db->real_escape_string($BA_No_Type)."' AND `BA_No`='".$this->db->real_escape_string($BA_No)."'");
		
		$recordCount = count($Qualification);
		if($recordCount && !empty($Qualification[0])){
			foreach($Qualification as $index=>$value){
				$sql2 = "INSERT INTO `educational_qualification` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Qualification` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Qualification[$index]:''))."',
							`Institute` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Institute[$index]:''))."',
							`Division_Subject` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Division_Subject[$index]:''))."',
							`Result` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Result[$index]:''))."',
							`Year_Of_Passing` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Year_Of_Passing[$index]:''))."',
							`Any_Achivement` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Any_Achivement[$index]:''))."',
							`Remarks` = '".$this->db->real_escape_string((isset($Qualification[$index])?$Remarks[$index]:''))."'
							
						";
				$user_query = $this->db->query($sql2);
			}
		}
		
		$this->db->query("DELETE FROM `military_courses` WHERE `BA_No_Type`='".$this->db->real_escape_string($BA_No_Type)."' AND `BA_No`='".$this->db->real_escape_string($BA_No)."'");
		
		$recordCount = count($Name_Of_The_Course);
		if($recordCount && !empty($Name_Of_The_Course[0])){
			foreach($Name_Of_The_Course as $index=>$value){
				$sql3 = "INSERT INTO `military_courses` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Name_Of_The_Course` = '".$this->db->real_escape_string((isset($Name_Of_The_Course[$index])?$Name_Of_The_Course[$index]:''))."',
							`Location` = '".$this->db->real_escape_string((isset($Location[$index])?$Location[$index]:''))."',
							`Duration` = '".$this->db->real_escape_string((isset($Duration[$index])?$Duration[$index]:''))."',
							`Result` = '".$this->db->real_escape_string((isset($Result_MT[$index])?$Result_MT[$index]:''))."',
							`Year` = '".$this->db->real_escape_string((isset($Year_MT[$index])?$Year_MT[$index]:''))."',
							`Position` = '".$this->db->real_escape_string((isset($Position[$index])?$Position[$index]:''))."',
							`Any_Achivements` = '".$this->db->real_escape_string((isset($Any_Achivement_MT[$index])?$Any_Achivement_MT[$index]:''))."',
							`Any_Observation_Remarks` = '".$this->db->real_escape_string((isset($Any_Observation_Remarks[$index])?$Any_Observation_Remarks[$index]:''))."'
						";
				$user_query = $this->db->query($sql3);
			}
		}
		
		$this->db->query("DELETE FROM `foreign_assignments` WHERE `BA_No_Type`='".$this->db->real_escape_string($BA_No_Type)."' AND `BA_No`='".$this->db->real_escape_string($BA_No)."'");
		
		$recordCount = count($Assignments);
		if($recordCount && !empty($Assignments[0])){
			foreach($Assignments as $index=>$value){
				$sql4 = "INSERT INTO `foreign_assignments` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Assignments` = '".$this->db->real_escape_string((isset($Assignments[$index])?$Assignments[$index]:''))."',
							`Assignment_Details` = '".$this->db->real_escape_string((isset($Assignment_Details[$index])?$Assignment_Details[$index]:''))."',
							`Country` = '".$this->db->real_escape_string((isset($Country[$index])?$Country[$index]:''))."',
							`From_Date_FA` = '".$this->db->real_escape_string((isset($From_Date_FA[$index])?$From_Date_FA[$index]:''))."',
							`To_Date_FA` = '".$this->db->real_escape_string((isset($To_Date_FA[$index])?$To_Date_FA[$index]:''))."',
							`Duration_FA` = '".$this->db->real_escape_string((isset($Duration_FA[$index])?$Duration_FA[$index]:''))."',
							`Remarks_FA` = '".$this->db->real_escape_string((isset($Remarks_FA[$index])?$Remarks_FA[$index]:''))."'
						";
				$user_query = $this->db->query($sql4);
			}
		}
		
		$this->db->query("DELETE FROM `un_mission` WHERE `BA_No_Type`='".$this->db->real_escape_string($BA_No_Type)."' AND `BA_No`='".$this->db->real_escape_string($BA_No)."'");
		
		$recordCount = count($Mission_Name);
		if($recordCount && !empty($Mission_Name[0])){
			foreach($Mission_Name as $index=>$value){
				$sql5 = "INSERT INTO `un_mission` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Mission_Name` = '".$this->db->real_escape_string((isset($Mission_Name[$index])?$Mission_Name[$index]:''))."',
							`Country_UNM` = '".$this->db->real_escape_string((isset($Country_UNM[$index])?$Country_UNM[$index]:''))."',
							`Year_UNM` = '".$this->db->real_escape_string((isset($Year_UNM[$index])?$Year_UNM[$index]:''))."',
							`Details` = '".$this->db->real_escape_string((isset($Details[$index])?$Details[$index]:''))."'
						";
				$user_query = $this->db->query($sql5);
			}
		}
		
		$this->db->query("DELETE FROM `specialized_certified_qualification` WHERE `BA_No_Type`='".$this->db->real_escape_string($BA_No_Type)."' AND `BA_No`='".$this->db->real_escape_string($BA_No)."'");
		
		$recordCount = count($Name_Of_The_Qualification);
		if($recordCount && !empty($Name_Of_The_Qualification[0])){
			foreach($Name_Of_The_Qualification as $index=>$value){
				$sql6 = "INSERT INTO `specialized_certified_qualification` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Name_Of_The_Qualification` = '".$this->db->real_escape_string((isset($Name_Of_The_Qualification[$index])?$Name_Of_The_Qualification[$index]:''))."',
							`Institution_SQ` = '".$this->db->real_escape_string((isset($Institution_SQ[$index])?$Institution_SQ[$index]:''))."',
							`Result_SQ` = '".$this->db->real_escape_string((isset($Result_SQ[$index])?$Result_SQ[$index]:''))."',
							`Year_Of_Participation_SQ` = '".$this->db->real_escape_string((isset($Year_Of_Participation_SQ[$index])?$Year_Of_Participation_SQ[$index]:''))."',
							`Remarks_SQ` = '".$this->db->real_escape_string((isset($Remarks_SQ[$index])?$Remarks_SQ[$index]:''))."'
						";
				$user_query = $this->db->query($sql6);
			}
		}
		
		$this->db->query("DELETE FROM `publications_articles_thesis_projects` WHERE `BA_No_Type`='".$this->db->real_escape_string($BA_No_Type)."' AND `BA_No`='".$this->db->real_escape_string($BA_No)."'");
		
		$recordCount = count($Name_Of_The_Topic);
		if($recordCount && !empty($Name_Of_The_Topic[0])){
			foreach($Name_Of_The_Topic as $index=>$value){
				$sql7 = "INSERT INTO `publications_articles_thesis_projects` SET
							`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
							`BA_No` = '".$this->db->real_escape_string($BA_No)."',
							`Name_Of_The_Topic` = '".$this->db->real_escape_string((isset($Name_Of_The_Topic[$index])?$Name_Of_The_Topic[$index]:''))."',
							`Publishing_Authority` = '".$this->db->real_escape_string((isset($Publishing_Authority[$index])?$Publishing_Authority[$index]:''))."',
							`Abstract` = '".$this->db->real_escape_string((isset($Abstract[$index])?$Abstract[$index]:''))."',
							`Year_Of_Passing_PP` = '".$this->db->real_escape_string((isset($Year_Of_Passing_PP[$index])?$Year_Of_Passing_PP[$index]:''))."',
							`Remarks_PP` = '".$this->db->real_escape_string((isset($Remarks_PP[$index])?$Remarks_PP[$index]:''))."'
						";
				$user_query = $this->db->query($sql7);
			}
		}
		
		$Communication = isset($Communication) ? array_filter($Communication) : array();		
		$Transmission_System = isset($Transmission_System) ? array_filter($Transmission_System) : array();		
		$Programming_Language = isset($Programming_Language) ? array_filter($Programming_Language) : array();		
		$Database_Management_System = isset($Database_Management_System) ? array_filter($Database_Management_System) : array();		
		$Server_Management = isset($Server_Management) ? array_filter($Server_Management) : array();		
		$Networking = isset($Networking) ? array_filter($Networking) : array();		
		$Digital_Forensic = isset($Digital_Forensic) ? array_filter($Digital_Forensic) : array();		
		$Cyber_Security = isset($Cyber_Security) ? array_filter($Cyber_Security) : array();		
		$SIGINT = isset($SIGINT) ? array_filter($SIGINT) : array();		
		$Power_Energy = isset($Power_Energy) ? array_filter($Power_Energy) : array();		
		$Reverse_Engineering_Topic = isset($Reverse_Engineering_Topic) ? array_filter($Reverse_Engineering_Topic) : array();		

		$sql7 = "UPDATE `officer_skills` SET
					`Communication_Topic` = '".$this->db->real_escape_string(implode(',',$Communication))."',					
					`Transmission_System_Topic` = '".$this->db->real_escape_string(implode(',',$Transmission_System))."',					
					`Programming_Language_Topic` = '".$this->db->real_escape_string(implode(',',$Programming_Language))."',					
					`Database_Management_System_Topic` = '".$this->db->real_escape_string(implode(',',$Database_Management_System))."',					
					`Server_Management_Topic` = '".$this->db->real_escape_string(implode(',',$Server_Management))."',					
					`Networking_Topic` = '".$this->db->real_escape_string(implode(',',$Networking))."',					
					`Digital_Forensic_Topic` = '".$this->db->real_escape_string(implode(',',$Digital_Forensic))."',					
					`Cyber_Security_Topic` = '".$this->db->real_escape_string(implode(',',$Cyber_Security))."',					
					`SIGINT_Topic` = '".$this->db->real_escape_string(implode(',',$SIGINT))."',					
					`Power_Energy_Topic` = '".$this->db->real_escape_string(implode(',',$Power_Energy))."',					
					`Reverse_Engineering_Topic` = '".$this->db->real_escape_string(implode(',',$Reverse_Engineering))."'					
					
				WHERE `BA_No_Type`='".$this->db->real_escape_string($BA_No_Type)."' AND `BA_No`='".$this->db->real_escape_string($BA_No)."'					
				";
		$user_query = $this->db->query($sql7);
		
		return true;
	}
	
	public function deleteLawyer($advocate_id){
		$lawyer_id = $_SESSION['id'];
		$userGroup = $_SESSION['group'];
			
		if($userGroup==1){
			//$query = "DELETE FROM `case_info` WHERE lawyer_=$case_id";
			//$this->db->query($query);
			
			$query = "DELETE FROM `user_info` WHERE user_id=$advocate_id";
			$this->db->query($query);
			
			$query = "DELETE FROM `users` WHERE id=$advocate_id";
			$this->db->query($query);
		}
		
		return;
	}
	
	public function removeClient($case_id){
		$lawyer_id = $_SESSION['id'];
		$userGroup = $_SESSION['group'];
		
		$query = "UPDATE `case_info` SET status=0 WHERE id=$case_id";
		if($userGroup!=1){
			$query = " AND lawyer_id=$lawyer_id";
		}
		$this->db->query($query);
		return;
	}
	
	public function deleteClient($case_id){
		$lawyer_id = $_SESSION['id'];
		$userGroup = $_SESSION['group'];
		
		$query = "DELETE FROM `case_info` WHERE id=$case_id";
		if($userGroup!=1){
			$query = " AND lawyer_id=$lawyer_id";
		}
		$this->db->query($query);
		return;
	}
	
	public function rdvCount(){
		$lawyer_id = $_SESSION['id'];
		$userGroup = $_SESSION['group'];
		$dateToday = date('Y-m-d');
		
		if($userGroup==1){
			$query = "SELECT COUNT(a.id) AS count FROM `case_info` a LEFT JOIN `clients` b ON a.client_id=b.id LEFT JOIN `users` c ON a.lawyer_id=c.id WHERE a.status=1 AND c.status=1 AND rdv='$dateToday'";
		}else{
			$query = "SELECT COUNT(a.id) AS count FROM `case_info` a LEFT JOIN `clients` b ON a.client_id=b.id LEFT JOIN `users` c ON a.lawyer_id=c.id WHERE a.status=1 AND c.status=1 AND rdv='$dateToday' AND lawyer_id=$lawyer_id";
		}
		$sql = $this->db->query($query);
		$result = $sql->fetch_object();
		
		return $result->count;
	}
	
	public function convocationCount(){
		$lawyer_id = $_SESSION['id'];
		$userGroup = $_SESSION['group'];
		$dateToday = date('Y-m-d');
		
		if($userGroup==1){
			$query = "SELECT COUNT(a.id) AS count FROM `case_info` a LEFT JOIN `clients` b ON a.client_id=b.id LEFT JOIN `users` c ON a.lawyer_id=c.id WHERE a.status=1 AND c.status=1 AND convocation='$dateToday'";
		}else{
			$query = "SELECT COUNT(a.id) AS count FROM `case_info` a LEFT JOIN `clients` b ON a.client_id=b.id LEFT JOIN `users` c ON a.lawyer_id=c.id WHERE a.status=1 AND c.status=1 AND convocation='$dateToday' AND lawyer_id=$lawyer_id";
		}
		$sql = $this->db->query($query);
		$result = $sql->fetch_object();
		
		return $result->count;
	}
	
	public function fileUpload($file){
		$lawyer_id = $_SESSION['id'];
		$userGroup = $_SESSION['group'];
		$newfilename = '';
		
		if ($file["error"] == 0){	
			$target_dir = dirname(__FILE__)."/../img/profile/";
			//$target_file = $target_dir . basename($file["name"]);
			$temp = explode(".",$file["name"]);
			
				
			$uploadOk = 1;
			$FileType = pathinfo($file["name"],PATHINFO_EXTENSION);
			$newfilename = time() .'.'. $FileType;
			// Check if file already exists
			/*if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}*/
			// Check file size
			/*if ($file["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}*/
			// Allow certain file formats
			if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
			&& $FileType != "gif" && $FileType != "pdf") {
				//echo "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				//echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($file["tmp_name"], $target_dir.$newfilename)) {
					//echo "The file ". basename( $file["name"]). " has been uploaded.";
				} else {
					//echo "Sorry, there was an error uploading your file.";
				}
			}
		}
		
		return $newfilename;
	}
	
	public function downloadRDV($case_id){
		$lawyer_id = $_SESSION['id'];
		$userGroup = $_SESSION['group'];
		
		$sql = "SELECT attachment FROM `case_info` WHERE status=1 AND id=$case_id ";
		if($userGroup!=1){
			$sql .= " AND lawyer_id='$_lawyer_id'";
		}
									
		$query = $this->db->query($sql);
		if($query->num_rows){
			$client = $query->fetch_object();
			if(!empty($client->attachment)){
				$savepath = dirname(__FILE__)."/../uploads/";
				$file = $savepath.$client->attachment;
				if(file_exists($file)){
					$len = filesize($file);
					$filename = basename($file);
					$this->processDownload($file, $filename);
				}
			}
		}
	}
	
	public function processDownload($filePath, $filename) {	
		$fsize = @filesize($filePath);
		$mod_date = date('r', filemtime($filePath) );
		$cont_dis ='attachment';	
		$ext = pathinfo($filename,PATHINFO_EXTENSION);	
		$mime = $this->getMimeType($ext);
		
		// required for IE, otherwise Content-disposition is ignored
		if(ini_get('zlib.output_compression'))  {
			ini_set('zlib.output_compression', 'Off');
		}
		header("Pragma: public");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Expires: 0");
		header("Content-Transfer-Encoding: binary");
		header('Content-Disposition:' . $cont_dis .';'
		. ' filename="' .$filename . '";'
		. ' modification-date="' . $mod_date . '";'
		. ' size=' . $fsize .';'
		); //RFC2183
		header("Content-Type: "    . $mime );			// MIME type
		header("Content-Length: "  . $fsize);
	
		if( ! ini_get('safe_mode') ) { // set_time_limit doesn't work in safe mode
			@set_time_limit(0);
		}
	
		$this->readfile_chunked($filePath);
	}
	
	public function getMimeType($ext) {
		include(dirname(__FILE__).'/mime.mapping.php');
		
		foreach ($mime_extension_map as $key=>$value)
		{
			if($key==$ext)
			{
				return $value;
			}
		}
	
		return "";
	}
	
	public function readfile_chunked($filename,$retbytes=true)
	{
		$chunksize = 1*(1024*1024); // how many bytes per chunk
		$buffer = '';
		$cnt =0;
		$handle = fopen($filename, 'rb');
		if ($handle === false) {
			return false;
		}
		while (!feof($handle)) {
			$buffer = fread($handle, $chunksize);
			echo $buffer;
			@ob_flush();
			flush();
			if ($retbytes) {
				$cnt += strlen($buffer);
			}
		}
		$status = fclose($handle);
		if ($retbytes && $status) {
			return $cnt; // return num. bytes delivered like readfile() does.
		}
		return $status;
	}
	
	public function newClientNotify($case_id){
		require_once(dirname(__FILE__). '/phpmail/class.phpmailer.php');
		
		$lawyer_id = $_SESSION['id'];
		$userGroup = $_SESSION['group'];
		
		$lawyerInfo = $this->lawyerInfo($lawyer_id);
		
		$adminInfo = $this->adminInfo();
		
		$mail_body = 'Hello Admin<br><br>
					New client created by this advocate.<br><br>
					Advocate: '.$lawyerInfo->first_name.' '.$lawyerInfo->last_name .'<br>
					Email: '.$lawyerInfo->email.'<br><br>
					
					Thanks';
					
		$mail = new PHPMailer(true);
		$mail->IsMail();
		$mail->SMTPAuth   = false;
		$mail->CharSet	= 'UTF-8';
		$mail->AddReplyTo($adminInfo->email,'CRM');
		$mail->From       = 'noreply@neshmedia-bd.com';
		$mail->FromName   = 'CRM';
		$mail->AddAddress($adminInfo->email, $adminInfo->first_name);
		$mail->Subject  = 'New Client';
		$mail->MsgHTML($mail_body);
		$mail->IsHTML(true);
		$mail->Send();
	}
    public function addprimary($record){
        require_once(dirname(__FILE__). '/phpmail/class.phpmailer.php');
        extract($record);
      
        
        $date = date('Y-m-d H:i:s');
        $type=$this->db->real_escape_string($BA_No_Type);
        $bno=$this->db->real_escape_string($BA_No);
        $token=base64_encode($type.$bno);
       $link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?token='.$token.'';
       $BA_NO=$this->db->real_escape_string($BA_No);
        $BA_Type=$this->db->real_escape_string($BA_No_Type);
         $checksql="SELECT * FROM profile where BA_No_Type='$BA_Type' and BA_No=$BA_NO  ";
         $check = $this->db->query($checksql);
    
		if($check->num_rows){
           return "BA EXITS" ;
        }
        else{
        $sql1 = "INSERT INTO `primaryinfo` SET
					`BA_No_Type` = '".$this->db->real_escape_string($BA_No_Type)."',
					`BA_No` = '".$this->db->real_escape_string($BA_No)."',
					
					`Rank` = '".$this->db->real_escape_string($rank)."',
				   `Course_Type` = '".$this->db->real_escape_string($course_type)."',
					`Course` = '".$this->db->real_escape_string($Course)."',
					`token` = '".$token."',
					`date` = '".$date."',
					`Email` = '".$this->db->real_escape_string($email)."' ";
		$user_query = $this->db->query($sql1);
        
		
		
		
	/*	
		
		$to = $email;;
      $subject = "CRM";

      $message = " <html> <head>
     <title>hello</title>
     </head>
      <body>
   
     <table>
     <tr>
    <th>Link</th>
   
      </tr>
     <tr>
      
     <td>'$link'</td>
        </tr>
       </table>
      </body>
      </html>
          ";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@neshmedia-bd.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);*/
        return true;
    }
    
}
    
}
?>