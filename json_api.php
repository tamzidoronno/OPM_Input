<?php 
//include("class/class.admin.php");
//$lawyer = new lawyerController();

                       
$conn       = new mysqli('localhost','root','','thelived_profile2' );
									
$officers_list_sql = "SELECT p.*,o.* FROM profile_primary p LEFT JOIN officer_skills_primary o ON(o.BA_No=p.BA_No)  AND (o.BA_No_Type=p.BA_No_Type)  WHERE 	(p.BA_No=o.BA_No AND p.BA_No_Type=o.BA_No_Type )  AND p.flag=0 AND o.flag=0 ";

								
$officers_query = $conn->query($officers_list_sql);

while($officerquery = $officers_query->fetch_object()){
    $officer[]=$officerquery;
}


	$query1 = $conn->query("SELECT * FROM `educational_qualification_primary` WHERE `flag`=0 ");

	
while($edresult = $query1->fetch_object()){
     $eduresult[]=$edresult;
 }
$query2 = $conn->query("SELECT * FROM `military_courses_primary` WHERE `flag`=0");

 while($mlresult = $query2->fetch_object()){
     $mili_result[]=$mlresult;
 }
$query3 = $conn->query("SELECT * FROM `foreign_assignments_primary` WHERE `flag`=0   ");

 while($fr_result = $query3->fetch_object()){
     $fori_result[]=$fr_result;
 }

$query45 = $conn->query("SELECT * FROM `publications_articles_thesis_projects_primary` WHERE `flag`=0 ");

 while($pbresult = $query45->fetch_object()){
     $publicresult[]=$pbresult;
 }
$query5 = $conn->query("SELECT * FROM `specialized_certified_qualification_primary` WHERE `flag`=0 ");

 while($spresult = $query5->fetch_object()){
     $spe_result[]=$spresult;
 }

$query6 = ("SELECT * FROM `un_mission_primary` WHERE `flag`=0 ");
$resultsql = $conn->query($query6);

// $un_result = mysqli_fetch_assoc($resultsql);

 while($result = $resultsql->fetch_object()){
     $un_result[]=$result;
 }
//var_dump($un_result);


$datapass=array('profile'=>$officer,'education'=>$eduresult,'military'=>$mili_result,'foriegn'=>$fori_result,'mission'=>$un_result,'special'=>$spe_result,'publications'=>$publicresult);
echo json_encode($datapass);


?>