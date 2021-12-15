<?php  get_header();


if(isset($_POST["submit"]))
{   


    insert_new_application_function();
    return 'data entered succefuly';
} 

?>

<h1>Apply Now</h1>
<form class="application_form" method="POST" action="">
<label for="name"><strong>Full Name</strong></label><br>
<input type="text" name="fname" id="fname" placeholder="First Name"><br>
<input type="text" id="sname" name="sname" placeholder="Last Name"><br>
<label for="birthdate"><strong>Birth Date</strong></label><br>
<input type="date" id="birthdate" name="birthdate" ><br>
<label for="email"><strong>Email Address</strong></label><br>
<input type="text" id="email" name="email" placeholder="ex:abc@email.com"><br>
<label for="pnumber"><strong>Phone Number</strong></label><br>
<input type="text" id="pnumber" name="pnumber" placeholder="123-45-678"><br>
format: 123-45-678<br>
<label for="caddress"><strong>Current Address</strong></label><br>
<input type="text" id="caddress" name="caddress" placeholder="Enter Address"><br>

<label for="resume"><strong>Upload Resume</strong></label><input type="file" name="resume" id="resume">

<input style="width: 150px; margin-top:20px;" type="submit" name="submit" value="Apply">


</form>


<?php

function insert_new_application_function(){
  
    if ( !isset($_POST['fname']) ) {
        return;
    }


    // Do some minor form validation to make sure there is content
    if (strlen($_POST['submit']) < 3) {
        echo 'Please enter a name. Titles must be at least three characters long.';
        return;
    }

    $applicationName = $_POST['fname'] ." ". $_POST['sname'];
    $post =array(
        'post_title'    => $applicationName ,
        'post_status'   => 'publish',   
        'post_type' 	=> 'application'

    );
    $file_name = $_FILES['file']['name'];
    $application_id = wp_insert_post($post);
        update_post_meta($application_id, "fname", $_POST["fname"] );
		update_post_meta($application_id, "sname", $_POST["sname"] );
		update_post_meta($application_id, "birthdate", $_POST["birthdate"] );
		update_post_meta($application_id, "email", $_POST["email"] );
        update_post_meta($application_id, "pnumber", $_POST["pnumber"] );
        update_post_meta($application_id, "caddress", $_POST["caddress"] );
        update_post_meta($application_id, "resume", $_POST["resume"] );

        echo 'your application was added succesfuly <br>';
}

get_footer();

