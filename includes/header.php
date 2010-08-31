<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Parallelus" />
	<meta name="description" content="A brief description of this website or your business." />
	<meta name="keywords" content="keywords, or phrases, associated, with each page, are best" />
	<title>Unite - Together is Better (created by Parallelus)</title>
	
	<!-- Favorites icon -->
	<link rel="shortcut icon" href="http://para.llel.us/favicon.ico" />
	
	<!-- Style sheets -->
	<link rel="stylesheet" type="text/css" href="css/reset.min.css" />
	<link rel="stylesheet" type="text/css" href="css/menu.min.css" />
	<link rel="stylesheet" type="text/css" href="css/fancybox.css" />
	<link rel="stylesheet" type="text/css" href="css/tooltip.min.css" />
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	   
	<link rel="stylesheet" type="text/css" href="css/mio.css" />
	
	<!-- jQuery framework and utilities -->
	<script type="text/javascript" src="js/jquery-1.4.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.min.js"></script>
	<script type="text/javascript" src="js/hoverIntent.min.js"></script>
	<script type="text/javascript" src="js/jquery.bgiframe.min.js"></script>
	<!-- Drop down menus -->
	<script type="text/javascript" src="js/superfish.min.js"></script>
	<script type="text/javascript" src="js/supersubs.min.js"></script>
	<!-- Tooltips -->
	<script type="text/javascript" src="js/jquery.cluetip.min.js"></script>
	<!-- Input labels -->
	<script type="text/javascript" src="js/jquery.overlabel.min.js"></script>
	<!-- Anchor tag scrolling effects -->
	<script type="text/javascript" src="js/jquery.scrollTo-min.js"></script>
	<script type="text/javascript" src="js/jquery.localscroll-min.js"></script>
	<!-- Inline popups/modal windows -->
	<script type="text/javascript" src="js/jquery.fancybox-1.2.6.pack.js"></script>		
	<!-- Font replacement (cufón) -->
	<script src="js/cufon-yui.js" type="text/javascript"></script>
	<script src="js/LiberationSans.font.js" type="text/javascript"></script>

	<!-- IE only includes (PNG Fix and other things for sucky browsers -->
	
	<!--[if lt IE 7]>
		<link rel="stylesheet" type="text/css" href="css/ie-only.css">
		<script type="text/javascript" src="js/pngFix.min.js"></script>
		<script type="text/javascript"> 
			$(document).ready(function(){ 
				$(document.body).supersleight();
			}); 
		</script> 
	<![endif]-->
	<!--[if IE]><link rel="stylesheet" type="text/css" href="css/ie-only-all-versions.css"><![endif]-->
	
	
	<!-- BEGIN: For Demo Only -->
		<!--			
		These entries are only needed for demo features, such as the real-time skin changer.
		They can be deleted for production installs without effecting the theme's design or 
		any of the funcionality.
		-->
		<script type="text/javascript" src="js/demo.js"></script>	
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
	<!-- END: For Demo Only -->
	

	<!-- Functions to initialize after page load -->
	<script type="text/javascript" src="js/onLoad.min.js"></script>
	
	<!-- form validation scripts (for contact page) -->
	<script src="js/jquery.validate.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	   
   $(document).ready(function(){
      $('#CommentForm').attr('autocomplete', 'off'); 
      $("#UserName").focus();

   });
   
   $.validator.addMethod("username", function(value) {
        return /^[a-z0-9\_]+$/i.test(value);
   }, "Username must contain only letters, numbers, or underscore.");
   
	   
	$.validator.addMethod('validChars', function (value) {

		var result = true;

		// unwanted characters

		var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?";

        for (var i = 0; i < value.length; i++) {

			if (iChars.indexOf(value.charAt(i)) != -1) {

				return false;
			}

		}

		return result;


   }, '');

   $().ready(function() {
	
   	// validate signup form on keyup and submit
   	$("#CommentForm").validate({
   		
   		rules: {
   			UserName: {
   				required: true,
   				minlength: 3,
   				maxlength: 20,
   				username: true		
//   				remote: {
//   			        url: "checkuser.php",
//   			        type: "post"
//   		        }
   			},
   			Password: {
   				required: true,
   				minlength: 5,
   				maxlength: 20
   			},
   			RepeatPassword: {
     				equalTo: "#Password"
   			},
   			Email: {
   				required: true,
   				email: true
//   				remote: {
//   			        url: "check-email.php",
//   			        type: "post"
//   		        }				
   			},
   			recaptcha_response_field: {
   				required: true
   			}   			
   		},
   		
   		messages: {
   			UserName: {
   				required: "Debe informar el nombre de usuario",
   				minlength: "El nombre de usuario debe tener al menos 3 carácteres",
   				maxlength: "El nombre de usuario debe tener como máximo 20 carácteres",
   				username: "El nombre de usuario sólo debe contener letras y números"
   			},
   			Password: {
   				required: "Debe informar la clave",
   				minlength: "La clave debe tener al menos 5 carácteres",
   				maxlength: "La clave debe tener como máximo 20 carácteres"
   			},
   			RepeatPassword: {
   	 		   equalTo: "No ha tecleado la misma clave"
   			},
   			Email: {
   				required: "Debe informar el email",
   				email: "Debe introducir un email válido"
    			},   			
   			recaptcha_response_field: {
   				required: "Debe informar el código de seguridad"   				
    			}   	    			
   		}
   	});
   	
   });	   
	</script>
	

   <script type="text/javascript">
             var RecaptchaOptions = {
                theme: 'custom',
                lang: 'es',
                custom_theme_widget: 'recaptcha_widget'
             };
   </script>	
   
</head>
<body>

<!-- Top reveal (slides open, add class "topReveal" to links for open/close toggle ) -->
<div id="ContentPanel">

	<!-- close button -->
	<a href="#" class="topReveal closeBtn">Close</a>
	
	<div class="contentArea">

		<!-- New member registration -->
		<div class="right" style="margin:10px 0 0;">
			<h1>
				Not a member yet?
				<span>Register now and get started.</span>
			</h1>
			<button type="button">Register for an account</button>
		</div>
		
		<!-- Alternate Login -->				
		<div>
			<form class="loginForm" method="post" action="" style="height:auto;">
				<div id="loginBg"><img src="images/icons/lock-and-key-110.png" width="110" height="110" alt="lock and key" /></div>
				<h2 style="margin-top: 20px;">Sign in to your account.</h2>
				<fieldset>
					<legend>Account Login</legend>
					<p class="left" style="margin: 0 8px 0 0;">
						<label for="RevealUsername" class="overlabel">Username</label>
						<input id="RevealUsername" name="RevealUsername" type="text" class="loginInput textInput rounded" />
					</p>
					<p class="left" style="margin: 0 5px 0 0;">
						<label for="RevealPassword" class="overlabel">Password</label>
						<input id="RevealPassword" name="RevealPassword" type="password" class="loginInput textInput rounded" />
					</p>
					<p class="left" style="margin: -7px 0 0;">
						<button type="submit" class="btn" style="margin:0;"><span>Sign in</span></button>
					</p>
				</fieldset>
				<p class="left noMargin">
					<a href="#">Forgot your password?</a>
				</p>
			</form>		
		</div>
		
		<!-- End of Content -->
		<div class="clear"></div>
	
	</div>
</div>

<!-- Site Container -->
<div id="Wrapper">
	<div id="PageWrapper">
		<div class="pageTop"></div>
		<div id="Header">
		
			<!-- Main Menu -->
			<div id="MenuWrapper">
				<div id="MainMenu">
					<div id="MmLeft"></div>
					<div id="MmBody">
						
						<!-- Main Menu Links -->
						<ul class="sf-menu">
							<li class="current"><a href="index.html">Home</a></li>
							<li>
								<a href="#">Features</a>
								<ul>
									<li><a href="#">Home page</a>
										<ul>
											<li><a href="index.html">Home 1 (default)</a></li>
											<li><a href="index-2.html">Home 2 (CU3ER)</a></li>
											<li><a href="index-3.html">Home 3 (GalleryView)</a></li>
										</ul>
									</li>
									<li><a href="sample-portfolio.html">Portfolio</a></li>
									<li><a href="sample-blog.html">Blog</a></li>
									<li>
										<a href="sample-login.html" class="login">Login</a>
										<ul>
											<li><a href="sample-login.html" class="login">Style 1 (popup)</a></li>
											<li><a href="#ContentPanel" class="topReveal">Style 2 (slide)</a></li>
										</ul>
									</li>
									<li><a href="sample-text.html">Text Styles</a></li>
									<li><a href="theme-information.html">About the Theme</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Skins</a>
								<ul>

									<li>
										<a href="#" onclick="switchSkin('1');">Skin 1</a>
										<ul>
											<li style="text-align:center;"><a href="#" onclick="switchSkin('1');"><img class="skin" src="images/content/skin-changer/skin-1.jpg" height="250" alt="Skin 1" /></a></li>
										</ul>
									</li>
									<li>
										<a href="#" onclick="switchSkin('2');">Skin 2</a>
										<ul>
											<li style="text-align:center;"><a href="#" onclick="switchSkin('2');"><img class="skin" src="images/content/skin-changer/skin-2.jpg" height="250" alt="Skin 2" /></a></li>
										</ul>
									</li>
									<li>
										<a href="#" onclick="switchSkin('3');">Skin 3</a>
										<ul>
											<li style="text-align:center;"><a href="#" onclick="switchSkin('3');"><img class="skin" src="images/content/skin-changer/skin-3.jpg" height="250" alt="Skin 3" /></a></li>
										</ul>
									</li>
									<li>
										<a href="#" onclick="switchSkin('4');">Skin 4</a>
										<ul>
											<li style="text-align:center;"><a href="#" onclick="switchSkin('4');"><img class="skin" src="images/content/skin-changer/skin-4.jpg" height="250" alt="Skin 4" /></a></li>
										</ul>
									</li>
									<li>
										<a href="#" onclick="switchSkin('5');">Skin 5</a>
										<ul>
											<li style="text-align:center;"><a href="#" onclick="switchSkin('5');"><img class="skin" src="images/content/skin-changer/skin-5.jpg" height="250" alt="Skin 5" /></a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li>
								<a href="sample-layout.html">Layout</a>
								<ul>
									<li><a href="sample-layout.html">Default Page</a></li>
									<li><a href="sample-layout.html#full_page">Full Page</a></li>
									<li><a href="sample-layout.html#blog_page">Blog</a></li>
									<li><a href="sample-layout.html#multi_column_page">2 &amp; 3 Column</a></li>
								</ul>
							</li>	
							<li><a href="sample-contact.html">Contact</a></li>	
						</ul>
						
						<div class="mmDivider"></div>				
						
						<!-- Extra Menu Links -->
						<ul id="MmOtherLinks" class="sf-menu">
							<li>
								<a href="#"><span class="mmFeeds">Feeds</span></a>
								<ul>
									<li><a href="#"><span class="mmRSS">RSS</span></a></li>
									<li><a href="#"><span class="mmFacebook">Facebook</span></a></li>
									<li><a href="#"><span class="mmTwitter">Twitter</span></a></li>
								</ul>
							</li>
							<li><a href="sample-login.html" class="login"><span class="mmLogin">Login</span></a></li>
						</ul>
						
					</div>
					<div id="MmRight"></div>
				</div>
			</div>
			
			<!-- Search -->
			<div id="Search">
				<form action="#" id="SearchForm" method="post">
					<p style="margin:0;"><input type="text" name="SearchInput" id="SearchInput" value="" /></p>
					<p style="margin:0;"><input type="submit" name="SearchSubmit" id="SearchSubmit" class="noStyle" value="" /></p>
				</form>
			</div>
			
			<!-- Logo -->
			<div id="Logo">
				<a href="index.html"></a>
			</div>
			
			<!-- End of Content -->
			<div class="clear"></div>
		
		</div>
		
		<div class="pageMain">