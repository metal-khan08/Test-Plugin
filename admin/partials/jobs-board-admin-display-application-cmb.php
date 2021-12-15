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


 //fetch the value from the database and saved in to variables
global $post;
$data =get_post_custom( $post->ID );
$fnameval=isset($data['fname']) ? esc_attr( $data['fname'][0] ):'no value';
$snameval=isset($data['sname']) ? esc_attr( $data['sname'][0] ):'no value';
$bdateval=isset($data['birthdate']) ? esc_attr( $data['birthdate'][0] ):'no value';
$emailval=isset($data['email']) ? esc_attr( $data['email'][0] ):'no value';
$pnumberval=isset($data['pnumber']) ? esc_attr( $data['pnumber'][0] ):'no value';
$caddresslval=isset($data['caddress']) ? esc_attr( $data['caddress'][0] ):'no value';
 ?>




<!-- this the fields of meta box -->
<ul>
    <label for="name">Full Name</label><br>
    <input type="text" name="fname" id="name" value="<?php echo $fnameval; ?>" placeholder="First name" /><input type="text" name="sname" id="name" value="<?php echo $snameval; ?>" placeholder="second name"/><br>
    <label for="birthdate">Birth date</label><br>
    <input type="date" id="birthdate" name="birthdate" value="<?php echo $bdateva; ?>"/><br>
    <label for="email">Email Address</label><br>
    <input type="text" name="email" id="email" value="<?php echo $emailval; ?>"/><br>
    <label for="pnumber">Phone Number</label><br>
    <input type="text" name="pnumber" id="pnumber" value="<?php echo $pnumberval; ?>"/><br>
    <label for="caddress">Complete Address</label><br>
    <input type="text" name="caddress" id="caddress" value="<?php echo $caddresslval; ?>"/><br>
 </ul>


<!-- This file should primarily consist of HTML with a little bit of PHP. -->
