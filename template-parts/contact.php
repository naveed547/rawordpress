<?php
/*
Template Name: Contact
*/
?>
<?php
/*global $wpdb; 
$tbl_name = $wpdb->prefix.'feedback'; 
$errors = new WP_Error();	
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "submit-a-plate") {
	$to = 'ahmed.naveed547@gmail.com';
	$subject = 'The subject';
	$body = 'The email body content';
	$headers = array('Content-Type: text/html; charset=UTF-8');

	wp_mail( $to, $subject, $body, $headers );
}*/

?>

<?php 
	/*if($sub_success == 'Success') {
		echo '<div class="success">' . __( 'Thank you we will get back you soon.', 'post_new' ) . '</div>';
		$sub_success = null;
	} 
	if (isset($errors) && sizeof($errors)>0 && $errors->get_error_code()) :
		echo '<ul class="errors">';
		foreach ($errors->errors as $error) {
			echo '<li>'.$error[0].'</li>';
		}
		echo '</ul>';
	endif; */
	print_r($_POST);	
?>
<?php
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
	if(!isset($hasError)) {
		$emailTo = $_POST['email'];
		//if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = $emailTo.','.get_option('admin_email');
		//}
		$subject = '[Acknowledgement Copy] From '.$name;
		//$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$body = get_email_body_wpse_96357();
		$headers = array('Content-Type: text/html; charset=UTF-8');

		$emailSent = wp_mail($emailTo, $subject, $body, $headers);
	}

} ?>

<?php if((isset($emailSent) && $emailSent == true) || (isset($hasError) || isset($captchaError))) { ?>
	<div class="modal fade" tabindex="-1" role="dialog" id="email-success" aria-labelledby="emailSucesseModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="emailSucesseModalLabel">Confirmation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  		<span aria-hidden="true">&times;</span>
					</button>
				</div>
			  	<div class="modal-body">
			  		
					<?php if(isset($emailSent) && $emailSent == true) { ?>
			  			<p>Thanks, your email was sent successfully.</p>
			  		<?php } else { ?>
			  			<p class="error">Sorry, an error occured.<p>
			  		<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<script>
		jQuery(document).ready(function(){
			jQuery("#email-success").modal("show");
		});
	</script>
<?php } ?>
<div class="modal fade" tabindex="-1" role="dialog" id="contact-us" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Contact Us</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  		<span aria-hidden="true">&times;</span>
				</button>
			</div>
		  	<div class="modal-body">
			    <form name="racademy" action="<?php the_permalink(); ?>" id="contactForm" method="post">
			    	<div class="form-group">
				    	<label for="contactName">Name:</label>
				    	<input type="text" class="form-control" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
						<?php if($nameError != '') { ?>
							<span class="error"><?=$nameError;?></span>
						<?php } ?>
				  	</div>
					<div class="form-group">
					    <label for="email">Email</label>
					    <input type="text"  class="form-control" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
						<?php if($emailError != '') { ?>
							<span class="error"><?=$emailError;?></span>
						<?php } ?>
					</div>
				    <!-- <div class="form-group row">
					    <label for="inputPassword3" class="col-sm-2 col-form-label">Message</label>
					    <div class="col-sm-10">
					     <?php $kv_editor_args =  array('media_buttons' => false , 'teeny' => true ); wp_editor( '', 'sws_feedback',  $kv_editor_args ); ?>
					    </div>
				  	</div> -->
				  	<div class="form-group">
					    <label for="commentsText">Message:</label>
					    <textarea name="comments"  class="form-control" id="commentsText" rows="5">
					    	<?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?>
					    </textarea>
						<?php if($commentError != '') { ?>
							<span class="error"><?=$commentError;?></span>
						<?php } ?>
				  	</div>
					<div class="form-group row justify-content-center">
						<div class="col-sm-4">
							<input type="hidden" name="submitted" id="submitted" value="true" />
					  		<button type="submit" class="btn btn-primary btn-block">Submit</button>
						</div>
					</div>	
				</form>
		  	</div>
		</div>
	</div>
</div>