<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="A interactive space to learn about what I am working on, simply click on the icons to learn more about what I'm learning about. Additionally, there is a contact form for visitors to reach out with messages.">
		<title>WORK -- Christopher Sims</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<link rel="stylesheet" href="styles.css">
		<link rel="icon" href="img/CS.png" type="image/png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
	</head>

	<body>

		<!--Header-->
		<div class="container text-content header">
			<div class = "row mt-2">
				<div class="col-4 name"><a href="Sims_Christopher_Resume.pdf" id="resume"  download target="_blank">Christopher Sims</a></div>
				<div class="col heading"><a href="index.html">.about()</a></div>
				<div class="col heading"><a href="work.php">.work()</a></div>
				<div class="col heading"><a href="blog.php">.blog()</a></div>
				<div class="col-2 heading d-flex justify-content-around">
					<a href="https://www.linkedin.com/in/christopherleesims/" target="_blank"><i class="bi bi-linkedin"></i></a>
					<a href="https://github.com/clrsims?tab=projects" target="_blank"><i class="bi bi-github"></i></a>
					<a href="https://www.instagram.com/chrislrsims/" target="_blank"><i class="bi bi-instagram"></i></a>
				</div>
			</div>
		</div>

		<div class="container very-small-padding">
			<div class="row ">
				<div class="col-12 text-content">
					<span class="work-message">This is what I'm currently working on.</span>
				</div>
			</div>
		
			<div class = "row justify-content-around text-center">

				<a class="col-3 outline square" href="math.html">
						<p>Math</p>
						<i class="bi bi-calculator-fill square-icon"></i>
				</a>

				<a class="col-3 outline square" href="coding.html">
					<p>Coding</p>
					<i class="bi bi-laptop square-icon"></i>
				</a>

			
				<a class="col-3 outline square" href="data.html">
					<p>Data</p>
					<i class="bi bi-database square-icon"></i>
				</a>
				
			</div>

			<!--PHP MAIL CONTACT SYSTEM-->
			<div class="row">
				
				<div class="container form-text">

					<div class="row">
						<div class="col-12 form-title">
							<span>Reach out to me here!</span>
						</div>
					</div>

					<form action="work.php" method="POST">

						<div class="row">
							<div class="col-7 cool-outline">

								<div class="form-group row contact-form-row">
									<label class="col-4 col-form-label d-flex justify-content-end" for="name"><span class="font-text">Name:</span></label>
									<div class="col-5">
										<input class="contact-text" type="text" id="name" name="name">
									</div>
								</div>
								
								<div class="form-group row contact-form-row ">
									<label class="col-4 col-form-label d-flex justify-content-end" for="email">Email:</label>
									<div class="col-5">
										<input class="contact-text" type="email" id="email" name="email"> <!-- Corrected type -->
									</div>
								</div>

								<div class="form-group row contact-form-row ">
									<label class="col-4 col-form-label d-flex justify-content-end" for="subject">Subject:</label> <!-- Corrected `for` attribute -->
									<div class="col-5">
										<input class="contact-text" type="text" id="subject" name="subject">
									</div>
								</div>

								<div class="form-group row contact-form-row">
									<label class="col-4 col-form-label d-flex justify-content-end" for="content">Message:</label> <!-- Corrected `for` attribute -->
									<div class="col-5">
										<textarea class="contact-textarea" id="content" name="content" rows="6"></textarea>
									</div>
								</div>

								<div class="form-group row d-flex justify-content-center">
									<div class="col-6 button-margins d-flex justify-content-around margin-left">
										<button class="contact-submit" type="submit">Submit</button>
										<button class="contact-delete" type="reset">Reset</button>
									</div>
								</div> 


							</div>
						</div>	

					</form>
				</div>
			</div>

			<?php

				use PHPMailer\PHPMailer\PHPMailer;
				use PHPMailer\PHPMailer\Exception;

				require 'config/vendor/autoload.php'; 

				$mail = new PHPMailer(true);

				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username   = 'chrislrsims@gmail.com'; 
				$mail->Password   = 'rqsu rlkp wtvc loej';  
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       
				$mail->Port       = 587;    
				$mail->addAddress('clsims@usc.edu', 'Christopher Sims'); 

				try {
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						if (isset($_POST['name']) && isset($_POST['subject']) && isset($_POST['email']) && isset($_POST['content'])) {
							$name = $_POST['name'];
							$subject = $_POST['subject'];
							$emailFrom = $_POST['email'];
							$content = $_POST['content'];

							$mail->setFrom('chrislrsims@gmail.com', $name);
							$mail->addReplyTo($emailFrom, $name);

							$mail->isHTML(true);
							$mail->Subject = $subject;
							$mail->Body = 'From ' . $name . ' on my personal website.<br><br>' . $content;
							$mail->AltBody = $content;

							if ($mail->send()){
								echo "<script>alert('Email sent successfully!')</script>";
							} else {
								echo "<script>alert('Email sending failed.')</script>";
							}

						}  else {
							echo "<script>alert('Please fill out all fields')</script>";
						}

					}
				} catch (Exception $e) {
					echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
				}
			?>


		</div>

		

		<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
		<script>

		document.addEventListener("DOMContentLoaded", function() {
			const observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
					} else {
						entry.target.classList.remove('is-visible');
					}
				});
			}, {
				threshold: 0.5 // Adjust as necessary
			});

			document.querySelectorAll('.text-section').forEach((section) => {
				observer.observe(section);
			});
		});

			document.getElementById('resume').addEventListener('click', function(event) {
				if (!confirm('Would you like to download my resume?')) {
					event.preventDefault();
				}
			});

			// adds an active class that selects only the a tag link the window is on
			document.addEventListener("DOMContentLoaded", function() {
				var links = document.querySelectorAll('a');
				var current = window.location.href;

				links.forEach(function(link) {
					if (link.href === current) {
						link.className += ' active';
					}
				});
			});


		</script>

	</body>
    
</html>
