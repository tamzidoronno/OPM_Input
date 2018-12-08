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
				<li><a href="clients.php">All Profiles</a></li>
			</ul>

			<!-- start: Content -->
			
			
			
		

			
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>All Profiles</h2>
                        <div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div class="row-fluid">
                        	<div class="x-box span12">
                            	<?php
								//$lawyer_sql = "SELECT a.*,b.email FROM `user_info` a LEFT JOIN `users` b ON a.user_id=b.id WHERE b.usergroup=2";
								$lawyer_sql = "SELECT a.*,b.* FROM `profile` a LEFT JOIN `officer_skills` b ON b.BA_No=a.BA_No";
								$lawyer_sql .= "  ORDER BY b.id ASC";
								
								$lawyer_query = $lawyer->db->query($lawyer_sql);
								?>
                                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                                	<thead>
                                    	<tr>
                                        
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
									
									if($lawyer_query->num_rows){
										while($advocate = $lawyer_query->fetch_object()){
											
											
											echo '<tr>
												<td>'.$advocate->BA_No_Type.'-'.$advocate->BA_No.'</td>
												<td>'.$advocate->Name.'</td>
												<td>'.$advocate->Rank.'</td>
												<td>'.$advocate->Course.' '.$advocate->Course_Type.'</td>
												<td>'.$advocate->Present_Posting.'</td>
												<td>'.$advocate->Contact_No.'</td>
												<td>'.str_ireplace(',','<br />',$advocate->Communication_Topic).str_ireplace(',','<br />',$advocate->Transmission_System_Topic).'</td>												

												<td>'.$advocate->First_Choice.',<br> '.$advocate->Second_Choice.'</td>	
											    <td>
													<a href="edit_lawyer.php?ba_no='.$advocate->BA_No.'&ba_type='.$advocate->BA_No_Type.'" >[edit]</a><br />
													<a href="view_lawyer.php?ba_no='.$advocate->BA_No.'&ba_type='.$advocate->BA_No_Type.'">[view]</a>
												</td>
												</tr>';
										}
									}
									else{
											//echo '<tr><td colspan="3">No any record found</td></tr>';
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

<script type="text/javascript">
function remove_lawyer(client_id){
	var con = confirm("Confirm remove this advocate?");
	if(con){
		location = 'action.php?task=remove_lawyer&id='+client_id;
	}
}
</script>
<?php include(dirname(__FILE__).'/footer.php');?>