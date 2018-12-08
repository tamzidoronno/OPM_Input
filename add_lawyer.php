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
				<li><a href="#">Add New Officer</a></li>
			</ul>
				
				
			<!-- start: Main Menu -->
			
			<!-- end: Main Menu -->
			
			
			<!-- start: Content -->
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>New Officer</h2>
					</div>
					<div class="box-content">
					<?php
					$error = true;
                    if(isset($_POST['submit']))
					{
						extract($_POST);
						if(!empty($BA_No_Type) && !empty($BA_No))
						{
							$client_data = $lawyer->addLawyer($_POST);
							if($client_data)
							{
								echo "Record Added";
								$error = false;
							}
							else
							{
								echo "Sorry could not send form data.";
							}
						}
						else
						{
							echo "Please fill the (*) fields.";
						}
						
						
					}
					if($error){
					?>
						<form action="" name="add-client" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
						  <fieldset>
                          	<div class="control-group">
							  <label class="control-label" for=""> *BA Number: </label>
							  <div class="controls">
							  
							  
								<span class="required"></span>
								<select name="BA_No_Type">
									<option value="BA">BA</option>
									<option value="BSS">BSS</option>
								</select>
								</span>
								<span class="required"></span><input type="number" name="BA_No"><br></span>
								
								
							  </div>
							</div>
							
							
                            <div class="control-group">
							  <label class="control-label" for=""> Full Name: </label>
							  <div class="controls">
								<input id="" name="full_name" type="text" class="input-xlarge" value=""  />
							  </div>
							</div>
							
							 <div class="control-group">
							  <label class="control-label" for=""> Full Name: </label>
							  <div class="controls">
								<input id="" name="full_name" type="text" class="input-xlarge" value="" style="width:200px; font-size:12px;"  />
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for="rank"> Rank: </label>
							  <div class="controls">
								<select id="rank" name="rank">
								<option value="Lt">Lt</option>
								<option value="Capt">Capt</option>
								<option value="Maj">Maj</option>
								<option value="Lt Col">Lt Col</option>		
								<option value="Col">Col</option>
								<option value="Brig">Brig</option>
								<option value="Maj Gen">Maj Gen</option>
								<option value="Lt Gen">Lt Gen</option>
								<option value="Gen">Gen</option><br>
								</select>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Course: </label>
							  <div class="controls">
								<select  name="course_type">
									<option value="L/C">L/C</option>
									<option value="Spl">Spl</option>
								</select>
								<input  type="number" name="Course"><br>
							  </div>
							</div>
							
							
                            <div class="control-group">
							  <label class="control-label" for=""> Present Posting: </label>
							  <div class="controls">
								<input type="text" name="present_posting"><br>
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for=""> 	Contact Number: </label>
							  <div class="controls">
								<input type="text" name="Contact_No"><br>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> E-mail: </label>
							  <div class="controls">
								<input type="text" name="email"><br>
							  </div>
							</div>
							
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Image: </label>
							  <div class="controls">
								<input type="file" name="profile-image"><br>
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
                                          	
                                          </tr>
                                      </thead>
                                      <tbody>
                                      	<tr><td>
                                        <select name="Qualification[]" class="input-xlarge">
                                        <option value="">Select</option>
		<option value="SSC">SSC</option>
		<option value="HSC">HSC</option>
		<option value="BSc">BSc</option>
		<option value="MSc">MSc</option>		
		<option value="PhD">PhD</option>
		</select>
        </td> <td><input type="text" name="Institute[]"></td>    <td><input type="text" name="Division_Subject[]"></td> <td><input type="text" name="Result[]"></td> <td><input type="text" name="Year_Of_Passing[]"></td> <td><input type="text" name="Any_Achivement[]"></td> <td><input type="text" name="Remarks[]"></td></tr>
                                      </tbody>
                                	</table>
                                </div>
<div class="span2"><span id="addScnt" class="addBtn"><i class="icon-plus"></i></span></div>
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
   
  </tr>
  </thead>
  <tbody>
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
  </tr> 
  </tbody>
</table></div>
<div class="span2"><span id="addCertified" class="addBtn"><i class="icon-plus"></i></span></div>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Publications/Articles/Thesis/Projects: </label>
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
  
  </tr>
  </thead>
  <tbody>
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

  </tr> 
  </tbody>
</table></div>
<div class="span2"><span id="addPublication" class="addBtn"><i class="icon-plus"></i></span></div>
							  </div>
							</div>
							
							
<br><H2> 
Skills(Choose fields where you think you are expert and can contribute for development):</H2></br>								
							
							<div class="control-group">
							  <label class="control-label" for=""> Communication: </label>
							  <div class="controls">
								<input type="checkbox" name="Communication[]" value="Combat Communication" />Combat Communication<br>
								<input type="checkbox" name="Communication[]" value="Cellular Communication" />Cellular Communication<br>
								<input type="checkbox" name="Communication[]" value="SAT Communication" />SAT Communication<br>
								<input type="checkbox" name="Communication[]" value="Microwave Communication" />Microwave Communication<br>
								<input type="text" name="Communication[]" value="" /><br><br>
							  </div>
							</div>
							
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Transmission System: </label>
							  <div class="controls">
								<input type="checkbox" name="Transmission_System[]" value="Optical Fibre Transmission">Optical Fibre Transmission</<br>
								<input type="checkbox" name="Transmission_System[]" value="Soft-Switched Telephony">Soft-Switched Telephony<br>
								<input type="text" name="Transmission_System[]" value=""><br>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Programming Language: </label>
							  <div class="controls">
								<input type="checkbox" name="Programming_Language[]" value="C/C++/C#">C/C++/C#<br>
								<input type="checkbox" name="Programming_Language[]" value="PHP">PHP<br>
								<input type="checkbox" name="Programming_Language[]" value="ASP">ASP<br>
								<input type="checkbox" name="Programming_Language[]" value="JAVA">JAVA<br>
								<input type="checkbox" name="Programming_Language[]" value="Android">Android<br>
								<input type="checkbox" name="Programming_Language[]" value="IOS">IOS<br>
								<input type="text" name="Programming_Language[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Database Management System: </label>
							  <div class="controls">
								<input type="checkbox" name="Database_Management_System[]" value="SQL">SQL<br>
								<input type="checkbox" name="Database_Management_System[]" value="MySqli">MySqli<br>
								<input type="checkbox" name="Database_Management_System[]" value="Oracle">Oracle<br>
								<input type="checkbox" name="Database_Management_System[]" value="SQLite">SQLite<br>
								<input type="text" name="Database_Management_System[]" value=""><br>
							  </div>
							</div>
							
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Server Management: </label>
							  <div class="controls">
								<input type="checkbox" name="Server_Management[]" value="Linux Server">Linux Server<br>
								<input type="checkbox" name="Server_Management[]" value="Windows Server">Windows Server<br>
								<input type="text" name="Server_Management[]" value=""><br><br>
							  </div>
							</div>
							
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Networking: </label>
							  <div class="controls">
								<input type="checkbox" name="Networking[]" value="CCNA(Cisco)">CCNA(Cisco)<br>
								<input type="checkbox" name="Networking[]" value="CCNP(Cisco">CCNP(Cisco)<br>
								<input type="checkbox" name="Networking[]" value="CCIE(Cisco)">CCIE(Cisco)<br>
								<input type="checkbox" name="Networking[]" value="JNCIE-ENT(Juniper)">JNCIE-ENT(Juniper)<br>
								<input type="text" name="Networking[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Digital Forensic: </label>
							  <div class="controls">
								<input type="checkbox" name="Digital_Forensic[]" value="CMI">CMI<br>
								<input type="checkbox" name="Digital_Forensic[]" value="CFS">CFS<br>
								<input type="text" name="Digital_Forensic[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Cyber Security: </label>
							  <div class="controls">
								<input type="checkbox" name="Cyber_Security[]" value="CEH">CEH<br>
								<input type="checkbox" name="Cyber_Security[]" value="CISA">CISA<br>
								<input type="checkbox" name="Cyber_Security[]" value="CISM">CISM<br>
								<input type="checkbox" name="Cyber_Security[]" value="CISSP">CISSP<br>
								<input type="text" name="Cyber_Security[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> SIGINT: </label>
							  <div class="controls">
								<input type="checkbox" name="SIGINT[]" value="EW">EW<br>
								<input type="checkbox" name="SIGINT[]" value="COMMINT">COMMINT<br>
								<input type="checkbox" name="SIGINT[]" value="ELINT">ELINT<br>
								<input type="text" name="SIGINT[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Power Energy: </label>
							  <div class="controls">
								<input type="checkbox" name="Power_Energy[]" value="Solar Energy">Solar Energy<br>
								<input type="checkbox" name="Power_Energy[]" value="Renewable Energy">Renewable Energy<br>
								<input type="text" name="Power_Energy[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Reverse Engineering: </label>
							  <div class="controls">
								<input type="checkbox" name="Reverse_Engineering[]" value="Reverse Logistics Data Analyst">Reverse Logistics Data Analyst<br>
								<input type="checkbox" name="Reverse_Engineering[]" value="Hardware Reverse Engineering">Hardware Reverse Engineering<br>
								<input type="checkbox" name="Reverse_Engineering[]" value="GREM">GREM<br>
								<input type="text" name="Reverse_Engineering[]" value=""><br>
							  </div>
							</div>
							
	<br><H2>Area Of Interest:</H2></br>							
							<div class="control-group">
							  <label class="control-label" for=""> First Choice: </label>
							  <div class="controls">
					  
								<?php 
							
							$area_of_interest_sql = "SELECT * FROM area_of_interest WHERE 1";
							
							$area_of_interest = $lawyer->db->query($area_of_interest_sql);
							
							
						?>
								<select name="First_Choice">
                                	<option value="" >Select One</option>
                                    	<?php if($area_of_interest->num_rows){
										while($rs = $area_of_interest->fetch_object()){ ?>
										<option value="<?php echo $rs->courses; ?>"><?php echo $rs->courses; ?></option>
                                        <?php } 
										}
										?>
                                  </select>    
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for=""> Second Choice: </label>
							  <div class="controls">
								:<select name="Second_Choice"><option value="" >Select One</option></select>
							  </div>
							</div>
							
							

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
			<span style="text-align:left;float:left">&copy; <?php echo date('Y');?> </span>
			
		</p>

	</footer>

<script type="text/javascript">
function goBack(){
	window.history.back();
}
</script>
<?php include(dirname(__FILE__).'/footer.php');?>