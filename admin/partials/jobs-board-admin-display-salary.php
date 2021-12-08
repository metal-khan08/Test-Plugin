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

echo  '<input type="number" name="salary_custom_input" id="custom_input" value=""/>';

function save_salary_data(){
    global $post;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return $post ->ID;
    }

    update_post_meta( $post ->ID, 'salary_custom_input', $_POST["salary_custom_input"] );
}
?>


<!-- This file should primarily consist of HTML with a little bit of PHP. -->