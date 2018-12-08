<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Dashboard</a></li>
			</ul>

			<div class="row-fluid">
                <div class="span6 offset2"><div class="heading"><h3>Welcome <?php echo $lawyer->name($lawyer_id); ?>, to the Officers' Profile Management Software.</h3></div>
                <div class="group">
                You are logged in as a <b><?php if($_SESSION['group'] == 1): echo "Superadmin"; else: echo "Advocate"; endif; ?></b>
                </div>
                </div>
			</div>
            <br /><br />
            <div class="sortable row-fluid">
            	<?php if($_SESSION['group']==1){ ?>
                	<a data-rel="tooltip" title="All Advocate." class="well span3 top-block" href="lawyers.php">
                        <span class="icon32 icon-red icon-bookmark"></span>
                        <div>All Profile</div>
                        <div></div>
                        <span class="notification"></span>
                    </a>
                    <a data-rel="tooltip" title="Add New Advocate" class="well span3 top-block" href="add_lawyer.php">
                        <span class="icon32 icon-red icon-user"></span>
                        <div>Add Profile</div>
                        <div></div>
                        <span class="notification"></span>
                    </a>
					
				<a data-rel="tooltip" title="Search Client" class="well span3 top-block" href="search_lawyer.php">
					<span class="icon32 icon-eye-open"></span>
					<div>Search Profile</div>
					<div></div>
					<span class="notification yellow"></span>
				</a>
            </div>
            <div class="sortable row-fluid">
                <?php } ?>
				


				
			</div>
          
	
	<div class="clearfix"></div>
</div>