jQuery(document).ready(function(){
	jQuery('input[rel="phone"]').keypress(function (e){
	  var charCode = (e.which) ? e.which : e.keyCode;
	  //console.log(charCode);
	  if (charCode > 31 && (charCode < 43 || charCode > 57)) {
		  //alert('');
		  return false;
	  }
	});
	
	if(jQuery( ".client-list #keyword").length > 0){
		jQuery( ".client-list #keyword" ).autocomplete({
		  source: searchKeyword
		});
	}
	
	jQuery('select[name="First_Choice"]').bind('change', function(){
		var First_Choice = jQuery('select[name="First_Choice"]').val();
		var Second_Choice = jQuery('select[name="Second_Choice"]').val();
		if(First_Choice){
			jQuery.ajax({	
				url:'ajaxrequest.php',
				type:'post',
				data:'First_Choice='+First_Choice,
				dataType:'html',
				beforeSend: function() {
				},
				success:function(data){
					$('select[name="Second_Choice"]').html(data);
					$('select[name="Second_Choice"]').val(Second_Choice);
				}
			});
		}
	}).change();
	
	function addTableRow(html, appendSection){
		if(jQuery(appendSection).length){
			jQuery(appendSection).append(html);
		}
	}
	
	jQuery(document).on('click', '.removeRow', function(){
		jQuery(this).parents('tr').remove();
	});
	
	jQuery(document).on('click', '#addScnt', function(){
		var html = '<tr><td><select name="Qualification[]" class="input-xlarge"><option value="">Select</option><option value="SSC">SSC</option><option value="HSC">HSC</option><option value="BSc">BSc</option><option value="MSc">MSc</option><option value="PhD">PhD</option></select</td> <td><input type="text" name="Institute[]"></td>    <td><input type="text" name="Division_Subject[]"></td> <td><input type="text" name="Result[]"></td> <td><input type="text" name="Year_Of_Passing[]"></td> <td><input type="text" name="Any_Achivement[]"></td> <td><input type="text" name="Remarks[]"></td> <td><i class="icon-remove removeRow"></i></td></tr>';
		
		addTableRow(html, '#education tbody');
	});
	
	jQuery(document).on('click', '#addMltCs', function(){
		var html = '<tr><td><input type="text" name="Name_Of_The_Course[]" style="width:80px; font-size:12px;"></td> <td><input type="text" name="Location[]" style="width:80px; font-size:12px;"></td><td><input type="text" name="Duration[]" style="width:80px; font-size:12px;"></td> <td><input type="text" name="Result_MT[]"></td> <td><input type="text" name="Year_MT[]"></td> <td><input type="text" name="Position[]"></td> <td><input type="text" name="Any_Achivement_MT[]"></td> <td><input type="text" name="Any_Observation_Remarks[]"></td> <td><i class="icon-remove removeRow"></i></td></tr>';
		
		addTableRow(html, '#Military-Courses tbody');
	});
	
	jQuery(document).on('click', '#addFoAss', function(){
		var html = '<tr><td><select name="Assignments[]"><option value="">Select</option><option value="Course">Course</option><option value="Training">Training</option><option value="PSI">PSI</option><option value="Visit">Visit</option><option value="Seminar">Seminar</option></select></td> <td><input type="text" name="Assignment_Details[]"></td> <td><input type="text" name="Country[]"></td><td><input type="Date" name="From_Date_FA[]"></td> <td><input type="Date" name="To_Date_FA[]"></td> <td><input type="" name="Duration_FA[]"></td> <td><input type="text" name="Remarks_FA[]"> </td> <td><i class="icon-remove removeRow"></i></td></tr>';
		
		addTableRow(html, '#Foreign-Assignments tbody');
	});
	
	jQuery(document).on('click', '#addUNMiss', function(){
		var html = '<tr><td><input type="text" name="Mission_Name[]"></td> <td><input type="text" name="Country_UNM[]"></td> <td><input type="text" name="Year_UNM[]"></td> <td><input type="text" name="Details[]"></td> <td></td> <td><i class="icon-remove removeRow"></i></td></tr>';
		
		addTableRow(html, '#UN-Mission tbody');
	});
	
	jQuery(document).on('click', '#addCertified', function(){
		var html = '<tr><td><input type="text" name="Name_Of_The_Qualification[]"></td> <td><input type="text" name="Institution_SQ[]"></td> <td><input type="text" name="Result_SQ[]"></td><td><input type="text" name="Year_Of_Participation_SQ[]"></td> <td><input type="text" name="Remarks_SQ[]"></td> <td><i class="icon-remove removeRow"></i></td></tr>';
		
		addTableRow(html, '#Certified-Qualification tbody');
	});
	
	jQuery(document).on('click', '#addPublication', function(){
		var html = '<tr><td><input type="text" name="Name_Of_The_Topic[]"></td><td><input type="text" name="Publishing_Authority[]"></td> <td><input type="text" name="Abstract[]"></td> <td><input type="text" name="Year_Of_Passing_PP[]"></td> <td><input type="text" name="Remarks_PP[]"></td> <td><i class="icon-remove removeRow"></i></td></tr>';
		
		addTableRow(html, '#Publications tbody');
	});
});
jQuery('.expand_btn').on('click', function(){
  jQuery('.expand_content').slideToggle();
  jQuery('.expand_btn').toggleClass( "minus" );
});