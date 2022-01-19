<?php


function insert_new_application_function(){
    // check if name is empty or not

  if ( !isset($_POST['fname']) ) {
      return;
  }

  if (!file_exists($_FILES['resume']['tmp_name']) || !is_uploaded_file($_FILES['resume']['tmp_name'])) {
      echo'<div style="margin-left:50px;"><h3>Resume not uploaded</h3></div>';
      return;
      }

  // Do some minor form validation to make sure there is content
  if (strlen($_POST['submit']) < 3) {
      echo '<div style="margin-left:50px;"><h3>Please enter a name. Titles must be at least three characters long.</h3></div>';
      return;
  }

  //check file type and upload file data, if it is not correct exit the function
  $supported_types = array('application/pdf');
  $arr_file_type = wp_check_filetype(basename($_FILES['resume']['name']));
  $uploaded_type = $arr_file_type['type'];
  $upload = wp_upload_bits($_FILES['resume']['name'], null, file_get_contents($_FILES['resume']['tmp_name']));
     
  if(in_array($uploaded_type, $supported_types)) {
      if(isset($upload['error']) && $upload['error'] != 0) {   
          die('<div style="margin-left:50px;"><h3>there was an error uploading your file</h3></div>') ;
      }
          else{
              $applicationName =$_POST["fname"]." ".$_POST["sname"];
              $post =array(
                  'post_title'    => $applicationName ,
                  'post_status'   => 'publish',   
                  'post_type' 	=> 'application'
              );
              //inser the post and getting the id
                  $application_id = wp_insert_post($post);
                  //updating the inserted post meta values
                  update_post_meta($application_id, "fname", $_POST["fname"] );
                  update_post_meta($application_id, "sname", $_POST["sname"] );
                  update_post_meta($application_id, "birthdate", $_POST["birthdate"] );
                  update_post_meta($application_id, "email", $_POST["email"] );
                  update_post_meta($application_id, "pnumber", $_POST["pnumber"] );
                  update_post_meta($application_id, "caddress", $_POST["caddress"] );
                  update_post_meta($application_id, "resume", $upload );
                  update_post_meta($application_id, "jobname", get_the_title() );  
                  wp_set_object_terms( $application_id, 'Pending', 'application_status' );
                  
                  echo '<div style="margin-left:50px;"><h3> Application Submited Successfuly</h3></div>';
          }
  } else {
          die('<div style="margin-left:50px;"><h3>File Type Not supported</h3></div>') ;
    }

  }