<?php
session_start();
include("class/class.admin.php");
//include("class/class.md.crypt.php");
$lawyer = new lawyerController();

$lawyer_id = $_SESSION['id'];
$userGroup = $_SESSION['group'];

if(!$lawyer->sessionBegin())
{
	header('location: login.php');
}

if(isset($_GET['out']))
{
	$lawyer->sessionEnd();
	header('location: login.php');
}
if(!isset($_SESSION['group']) || $_SESSION['group']!=1){
	header('location: index.php');
}


//$lawyer_sql = "SELECT a.*,b.email FROM `user_info` a LEFT JOIN `users` b ON a.user_id=b.id WHERE b.usergroup=2 AND a.user_id=$advocate_id";
//$lawyer_sql = "SELECT a.*,b.*,c.*,d.*,e.*,f.*,g.* FROM `profile` a LEFT JOIN `officer_skills` b ON b.BA_No=a.BA_No LEFT JOIN `military_courses` c ON b.BA_No=c.BA_No LEFT JOIN `educational_qualification` d ON d.BA_No=c.BA_No LEFT JOIN `foreign_assignments` e ON e.BA_No=d.BA_No LEFT JOIN `publications_articles_thesis_projects` f ON f.BA_No=e.BA_No LEFT JOIN `specialized_certified_qualification`  g ON g.BA_No=f.BA_No";
//$conn       = new mysqli('localhost','thelived_rmdemo','@rmdemo##','thelived_profile2' );
$lawyer_sql = "SELECT a.*,b.* FROM `profile_temp` a LEFT JOIN `officer_skills_temp` b ON b.BA_No=a.BA_No ";
$lawyer_sql .= " WHERE a.BA_No='".$_REQUEST['ba_no']."' AND a.BA_No_Type='".$_REQUEST['ba_type']."' ORDER BY b.id ASC";
//echo $lawyer_sql;
$lawyer_query = $lawyer->db->query($lawyer_sql);
//print_r($lawyer_query);exit;



if(!$lawyer_query->num_rows){
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include(dirname(__FILE__)."/include/head.php"); ?>
<body>
		<!-- start: Header -->
	<?php include(dirname(__FILE__)."/include/header.php"); ?>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php include(dirname(__FILE__)."/include/menu.php"); ?>
			<!-- end: Main Menu -->
			
			
			<!-- start: Content -->
			<div id="content" class="span10">
						
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Edit Profile</a></li>
			</ul>
				
				
			<!-- start: Main Menu -->
			
			<!-- end: Main Menu -->
			
			
			<!-- start: Content -->
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Edit Profile</h2>
					</div>
					<div class="box-content">
					<?php
					$error = true;
                    if(isset($_POST['submit']))
					{
						if(!empty($_POST['full_name']) && !empty($_POST['BA_No_Type']) && !empty($_POST['BA_No']))
						{
							{
								$client_data = $lawyer->addLawyer($_POST);
								if($client_data)
								{
									echo "Record Saved";
									$error = false;
								}
								else
								{
									echo "Sorry could not send form data.";
								}
							}
						}
						else
						{
							echo "Please fill the (*) fields.";
						}
						
						
					}
					$lawyer_query = $lawyer->db->query($lawyer_sql);
					$advocate = $lawyer_query->fetch_object();
                       //$decriptkey=$advocate->Dir_Comment;
                      //$decriptval=$lawyer->decriptvalue($advocate);
                      
                      //$decript = new mdCrypt($decriptkey);
                        //print_r($decriptval);
                       // $descript = new mdCrypt($key);
                    // echo $encript=$descript->encrypt('BSS');
                        
                    //echo $des=$descript->decrypt('83t3p3');
                     //   exit;
                       
					{
					?>
						<form action="" name="add-client" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
						  <fieldset>
						  
                            <div class="control-group">
							  <label class="control-label" for=""> *BA Number: </label>
							  <div class="controls">
							  
							  
								<span class="required"></span>
								<select name="BA_No_Type" readonly>
									<option value="BA" <?php if($advocate->BA_No_Type=='BA'){echo ' selected="selected"';}?>>BA</option>
									<option value="BSS" <?php if($advocate->BA_No_Type=='BSS'){echo ' selected="selected"';}?>>BSS</option>
								</select>
								
								<span class="required"></span>
								<input name="BA_No" type="number" class="input-xlarge" value="<?php echo $advocate->BA_No;?>"  readonly /></span>
							  </div>
							</div>
						  
						  
							
						  
						  
						  
                          	<div class="control-group">
							  <label class="control-label" for="name"><span class="required">*</span> Full Name:  </label>
							  <div class="controls">
								<input name="full_name" type="text" class="input-xlarge" value="<?php echo $advocate->Name;?>" required="required" />
							  </div>
							</div>
							
							
							
							
							
							
                            <div class="control-group">
							  <label class="control-label" for="phone"> Rank: </label>
							  <div class="controls">
								<input name="rank" type="text" class="input-xlarge" value="<?php echo $advocate->Rank;?>"  />
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Course: </label>
							  <div class="controls">			  
								<span class="required"></span>
								<input name="course_type" type="text" class="input-xlarge" value="<?php echo $advocate->Course_Type;?>"  />
								</span>								
								<span class="required"></span>
								<input name="Course" type="number" class="input-xlarge" value="<?php echo $advocate->Course;?>"  /></span>
							  </div>
							</div>
							
							
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for="phone"> Present Posting: </label>
							  <div class="controls">
								<input name="present_posting" type="text" class="input-xlarge" value="<?php echo $advocate->Present_Posting;?>"  />
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Contact Number: </label>
							  <div class="controls">
								<input name="Contact_No" type="number" class="input-xlarge" value="<?php echo $advocate->Contact_No;  ?>"  />
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for=""> Image: </label>
                              <?php 
								if($advocate->Image){
									echo '<img src="img/profile/'.$advocate->Image.'" style="max-height:100px;" /><br><br>'; 
								}
								?>
							  <div class="controls">
								<input type="file" name="profile-image"><br>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> E-mail: </label>
							  <div class="controls">
								<input name="email" type="text" class="input-xlarge" value="<?php echo $advocate->Email;?>"  />
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Educational Qualifications: </label>
							  <div class="controls" style="width:50%">
                              	<div class="table-responsive">
                                    <table border="1" width="100%" id="education">
                                      <thead>
                                          <tr>
                                            <th>Qualification</th>
                                            <th>Institute</th> 
                                            <th>Division/<br>Subject</th>
                                            <th>Results</th>
                                            <th>Year Of Passing</th>
                                            <th>Any Achivements</th>
                                            <th>Remarks</th> 
                                            <th></th>	
                                          </tr>
                                      </thead>
                                      <tbody>
                                      	<?php 
                              
										$query = $lawyer->db->query("SELECT * FROM `educational_qualification_temp` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");
										
                    
										if($query->num_rows){
											$i=0;
											while($result = $query->fetch_object()){
                                               
												$i++;
												echo '<tr><td><select name="Qualification[]" class="input-xlarge"><option value="">Select</option><option value="SSC" '.(($result->Qualification)=='SSC'?' selected="selected"':'').'>SSC</option><option value="HSC" '.(($result->Qualification)=='HSC'?' selected="selected"':'').'>HSC</option><option value="BSc" '.(($result->Qualification)=='BSc'?' selected="selected"':'').'>BSc</option><option value="MSc" '.(($result->Qualification)=='MSc'?' selected="selected"':'').'>MSc</option><option value="PhD" '.(($result->Qualification)=='PhD'?' selected="selected"':'').'>PhD</option></select</td> <td><input type="text" name="Institute[]" value="'.($result->Institute).'"></td> <td><input type="text" name="Division_Subject[]" value="'.($result->Division_Subject).'"></td> <td><input type="text" name="Result[]" value="'.($result->Result).'"></td> <td><input type="text" name="Year_Of_Passing[]" value="'.($result->Year_Of_Passing).'"></td> <td><input type="text" name="Any_Achivement[]" value="'.($result->Any_Achivement).'"></td> <td><input type="text" name="Remarks[]" value="'.($result->Remarks).'"></td> <td>'.($i>1?'<i class="icon-remove removeRow"></i>':'').'</td></tr>';
											}
                                            
										?>
                                        <?php }else{ ?>
                                      	<tr><td>
                                        <select name="Qualification[]" class="input-xlarge">
                                        <option value="">Select</option>
		<option value="SSC">SSC</option>
		<option value="HSC">HSC</option>
		<option value="BSc">BSc</option>
		<option value="MSc">MSc</option>		
		<option value="PhD">PhD</option>
		</select>
        </td> <td><input type="text" name="Institute[]"></td>    <td><input type="text" name="Division_Subject[]"></td> <td><input type="text" name="Result[]"></td> <td><input type="text" name="Year_Of_Passing[]"></td> <td><input type="text" name="Any_Achivement[]"></td> <td><input type="text" name="Remarks[]"></td> <td></td></tr>
        										<?php } ?>
                                      </tbody>
                                	</table>
                                </div>
<div class="span2"><span id="addScnt" class="addBtn"><i class="icon-plus"></i></span></div>
							  </div>
							</div>
							
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Military Courses: </label>
							  <div class="controls">
<div class="table-responsive">								
<table border="1" id="Military-Courses">
<thead>
  <tr>
    <th>Nmae Of<br> The <br>Course</th>
    <th>Location</th> 
	<th>Duration<br>(weeks)</th>
	<th>Result</th>
	<th>Year</th>
    <th>Position</th> 
	<th>Any<br>Achievements</th>
    <th>Any Observations/<br> Remarks</th> 
    <th></th>
  </tr>
</thead>
<tbody>
<?php 
$query = $lawyer->db->query("SELECT * FROM `military_courses_temp` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");

if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		$i++;
      
		echo '<tr><td><input type="text" name="Name_Of_The_Course[]" value="'.($result->Name_Of_The_Course).'" style="width:80px; font-size:12px;"></td> <td><input type="text" name="Location[]" value="'.($result->Location).'" style="width:80px; font-size:12px;"></td><td><input type="text" name="Duration[]" value="'.($result->Duration).'" style="width:80px; font-size:12px;"></td> <td><input type="text" name="Result_MT[]" value="'.($result->Result).'"></td> <td><input type="text" name="Year_MT[]" value="'.($result->Year).'"></td> <td><input type="text" name="Position[]" value="'.($result->Position).'"></td> <td><input type="text" name="Any_Achivement_MT[]" value="'.($result->Any_Achivements).'"></td> <td><input type="text" name="Any_Observation_Remarks[]" value="'.($result->Any_Observation_Remarks).'"></td> <td>'.($i>1?'<i class="icon-remove removeRow"></i>':'').'</td></tr>';
	}
?>
<?php }else{ ?>
  <tr>
    <td>
		<input type="text" name="Name_Of_The_Course[]" style="width:80px; font-size:12px;">
	</td>    
	<td>
		<input type="text" name="Location[]" style="width:80px; font-size:12px;">
	</td>    
	<td>
		<input type="text" name="Duration[]" style="width:80px; font-size:12px;">
	</td> 
	<td>
		<input type="text" name="Result_MT[]">
	</td> 
	<td>
		<input type="text" name="Year_MT[]">
	</td> 
    <td>
		<input type="text" name="Position[]">
	</td> 
	<td>
		<input type="text" name="Any_Achivement_MT[]">
	</td> 
	<td>
		<input type="text" name="Any_Observation_Remarks[]">
	</td> 
    <td></td>
  </tr> 
<?php } ?>
</tbody>
</table>
</div>

<div class="span2"><span id="addMltCs" class="addBtn"><i class="icon-plus"></i></span></div>
							  </div>
							</div>
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Foreign Assignments: </label>
							  <div class="controls">
                              <div class="table-responsive">	
								<table border="1" width="100%" id="Foreign-Assignments"><thead>
  <tr>
    <th>Assignments</th>
    <th>Assignment<br>Details</th> 
    <th>Country</th>
	<th>From</th>
    <th>To</th>
	<th>Duration</th>
    <th>Remarks</th> 
  </tr>
  </thead>
  <tbody>
<?php 
$query = $lawyer->db->query("SELECT * FROM `foreign_assignments_temp` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");

if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		$i++;
		echo '<tr><td><select name="Assignments[]"><option value="">Select</option><option value="Course" '.($result->Assignments=='Course'?' selected="selected"':'').'>Course</option><option value="Training" '.($result->Assignments=='Training'?' selected="selected"':'').'>Training</option><option value="PSI" '.($result->Assignments=='PSI'?' selected="selected"':'').'>PSI</option><option value="Visit" '.($result->Assignments=='Visit'?' selected="selected"':'').'>Visit</option><option value="Seminar" '.($result->Assignments=='Seminar'?' selected="selected"':'').'>Seminar</option></select></td> <td><input type="text" name="Assignment_Details[]" value="'.$result->Assignment_Details.'"></td> <td><input type="text" name="Country[]" value="'.$result->Country.'"></td><td><input type="Date" name="From_Date_FA[]" value="'.$result->From_Date_FA.'"></td> <td><input type="Date" name="To_Date_FA[]" value="'.$result->To_Date_FA.'"></td> <td><input type="" name="Duration_FA[]" value="'.$result->Duration_FA.'"></td> <td><input type="text" name="Remarks_FA[]" value="'.$result->Remarks_FA.'"> </td> <td>'.($i>1?'<i class="icon-remove removeRow"></i>':'').'</td></tr>';
	}
?>
<?php }else{ ?>
  <tr>
   <td>
		<select name="Assignments[]">
        <option value="">Select</option>
		<option value="Course">Course</option>
		<option value="Training">Training</option>
		<option value="PSI">PSI</option>
		<option value="Visit">Visit</option>		
		<option value="Seminar">Seminar</option>
		</select>	
	</td>    
	<td>
		<input type="text" name="Assignment_Details[]">
	</td>    
	<td>
		<input type="text" name="Country[]">
	</td> 
	<td>
		<input type="Date" name="From_Date_FA[]">
	</td> 
	<td>
		<input type="Date" name="To_Date_FA[]">
	</td> 
    <td>
		<input type="" name="Duration_FA[]">
	</td> 
	<td>
		<input type="text" name="Remarks_FA[]">
	</td> 
	<td></td>
  </tr>
<?php } ?> 
  </tbody>
</table></div>
<div class="span2"><span id="addFoAss" class="addBtn"><i class="icon-plus"></i></span></div>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> UN Mission: </label>
							  <div class="controls">
                              <div class="table-responsive">
								<table border="1" width="100%" id="UN-Mission">
                                <thead>
  <tr>
    <th>Mission Name</th>
    <th>Country</th> 
    <th>Year</th>
	<th>Details</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
<?php 
$query = $lawyer->db->query("SELECT * FROM `un_mission_temp` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");

if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		$i++;
		echo '<tr><td><input type="text" name="Mission_Name[]" value="'.$result->Mission_Name.'"></td> <td><input type="text" name="Country_UNM[]" value="'.$result->Country_UNM.'"></td> <td><input type="text" name="Year_UNM[]" value="'.$result->Year_UNM.'"></td> <td><input type="text" name="Details[]" value="'.$result->Details.'"></td> <td>'.($i>1?'<i class="icon-remove removeRow"></i>':'').'</td></tr>';
	}
?>
<?php }else{ ?>
  <tr>
    <td>
		<input type="text" name="Mission_Name[]">
	</td>    
	<td>
		<input type="text" name="Country_UNM[]">
	</td>    
	<td>
		<input type="text" name="Year_UNM[]">
	</td> 
	<td>
		<input type="text" name="Details[]">
	</td> 
    <td></td>
  </tr> 
<?php } ?>
  </tbody>
</table></div>
<div class="span2"><span id="addUNMiss" class="addBtn"><i class="icon-plus"></i></span></div>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Specialized/Certified Qualification: </label>
							  <div class="controls">
                              <div class="table-responsive">
								<table border="1" width="100%" id="Certified-Qualification">
                                <thead>
  <tr>
    <th>Name Of<br> The <br>Qualification</th>
    <th>Institution</th> 
    <th>Result</th>
	<th>Year Of <br>Participation</th>
	<th>Remarks</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
<?php 
$query = $lawyer->db->query("SELECT * FROM `specialized_certified_qualification_temp` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");

if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		$i++;
		echo '<tr><td><input type="text" name="Name_Of_The_Qualification[]" value="'.$result->Name_Of_The_Qualification.'"></td> <td><input type="text" name="Institution_SQ[]" value="'.$result->Institution_SQ.'"></td> <td><input type="text" name="Result_SQ[]" value="'.$result->Result_SQ.'"></td><td><input type="text" name="Year_Of_Participation_SQ[]" value="'.$result->Year_Of_Participation_SQ.'"></td> <td><input type="text" name="Remarks_SQ[]" value="'.$result->Remarks_SQ.'"></td> <td>'.($i>1?'<i class="icon-remove removeRow"></i>':'').'</td></tr>';
	}
?>
<?php }else{ ?>
  <tr>
    <td>
		<input type="text" name="Name_Of_The_Qualification[]">
	</td>    
	<td>
		<input type="text" name="Institution_SQ[]">
	</td>    
	<td>
		<input type="text" name="Result_SQ[]">
	</td> 
	<td>
		<input type="text" name="Year_Of_Participation_SQ[]">
	</td> 
	<td>
		<input type="text" name="Remarks_SQ[]">
	</td> 
    <td></td>
  </tr> 
<?php } ?>
  </tbody>
</table></div>
<div class="span2"><span id="addCertified" class="addBtn"><i class="icon-plus"></i></span></div>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Publications/Articles/<br>Thesis/Projects: </label>
							  <div class="controls">
                              <div class="table-responsive">
								<table border="1" width="100%" id="Publications">
                                <thead>
  <tr>
    <th>Name Of<br> The Topic</th>
    <th>Publishing<br>Authority</th> 
    <th>Abstract</th>
	<th>Year Of <br>Passing</th>
	<th>Remarks</th>
    <th></th>
  </tr>
  </thead>
  <thead>
<?php 
$query = $lawyer->db->query("SELECT * FROM `publications_articles_thesis_projects_temp` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");

if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		$i++;
		echo '<tr><td><input type="text" name="Name_Of_The_Topic[]" value="'.$result->Name_Of_The_Topic.'"></td><td><input type="text" name="Publishing_Authority[]" value="'.$result->Publishing_Authority.'"></td> <td><input type="text" name="Abstract[]" value="'.$result->Abstract.'"></td> <td><input type="text" name="Year_Of_Passing_PP[]" value="'.$result->Year_Of_Passing_PP.'"></td> <td><input type="text" name="Remarks_PP[]" value="'.$result->Remarks_PP.'"></td> <td>'.($i>1?'<i class="icon-remove removeRow"></i>':'').'</td></tr>';
	}
?>
<?php }else{ ?>
  <tr>
    <td>
		<input type="text" name="Name_Of_The_Topic[]">
	</td>    
	<td>
		<input type="text" name="Publishing_Authority[]">
	</td>    
	<td>
		<input type="text" name="Abstract[]">
	</td> 
	<td>
		<input type="text" name="Year_Of_Passing_PP[]">
	</td> 
	<td>
		<input type="text" name="Remarks_PP[]">
	</td> 
    <td></td>
  </tr> 
<?php } ?>
  </thead>
</table></div>
<div class="span2"><span id="addPublication" class="addBtn"><i class="icon-plus"></i></span></div>
							  </div>
							</div>
											
							
							
								
							
<br>Skills:</br>		<?php ?>
                       
                           <?php $pre_Communication=array("Combat Communication","Cellular Communication","SAT Communication","Microwave Communication");
                                $pre_value=explode(',',$advocate->Communication_Topic); 
                                	
                               
                                $res=array_diff($pre_value,$pre_Communication); 
                               
                                 ?> 
						
							<div class="control-group">
							  <label class="control-label" for=""> Communication: </label>
							  <div class="controls">
								<input type="checkbox" name="Communication[]" value="Combat Communication" <?php if(in_array('Combat Communication',explode(',',$advocate->Communication_Topic))){echo ' checked="checked"';}?> />Combat Communication<br>
								<input type="checkbox" name="Communication[]" value="Cellular Communication" <?php if(in_array('Cellular Communication',explode(',',$advocate->Communication_Topic))){echo ' checked="checked"';}?> />Cellular Communication<br>
								<input type="checkbox" name="Communication[]" value="SAT Communication" <?php if(in_array('SAT Communication',explode(',',$advocate->Communication_Topic))){echo ' checked="checked"';}?> />SAT Communication<br>
								<input type="checkbox" name="Communication[]" value="Microwave Communication" <?php if(in_array('Microwave Communication',explode(',',$advocate->Communication_Topic))){echo ' checked="checked"';}?> />Microwave Communication<br>
								<input type="text" name="Communication[]" value="<?php echo (count($res)>0)?current($res):''; ?> " /><br><br>
							  </div>
							</div>
							
							
							
							<?php $pre_System=array("Optical Fibre Transmission","Soft-Switched Telephony");
                                $pre_Systemvalue=explode(',',$advocate->Transmission_System_Topic);   
                                   $Systemresult=array_diff($pre_Systemvalue,$pre_System);
                
                                   ?>
							
							<div class="control-group">
							  <label class="control-label" for=""> Transmission System: </label>
							  <div class="controls">
								<input type="checkbox" name="Transmission_System[]" value="Optical Fibre Transmission" <?php if(in_array('Optical Fibre Transmission',explode(',',$advocate->Transmission_System_Topic))){echo ' checked="checked"';}?> >Optical Fibre Transmission</<br>
								<input type="checkbox" name="Transmission_System[]" value="Soft-Switched Telephony"  <?php if(in_array('Soft-Switched Telephony',explode(',',$advocate->Transmission_System_Topic))){echo ' checked="checked"';}?>>Soft-Switched Telephony<br>
								
								<input type="text" name="Transmission_System[]" value="<?php echo (count($Systemresult)>0)?current($Systemresult):''; ?> "><br>
							  </div>
							</div>
							
							<?php $pre_Programming=array("C/C++/C#","PHP","ASP","JAVA","Android","IOS");
                                $pre_Programmingvalue=explode(',',$advocate->Programming_Language_Topic);   
                                   $Programmingresult=array_diff($pre_Programmingvalue,$pre_Programming);
                
                                   ?>
							
							<div class="control-group">
							  <label class="control-label" for=""> Programming Language: </label>
							  <div class="controls">
								<input type="checkbox" name="Programming_Language[]" value="C/C++/C#" <?php if(in_array('C/C++/C#',explode(',',$advocate->Programming_Language_Topic))){echo ' checked="checked"';}?> >C/C++/C#<br>
								
								<input type="checkbox" name="Programming_Language[]" value="PHP" <?php if(in_array('PHP',explode(',',$advocate->Programming_Language_Topic))){echo ' checked="checked"';}?>  >PHP<br>
								<input type="checkbox" name="Programming_Language[]" value="ASP"  <?php if(in_array('ASP',explode(',',$advocate->Programming_Language_Topic))){echo ' checked="checked"';}?> >ASP<br>
								<input type="checkbox" name="Programming_Language[]" value="JAVA" <?php if(in_array('JAVA',explode(',',$advocate->Programming_Language_Topic))){echo ' checked="checked"';}?>>JAVA<br>
								<input type="checkbox" name="Programming_Language[]" value="Android" <?php if(in_array('Android',explode(',',$advocate->Programming_Language_Topic))){echo ' checked="checked"';}?>>Android<br>
								<input type="checkbox" name="Programming_Language[]" value="IOS" <?php if(in_array('IOS',explode(',',$advocate->Programming_Language_Topic))){echo ' checked="checked"';}?>>IOS<br>
								<input type="text" name="Programming_Language[]" value="<?php echo (count($Programmingresult)>0)?current($Programmingresult):''; ?>"><br>
							  </div>
							</div>
							
							<?php $pre_Management=array("SQL","MySqli","Oracle","SQLite");
                                  $pre_Managementvalue=explode(',',$advocate->Database_Management_System_Topic);   
                                  $Management=array_diff($pre_Managementvalue,$pre_Management);
                
                                   ?>
							<div class="control-group">
							  <label class="control-label" for=""> Database Management System: </label>
							  <div class="controls">
								<input type="checkbox" name="Database_Management_System[]" value="SQL" <?php if(in_array('SQL',explode(',',$advocate->Database_Management_System_Topic))){echo ' checked="checked"';}?>>SQL<br>
								<input type="checkbox" name="Database_Management_System[]" value="MySqli"  <?php if(in_array('MySqli',explode(',',$advocate->Database_Management_System_Topic))){echo ' checked="checked"';}?>>MySqli<br>
								<input type="checkbox" name="Database_Management_System[]" value="Oracle"  <?php if(in_array('Oracle',explode(',',$advocate->Database_Management_System_Topic))){echo ' checked="checked"';}?>>Oracle<br>
								<input type="checkbox" name="Database_Management_System[]" value="SQLite"  <?php if(in_array('SQLite',explode(',',$advocate->Database_Management_System_Topic))){echo ' checked="checked"';}?>>SQLite<br>
								<input type="text" name="Database_Management_System[]" value="<?php echo (count($Management)>0)?current($Management):''; ?>"><br>
							  </div>
							</div>
							
							
							<?php $pre_Server=array("Linux Server","Windows Server");
                                  $pre_Servervalue=explode(',',$advocate->Server_Management_Topic);   
                                  $Server=array_diff($pre_Servervalue,$pre_Server);
                
                            ?>
							
							<div class="control-group">
							  <label class="control-label" for=""> Server Management: </label>
							  <div class="controls">
								<input type="checkbox" name="Server_Management[]" value="Linux Server"  <?php if(in_array('Linux Server',explode(',',$advocate->Server_Management_Topic))){echo ' checked="checked"';}?>>Linux Server<br>
								<input type="checkbox" name="Server_Management[]" value="Windows Server"  <?php if(in_array('Windows Server',explode(',',$advocate->Server_Management_Topic))){echo ' checked="checked"';}?>>Windows Server<br>
								<input type="text" name="Server_Management[]" value="<?php echo (count($Server)>0)?current($Server):''; ?>"><br><br>
							  </div>
							</div>
							
							
							<?php $pre_Networking=array("CCNA(Cisco)","CCNP(Cisco","CCIE(Cisco)","JNCIE-ENT(Juniper)");
                                  $pre_Networkingvalue=explode(',',$advocate->Networking_Topic);   
                                  $Networking=array_diff($pre_Networkingvalue,$pre_Networking);
                
                            ?>
							<div class="control-group">
							  <label class="control-label" for=""> Networking: </label>
							  <div class="controls">
								<input type="checkbox" name="Networking[]" value="CCNA(Cisco)" <?php if(in_array('CCNA(Cisco)',explode(',',$advocate->Networking_Topic))){echo ' checked="checked"';}?>>CCNA(Cisco)<br>
								<input type="checkbox" name="Networking[]" value="CCNP(Cisco" <?php if(in_array('CCNP(Cisco',explode(',',$advocate->Networking_Topic))){echo ' checked="checked"';}?>>CCNP(Cisco)<br>
								<input type="checkbox" name="Networking[]" value="CCIE(Cisco)" <?php if(in_array('CCIE(Cisco)',explode(',',$advocate->Networking_Topic))){echo ' checked="checked"';}?>>CCIE(Cisco)<br>
								<input type="checkbox" name="Networking[]" value="JNCIE-ENT(Juniper)" <?php if(in_array('JNCIE-ENT(Juniper)',explode(',',$advocate->Networking_Topic))){echo ' checked="checked"';}?>>JNCIE-ENT(Juniper)<br>
								<input type="text" name="Networking[]" value="<?php echo (count($Networking)>0)?current($Networking):''; ?>"><br>
							  </div>
							</div>
							
							<?php $pre_Digital=array("CMI","CFS");
                                  $pre_Digitalvalue=explode(',',$advocate->Digital_Forensic_Topic);   
                                  $Digital_Forensic=array_diff($pre_Digitalvalue,$pre_Digital);
                
                            ?>
							<div class="control-group">
							  <label class="control-label" for=""> Digital Forensic: </label>
							  <div class="controls">
								<input type="checkbox" name="Digital_Forensic[]" value="CMI" <?php if(in_array('CMI',explode(',',$advocate->Digital_Forensic_Topic))){echo ' checked="checked"';}?>>CMI<br>
								<input type="checkbox" name="Digital_Forensic[]" value="CFS" <?php if(in_array('CFS',explode(',',$advocate->Digital_Forensic_Topic))){echo ' checked="checked"';}?>>CFS<br>
								<input type="text" name="Digital_Forensic[]" value="<?php echo (count($Digital_Forensic)>0)?current($Digital_Forensic):''; ?>"><br>
							  </div>
							</div>
							
							<?php $pre_Cyber=array("CEH","CISA","CISM","CISSP");
                                  $pre_Cybervalue=explode(',',$advocate->Cyber_Security_Topic);   
                                  $Cyber=array_diff($pre_Cybervalue,$pre_Cyber);
                
                            ?>
							<div class="control-group">
							  <label class="control-label" for=""> Cyber Security: </label>
							  <div class="controls">
								<input type="checkbox" name="Cyber_Security[]" value="CEH" <?php if(in_array('CEH',explode(',',$advocate->Cyber_Security_Topic))){echo ' checked="checked"';}?>>CEH<br>
								<input type="checkbox" name="Cyber_Security[]" value="CISA" <?php if(in_array('CISA',explode(',',$advocate->Cyber_Security_Topic))){echo ' checked="checked"';}?> >CISA<br>
								<input type="checkbox" name="Cyber_Security[]" value="CISM" <?php if(in_array('CISM',explode(',',$advocate->Cyber_Security_Topic))){echo ' checked="checked"';}?>>CISM<br>
								<input type="checkbox" name="Cyber_Security[]" value="CISSP" <?php if(in_array('CISSP',explode(',',$advocate->Cyber_Security_Topic))){echo ' checked="checked"';}?>>CISSP<br>
								<input type="text" name="Cyber_Security[]" value="<?php echo (count($Cyber)>0)?current($Cyber):''; ?>"><br>
							  </div>
							</div>
							<?php $pre_SIGINT=array("EW","COMMINT","ELINT");
                                  $pre_SIGINTvalue=explode(',',$advocate->SIGINT_Topic);   
                                  $SIGINT=array_diff($pre_SIGINTvalue,$pre_SIGINT);
                
                            ?>
							
							<div class="control-group">
							  <label class="control-label" for=""> SIGINT: </label>
							  <div class="controls">
								<input type="checkbox" name="SIGINT[]" value="EW" <?php if(in_array('EW',explode(',',$advocate->SIGINT_Topic))){echo ' checked="checked"';}?>>EW<br>
								<input type="checkbox" name="SIGINT[]" value="COMMINT" <?php if(in_array('COMMINT',explode(',',$advocate->SIGINT_Topic))){echo ' checked="checked"';}?>>COMMINT<br>
								<input type="checkbox" name="SIGINT[]" value="ELINT" <?php if(in_array('ELINT',explode(',',$advocate->SIGINT_Topic))){echo ' checked="checked"';}?>>ELINT<br>
								<input type="text" name="SIGINT[]" value="<?php echo (count($SIGINT)>0)?current($SIGINT):''; ?>"><br>
							  </div>
							</div>
							
							<?php $pre_Power=array("Solar Energy","Renewable Energy");
                                  $pre_Powervalue=explode(',',$advocate->Power_Energy_Topic);   
                                  $Power=array_diff($pre_Powervalue,$pre_Power);
                
                            ?>
							<div class="control-group">
							  <label class="control-label" for=""> Power Energy: </label>
							  <div class="controls">
								<input type="checkbox" name="Power_Energy[]" value="Solar Energy" <?php if(in_array('Solar Energy',explode(',',$advocate->Power_Energy_Topic))){echo ' checked="checked"';}?>>Solar Energy<br>
								<input type="checkbox" name="Power_Energy[]" value="Renewable Energy" <?php if(in_array('Renewable Energy',explode(',',$advocate->Power_Energy_Topic))){echo ' checked="checked"';}?>>Renewable Energy<br>
								<input type="text" name="Power_Energy[]" value="<?php echo (count($Power)>0)?current($Power):''; ?>"><br>
							  </div>
							</div>
							
							<?php $pre_Reverse=array("Reverse Logistics Data Analyst","Hardware Reverse Engineering","GREM");
                                  $pre_Reversevalue=explode(',',$advocate->Reverse_Engineering_Topic);   
                                  $Reverse=array_diff($pre_Reversevalue,$pre_Reverse);
                
                            ?>
							<div class="control-group">
							  <label class="control-label" for=""> Reverse Engineering: </label>
							  <div class="controls">
								<input type="checkbox" name="Reverse_Engineering[]" value="Reverse Logistics Data Analyst" <?php if(in_array('Reverse Logistics Data Analyst',explode(',',$advocate->Reverse_Engineering_Topic))){echo ' checked="checked"';}?>>Reverse Logistics Data Analyst<br>
								<input type="checkbox" name="Reverse_Engineering[]" value="Hardware Reverse Engineering" <?php if(in_array('Hardware Reverse Engineering',explode(',',$advocate->Reverse_Engineering_Topic))){echo ' checked="checked"';}?>>Hardware Reverse Engineering<br>
								<input type="checkbox" name="Reverse_Engineering[]" value="GREM" <?php if(in_array('GREM',explode(',',$advocate->Reverse_Engineering_Topic))){echo ' checked="checked"';}?>>GREM<br>
								<input type="text" name="Reverse_Engineering[]" value="<?php echo (count($Reverse)>0)?current($Reverse):''; ?>"><br>
							  </div>
							</div>
						
							
											
	<br>Area Of Interest:</br>						
							<div class="control-group">
							  <label class="control-label" for=""> First Choice: </label>
							  <div class="controls">
					  
								<select name="First_Choice">
			<option value="Combat Communication" <?php if($advocate->First_Choice=='Combat Communication') {echo "selected"; }?> >Combat Communication</option>
			<option value="Cellular Communication" <?php if($advocate->First_Choice=='Cellular Communication') {echo "selected";}?>>Cellular Communication</option>
			<option value="SAT Communication" <?php if($advocate->First_Choice=='SAT Communication') {echo "selected";}?>>SAT Communication</option>
			<option value="Microwave Communication" <?php if($advocate->First_Choice=='Microwave Communication') {echo "selected";}?> >Microwave Communication</option>		
			<option value="Soft-switched Telephony" <?php if($advocate->First_Choice=='Soft-switched Telephony') {echo "selected";}?>>Soft-Switched Telephony</option>
			<option value="Programming & Database Management" <?php if($advocate->First_Choice=='Programming & Database Management') {echo "selected";}?>>Programming & Database Management</option>
			<option value="Networking & Server Management" <?php if($advocate->First_Choice=='Networking & Server Management') {echo "selected";}?>>Networking & Server Management</option>
			<option value="Digital Forensic" <?php if($advocate->First_Choice=='Digital Forensic') {echo "selected";}?>>Digital Forensic</option>
			<option value="Reverse Engineering" <?php if($advocate->First_Choice=='Reverse Engineering') {echo "selected";}?>>Reverse Engineering</option>
			<option value="Cyber Security" <?php if($advocate->First_Choice=='Cyber Security') {echo "selected";}?>>Cyber Security</option>
			<option value="COMMSEC" <?php if($advocate->First_Choice=='COMMSEC') {echo "selected";}?>>COMMSEC</option>
			<option value="Power Energy" <?php if($advocate->First_Choice=='Power Energy') {echo "selected";}?>>Power Energy</option>
			</select>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Second Choice: </label>
							  <div class="controls">
								<select name="Second_Choice">
			<option value="Combat Communication" <?php if($advocate->Second_Choice=='Combat Communication') {echo "selected"; }?>>Combat Communication</option>
			<option value="Cellular Communication" <?php if($advocate->Second_Choice=='Cellular Communication') {echo "selected";}?>>Cellular Communication</option>
			<option value="SAT Communication" <?php if($advocate->Second_Choice=='SAT Communication') {echo "selected";}?>>SAT Communication</option>
			<option value="Microwave Communication" <?php if($advocate->Second_Choice=='Microwave Communication') {echo "selected";}?> >Microwave Communication</option>		
			<option value="Soft-switched Telephony" <?php if($advocate->Second_Choice=='Soft-switched Telephony') {echo "selected";}?>>Soft-Switched Telephony</option>
			<option value="Programming & Database Management" <?php if($advocate->Second_Choice=='Programming & Database Management') {echo "selected";}?>>Programming & Database Management</option>
			<option value="Networking & Server Management" <?php if($advocate->Second_Choice=='Networking & Server Management') {echo "selected";}?>>Networking & Server Management</option>
			<option value="Digital Forensic" <?php if($advocate->Second_Choice=='Digital Forensic') {echo "selected";}?>>Digital Forensic</option>
			<option value="Reverse Engineering" <?php if($advocate->Second_Choice=='Reverse Engineering') {echo "selected";}?>>Reverse Engineering</option>
			<option value="Cyber Security" <?php if($advocate->Second_Choice=='Cyber Security') {echo "selected";}?>>Cyber Security</option>
			<option value="COMMSEC" <?php if($advocate->Second_Choice=='COMMSEC') {echo "selected";}?>>COMMSEC</option>
			<option value="Power Energy" <?php if($advocate->Second_Choice=='Power Energy') {echo "selected";}?>>Power Energy</option>
			</select><br>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Director Signals' Comment: </label>
							  <div class="controls">
								<input type="text" name="Director_Signal_Comment" class="input-xlarge" value="<?php echo $advocate->Dir_Comment;?>"><br>	
							  </div>
							</div>
			
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
														
							
							
                            <?php /*?><div class="control-group">
                                <label class="control-label" for="password"> Update Password: </label>
                                <div class="controls">
                                    <input name="password" type="password" class="input-xlarge" id="password" value=""/>
                                </div>
                            </div>
							
							
							
							
                            <div class="control-group">
                                <label class="control-label" for="password2">Confirm Password: </label>
                                <div class="controls">
                                    <input name="password2" type="password" class="input-xlarge" id="password2" value=""/>
                                </div>
                            </div><?php */?>
							
							
                            
							<div class="form-actions">
							  <button type="button" class="btn" onClick="goBack();">Cancel</button>
                              <input name="submit" type="submit" class="btn btn-primary" value="Save" />
							</div>
							
							
							
							
						  </fieldset>
						</form>   
						<?php } ?>
					</div>
				</div><!--/span-->

			</div><!--/row-->
                
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
	
	<div class="clearfix"></div>
	</div>
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; <?php echo date('Y'); ?> </span>
			
		</p>

	</footer>
<script type="text/javascript">
function goBack(){
	window.history.back();
}
</script>
<?php include(dirname(__FILE__).'/footer.php');?>