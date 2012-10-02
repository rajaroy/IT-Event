<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>IT-event CMS</title>
<meta  http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/shadowbox.css">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/labelfy.js"></script>
<script type="text/javascript" src="../js/form.validate.js"></script> 
<script type="text/javascript" src="../js/shadowbox.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>

<script type="text/javascript">
Shadowbox.init();
</script>

<script type="text/javascript">
		// Contact formulier controle
		$(document).ready(function() {
			$("#fvujq-form1").validate({
				submitHandler:function(form) {
					SubmittingForm();
				},
				rules: {
					name: {
						required: true,
						letters: true
					},
					email: {
						required: true,
						email: true
					},
					url: {
						url: true
					},
					comment: {
						required: true
					}
				},
				messages: {
					comment: "Vergeet uw bericht niet."
				}
			});
		});

		jQuery.validator.addMethod(
			"selectNone",
			function(value, element) {
				if (element.value == "none")
				{
					return false;
				}
				else return true;
			},
			"Please select an option."
		);

// Registreer formulier controle
		$(document).ready(function() {
			$("#register-form").validate({
				submitHandler:function(form) {
					SubmittingForm();
				},
				rules: {
					voornaam: {
						required: true,
						letters: true
					},
					ww1: {
						required: true
					},
					ww2: {
						required: true,
						equalTo: $("#ww1")
					},
					comment: {
						required: true
					}
				},
				messages: {
					comment: "Vergeet uw bericht niet."
				}
			});
		});

		jQuery.validator.addMethod(
			"selectNone",
			function(value, element) {
				if (element.value == "none")
				{
					return false;
				}
				else return true;
			},
			"Please select an option."
		);

		// Upload titel check
			$(document).ready(function() {
			$("#upload-form").validate({
				submitHandler:function(form) {
					SubmittingForm();
				},
				rules: {
					titel: {
						required: true,
						letters: true
					}
				}
			});
		});

	</script>

</head>
<body>
<div id="page">
<div id="head">
<? include "incs/menu.php"; ?>
</div>

<div id="content">