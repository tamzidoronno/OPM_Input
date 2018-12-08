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
				<li><a href="search_lawyer.php">Search</a></li>
			</ul>

			<!-- start: Content -->
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Search</h2>
					</div>
					<div class="box-content">
						<div class="row-fluid">
                        	<div class="x-box span12 client-list">
                            	<div class="search-form">
                                	<form action="" name="search-client" method="post" enctype="multipart/form-data" class="form-horizontal">
									<?php 
									$ba_no = isset($_REQUEST['ba_no'])?$_REQUEST['ba_no']:'';
									$ba_type = isset($_REQUEST['ba_type'])?$_REQUEST['ba_type']:'';
									$course_type = isset($_REQUEST['course_type'])?$_REQUEST['course_type']:'';
									$course = isset($_REQUEST['course'])?$_REQUEST['course']:'';
									$rank = isset($_REQUEST['rank'])?$_REQUEST['rank']:'';
						
									
									$Qualification = isset($_REQUEST['Qualification'])?$_REQUEST['Qualification']:'';
									$Institute = isset($_REQUEST['Institute'])?$_REQUEST['Institute']:'';
									$MinResult = isset($_REQUEST['MinResult'])?$_REQUEST['MinResult']:'';
									$MaxResult = isset($_REQUEST['MaxResult'])?$_REQUEST['MaxResult']:'';
									$Year_Of_Passing = isset($_REQUEST['Year_Of_Passing'])?$_REQUEST['Year_Of_Passing']:'';
									
													
									
									
									$Name_Of_The_Course = isset($_REQUEST['Name_Of_The_Course'])?$_REQUEST['Name_Of_The_Course']:'';
									$Result_MT = isset($_REQUEST['Result_MT'])?$_REQUEST['Result_MT']:'';
									$Year_MT = isset($_REQUEST['Year_MT'])?$_REQUEST['Year_MT']:'';
									$Position = isset($_REQUEST['Position'])?$_REQUEST['Position']:'';
									
									$Assignments = isset($_REQUEST['Assignments'])?$_REQUEST['Assignments']:'';				
									$Assignment_Details = isset($_REQUEST['Assignment_Details'])?$_REQUEST['Assignment_Details']:'';
									$Country = isset($_REQUEST['Country'])?$_REQUEST['Country']:'';
									
									
									$Mission_Name = isset($_REQUEST['Mission_Name'])?$_REQUEST['Mission_Name']:'';
									$Country_UNM = isset($_REQUEST['Country_UNM'])?$_REQUEST['Country_UNM']:'';
									
									
									$Communication = isset($_REQUEST['Communication'])?$_REQUEST['Communication']:'';
									$Transmission_System = isset($_REQUEST['Transmission_System'])?$_REQUEST['Transmission_System']:'';
									$programming_language = isset($_REQUEST['Programming_Language'])?$_REQUEST['Programming_Language']:'';
									$Database_Management_System = isset($_REQUEST['Database_Management_System'])?$_REQUEST['Database_Management_System']:'';
									$Server_Management = isset($_REQUEST['Server_Management'])?$_REQUEST['Server_Management']:'';
									$Networking = isset($_REQUEST['Networking'])?$_REQUEST['Networking']:'';
									$Digital_Forensic = isset($_REQUEST['Digital_Forensic'])?$_REQUEST['Digital_Forensic']:'';
									$Cyber_Security = isset($_REQUEST['Cyber_Security'])?$_REQUEST['Cyber_Security']:'';
									$SIGINT = isset($_REQUEST['SIGINT'])?$_REQUEST['SIGINT']:'';
									$Power_Energy = isset($_REQUEST['Power_Energy'])?$_REQUEST['Power_Energy']:'';
									$Reverse_Engineering = isset($_REQUEST['Reverse_Engineering'])?$_REQUEST['Reverse_Engineering']:'';
									
									
									$First_Choice = isset($_REQUEST['First_Choice'])?$_REQUEST['First_Choice']:'';
									$Second_Choice = isset($_REQUEST['Second_Choice'])?$_REQUEST['Second_Choice']:'';

									
									
									
									
									
									
									if(count($_REQUEST)>0){
									$officers_list_sql = "SELECT p.*,o.*,mc.*,fa.*,um.*,ec.* FROM profile p LEFT JOIN officer_skills o ON(o.BA_No=p.BA_No)  AND (o.BA_No_Type=p.BA_No_Type) LEFT JOIN educational_qualification ec ON(ec.BA_No=p.BA_No) AND (ec.BA_No_Type=p.BA_No_Type) LEFT JOIN military_courses mc ON(mc.BA_No=ec.BA_No) AND (mc.BA_No_Type=ec.BA_No_Type) LEFT JOIN foreign_assignments fa ON(fa.BA_No=mc.BA_No) AND (fa.BA_No_Type=mc.BA_No_Type) LEFT JOIN un_mission um ON(um.BA_No=fa.BA_No) AND (um.BA_No_Type=fa.BA_No_Type)  WHERE 
									(p.BA_No=o.BA_No AND p.BA_No_Type=o.BA_No_Type ) AND (p.BA_No=ec.BA_No AND p.BA_No_Type=ec.BA_No_Type)";
									
									
									
													if($ba_no)
														$officers_list_sql .= " AND LOWER(p.BA_No) LIKE LOWER('%".$ba_no."%')";
													if($ba_type)
														$officers_list_sql .= " AND LOWER(p.BA_No_Type) LIKE LOWER('%".$ba_type."%')";
													if($course_type)
														$officers_list_sql .= " AND LOWER(p.Course_Type) LIKE LOWER('%".$course_type."%')";
													if($course)
														$officers_list_sql .= " AND LOWER(p.Course) LIKE LOWER('%".$course."%')";	
													
													if($rank)
														$officers_list_sql .= " AND LOWER(p.Rank) LIKE LOWER('%".$rank."%')";						

													
													if($Qualification)
													$officers_list_sql .= " AND LOWER(ec.Qualification) LIKE LOWER('%".$Qualification."%')";
													if($Institute)
													$officers_list_sql .= " AND LOWER(ec.Institute) LIKE LOWER('%".$Institute."%')";
												
													if($MinResult || $MaxResult)
													$officers_list_sql .= " AND (ec.Result) >=$MinResult and (ec.Result) <=$MaxResult" ;
												
												
													if($Year_Of_Passing)
														$officers_list_sql .= " AND LOWER(ec.Year_Of_Passing) LIKE LOWER('%".$Year_Of_Passing."%')";
													
													
													
													if($Name_Of_The_Course)
													$officers_list_sql .= " AND LOWER(mc.Name_Of_The_Course) LIKE LOWER('%".$Name_Of_The_Course."%')";
													if($Result_MT)
													$officers_list_sql .= " AND LOWER(mc.Result) LIKE LOWER('%".$Result_MT."%')";
												
													if($Year_MT)
													$officers_list_sql .= " AND LOWER(mc.Year) LIKE LOWER('%".$Year_MT."%')";
												
													if($Position)
													$officers_list_sql .= " AND LOWER(mc.Position) LIKE LOWER('%".$Position."%')";
													
											
													
													if($Assignments)
													$officers_list_sql .= " AND LOWER(fa.Assignments) LIKE LOWER('%".$Assignments."%')";
													if($Assignment_Details)
													$officers_list_sql .= " AND LOWER(fa.Assignment_Details) LIKE LOWER('%".$Assignment_Details."%')";												
													if($Country)
													$officers_list_sql .= " AND LOWER(fa.Country) LIKE LOWER('%".$Country."%')";
													
													
													if($Mission_Name)
													$officers_list_sql .= " AND LOWER(fa.Mission_Name) LIKE LOWER('%".$Mission_Name."%')";												
													if($Country_UNM)
													$officers_list_sql .= " AND LOWER(fa.Country_UNM) LIKE LOWER('%".$Country_UNM."%')";
													
													
													
													

													if($Communication) {	
													
														foreach($Communication as $Comm){
															$officers_list_sql .= " AND LOWER(o.Communication_Topic) LIKE LOWER('%".$Comm."%')";
														}
													}
													if($Transmission_System) {	
													
														foreach($Transmission_System as $TxSys){
															$officers_list_sql .= " AND LOWER(o.Transmission_System_Topic) LIKE LOWER('%".$TxSys."%')";
														}
													}
													
													if($programming_language) {	
													
														foreach($programming_language as $language){
															$officers_list_sql .= " AND LOWER(o.Programming_Language_Topic) LIKE LOWER('%".$language."%')";
														}
													}
																	
													
													if($Database_Management_System) {	
													
														foreach($Database_Management_System as $DataBase){
															$officers_list_sql .= " AND LOWER(o.Database_Management_System_Topic) LIKE LOWER('%".$DataBase."%')";
														}
													}
													if($Server_Management) {	
													
														foreach($Server_Management as $ServerMgt){
															$officers_list_sql .= " AND LOWER(o.Server_Management_Topic) LIKE LOWER('%".$ServerMgt."%')";
														}
													}
													
													if($Networking) {	
													
														foreach($Networking as $Netwk){
															$officers_list_sql .= " AND LOWER(o.Networking_Topic) LIKE LOWER('%".$Netwk."%')";
														}
													}
												
													
													if($Digital_Forensic) {	
													
														foreach($Digital_Forensic as $Forensic){
															$officers_list_sql .= " AND LOWER(o.Digital_Forensic_Topic) LIKE LOWER('%".$Forensic."%')";
														}
													}
													if($Cyber_Security) {	
													
														foreach($Cyber_Security as $CyberSy){
															$officers_list_sql .= " AND LOWER(o.Cyber_Security_Topic) LIKE LOWER('%".$CyberSy."%')";
														}
													}
													if($SIGINT) {	
													
														foreach($SIGINT as $SigssInt){
															$officers_list_sql .= " AND LOWER(o.SIGINT_Topic) LIKE LOWER('%".$SigssInt."%')";
														}
													}if($Power_Energy) {	
													
														foreach($Power_Energy as $PowEnergy){
															$officers_list_sql .= " AND LOWER(o.Power_Energy_Topic) LIKE LOWER('%".$PowEnergy."%')";
														}
													}if($Reverse_Engineering) {	
													
														foreach($Reverse_Engineering as $RevEngr){
															$officers_list_sql .= " AND LOWER(o.Reverse_Engineering_Topic) LIKE LOWER('%".$RevEngr."%')";
														}
													}
													
													
													
														
													if($First_Choice)
														$officers_list_sql .= " AND LOWER(p.First_Choice) LIKE LOWER('%".$First_Choice."%')";
													if($Second_Choice)
														$officers_list_sql .= " AND LOWER(ec.Second_Choice) LIKE LOWER('%".$Second_Choice."%')";
													
													
												
													
									$officers_list_sql .= " GROUP BY p.BA_No ORDER BY p.Name ASC;";	
									
									$officers_query = $lawyer->db->query($officers_list_sql);
										
									
									}
									?>
									
									
									
									
									
						
									
									
									
									
									 <span class="expand_btn"></span>
									
									
                                    	<fieldset class="expand_content">
                                    		<p><H2> Search Desire Officers </H2></p>
									 <br/>
                                    		<div class="four-column-section">
                                        	<div class="control-group four-column">
                                            	<label class="control-label" for="keyword">BA Number: </label>
                                                <div class="controls">
								
												<select name="ba_type" id="ba_type" type="text" class="input-xlarge" style="width:99px; font-size:12px;">
													<option value="">Select</option>
													<option value="BA">BA</option>
													<option value="BSS">BSS</option>
												</select>
												<input name="ba_no" id="ba_no" type="text" class="input-xlarge" value="" style="width:80px; font-size:12px;">
												</div>
                        </div>
											
												<div class="control-group four-column">
                                            	<label class="control-label" for="keyword">Course: </label>
                                                <div class="controls">
												<select  name="course_type"  id="course_type" type="text" class="input-xlarge" value="<?php //echo $course_type;?>" style="width:99px; font-size:12px;">
													<option value="">Select</option>
													<option value="L/C">L/C</option>
													<option value="Spl">Spl</option>
												</select>												
												<input name="course" id="course" type="text" class="input-xlarge" value="<?php //echo $course;?>" style="width:80px; font-size:12px;" />
												</div>
												</div>
												
											<div class="control-group four-column">
											  <label class="control-label" for="rank"> Rank: </label>
											  <div class="controls">
												<select id="rank" name="rank" style="width:99px; font-size:12px;">
												<option value="">Select</option>
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
										</div>
                                             
							<div class="control-group">
							  <label class="control-label" for=""> Educational Qualifications: </label>
							  <div class="controls" style="width:70%">
                              	<div class="table-responsive">
                                    <table border="1" width="100%" id="education">
                                      <thead>
                                          <tr>
                                            <th>Qualification</th>
                                            <th>Institute</th> 
                                            <th>Division/<br>Subject</th>
                                            <th>Min Result</th><th>Max Result</th>
                                            <th>Year Of Passing</th>
                                      
                                            	
                                          </tr>
                                      </thead>
                                      <tbody>
                                      	<tr><td>
                                        <select name="Qualification" class="input-xlarge" style="width:80px; font-size:12px;">
                                        <option value="">Select</option>
										<option value="SSC">SSC</option>
										<option value="HSC">HSC</option>
										<option value="BSc">BSc</option>
										<option value="MSc">MSc</option>		
										<option value="PhD">PhD</option>
										</select></td> 
										<td><input type="text" name="Institute" style="width:80px; font-size:12px;"></td>    
										<td><input type="text" name="Division_Subject" style="width:80px; font-size:12px;"></td> 
										<td><input type="text" name="MinResult" style="width:80px; font-size:12px;"></td>
										<td><input type="text" name="MaxResult" style="width:80px; font-size:12px;"></td> 
										<td><input type="text" name="Year_Of_Passing" style="width:80px; font-size:12px;"></td> 
				 
										</tr>
																	  </tbody>
																	</table>
																</div>
								
															  </div>
															</div>	
												<div class="two-column-section">
									<div class="control-group two-column">
							  <label class="control-label" for=""> Military Courses: </label>
							  <div class="controls" style="width:60%">
										<div class="table-responsive">								
										<table border="1" id="Military-Courses">
										<thead>
										  <tr>
											<th>Nmae Of<br> The <br>Course</th>
											<th>Result</th>
											<th>Year</th>
											<th>Position</th> 
											
										  </tr>
										</thead>
										<tbody>
										  <tr>
											<td>
												<input type="text" name="Name_Of_The_Course" style="width:80px; font-size:12px;">
											</td>    
											
											<td>
												<input type="text" name="Result_MT"  style="width:80px; font-size:12px;">
											</td> 
											<td>
												<input type="text" name="Year_MT" style="width:80px; font-size:12px;">
											</td> 
											<td>
												<input type="text" name="Position" style="width:80px; font-size:12px;">
											</td> 
										
										  </tr> 
										</tbody>
										</table>
										</div>

																	  </div>
																	</div>
																							
										<div class="control-group two-column">
										  <label class="control-label" for=""> UN Mission: </label>
										  <div class="controls" style="width:70%">
										  <div class="table-responsive">
											<table border="1" width="100%" id="UN-Mission">
											<thead>
										  <tr>
											<th>Mission Name</th>
											<th>Country</th> 
											
											
											
										  </tr>
										  </thead>
										  <tbody>
										  <tr>
											<td>
												<input type="text" name="Mission_Name" style="width:80px; font-size:12px;">
											</td>    
											<td>
												<input type="text" name="Country_UNM" style="width:80px; font-size:12px;">
											</td>    
					 
											
										  </tr> 
										  </tbody>
										</table></div>
										</div>
									</div>	
								</div>
																	
																	
																	
																	<div class="control-group">
																	  <label class="control-label" for=""> Foreign Assignments: </label>
																	  <div class="controls" style="width:60%">
																	  <div class="table-responsive">	
																		<table border="1" width="100%" id="Foreign-Assignments"><thead>
										  <tr>
											<th>Assignments</th>
											<th>Assignment<br>Details</th> 
											<th>Country</th>
											 
										  </tr>
										  </thead>
										  <tbody>
										  <tr>
										   <td>
												<select name="Assignments" style="width:80px; font-size:12px;">
												<option value="">Select</option>
												<option value="Course">Course</option>
												<option value="Training">Training</option>
												<option value="PSI">PSI</option>
												<option value="Visit">Visit</option>		
												<option value="Seminar">Seminar</option>
												</select>	
											</td>    
											<td>
												<input type="text" name="Assignment_Details" style="width:80px; font-size:12px;">
											</td>    
											<td>
												<input type="text" name="Country" style="width:80px; font-size:12px;">
											</td> 	 
											
										
										  </tr> 
										  </tbody>
										</table></div>
																	  </div>
																	</div>
																	
																	
									<H2> 
Skills(Choose fields where you think you are expert and can contribute for development):</H2>							
							<div class="four-column-section">
							<div class="control-group four-column">
							  <label class="control-label" for=""> Communication: </label>
							  <div class="controls" >
								<input type="checkbox" name="Communication[]" value="Combat Communication" />Combat Communication<br>
								<input type="checkbox" name="Communication[]" value="Cellular Communication" />Cellular Communication<br>
								<input type="checkbox" name="Communication[]" value="SAT Communication" />SAT Communication<br>
								<input type="checkbox" name="Communication[]" value="Microwave Communication" />Microwave Communication<br>
								<input type="text" name="Communication[]" value="" /><br><br>
							  </div>
							</div>
							
							
							
							
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> Transmission System: </label>
							  <div class="controls">
								<input type="checkbox" name="Transmission_System[]" value="Optical Fibre Transmission">Optical Fibre Transmission<br>
								<input type="checkbox" name="Transmission_System[]" value="Soft-Switched Telephony">Soft-Switched Telephony<br>
								<input type="text" name="Transmission_System[]" value=""><br>
							  </div>
							</div>
							
							
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> Programming Language: </label>
							  <div class="controls">
								<input type="checkbox" name="Programming_Language[]" value="C/C++/C#">C/C++/C#<br>
								<input type="checkbox" name="Programming_Language[]" value="PHP">PHP<br>
								<input type="checkbox" name="Programming_Language[]" value="ASP">ASP<br>
								<input type="checkbox" name="Programming_Language[]" value="JAVA">JAVA<br>
								<input type="checkbox" name="Programming_Language[]" value="Android">Android<br>
								<input type="checkbox" name="Programming_Language[]" value="IOS">IOS<br>
								
							  </div>
							</div>
					
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> Database Management System: </label>
							  <div class="controls">
								<input type="checkbox" name="Database_Management_System[]" value="SQL">SQL<br>
								<input type="checkbox" name="Database_Management_System[]" value="MySqli">MySqli<br>
								<input type="checkbox" name="Database_Management_System[]" value="Oracle">Oracle<br>
								<input type="checkbox" name="Database_Management_System[]" value="SQLite">SQLite<br>
								<input type="text" name="Database_Management_System[]" value=""><br>
							  </div>
							</div>
							
							
							
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> Server Management: </label>
							  <div class="controls">
								<input type="checkbox" name="Server_Management[]" value="Linux Server">Linux Server<br>
								<input type="checkbox" name="Server_Management[]" value="Windows Server">Windows Server<br>
								<input type="text" name="Server_Management[]" value=""><br><br>
							  </div>
							</div>
							
							
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> Networking: </label>
							  <div class="controls">
								<input type="checkbox" name="Networking[]" value="CCNA(Cisco)">CCNA(Cisco)<br>
								<input type="checkbox" name="Networking[]" value="CCNP(Cisco">CCNP(Cisco)<br>
								<input type="checkbox" name="Networking[]" value="CCIE(Cisco)">CCIE(Cisco)<br>
								<input type="checkbox" name="Networking[]" value="JNCIE-ENT(Juniper)">JNCIE-ENT(Juniper)<br>
								<input type="text" name="Networking[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> Digital Forensic: </label>
							  <div class="controls">
								<input type="checkbox" name="Digital_Forensic[]" value="CMI">CMI<br>
								<input type="checkbox" name="Digital_Forensic[]" value="CFS">CFS<br>
								<input type="text" name="Digital_Forensic[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> Cyber Security: </label>
							  <div class="controls">
								<input type="checkbox" name="Cyber_Security[]" value="CEH">CEH<br>
								<input type="checkbox" name="Cyber_Security[]" value="CISA">CISA<br>
								<input type="checkbox" name="Cyber_Security[]" value="CISM">CISM<br>
								<input type="checkbox" name="Cyber_Security[]" value="CISSP">CISSP<br>
								<input type="text" name="Cyber_Security[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> SIGINT: </label>
							  <div class="controls">
								<input type="checkbox" name="SIGINT[]" value="EW">EW<br>
								<input type="checkbox" name="SIGINT[]" value="COMMINT">COMMINT<br>
								<input type="checkbox" name="SIGINT[]" value="ELINT">ELINT<br>
								<input type="text" name="SIGINT[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> Power Energy: </label>
							  <div class="controls">
								<input type="checkbox" name="Power_Energy[]" value="Solar Energy">Solar Energy<br>
								<input type="checkbox" name="Power_Energy[]" value="Renewable Energy">Renewable Energy<br>
								<input type="text" name="Power_Energy[]" value=""><br>
							  </div>
							</div>
							
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> Reverse Engineering: </label>
							  <div class="controls">
								<input type="checkbox" name="Reverse_Engineering[]" value="Reverse Logistics Data Analyst">Reverse Logistics Data Analyst<br>
								<input type="checkbox" name="Reverse_Engineering[]" value="GREM">GREM<br>
								<input type="checkbox" name="Reverse_Engineering[]" value="Hardware Reverse Engineering">Hardware Reverse Engineering<br>
								<input type="text" name="Reverse_Engineering[]" value=""><br>
							  </div>
							</div>
						</div>
												
												
												
							<br><H2>Area Of Interest:</H2>
<div class="four-column-section">
							<div class="control-group four-column">
							  <label class="control-label" for=""> First Choice: </label>
							  <div class="controls">
								<select id="" name="First_Choice">
								<option value="">Select</option>
								<option value="Combat Communication">Combat Communication</option>
								<option value="Cellular Communication">Cellular Communication</option>
								<option value="SAT Communication">SAT Communication</option>
								<option value="Microwave Communication">Microwave Communication</option>		
								<option value="Transmission System">Transmission System</option>
								<option value="Programming Language">Programming Language</option>
								<option value="Database Management System">Database Management System</option>
								<option value="Server Management">Server Management</option>
								<option value="Networking">Networking</option>
								<option value="Digital Forensic">Digital Forensic</option>
								<option value="Cyber Security">Cyber Security</option><br>
								<option value="SIGINT">SIGINT</option>
								<option value="Power Energy">Power Energy</option>
								<option value="Reverse Engineering">Reverse Engineering</option><br>
								</select>
							  </div>
							</div>
							
							<div class="control-group four-column">
							  <label class="control-label" for=""> Second Choice: </label>
							  <div class="controls">
								<select id="" name="Second_Choice">
								<option value="">Select</option>
								<option value="Combat Communication">Combat Communication</option>
								<option value="Cellular Communication">Cellular Communication</option>
								<option value="SAT Communication">SAT Communication</option>
								<option value="Microwave Communication">Microwave Communication</option>		
								<option value="Transmission System">Transmission System</option>
								<option value="Programming Language">Programming Language</option>
								<option value="Database Management System">Database Management System</option>
								<option value="Server Management">Server Management</option>
								<option value="Networking">Networking</option>
								<option value="Digital Forensic">Digital Forensic</option>
								<option value="Cyber Security">Cyber Security</option><br>
								<option value="SIGINT">SIGINT</option>
								<option value="Power Energy">Power Energy</option>
								<option value="Reverse Engineering">Reverse Engineering</option><br>
								</select>
							  </div>
							</div>
						</div>


					        <div class="control-group">
                                                    
                                                    <div class="controls">
                                                     <input name="submit" type="submit" class="btn btn-primary " value="Search" />
                                                    </div>
                                            	</div>                                         
                                                
                                        </fieldset>
									<table class="table table-striped table-bordered">
                                	<thead>
                                    	<tr>
                                        	<th>Picture</th>
                                            <th>Number</th>
                                            <th>Name</th>
											<th>Rank</th>
                                            <th>Course</th>
                                            <th>Present Posting</th>
											<th>Contact Number</th>
											<th>Skills</th>                                            
                                            <th>Area Of Interest</th>
											<th>Action</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									
									if(isset($officers_query->num_rows) && $officers_query->num_rows){							
										
											//print_r($officers_query->fetch_object());
										while($officer = $officers_query->fetch_object()){
											
												$img = ($officer->Image)?$officer->Image:'image_not_available.png';											
												echo '<tr>
												<td><img src="img/profile/'.$img.'" style="max-height:200px;" /><br><br></td>
												<td>'.$officer->BA_No_Type.'-'.$officer->BA_No.'</td>
												<td>'.$officer->Name.'</td>
												<td>'.$officer->Rank.'</td>
												<td>'.$officer->Course.' '.$officer->Course_Type.'</td>
												<td>'.$officer->Present_Posting.'</td>
												<td>'.$officer->Contact_No.'</td>
												<td>'.str_ireplace(',','<br />',$officer->Communication_Topic).str_ireplace(',','<br />',$officer->Transmission_System_Topic).'</td>												

												<td>'.$officer->First_Choice.',<br> '.$officer->Second_Choice.'</td>	
											    <td>
													<a href="edit_lawyer.php?ba_no='.$officer->BA_No.'&ba_type='.$officer->BA_No_Type.'" >[edit]</a><br />
													<a href="view_lawyer.php?ba_no='.$officer->BA_No.'&ba_type='.$officer->BA_No_Type.'">[view]</a>
												</td>
												</tr>';
										
						
										}
									}
										else{
											echo '<tr><td colspan="9">No any record found</td></tr>';
										}
										?>
									</tbody>
                                </table>
                                    </form>
                                </div>
                                         
                                </div>    
                            </div>
                        </div>
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
<style type="text/css">
.chzn-container-single .chzn-single{
	height:32px;
}
#keyword_chzn + .btn{
	display:inline-block;
	position:relative;
	margin-top:-26px;
}
.client-list .box .box-content{
	position:relative;
}
.client-list .box .box-content .fluid-old{
	position:absolute;
	right:10px;
	top:10px;
	background:#F00;
	color:#fff;
	text-transform:uppercase;
	padding:10px;
}
.client-list .box .box-content .fluid-btn-area{
	position:absolute;
	right:10px;
	top:10px;
}
</style>
<script type="text/javascript">
var searchKeyword = ["<?php echo implode('","',$searchKeyword);?>"];
</script>
<?php include(dirname(__FILE__).'/footer.php');?>