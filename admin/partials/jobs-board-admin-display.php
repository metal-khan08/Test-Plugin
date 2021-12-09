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


 //fetch the vale from the database and saved in to variables
global $post;
$data =get_post_custom( $post->ID );
$locval=isset($data['meta_location']) ? esc_attr( $data['meta_location'][0] ):'no value';
$salval=isset($data['meta_number']) ? esc_attr( $data['meta_number'][0] ):'no value';
$timval=isset($data['meta_timings']) ? esc_attr( $data['meta_timings'][0] ):'no value';
$benval=isset($data['custom_benefits']) ? esc_attr( $data['custom_benefits'][0] ):'no value';
 ?>




<!-- this the fields of meta box -->
<ul>
    <h3>Location</h3>
    <input type="text" name="meta_location" id="meta_location" value="<?php echo $locval?>"/>
    <h3>Salary</h3>
    <input type="range" min="10000" max="100000" name="meta_number" id="meta_number" value="<?php echo $salval ?>"/>
    <h3>Timings</h3>
    <input type="text" name="meta_timings" id="meta_timings" value="<?php echo $timval ?>"/>
    <h3>Benefits</h3>
    <input type="text" name="custom_benefits" id="custom_benefits" value="<?php echo $benval ?>"/>
 </ul>


<!-- This file should primarily consist of HTML with a little bit of PHP. -->
