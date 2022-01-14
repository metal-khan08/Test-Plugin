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
$gb_classs= "session_class";
		$_SESSION['gb']=isset($gb_classs) ? $gb_classs : '';
		/*session created*/ 
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->



<!------------------settings page for the Application------------------------>

<div class="container <?php echo $_SESSION["gb"] ?>" style="margin-top:40px; max-width:50%; text-align:center; border-radius: 20px;">
  <div class="row alert alert-primary">
    <div class="col-sm">
        <h4>Click this button to export applications </h4>
        <form id='applicationExport' method="POST" action="">
				<input class='btn btn-primary' type="submit" name="export" value="Export">
    	</form>
    </div>
  </div>
</div>


<script type="text/javascript">
		jQuery('#applicationExport').submit(function(event){
		event.preventDefault();		
		var formD=jQuery("#applicationExport").serialize();
    var formData =new FormData;
    formData.append('action','func_export_all_posts');
		formData.append('func_export_all_posts',formD);
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
</script>

