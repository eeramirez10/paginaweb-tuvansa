<?php
//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}

	//Check to make sure that the subject field is not empty
	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'ventasmex@tuvansa.com.mx'; //Put your own email address here
		$body = "Nombre: $name \n\nE-mail: $email \n\nComentarios:\n $comments";
		$headers = 'From:  <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tuvansa | Contact</title>

    <meta content='Empresa Mexicana con más de cinco décadas en la comercialización de Tubería, Válvulas y Conexiones para uso industrial' name='description' />
		<meta name='author' content='De Puro Corazón'/>
		<meta name="distribución" content="global"/>
		<meta name="language" content="en"/>

		<likn rel="shortcut icon" href="favicon.ico" />

    <link rel="stylesheet" type="text/css" href="css/general-styles.css" />
		<link rel="stylesheet" type="text/css" href="css/menu_sideslide.css" />
		<link rel="stylesheet" type="text/css" href="css/form.css" />

		<script src="js/modernizr.custom.js"></script>

		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>

    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>

	<!-- MENU RESPONSIVE -->
	<div class="menu-wrap">
		<div class="menu">
			<div class="icon-list">
				<a href="index.html" target="_self"><span>Home</span></a>
				<a href="quienes-somos.html" target="_self"><span>Who we are</span></a>
				<a href="productos.html" target="_self"><span>Our products</span></a>
				<a href="sistemas-de-calidad.html" target="_self"><span>Quality Systems</span></a>
				<a href="sucursales.html" target="_self"><span>Branches</span></a>
        <!-- <a href="media.html" target="_self"><span>Media</span></a> -->
				<a href="contacto.php" target="_self"><span>Contact</span></a>
				<a href="../index.html" target="_self"><span><img src="imgs/mexicoFlagIcon.gif"></span></a>			</div>
		</div>
		<button class="close-button" id="close-button">Close Menu</button>
	</div>
	<button class="menu-button" id="open-button">Menu</button>

	<header class="wow fadeInDown" data-wow-duration="1s">
		<div>
			<div class="logo">
				<a href="index.html"><img src="imgs/logo-tuvansa.png" alt="Tuvansa"></a>
			</div>
			<nav id="menu">
				<ul>
					<a href="quienes-somos.html" target="_self"><li>Who we are</li></a>
					<a href="productos.html" target="_self"><li>Products</li></a>
					<a href="sistemas-de-calidad.html" target="_self"><li>Quality Systems</li></a>
					<a href="sucursales.html" target="_self"><li>Branches</li></a>
          <!-- <a href="media.html" target="_self"><li>Media</li></a> -->
					<a href="contacto.php" target="_self"><li>Contact</li></a>
					<a href="../index.html" target="_self"><li><img src="imgs/mexicoFlagIcon.gif"></li></a>
				</ul>
			</nav>
		</div>
	</header>

	<div class="container">
		<div class="big-banner banner-contacto">
			<div>
				<h2>We are a proudly Mexican company with more than five decades of experience.</h2>
				<p>We have extensive experience commercializing pipes, valves and fittings for industrial use.</p>
			</div>
		</div>

		<div class="quienes">
			<div class="title">
				<h1>Contact Us</h1>
			</div>
			<div class="columna six">
				<div id="contacto-wrapper">
					<?php if(isset($hasError)) { //If errors are found ?>
						<p class="error">Please make sure you fill all fields correctly.</p>
					<?php } ?>

					<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
						<p class="send"><strong>Your message has been sent successfully</strong></p>
						<p>Thanks <strong><?php echo $name;?></strong> for sending your comments, very soon we will contact you.</p>
					<?php } ?>

					<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactoform">
						<div>
						    <label for="name"><strong>Name:</strong></label>
							<input type="text" size="50" name="contactname" id="contactname" value="" class="required" />
						</div>

						<div>
							<label for="email"><strong>Email:</strong></label>
							<input type="text" size="50" name="email" id="email" value="" class="required email" />
						</div>

						<div>
							<label for="subject"><strong>Subject:</strong></label>
							<input type="text" size="50" name="subject" id="subject" value="" class="required" />
						</div>

						<div>
							<label for="message"><strong>Message:</strong></label>
							<textarea rows="5" cols="50" name="message" id="message" class="required"></textarea>
						</div>
					  <input type="submit" value="Send" name="submit" class="btn" />
					</form>
				</div>
			</div>
			<div class="columna three">
				<!-- <strong>Tuvansa México</strong><br>
				Retorno de San Buenaventura 12<br>
				Fracc. Ind. San Buenaventura<br>
				Apdo. 180, C.P. 54135,<br>
				Tlalnepantla, Edo. Méx.<br>
				t. (55) 5039.0730<br>
				f. (55) 5039.0746<br>
				<a href="mailto:ventasmex@tuvansa.com.mx">ventasmex@tuvansa.com.mx</a> -->
			</div>

		</div>

		<div class="cita-mas">

		</div>
	</div>

	<footer>
		<div class="derechos">
			<p>® 2014. ALL RIGHTS RESERVED</p>
		</div>
	</footer>

	<!-- MENU RESPONSIVE -->
	<script src="js/classie.js"></script>
	<script src="js/main.js"></script>

	<script>
		$(window).scroll(function() {
		    var scroll = $(window).scrollTop();

		    if (scroll >= 100) {
		        $("header").addClass("scroll");
		    } else {
		        $("header").removeClass("scroll");
		    }
		});
	</script>

	<script src="js/jquery.min.js" type="text/javascript"></script>
  <script src="js/jquery.validate.pack.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#contactform").validate();
		});
	</script>

</body>
</html>

