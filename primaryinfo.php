<?php
require_once("class/class.common.php");
$common = new commonClass();
$common->sessionStart();
include("class/class.admin.php");

$lawyer = new lawyerController();

$error = true;
if(isset($_POST['lawsubmit'])){
    extract($_POST);
    if(!empty($BA_No_Type) && !empty($BA_No))    {
        
        $client_data = $lawyer->addLawyerprimary($_POST);
        
        if($client_data)        {
            $_SESSION['success'] = "Record Added";
            $common->redirect($_SERVER['PHP_SELF']);
            $error = false;
        }
        else{
            $_SESSION['warning'] = "Sorry could not send form data.";
        }
    }
    else{
        $_SESSION['warning'] = "Please fill the (*) fields.";
    }


}
	
$error = true;
if(isset($_POST['submit'])){
    
   // $_SESSION['success'] = "test success message";
   
    $emailErr =  "";
 $email =  "";
    extract($_POST);
    if(!empty($BA_No_Type) && !empty($BA_No)){
          $email  = $_POST['email'];
          $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

         if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||$emailB != $email) {
           $emailErr="Invalid Email"; 
          }
        else{
         $client_data = $lawyer->addprimary($_POST);   
        }
       
        if($client_data !=='BA EXITS'){
            $_SESSION['success'] = "Record Added";
            $common->redirect($_SERVER['PHP_SELF']);
            $error = false;
        }
        
        else{
            $_SESSION['warning'] = "Sorry could not send form data.";
        }
       if($client_data =='BA EXITS'){
            $_SESSION['exit_warning']= "Already Exits BA_NO BA_TYPE.";
        } 
        
    }
    else{
        $_SESSION['warning'] = "Please fill the (*) fields.";
    }


}
					
					?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include(dirname(__FILE__)."/include/head.php");  ?>
    <style>
        .row {
            margin-left: 5px;
        }
        #wrapper {
         text-align:center;
         margin:0 auto;
         padding:0px;
         width:995px;
        }
        #output_image {
         max-width:300px;
        }
        .float-right {
         float: right;
         color: #ffffff;
        }
        /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    padding: 30px;
    border: 1px solid #888;
    width: 27%;
    margin-left: 50%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

    </style>
    <body>
         
        <div class="container">
            <div class="box infobox">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon white edit"></i><span class="break"></span>Primary Info  <?php // if($token) echo $result->BA_No_Type.' '.$result->BA_No ; ?>   </h2>
                    <a class="float-right" href="logout.php">Logout</a>
                </div>
                <div class="box-content">
                    
                         
                        


                            <form action="" name="add-client" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                                <fieldset>
                                    <div class="row">
                                        <div class="span5">
                                           <div class="control-group">
                                                <label class="control-label" for="rank"> Rank: </label>
                                                <div class="controls">
                                                    <input id="rank" class="span5" name="rank" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span5">
                                            <div class="control-group">
                                                <label class="control-label" for=""> E-mail: </label>
                                                <div class="controls">
                                                    <input class="span5" type="text" name="email"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                        
                                    <div class="row">    
                                        <div class="span5">
                                            <div class="control-group">
                                                <label class="control-label" for=""> Full Name: </label>
                                                <div class="controls">
                                                    <input id="" name="full_name" type="text" class="span5" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                        
                                        <div class="row">
                                        <div class="span5">
                                            <div class="control-group">
                                                <label class="control-label" for=""> Present Posting: </label>
                                                <div class="controls">
                                                    <input class="span5" type="text" name="present_posting"><br>
                                                </div>
                                            </div>

                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="span5">
                                            <div class="control-group">
                                                <label class="control-label" for=""> 	Contact Number: </label>
                                                <div class="controls">
                                                    <input class="span3" type="text" name="Contact_No"><br>
                                                </div>
                                            </div>

                                        </div>
                                        </div>
                                        
                                        <div class="row">
                                           <div class="span5">
                                            <div class="control-group">
                                            <label class="control-label" for=""> Image: </label>
                                            <div class="controls">
                                                <input type="file" name="profile-image" onchange="preview_image(event)">
                                             <img id="output_image"/><br>
                                            </div>
                                            </div>
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
                                                        <tr>
                                                            <td>
                                                                <select name="Qualification[]" class="input-xlarge" required>
                                                                <option value="">Select</option>
		                                                        <option value="SSC">SSC</option>
		                                                        <option value="HSC">HSC</option>
		                                                        <option value="BSc">BSc</option>
		                                                        <option value="MSc">MSc</option>		
		                                                        <option value="PhD">PhD</option>
		                                                         </select>
                                                            </td>
                                                            <td><input type="text" name="Institute[]"></td>
                                                            <td><input type="text" name="Division_Subject[]"></td>
                                                            <td><input type="text" name="Result[]"></td>
                                                            <td><input type="text" name="Year_Of_Passing[]"></td>
                                                            <td><input type="text" name="Any_Achivement[]"></td>
                                                            <td><input type="text" name="Remarks[]"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="span2"><span id="addScnt" class="addBtn"><i class="icon-plus"></i></span></div>
                                        </div>
                                    </div>





                                    <div class="control-group">
                                        <label class="control-label" for=""> Military Courses: </label>
                                        <div class="controls">
                                            <div class="table-responsive">
                                                <table border="1" id="Military-Courses">
                                                    <thead>
                                                        <tr>
                                                            <th>Name Of<br> The <br>Course</th>
                                                            <th>Location</th>
                                                            <th>Duration<br>(weeks)</th>
                                                            <th>Result</th>
                                                            <th>Year</th>
                                                            <th>Position</th>
                                                            <th>Any<br>Achievements</th>
                                                            <th>Any Observations/<br> Remarks</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="Name_Of_The_Course[]" style="width:80px; font-size:12px;">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Location[]" style="width:80px; font-size:12px;">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Duration[]" style="width:80px; font-size:12px;">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Result_MT[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Year_MT[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Position[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Any_Achivement_MT[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Any_Observation_Remarks[]">
                                                            </td>
                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="span2"><span id="addMltCs" class="addBtn"><i class="icon-plus"></i></span></div>
                                        </div>
                                    </div>




                                    <div class="control-group">
                                        <label class="control-label" for=""> Foreign Assignments: </label>
                                        <div class="controls">
                                            <div class="table-responsive">
                                                <table border="1" width="100%" id="Foreign-Assignments">
                                                    <thead>
                                                        <tr>
                                                            <th>Assignments</th>
                                                            <th>Assignment<br>Details</th>
                                                            <th>Country</th>
                                                            <th>From</th>
                                                            <th>To</th>
                                                            <th>Duration</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <select name="Assignments[]" required>
        <option value="">Select</option>
		<option value="Course">Course</option>
		<option value="Training">Training</option>
		<option value="PSI">PSI</option>
		<option value="Visit">Visit</option>		
		<option value="Seminar">Seminar</option>
		</select>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Assignment_Details[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Country[]">
                                                            </td>
                                                            <td>
                                                                <input type="Date" name="From_Date_FA[]">
                                                            </td>
                                                            <td>
                                                                <input type="Date" name="To_Date_FA[]">
                                                            </td>
                                                            <td>
                                                                <input type="" name="Duration_FA[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Remarks_FA[]">
                                                            </td>
                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="span2"><span id="addFoAss" class="addBtn"><i class="icon-plus"></i></span></div>
                                        </div>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label" for=""> UN Mission: </label>
                                        <div class="controls">
                                            <div class="table-responsive">
                                                <table border="1" width="100%" id="UN-Mission">
                                                    <thead>
                                                        <tr>
                                                            <th>Mission Name</th>
                                                            <th>Country</th>
                                                            <th>Year</th>
                                                            <th>Details</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="Mission_Name[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Country_UNM[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Year_UNM[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="Details[]">
                                                            </td>
                                                           
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="span2"><span id="addUNMiss" class="addBtn"><i class="icon-plus"></i></span></div>
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
                                                            <th>Certificate</th>
                                                            
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
                                                            <td>
                                                                <input type="file" name="Certificate_File[]">
                                                            </td>
                                                           
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="span2"><span id="addCertified" class="addBtn"><i class="icon-plus"></i></span></div>
                                        </div>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label" for=""> Publications/Articles/<br>Thesis/Projects: </label>
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
                                                            <th>Paper</th>
                                                           
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
                                                            <td>
                                                                <input type="file" name="Paper_File[]">
                                                            </td>
                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="span2"><span id="addPublication" class="addBtn"><i class="icon-plus"></i></span></div>
                                        </div>
                                    </div>



                                    <h3>Skills:</h3>
                                    <div class="four-column-section">
                                    <div class="control-group four-column">
                                        <label class="control-label" for=""> Communication: </label>
                                        <div class="controls">
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
                                            <input type="text" name="Programming_Language[]" value=""><br>
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
                                            <input type="checkbox" name="Reverse_Engineering[]" value="Hardware Reverse Engineering">Hardware Reverse Engineering<br>
                                            <input type="checkbox" name="Reverse_Engineering[]" value="GREM">GREM<br>
                                            <input type="text" name="Reverse_Engineering[]" value=""><br>
                                        </div>
                                    </div>
                                </div>

                                    <h3>Area Of Interest:</h3>
                                    <div class="four-column-section">
                                    <div class="control-group four-column">
                                        <label class="control-label" for=""> First Choice: </label>
                                        <div class="controls">

                                            <?php 
							
							$area_of_interest_sql = "SELECT * FROM area_of_interest WHERE 1";
							
							$area_of_interest = $lawyer->db->query($area_of_interest_sql);
							
							
						?>
                                            <select name="First_Choice" required>
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


                                    <div class="control-group four-column">
                                        <label class="control-label" for=""> Second Choice: </label>
                                        <div class="controls">
                                            <select name="Second_Choice"  ><option value="" >Select One</option></select>
                                        </div>
                                    </div>
                                </div>

                                  <div class="four-column-section">
                                    <div class="control-group four-column">
                                        <label class="control-label" for=""> Director Signals' Comment: </label>
                                        <div class="controls">
                                            <input type="text" name="Director_Signal_Comment" value=""><br>
                                        </div>
                                    </div>
                                     
                                    </div>
                                   <button class="btn btn-primary" id="myBtn">Save Information</button>
                                   <!-- The Modal -->
                                    <div id="myModal" class="modal">

                                      <!-- Modal content -->
                                      <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <div class="control-group four-column">
                                        <label class="control-label" for=""> Enter a Key to encrypt your data to the database: </label>
                                        <div class="controls">
                                            <input type="text" name="incryptKey" value="<?php echo rand(10,10000000); ?>"><br>
                                        </div>

                                        </div>

                                    <div class="form-actions">
                                        <!-- <button type="button" class="btn" onClick="goBack();">Cancel</button> -->
                                        <input name="lawsubmit" type="submit" class="btn btn-primary" value="Save" />
                                    </div>
                                      </div>

                                    </div>
                                    

                                </fieldset>
                            </form>
                         
                           

                </div>
            </div>
        </div>
        <script type="text/javascript">
            function goBack() {
                window.history.back();
            }


            function preview_image(event) 
            {
             var reader = new FileReader();
             reader.onload = function()
             {
              var output = document.getElementById('output_image');
              output.src = reader.result;
             }
             reader.readAsDataURL(event.target.files[0]);
            }


        </script>

        <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
        <?php include(dirname(__FILE__).'/footer.php');?>
    </body>

    </html>
