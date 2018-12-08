<?php
/*include_once("class/class.admin.php");
$db = new lawyerController();*/
?>
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li><a href="index.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
            <?php if($_SESSION['group']==1){ ?>
            <li><a href="lawyers.php"><i class="icon-bookmark"></i><span class="hidden-tablet"> All Profile</span></a></li>
            <li><a href="add_lawyer.php"><i class="icon-user"></i><span class="hidden-tablet"> Add Profile</span></a></li>
            <li><a href="new_officer.php"><i class="icon-user"></i><span class="hidden-tablet"> New Officer</span></a></li>
            <li><a href="search_lawyer.php"><i class="icon-tasks"></i><span class="hidden-tablet"> Search Profile</span></a></li>
            <?php } ?>
            <?php /* <li><a href="clients.php"><i class="icon-tasks"></i><span class="hidden-tablet"> All Client</span></a></li>	
            <li><a href="add_client.php"><i class="icon-briefcase"></i><span class="hidden-tablet"> Add New Client</span></a></li>
            
            <li><a href="search.php"><i class="icon-eye-open"></i><span class="hidden-tablet"> Search Client</span></a></li>
            <li><a href="rdv.php"><i class="icon-calendar"></i><span class="hidden-tablet"> RDV Fixed</span> <span class="label label-important"> <?php echo $lawyer->rdvCount();?> </span></a></li>
            <li><a href="old_client.php"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Old Client</span></a></li>
            <li><a href="convocation.php"><i class="icon-edit"></i><span class="hidden-tablet"> Convocation Date</span>  <span class="label label-important"> <?php echo $lawyer->convocationCount();?> </span></a></li>
        
		*/ ?> 
		</ul>
    </div>
</div>