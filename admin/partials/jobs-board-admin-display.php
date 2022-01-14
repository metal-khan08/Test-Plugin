<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       def.com
 * @since      1.0.0
 *
 * @package    Jobs_Board
 * @subpackage Jobs_Board/admin/partials
 */


 ?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->

        <!--------------------- settings page for the jobs board ------------------------------->


<div class="container" style="margin-top:40px; max-width:70%; text-align:center; border-radius: 20px;">
  <div class="row">
    <div class="col" style="background-color: mistyrose; padding:20px;">
		<h4>Click this button to export Jobs </h4>
        <form id='jobsExport' method="POST" action="">
				<input class='btn btn-primary' type="submit" name="export" value="Export">
    	</form>
    </div>
    <div class="col" style="background-color: papayawhip; padding:20px;">
		<form action="<?php echo admin_url('admin-ajax.php' ) ?>" enctype="multipart/form-data" method="POST" id="importAction">
			<h4>Click this button to import Jobs </h4>
			<input class='btn btn-primary' type="file" name="import">
			<input type="hidden" name="action" value="jobs_board_import_csv">
			<input type="submit" name="import" value="import">
		</form>	
    </div>
  </div>
  <div id="result"></div>


  <!---------------------------- script for ajax -------------------------------->


<script type="text/javascript">
		jQuery('#jobsExport').submit(function(event){
		event.preventDefault();		
		var formD=jQuery("#jobsExport").serialize();
    var formData =new FormData;
    formData.append('action','jobs_board_csv');
		formData.append('jobs_board_csv',formD);
		jQuery.ajax({
			url:my_ajax_object.ajax_url,
			data:formData,
			processData:false,
			contentType: false,
			type:'post',
			success:function(data){
				console.log('success');
				window.open( data );
				jQuery.unlink( data );
				
          }
		});
		});

		
			jQuery(document).ready(function($){
		$('#importAction').ajaxForm({
			success:function(response){
				console.log(response);
				document.getElementById("importAction").reset();
				document.getElementById("result").innerHTML += response;

			}
		});
	});

</script>

