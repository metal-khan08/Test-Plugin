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


<!-- <div class="container" style="margin-top:40px; max-width:70%; text-align:center; border-radius: 20px;">
  <div class="row">
    <div class="col" style="background-color: mistyrose; padding:20px;">
		<h4>Click this button to export Jobs </h4>
        <form id='jobsExport' method="POST" action="">
			<input class='btn btn-primary' type="submit" name="export" value="Export">
    	</form>
    </div>
    <div class="col" style="background-color: papayawhip; padding:20px;">
		<form action="<?php// echo admin_url('admin-ajax.php' ) ?>" enctype="multipart/form-data" method="POST" id="importAction">
			<h4>Click this button to import Jobs </h4>
			<input class='btn btn-primary' type="file" name="import">
			<input type="hidden" name="action" value="jobs_board_import_csv">
			<input type="submit" name="import" value="import">
		</form>	
    </div>
  </div>
  <div id="result"></div> -->
<div class="wrap">
  <form action="options.php" method="POST">
<?php
   // output security fields for the registered setting "jobs-board-settings"
   settings_fields( 'jobs-board-settings' );
   // output setting sections and their fields
   // (sections are registered for "jobs-board-settings", each field is registered to a specific section)
   do_settings_sections( 'jobs-board-settings' );
   // output save settings button
   submit_button( 'Save Settings' );
  ?>
  

  </form>
</div>