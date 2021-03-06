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
 $encript = new mdCrypt();
     
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
				<li><a href="search_lawyer.php">New Officer</a></li>
			</ul>

			<!-- start: Content -->
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>New Officer</h2>
					</div>
					<div class="box-content">
						<div class="row-fluid">
                        	<div class="x-box span12 client-list">
                            	<div class="search-form">
                                	
									<?php 
								$conn       = new mysqli('localhost','root','','thelived_profile' );
									
									$officers_list_sql = "SELECT p.*,o.* FROM profile_temp p LEFT JOIN officer_skills_temp o ON(o.BA_No=p.BA_No)  AND (o.BA_No_Type=p.BA_No_Type) LEFT JOIN educational_qualification_temp ec ON(ec.BA_No=p.BA_No) AND (ec.BA_No_Type=p.BA_No_Type)  WHERE 
									(p.BA_No=o.BA_No AND p.BA_No_Type=o.BA_No_Type ) AND (p.BA_No=ec.BA_No AND p.BA_No_Type=ec.BA_No_Type) AND p.flag=0 AND o.flag=0 AND ec.flag=0 ";
												
													
													
									$officers_list_sql .= " GROUP BY p.BA_No ORDER BY p.Name ASC;";	
									//echo $officers_list_sql;exit;
									$officers_query = $conn->query($officers_list_sql);
									
                                    $tem_insert=$lawyer->tempdata_insert();
                                    
                                    
									?>
                                    	
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
												<td>'.substr($encript->encrypt($officer->Name), 0, 10).'.....</td>
												<td>'.substr($encript->encrypt($officer->Rank),0,10).'.....</td>
												<td>'.substr($encript->encrypt($officer->Course),0,10).' '.substr($encript->encrypt($officer->Course_Type),0,10).'.....</td>
												<td>'.substr($encript->encrypt($officer->Present_Posting),0,10).'.....</td>
												<td>'.substr($encript->encrypt($officer->Contact_No),0,10).'.....</td>
												<td>'.str_ireplace(',','<br />',($officer->Communication_Topic)).str_ireplace(',','<br />',($officer->Transmission_System_Topic)).'</td>												

												<td>'.substr($officer->First_Choice,0,10).'..,<br> '.substr($officer->Second_Choice,0,10).'..</td>	
											    <td>
													<a href="edit_newLawyer.php?ba_no='.$officer->BA_No.'&ba_type='.$officer->BA_No_Type.'" >[edit]</a><br />
													
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