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



<!------------------settings page for the jobs board------------------------>

<div class='settings-back-div'>
<form method="post" action="options.php">
    <?php
    settings_fields( 'jobsBoardSettings' );
    do_settings_sections( 'jobsBoardSettings' );
    ?>
  <div class="form-group">
    <label for="fsettings">First Settings</label>
    <input type="text" class="form-control" id="fsettings" name="fsettings" aria-describedby="emailHelp" value="<?php echo get_option( 'fsettings' ); ?>">
  </div>
  <div class="form-group">
    <label for="Ssettings">Second Settings</label>
    <input type="text" class="form-control" id="Ssettings" name="Ssettings" value="<?php echo get_option( 'Ssettings' ); ?>">
  </div>
  <button type="submit" class="btn btn-danger">Submit</button>
</form>
</div>