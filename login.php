<?php 
require_once("class/class.common.php");
$common = new commonClass();
$common->sessionStart();
include("class/class.admin.php");
$lawyer = new lawyerController();

if($lawyer->isLogin()){
    $common->redirect('index.php');
}

?>
<?php
$pageTitle = "OPM : Login";
$pageClass = "";
include('header.php');
?>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="index.php"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2>Login to your account</h2>
					<?php
					require_once("class/class.admin.php");
					$login = new lawyerController();
					
					if(isset($_POST['submit']))
					{
						extract($_POST);
						
						$login_data = $login->login($BA_No_Type, $BA_No, $Course_Type, $Course, $dob);
						
						if($login_data)
						{
							echo '<script type="text/javascript">location="primaryinfo.php";</script>'; exit;
						}
						else
						{
							echo '<div class="error">Please enter correct BA Number,Course and Date of Birth</div>';
						}
					}
					?>
					<form class="form-horizontal" action="" enctype="multipart/form-data" method="post">
						<fieldset>
							
                          	<div class="control-group">
							  <label class="control-label" for=""> *BA Number: </label>
							  <div class="controls">
							  
							  
							
								<select name="BA_No_Type">
									<option value="BA">BA</option>
									<option value="BSS">BSS</option>
								</select>
								
								<input type="number" name="BA_No"><br>						
							  </div>
							</div>
							<div class="clearfix"></div>

							<div class="control-group">
							  <label class="control-label" for=""> Course: </label>
							  <div class="controls">
								<select  name="Course_Type">
									<option value="L/C">L/C</option>
									<option value="Spl">Spl</option>
								</select>
								<input  type="number" name="Course"><br>
							  </div>
							</div>									
							<div class="clearfix"></div>
							
							
							
					         <div class="control-group">
							  <label class="control-label" for=""> Date of Birth: </label>
							  <div class="controls"> 								
								<input type="Date" name="dob"><br>						
							  </div>
							</div>
							<div class="clearfix"></div>
							
							
							
							<div class="button-login">	
								<button name="submit" type="submit" class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
                       </fieldset>
					</form>
					<hr>
					<h3>Forgot Password?</h3>
					<p>
						No problem, <a href="#">click here</a> to get a new password.
					</p>	
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->

<?php include('footer.php');?>