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
$case_id = (int)$_REQUEST['id'];

$client_sql = "SELECT a.*, b.name AS client_name, b.phone, CONCAT(c.first_name, ' ', c.last_name) AS lawyer_name FROM `case_info` a LEFT JOIN `clients` b ON a.client_id=b.id LEFT JOIN user_info c ON a.lawyer_id=c.user_id WHERE a.id=$case_id";
if($userGroup!=1){
	$client_sql .= " AND a.lawyer_id=$lawyer_id";
}
$client_query = $lawyer->db->query($client_sql);
if(!$client_query->num_rows){
	header('location: index.php');
}else{
	$client = $client_query->fetch_object();
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
				<li><a href="#">Edit Client</a></li>
			</ul>
				
				
			<!-- start: Main Menu -->
			
			<!-- end: Main Menu -->
			
			
			<!-- start: Content -->
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Edit Client</h2>
					</div>
					<div class="box-content">
					<?php
					$error = true;
                    if(isset($_POST['submit']))
					{
						extract($_POST);
						if(!empty($name) && !empty($phone) && !empty($recieved) && !empty($where) && !empty($recours))
						{
							if(!empty($convocation))
								$convocation = date("Y-m-d", strtotime($convocation));
							if(!empty($lastd))
								$lastd = date("Y-m-d", strtotime($lastd));
							if(!empty($rdv))
								$rdv = date("Y-m-d", strtotime($rdv));
							$client_data = $lawyer->editClient($case_id, $dossier, $client_id, $name, $phone, $adname, date("Y-m-d", strtotime($recieved)), $where, $recours, $aj, $convocation, $lastd, $payment, $question, $lawyer_id, date("Y-m-d H:i:s"), $lawyer_id, $rdv, $_FILES["attachment"]);
							if($client_data)
							{
								echo "Client information saved";
								echo "<script> location.replace('view_client.php?id=$client_data')</script>";
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
						<form action="" name="add-client" method="post" enctype="multipart/form-data" class="form-horizontal">
						  <fieldset>
                          	<div class="control-group">
							  <label class="control-label" for="dossier"><span class="required">*</span> Dossier: </label>
							  <div class="controls">
								<input name="dossier" type="text" rel="phone" class="input-xlarge" value="<?php echo $client->dossier;?>" required="required" />
							  </div>
							</div>
                          	<div class="control-group">
							  <label class="control-label" for="name"><span class="required">*</span> Client Name: </label>
							  <div class="controls">
								<input name="name" type="text" class="input-xlarge" value="<?php echo $client->client_name;?>" />
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="phone"><span class="required">*</span> Phone No: </label>
							  <div class="controls">
								<input name="phone" type="text" rel="phone" class="input-xlarge" value="<?php echo $client->phone;?>" />
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="rdate"><span class="required">*</span> Receive Date: </label>
							  <div class="controls">
								<input name="recieved" type="text" class="input-xlarge datepicker" id="rdate" value="<?php echo date("m/d/Y", strtotime($client->receive_date)); ?>">
							  </div>
							</div>
                            <div class="control-group">
                                <label class="control-label" for="where"><span class="required">*</span> Where: </label>
                                <div class="controls">
                                    <select name="where" data-placeholder="Where:" id="where" data-rel="chosen">
                                      <option value="1" <?php if($client->location=='1'){echo ' selected="selected"';}?>>OFPRA</option>
                                      <option value="2" <?php if($client->location=='2'){echo ' selected="selected"';}?>>CNDA</option>
                                      <option value="3" <?php if($client->location=='3'){echo ' selected="selected"';}?>>IMMIGRATION</option>
                                  </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="recours"><span class="required">*</span> Recours: </label>
                                <div class="controls">
                                    <select name="recours" data-placeholder="Recours" id="recours" data-rel="chosen">
                                      <option value="1" <?php if($client->recours=='1'){echo ' selected="selected"';}?>>OK</option>
                                      <option value="2" <?php if($client->recours=='2'){echo ' selected="selected"';}?>>NOT YET</option>
                                  </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="aj"> Aj: </label>
                                <div class="controls">
                                    <select name="aj" data-placeholder="Aj" id="aj" data-rel="chosen">
                                      <option value="1" <?php if($client->aj=='1'){echo ' selected="selected"';}?>>OK</option>
                                      <option value="2" <?php if($client->aj=='2'){echo ' selected="selected"';}?>>IMPOSSIBLE</option>
                                      <option value="3" <?php if($client->aj=='3'){echo ' selected="selected"';}?>>NOT YET</option>
                                  </select>
                                </div>
                            </div>
                            <div class="control-group">
							  <label class="control-label" for="convocation">Convocation: </label>
							  <div class="controls">
                              	<?php $convocation = $client->convocation!='0000-00-00' ? date("m/d/Y", strtotime($client->convocation)) : '';?>
								<input name="convocation" type="text" class="input-xlarge datepicker" id="convocation" value="<?php echo $convocation; ?>">
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="lastd"> Document Last Date: </label>
							  <div class="controls">
                              	<?php $doc_last_date = $client->doc_last_date!='0000-00-00' ? date("m/d/Y", strtotime($client->doc_last_date)) : '';?>
								<input name="lastd" type="text" class="input-xlarge datepicker" id="lastd" value="<?php echo $doc_last_date; ?>">
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="payment"> Payment: </label>
							  <div class="controls">
								<input name="payment" type="text" class="input-xlarge" value="<?php echo $client->payment;?>" />
							  </div>
							</div>
                            <?php if($userGroup==1){ ?>
							<div class="control-group">
                                <label class="control-label" for="adname"><span class="required">*</span> Advocate Name: </label>
                                <div class="controls">
                                <?php
                                $name_sql = "SELECT a.* FROM `user_info` a LEFT JOIN `users` b ON a.user_id=b.id WHERE b.usergroup=2";
								$name_query = $lawyer->db->query($name_sql);
								
								?>
                                    <select name="adname" data-placeholder="Select Advocate" id="adname" data-rel="chosen" required="required">
                                    	<option value="">Select Advocate</option>
									<?php  
                                    while($advocate_name = mysqli_fetch_row($name_query)){
										if($advocate_name[1]==$client->lawyer_id)
											$_sel = ' selected="selected"';
										else
											$_sel = '';
                                    ?>
                                        <option value="<?php echo $advocate_name[1]; ?>" <?php echo $_sel;?>><?php echo $advocate_name[2].' '.$advocate_name[3]; ?></option>
									<?php
                                    }
                                    ?>
                                  	</select>
                                </div>
                            </div>
                            <?php }else {?>
                            	<input type="hidden" name="adname" value="<?php echo $lawyer_id;?>" />
                            <?php } ?>
                            <div class="control-group">
							  <label class="control-label" for="question"> Question: </label>
							  <div class="controls">
								<textarea name="question" id="question" class="input-xlarge"><?php echo $client->question;?></textarea>
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="attachment"> Attachment: </label>
							  <div class="controls">
                              	<label><?php echo $client->attachment;?></label>
                                <input type="file" accept="application/pdf,image/jpeg,image/x-png,image/gif" name="attachment" />
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="rdv">Rdv: </label>
							  <div class="controls">
                              <?php $rdv = $client->rdv!='0000-00-00' ? date("m/d/Y", strtotime($client->rdv)) : '';?>
								<input name="rdv" type="text" class="input-xlarge datepicker" id="rdv" placeholder="Rdv" value="<?php echo $rdv;?>">
							  </div>
							</div>
                            <?php /*?><div class="control-group">
							  <label class="control-label" for="f_rdv_1"> 1st Rdv: </label>
							  <div class="controls">
								<input name="f_rdv[]" type="text" class="input-xlarge datepicker" id="f_rdv_1" placeholder="1st Rdv" value="">
							  </div>
							</div><?php */?>
                            
							<div class="form-actions">
                            	<input type="hidden" name="client_id" value="<?php echo $client->client_id;?>" />
                                <input type="hidden" name="case_id" value="<?php echo $client->id;?>" />
							  <button type="button" class="btn" onClick="goBack();">Cancel</button>
                              <input name="submit" type="submit" class="btn btn-primary" value="Valid" />
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