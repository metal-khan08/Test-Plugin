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



<!------------------settings page for the Application------------------------>

<div class="container " style="margin-top:40px; max-width:50%; text-align:center; border-radius: 20px;">
	<form action="<?php echo admin_url('admin-ajax.php' ) ?>" method="POST" id="applicationExport">
		<div class="row">
			<div class="col" style="background-color: mistyrose; padding:20px;">
			<h4>Start date </h4>
				<input class='btn btn-primary' type="date" name="startDate" id="startDate">
			</div>
			<div class="col" style="background-color: papayawhip; padding:20px;">
				<h4>End Date</h4>
				<input class='btn btn-primary' type="date" name="EndDate" id="EndDate">
			</div>
		</div>
		<div class="row "style="background-color: lightsteelblue; padding:20px;">
			<div class="col">
			<?php
				$args = array(
					'post_type'      => 'application',
					'posts_per_page' => '-1'
				 );
				 $query = new WP_Query($args); ?>
				 <h4>Select the the Job name to Export</h4>
				 <select id="jobname" name="jobname">
				 <option value="" >Select Category</option>
					 <?php
				$jobtype=array();
				while($query->have_posts()) {
				$query->the_post() ;
				$appid=get_the_ID();
				$jobname=get_post_meta( $appid, 'jobname', true );
				if(in_array($jobname,$jobtype) == false){
						echo 	'<option value="'. $jobname .'">'. $jobname .'</option> <br>';
						array_push($jobtype,$jobname);				
					 }			
					  } 
				?>
				</select>
			</div>
		</div>
		<div class="row "style="background-color: lightblue; padding:20px;">
			<div class="col">
				<h4>Click this button to export applications </h4>
				<input type="hidden" name="action" value="func_export_all_posts">
				<input class='btn btn-primary' type="submit" name="export" value="Export">
			</div>
		</div>
  	</form>	
</div>

<div id="result">

</div>




<script type="text/javascript">


		jQuery(document).ready(function($){
		$('#applicationExport').ajaxForm({
			success:function(response){
				window.open( response );
				// document.getElementById("result").innerHTML += response;



			}
		});
	});
</script>

