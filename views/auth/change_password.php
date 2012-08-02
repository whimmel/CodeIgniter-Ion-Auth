<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
<?php
		echo '<script src="/clinics/static/js/jquery-1.7.1.min.js"></script>';
		echo '<script src="/clinics/static/js/i18n/grid.locale-en.js"></script>';
		echo '<script src="/clinics/static/js/jquery.jqGrid.src.js"></script>';
		echo '<script src="/clinics/static/js/jquery-ui-1.8.16.custom.min.js"></script>';
		echo '<script src="/clinics/static/js/jquery-ui-1.8.16.custom.min.js"></script>';
		echo '<script src="/clinics/static/js/jquery.cookie.js"></script>';	
		echo '<script src="/clinics/static/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>';
		
		echo '<link rel="stylesheet" type="text/css" media="screen" href="/clinics/static/js/css/start/jquery-ui-1.8.16.custom.css" />';
		echo '<link rel="stylesheet" type="text/css" media="screen" href="/clinics/static/js/css/ui.jqgrid.css" />';
		echo '<link href="/clinics/static/css/general.css" rel="stylesheet" type="text/css" />';
		echo '<link href="/clinics/static/css/layout.css" rel="stylesheet" type="text/css" />';
		echo '<link href="/clinics/static/css/clinics_styles.css" rel="stylesheet" type="text/css" />';
		echo '<link href="/clinics/static/js/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />';
?>
	<title>Change Password</title>
	</head>
	<body>
	
		<div id="wrapper">
			<div align="center" style="background:#fff !important;"><br /><img src="<?php echo base_url(); ?>static/imgs/AlereAveeLogo_big.png" height="60" /><br /><br /></div>
			<div id="clinics-title-bar" style="height:40px; padding-top:8px;" align="center">
				<div style="margin-top:3px;">Avee/Alere Laboratories Clinic Portal</div>
			</div>
			<div align="center" id="infoMessage"><?php echo $message;?></div>
			
			<br />
			<div id="clinics-spinner" class="spinner-clinics" style="display:none;">
				<img id="clinics-spinner-img" src="clinics_images/ajax-loader.gif" alt="Loading..."/>
			</div>
			<div id="no_js" style="font-size:14pt; width:600px; margin-left:auto; margin-right:auto;">You must have JavaScript and cookies enabled to use the Clinic Portal</div>
			
			<?php echo form_open("auth/change_password");?>
			
			<table id="login_table" style="visibility:hidden;" width=475 border=1 align="center" cellpadding=0 cellspacing=10 bgcolor="#FFFFFF">
			  <tr>
			    <td width=450 align="center" valign="middle"> 
				 <input type="hidden" name="psRefer" value="">
				    <table width=450 border=0 cellpadding=4 cellspacing=0>
			
			       <tr>
			            <td align="right" width=40%>Old Password:</td>
			            <td align="left" width=60%><?php echo form_input($old_password);?></td>
			       </tr>

			       <tr>
			            <td align="right" width=40%>New Password (at least <?php echo $min_password_length;?> characters long):</td>
			            <td align="left" width=60%><?php echo form_input($new_password);?></td>
			       </tr>
			       
			       <tr>
			            <td align="right" width=40%>Confirm New Password:</td>
			            <td align="left" width=60%><?php echo form_input($new_password_confirm);?></td>
			       </tr>
			       
			       <tr>
			        <td align="right" width=40%><?php echo form_submit('submit', 'Change');?></td>
			        <td align="left" width=60%><?php echo form_reset('reset', 'Clear');?></td>
			       </tr>
			      </table>
			      
			    </td>
			  </tr>
			
			</table>
			<?php echo form_close();?>
			
			<div align="center" style="margin-top:10px; ">
				<div id="clin-backimg-1"><img src="/clinics/static/imgs/clinics_images/flask.jpg" /></div>
				<div id="clin-backimg-2"><img src="/clinics/static/imgs/clinics_images/tube-left.jpg" /></div>
				<div id="clin-backimg-3"><img src="/clinics/static/imgs/clinics_images/microscope.jpg" /></div>
				<div id="clin-backimg-4"><img src="/clinics/static/imgs/clinics_images/tube-right.jpg" /></div>
				<div id="clin-backimg-5"><img src="/clinics/static/imgs/clinics_images/tube-left.jpg" /></div>
				<div id="clin-backimg-6"><img src="/clinics/static/imgs/clinics_images/microscope.jpg" /></div>
				<div id="clin-backimg-7"><img src="/clinics/static/imgs/clinics_images/tube-right.jpg" /></div>
				<div id="clin-backimg-8"><img src="/clinics/static/imgs/clinics_images/flask.jpg" /></div>
			</div>
			
			<br />
			<div id="footer">
				<div class="layout">
					<div align="center"><br /><br />&copy; <? echo date('Y'); ?> Alere Inc. All rights reserved.</div>
				</div>
			</div>
	
		</div>

		<script type="text/javascript">
			$(document).ready(function() {

				 var TEST_COOKIE = 'test_cookie';
				 
				 jQuery.cookie( TEST_COOKIE, true );
				 
				 if ( jQuery.cookie ( TEST_COOKIE ) ) {
					$("#no_js").hide();
				 	jQuery.cookie( TEST_COOKIE, null );  // delete the cookie
					$("#login_table").css("visibility","visible");
					$("#login_btn,#clear_btn").button();
				 }
				 else {
				 	alert( 'Your JavaScript is enabled but your cookies are not. Please enable cookies and try again.' );
				 }

			});
		
		</script>
	</body>

</html>   
