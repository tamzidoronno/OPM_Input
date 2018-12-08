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
									$programming_language = isset($_REQUEST['Programming_Language'])?$_REQUEST['Programming_Language']:'';
									$Qualification = isset($_REQUEST['Qualification'])?$_REQUEST['Qualification']:'';
									//echo $programming_language.'ss'.count($programming_language);
									//print_r($programming_language);exit;
									if(count($_REQUEST)>0){
									$officers_list_sql = "SELECT p.*,o.* FROM profile p LEFT JOIN officer_skills o ON(o.BA_No=p.BA_No)  AND (o.BA_No_Type=p.BA_No_Type) LEFT JOIN educational_qualification ec ON(ec.BA_No=p.BA_No) AND (ec.BA_No_Type=p.BA_No_Type)  WHERE 
									(p.BA_No=o.BA_No AND p.BA_No_Type=o.BA_No_Type ) AND (p.BA_No=ec.BA_No AND p.BA_No_Type=ec.BA_No_Type)";
													if($ba_no)
														$officers_list_sql .= " AND LOWER(p.BA_No) LIKE LOWER('%".$ba_no."%')";
													if($ba_type)
														$officers_list_sql .= " AND LOWER(p.BA_No_Type) LIKE LOWER('%".$ba_type."%')";
													if($course_type)
														$officers_list_sql .= " AND LOWER(p.Course_Type) LIKE LOWER('%".$course_type."%')";
													if($course)
														$officers_list_sql .= " AND LOWER(p.Course) LIKE LOWER('%".$course."%')";
														
													if($programming_language) {	
													
														foreach($programming_language as $language){
															$officers_list_sql .= " AND LOWER(o.Programming_Language_Topic) LIKE LOWER('%".$language."%')";
														}
													}
													
													if($Qualification)
													$officers_list_sql .= " AND LOWER(ec.Qualification) LIKE LOWER('%".$Qualification."%')";
													
									$officers_list_sql .= " GROUP BY p.BA_No ORDER BY p.Name ASC;";	
									//echo $officers_list_sql;exit;
									$officers_query = $lawyer->db->query($officers_list_sql);
									}
									?>
                                    	<fieldset>
                                        	<div class="control-group">
                                            	<label class="control-label" for="keyword">BA NO: </label>
                                                <div class="controls">
												<input name="ba_no" id="ba_no" type="text" class="input-xlarge" value="<?php echo $ba_no;?>" />
												</div>
                                            </div>
												<div class="control-group">
                                            	<label class="control-label" for="keyword">BA Type: </label>
                                                <div class="controls">
												<input name="ba_type" id="ba_type" type="text" class="input-xlarge" value="<?php echo $ba_type;?>" />
												</div>
                                            </div>
												<div class="control-group">
                                            	<label class="control-label" for="keyword">Course Type: </label>
                                                <div class="controls">
												<input name="course_type" id="course_type" type="text" class="input-xlarge" value="<?php echo $course_type;?>" />
												</div>
                                            </div>
												<div class="control-group">
                                                    <label class="control-label" for="keyword">Course: </label>
                                                    <div class="controls">
                                                    <input name="course" id="course" type="text" class="input-xlarge" value="<?php echo $course;?>" />
                                                    <input name="submit" type="submit" class="btn btn-primary " value="Search" />
                                                    </div>
                                            	</div>
                                                <div class="control-group">
                                                	<label class="control-label" for="programming">Programming Language</label>
                                                    <input type="checkbox" name="Programming_Language[]" value="C/C++/C#" >C/C++/C#<br>
													<input type="checkbox" name="Programming_Language[]" value="PHP" >PHP<br>
													<input type="checkbox" name="Programming_Language[]" value="ASP" >ASP<br>
													<input type="checkbox" name="Programming_Language[]" value="JAVA">JAVA<br>
													<input type="checkbox" name="Programming_Language[]" value="Android">Android<br>
													<input type="checkbox" name="Programming_Language[]" value="IOS">IOS<br>
                                                </div>
                                               <div class="control-group">
                                               <label class="control-label" for="education">Educational Qualification</label>
                                               <select name="Qualification" class="input-xlarge">
                                                    <option value="">Select</option>
                                                    <option value="SSC">SSC</option>
                                                    <option value="HSC">HSC</option>
                                                    <option value="BSc">BSc</option>
                                                    <option value="MSc">MSc</option>		
                                                    <option value="PhD">PhD</option>
                                        		</select>
                                               </div>     
                                                
                                        </fieldset>
                                    </form>
                                </div>
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
									
									if($officers_query->num_rows){
											//print_r($officers_query->fetch_object());
										while($officer = $officers_query->fetch_object()){
											
											$img = ($officer->Image)?$officer->Image:'image_not_available.png';
											echo '<tr>
												<td><img src="img/profile/'.$img.'" style="max-height:100px;" /><br><br></td>
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
										
									?>
                                    

                                        <?php 
										}
										}else{
											echo '<tr><td colspan="9">No any record found</td></tr>';
										}
										?>
									</tbody>
                                </table>
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