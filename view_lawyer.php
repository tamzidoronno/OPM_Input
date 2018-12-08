<?php
session_start();
include("class/class.admin.php");
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
$lawyer_sql = "SELECT a.*,b.* FROM `profile` a LEFT JOIN `officer_skills` b ON b.BA_No=a.BA_No";
$lawyer_sql .= "  WHERE a.BA_No='".$_REQUEST['ba_no']."' AND a.BA_No_Type='".$_REQUEST['ba_type']."' ORDER BY b.id ASC";
//echo $lawyer_sql;
$lawyer_query = $lawyer->db->query($lawyer_sql);
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
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Edit Advocate</h2>
					</div>
					<div class="box-content">
					<?php
					$error = true;
                    if(isset($_POST['submit']))
					{
						extract($_POST);
						if(!empty($first_name) && !empty($email))
						{
							if(!empty($password) && $password!=$password2){
								echo 'Password incorrect!';
							}else{
								$client_data = $lawyer->updateProfile($advocate_id, $first_name, $last_name, $email, $password, $phone);
								if($client_data)
								{
									echo "Advocate Saved";
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
					$advocate = $lawyer_query->fetch_object();//echo '<pre>';print_r($advocate);echo '</pre>';
					{
					?>
						<form action="" name="add-client" method="post" enctype="multipart/form-data" class="form-horizontal">
						  <fieldset>
						  
						  
                            <div class="control-group">
							  <label class="control-label" for=""> *BA Number: </label>
							  <div class="controls">
							  
							  
								<span class="required"></span>
								<?php echo $advocate->BA_No_Type;?>
								</span>
								
								<span class="required"></span>
								<?php echo $advocate->BA_No;?>
							  </div>
							</div>
						  
						  
							
						  
						  
						  
                          	<div class="control-group">
							  <label class="control-label" for="name"> Full Name:  </label>
							  <div class="controls">
								<?php echo $advocate->Name;?>
							  </div>
							</div>
							
							
							
							
							
							
                            <div class="control-group">
							  <label class="control-label" for="phone"> Rank: </label>
							  <div class="controls">
								<?php echo $advocate->Rank;?>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Course: </label>
							  <div class="controls">			  
								<?php echo $advocate->Course;?>
								</span>								
								<?php echo $advocate->Course_Type;?>
							  </div>
							</div>
							
							
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for="phone"> Present Posting: </label>
							  <div class="controls">
								<?php echo $advocate->Present_Posting;?>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Contact Number: </label>
							  <div class="controls">
								<?php echo $advocate->Contact_No;?>
							  </div>
							</div>
							
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> E-mail: </label>
							  <div class="controls">
								<?php echo $advocate->Email;?>
							  </div>
							</div>
							
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Educational Qualifications: </label>
							  <div class="controls" style="width:34%">
								<table border="1"; width="100%">
  <tr>
    <th>Qualification</th>
    <th>Institute</th> 
    <th>Division/<br>Subject</th>
	<th>Results</th>
    <th>Year Of Passing</th>
	<th>Any Achivements</th>
    <th>Remarks</th> 	
  </tr>
  <?php
  $query = $lawyer->db->query("SELECT * FROM `educational_qualification` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");
										
                    
if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		?>
  <tr>
    <td>
		<?php echo $result->Qualification;?>
		
	</td>
    <td>
		<?php echo $result->Institute;?>
	</td>    
	<td>
		<?php echo $result->Division_Subject;?>
	</td>    
	<td>
		<?php echo $result->Result;?>
	</td> 
		<td>
		<?php echo $result->Year_Of_Passing;?>
	</td> 
		<td>
		<?php echo $result->Any_Achivement;?>
	</td> 
    <td>
		<?php echo $result->Remarks;?>
	</td> 
  </tr> 
  <?php }} ?>
</table>
							  </div>
							</div>
							
							

							<div class="control-group">
							  <label class="control-label" for=""> Military Courses: </label>
							  <div class="controls" style="width:34%">									
<table border="1";>
  <tr>
    <th>Nmae Of<br> The <br>Course</th>
    <th>Location</th> 
	<th>Duration<br>(weeks)</th>
	<th>Result</th>
	<th>Year</th>
    <th>Position</th> 
	<th>Any<br>Achievements</th>
    <th>Any Observations/<br> Remarks</th> 
  </tr>
  <?php 
$query = $lawyer->db->query("SELECT * FROM `military_courses` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");

if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		?>
  <tr>
    <td>
		<?php echo $result->Name_Of_The_Course;?>
	</td>    
	<td>
		<?php echo $result->Location;?>
	</td>    
	<td>
		<?php echo $result->Duration;?>
	</td> 
	<td>
		<?php echo $result->Result;?>
	</td> 
	<td>
		<?php echo $result->Year;?>
	</td> 
    <td>
		<?php echo $result->Position;?>
	</td> 
	<td>
		<?php echo $result->Any_Achivements;?>
	</td> 
	<td>
		<?php echo $result->Any_Observation_Remarks;?>
	</td> 
  </tr>
  <?php }} ?> 
	</table>
		<br>
			</div>
				</div>
						
							
							
							
								
							<div class="control-group">
							  <label class="control-label" for=""> Foreign Assignments: </label>
							  <div class="controls">
								<table border="1"; width="100%">
  <tr>
    <th>Assignments</th>
    <th>Assignment<br>Details</th> 
    <th>Country</th>
	<th>From</th>
    <th>To</th>
	<th>Duration</th>
    <th>Remarks</th> 
  </tr>
  <?php 
$query = $lawyer->db->query("SELECT * FROM `foreign_assignments` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");

if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		?>
  <tr>
   <td>
		<?php echo $result->Assignments;?>

	</td>    
	<td>
		<?php echo $result->Assignment_Details;?>
	</td>    
	<td>
		<?php echo $result->Country;?>
	</td> 
	<td>
		<?php echo $result->From_Date_FA;?>
	</td> 
	<td>
		<?php echo $result->To_Date_FA;?>
	</td> 
    <td>
		<?php echo $result->Duration_FA;?>
	</td> 
	<td>
		<?php echo $result->Remarks_FA;?>
	</td> 

  </tr> 
  <?php }} ?>
</table><br>
							  </div>
							</div>
							
						
							
								<div class="control-group">
							  <label class="control-label" for=""> UN Mission: </label>
							  <div class="controls">
								<table border="1"; width="100%">
  <tr>
    <th>Mission Name</th>
    <th>Country</th> 
    <th>Year</th>
	<th>Details</th>
  </tr>
  <?php 
$query = $lawyer->db->query("SELECT * FROM `un_mission` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");

if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		?>
  <tr>
    <td>
		<?php echo $result->Mission_Name;?>
	</td>    
	<td>
		<?php echo $result->Country_UNM;?>
	</td>    
	<td>
		<?php echo $result->Year_UNM;?>
	</td> 
	<td>
		<?php echo $result->Details;?>
	</td> 
  </tr> 
  <?php }} ?>
</table><br>
							  </div>
							</div>
						
							
				
							
							<div class="control-group">
							  <label class="control-label" for=""> Specialized/Certified Qualification: </label>
							  <div class="controls">
								<table border="1"; width="100%">
  <tr>
    <th>Name Of<br> The <br>Qualification</th>
    <th>Institution</th> 
    <th>Result</th>
	<th>Year Of <br>Participation</th>
	<th>Remarks</th>
  </tr>
  <?php 
$query = $lawyer->db->query("SELECT * FROM `specialized_certified_qualification` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");

if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		?>
  <tr>
    <td>
		<?php echo $result->Name_Of_The_Qualification;?>
	</td>    
	<td>
		<?php echo $result->Institution_SQ;?>
	</td>    
	<td>
		<?php echo $result->Result_SQ;?>
	</td> 
	<td>
		<?php echo $result->Year_Of_Participation_SQ;?>
	</td> 
	<td>
		<?php echo $result->Remarks_SQ;?>
	</td> 
  </tr> 
  <?php }} ?>
</table><br>
							  </div>
							</div>
							
										
			
							<div class="control-group">
							  <label class="control-label" for=""> Publications/Articles/<br>Thesis/Projects: </label>
							  <div class="controls">
								<table border="1"; width="100%">
  <tr>
    <th>Name Of<br> The Topic</th>
    <th>Publishing<br>Authority</th> 
    <th>Abstract</th>
	<th>Year Of <br>Passing</th>
	<th>Remarks</th>
  </tr>
  <?php 
$query = $lawyer->db->query("SELECT * FROM `publications_articles_thesis_projects` WHERE `BA_No`='".$_REQUEST['ba_no']."' AND `BA_No_Type`='".$_REQUEST['ba_type']."' ORDER BY id ASC");

if($query->num_rows){
	$i=0;
	while($result = $query->fetch_object()){
		?>
  <tr>
    <td>
		<?php echo $result->Name_Of_The_Topic;?>
	</td>    
	<td>
		<?php echo $result->Publishing_Authority;?>
	</td>    
	<td>
		<?php echo $result->Abstract;?>
	</td> 
	<td>
		<?php echo $result->Year_Of_Passing_PP;?>
	</td> 
	<td>
		<?php echo $result->Remarks_PP;?>
	</td> 
  </tr> 
  <?php }} ?>
</table><br>
							  </div>
							</div>
											
							
							
								
							
<br>Skills:</br>							
							
							<div class="control-group">
							  <label class="control-label" for=""> Communication: </label>
							  <div class="controls">
								<?php echo $advocate->Communication_Topic;?>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Transmission System: </label>
							  <div class="controls">
								<?php echo $advocate->Transmission_System_Topic	;?>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Programming Language: </label>
							  <div class="controls">
								<?php echo $advocate->Programming_Language_Topic;?>
							  </div>
							</div>
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Database Management System: </label>
							  <div class="controls">
								<?php echo $advocate->Database_Management_System_Topic;?>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Server Management: </label>
							  <div class="controls">
								<?php echo $advocate->Server_Management_Topic;?>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Networking: </label>
							  <div class="controls">
								<?php echo $advocate->Networking_Topic;?>
							  </div>
							</div>
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Digital Forensic: </label>
							  <div class="controls">
								<?php echo $advocate->Digital_Forensic_Topic;?>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Cyber Security: </label>
							  <div class="controls">
								<?php echo $advocate->Cyber_Security_Topic;?>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> SIGINT: </label>
							  <div class="controls">
								<?php echo $advocate->SIGINT_Topic;?>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Power Energy: </label>
							  <div class="controls">
								<?php echo $advocate->Power_Energy_Topic;?>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Reverse Engineering: </label>
							  <div class="controls">
								<?php echo $advocate->Reverse_Engineering_Topic;?>					
							</div>
							
							<br>
							
							
											
	<br>Area Of Interest:</br>						
							<div class="control-group">
							  <label class="control-label" for=""> First Choice: </label>
							  <div class="controls">
							  <?php echo $advocate->First_Choice;?>	
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Second Choice: </label>
							  <div class="controls">
							  <?php echo $advocate->Second_Choice;?>	
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Director Signals' Comment: </label>
							  <div class="controls">
								<input type="text" name="Director_Signal_Comment" class="input-xlarge" value="<?php echo $advocate->Dir_Comment;?>"><br>	
							  </div>
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
			<span style="text-align:left;float:left">&copy;Oct 2018 </span>
			
		</p>

	</footer>
<script type="text/javascript">
function goBack(){
	window.history.back();
}
</script>
<?php include(dirname(__FILE__).'/footer.php');?>