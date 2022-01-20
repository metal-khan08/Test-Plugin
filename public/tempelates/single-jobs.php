<?php  get_header();
require_once 'template.php';
if(!empty($isOpen)){

    if(isset($_POST["submit"])){   
    
    insert_new_application_function();
    return;
} 
?>

<h1>Apply Now</h1>
<div class="wrap">
<form  id="jobApplicationForm"  enctype="multipart/form-data" class="application_form" method="POST" action="">
<label for="name"><strong>Full Name</strong></label><br>
<input required type="text" name="fname" id="fname" placeholder="First Name"><br>
<input required type="text" id="sname" name="sname" placeholder="Last Name"><br>
<?php echo isset($showBirthDate)?$showBirthDate:"" ; ?>
<label for="email"><strong>Email Address</strong></label><br>
<input required type="text" id="email" name="email" placeholder="ex:abc@email.com"><br>
<label for="pnumber"><strong>Phone Number</strong></label><br>
<input required type="text" id="pnumber" name="pnumber" placeholder="123-45-678"><br>
<strong>format:</strong> 123-45-678<br>
<?php echo isset($showAddress)?$showAddress:"" ; ?>
<label for="resume"><strong>Upload Resume</strong></label>
<input required type="file" name="resume" id="resume">
<input required type="hidden" name="jobname" value="<?php the_title(); ?>">
<input style="width: 150px; margin-top:20px;" type="submit" name="submit" >
</form>
</div>

<?php
} else{
    
    echo "<div class='wrap'>".$jobClosed."</div>";
}
get_footer();


