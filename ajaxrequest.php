<?php 
session_start();
include("class/class.admin.php");
$officer = new lawyerController();

if($_POST['First_Choice']){
					  		$area_of_interest_sql = "SELECT * FROM area_of_interest WHERE courses NOT LIKE '%".$_POST['First_Choice']."%'"; 
							$area_of_interest = $officer->db->query($area_of_interest_sql);

                                	$html = '<option value="" >Select One</option>';
                                    if($area_of_interest->num_rows){
										while($rs = $area_of_interest->fetch_object()){
										$html .= '<option value="'.$rs->courses.'">'.$rs->courses.'</option>';										
										}
										echo $html;
										exit;
									} 

}
?>