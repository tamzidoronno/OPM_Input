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

$sql = "SELECT a.*,b.email FROM `user_info` a LEFT JOIN `users` b ON a.user_id=b.id WHERE b.id = '".$lawyer_id."'";
$lawyer_name_query = $lawyer->db->query($sql);
$lawyer_info = $lawyer_name_query->fetch_object();
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
				<li><a href="#">Profile</a></li>
			</ul>
				
				
			<!-- start: Main Menu -->
			
			<!-- end: Main Menu -->
			
			
			<!-- start: Content -->
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Profile</h2>
					</div>
					<div class="box-content">
					<?php
					$error = true;
                    if(isset($_POST['submit']))
					{
						extract($_POST);
						if((!empty($first_name) && !empty($email)))
						{
							if(!empty($password) && $password!=$password2){
								echo 'Password incorrect!';
							}else{
								$client_data = $lawyer->updateProfile($user_id, $first_name, $last_name, $email, $password, $phone);
								if($client_data)
								{
									echo "Profile Updated";
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
					if($error){
					?>
						<form action="" name="add-client" method="post" enctype="multipart/form-data" class="form-horizontal">
						  <fieldset>
                          	<div class="control-group">
							  <label class="control-label" for="name"><span class="required">*</span> First Name: </label>
							  <div class="controls">
								<input name="first_name" type="text" class="input-xlarge" value="<?php echo $lawyer_info->first_name;?>" required="required" />
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="phone"> Last Name: </label>
							  <div class="controls">
								<input name="last_name" type="text" class="input-xlarge" value="<?php echo $lawyer_info->last_name;?>"  />
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="phone"> Phone: </label>
							  <div class="controls">
								<input name="phone" type="text" class="input-xlarge" value="<?php echo $lawyer_info->phone;?>" />
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="rdate"><span class="required">*</span> Email: </label>
							  <div class="controls">
								<input name="email" type="email" class="input-xlarge" id="email" value="<?php echo $lawyer_info->email;?>" readonly />
							  </div>
							</div>
                            <div class="control-group">
                                <label class="control-label" for="where">Update Password: </label>
                                <div class="controls">
                                    <input name="password" type="password" class="input-xlarge" id="password" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="where">Confirm Password: </label>
                                <div class="controls">
                                    <input name="password2" type="password" class="input-xlarge" id="password2" value=""/>
                                </div>
                            </div>
                            
							<div class="form-actions">
                            	<input name="user_id" type="hidden" value="<?php echo $lawyer_info->user_id;?>" />
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
			<span style="text-align:left;float:left">&copy; 2015 </span>
			
		</p>

	</footer>
<script type="text/javascript">
function goBack(){
	window.history.back();
}
</script>
<?php include(dirname(__FILE__).'/footer.php');?>