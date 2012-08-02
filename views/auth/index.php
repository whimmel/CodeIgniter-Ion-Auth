<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php
		echo '<script src="'.base_url().'static/js/jquery-1.7.1.min.js"></script>';
		echo '<script src="'.base_url().'static/js/i18n/grid.locale-en.js"></script>';
		echo '<script src="'.base_url().'static/js/jquery.jqGrid.src.js"></script>';
		echo '<script src="'.base_url().'static/js/jquery-ui-1.8.16.custom.min.js"></script>';
		echo '<script src="'.base_url().'static/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>';
		echo '<script src="'.base_url().'static/js/jquery.validate.min.js"></script>';
		
		echo '<link rel="stylesheet" type="text/css" media="screen" href="'.base_url().'static/js/css/start/jquery-ui-1.8.16.custom.css" />';
		echo '<link rel="stylesheet" type="text/css" media="screen" href="'.base_url().'static/js/css/ui.jqgrid.css" />';
		echo '<link href="'.base_url().'static/css/general.css" rel="stylesheet" type="text/css" />';
		echo '<link href="'.base_url().'static/css/layout.css" rel="stylesheet" type="text/css" />';
		echo '<link href="'.base_url().'static/js/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />';
		echo '<link href="'.base_url().'static/css/clinics_styles.css" rel="stylesheet" type="text/css" />';
		
//@todo		$client_info = json_decode( $this->session->userdata('client_info') );	// RASCLIENTCONTACTS info from Starlims
//@todo		$rep_info = json_decode( $this->session->userdata('rep_info') );		// Rep info in Starlims
//@todo		$reps_info = json_decode( $this->session->userdata('reps_info') );		// Rep info in reps table linked by referred_by in customers2
		?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<style type="text/css">
			.divOuter {
				display: inline;
				text-align: center;
			}
			.divInner1 {
				float: left;
				width: 150px;
				margin-left: 3px;
				margin-right: 3px;
			}
			.divInner2 {
				float: right;
				width: 150px;
				margin-left: 3px;
				margin-right: 3px;
			}
			.pointer { 
				cursor: pointer; 
				text-decoration: underline;
			}   
			.td_valign_middle {
				vertical-align:middle;
			}
			.positive_result {
				color: #FF0000 !important;
			}
			.positive_result a {
				color: #FF0000 !important;
			}
			.negative_result {
				color: #000000 !important;
			}
			.negative_result a {
				color: #000000 !important;
			}
			.abnormal_result {
				color: #8A2BE2 !important;
			}
			.abnormal_result a {
				color: #8A2BE2 !important;
			}
		</style>
		<title>Avee Laboratories Clinics System</title>

		<script type="text/javascript">
		$(function() {
			var lastsel2;
			$("#grdUsers").jqGrid({
				url: '<?php echo base_url(); ?>/index.php/auth/users_xml',
				editurl: '<?php echo base_url(); ?>/index.php/auth/users_update',
				datatype: 'xml',
				colNames : ['Username', "First Name", "Last Name", "Email", 'Groups', "Active"],
				colModel : [
					{ name : "username",   width: 100, sortable: true, sorttype: 'string', editable: false }, 
					{ name : "first_name", width: 100, sortable: true, sorttype: 'string', editable: true }, 
					{ name : "last_name",  width: 150, sortable: true, sorttype: 'string', editable: true }, 
					{ name : "email",      width: 250, sortable: true, sorttype: 'string', editable: true }, 
					{ name : "groups",     width: 75,  }, 
					{ name : "active",     width: 75,  editable: true, edittype: "checkbox", editoptions: { value: "Active:Inactive" }}
				],
				rowNum : 15,
				rowList : [15, 40, 100, 200, 1000, 2000],
				pager : '#pnlUsersControl',
				sortname : 'username',
				sortorder : 'asc',
				viewrecords : true,
				height : 'auto',
				toolbar : [true, "top"],
				onSelectRow: function(id) {
					if(id && id !== lastsel2) {
						jQuery('#grdUsers').restoreRow(lastsel2);
						jQuery('#grdUsers').editRow(id, true);
						lastsel2 = id;
					}
				},
				serializeRowData: function(postdata) {
					postdata.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
					return postdata;
				},
				subGrid: false, // TODO: can't edit groups yet - wh
				subGridUrl: "<?php echo base_url(); ?>/index.php/auth/groups_xml",
				subGridModel: [
					{ name: ["Group", "Description"] } 
				]
			});
		});
		</script>
	</head>
	<body>
		<div id="wrapper">
			<?php $scroll_space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
			<div align="center" style="background:#fff !important;"><br /><img src="<?php echo base_url(); ?>static/imgs/AlereAveeLogo_big.png" height="60" /><br /><br /></div>
				<div id="clinics-title-bar" style="height:40px; padding-top:8px;" align="center">
				<div style="margin-top:3px;">Avee/Alere Laboratories Clinic Portal</div>
			</div>
			<br />
			<?php  
			
			// logout section
			echo '<div id="clinics-logout">';
			echo "<strong>Welcome, ".$this -> session -> userdata('user') . '</strong><br /><a class="clinics-logout-link" href="'.base_url().'index.php/user/logout">Log Out</a>';
			echo ' | <a class="clinics-logout-link" href="'.base_url().'index.php/auth/change_password">Change Password</a>';			
			echo '</div>';
			
			// message section
			
			// customer service button
			if ( $this->session->userdata('is_customer_service') == true || $this->session->userdata('isadmin') == true ) {
				echo '<div id="customer_service_div" style="position:absolute; left:10px; top:10px; visibility:hidden;"><input type="button" id="customer_service_btn" value="Customer Service" /></div>';
			}
			?>
			<div id="clinics-spinner" class="spinner-clinics" style="display:none;">
				<img id="clinics-spinner-img" src="/clinics/static/imgs/clinics_images/ajax-loader.gif" alt="Loading..."/>
			</div>
			
			<div align="center" style="margin-top:10px; ">
				<div id="clin-backimg-1"><img src="/clinics/static/imgs/clinics_images/flask.jpg" /></div>
				<div id="clin-backimg-2"><img src="/clinics/static/imgs/clinics_images/tube-left.jpg" /></div>
				<div id="clin-backimg-3"><img src="/clinics/static/imgs/clinics_images/microscope.jpg" /></div>
				<div id="clin-backimg-4"><img src="/clinics/static/imgs/clinics_images/tube-right.jpg" /></div>
				<div id="clin-backimg-5"><img src="/clinics/static/imgs/clinics_images/tube-left.jpg" /></div>
				<div id="clin-backimg-6"><img src="/clinics/static/imgs/clinics_images/microscope.jpg" /></div>
				<div id="clin-backimg-7"><img src="/clinics/static/imgs/clinics_images/tube-right.jpg" /></div>
				<div id="clin-backimg-8"><img src="/clinics/static/imgs/clinics_images/flask.jpg" /></div>
				
				<div id="ui-tabs" style="visibility:hidden;">
					<ul>
						<li><a href="#tabs-1">User List</a></li>
						<li><a href="#tabs-2">Create User</a></li>
					</ul>
					<div id="tabs-1">
						<div id="grdContainer" style="margin-top:10px; width:936px; margin-left:auto; margin-right:auto;">
							<!-- jqGrid table holding users -->
							<table id="grdUsers" width=100% style="font-size:1.0em; margin-left:auto; margin-right:auto;">
							<tr><td></td></tr>
							</table>
							<!-- Control bar for table pagination -->
							<div id="pnlUsersControl"></div>
						</div>
					</div><?php // end of #tabs-1 ?>
								
					<div id="tabs-2">
						<div class='mainInfo'>
					
						<h1>Create User</h1>
						<p>Please enter the users information below.</p>
						
						<div id="infoMessage"><?php echo $message;?></div>
						
					    <?php echo form_open("auth/create_user");?>
					      <p>Username:<br />
					      <?php echo form_input($username);?>
					      </p>
					      
					      <p>First Name:<br />
					      <?php echo form_input($first_name);?>
					      </p>
					      
					      <p>Last Name:<br />
					      <?php echo form_input($last_name);?>
					      </p>
					      
					      <p>Company Name:<br />
					      <?php echo form_input($company);?>
					      </p>
					      
					      <p>Email:<br />
					      <?php echo form_input($email);?>
					      </p>
					      
					      <p>Phone:<br />
					      <?php echo form_input($phone1);?>-<?php echo form_input($phone2);?>-<?php echo form_input($phone3);?>
					      </p>
					      
					      <p>Password:<br />
					      <?php echo form_input($password);?>
					      </p>
					      
					      <p>Confirm Password:<br />
					      <?php echo form_input($password_confirm);?>
					      </p>
					      
					      
					      <p><?php echo form_submit('submit', 'Create User');?></p>
					
					      
					   	 <?php echo form_close();?>
					
						</div>
					</div><?php // end of #tabs-2 ?>
			
				</div>
			</div>
		
			<br />
			
			<div id="footer">
				<div class="layout">
					<div align="center">&copy; <? echo date('Y'); ?> Alere Inc. All rights reserved.</div>
				</div>
			</div>

		</div>
		
		<script type="text/javascript">
		$(document).ready(function(){
			$('#bulk_actions').val('please_select_action');
			$('#send_message_btn').button();
			
			<?php if ( $this->session->userdata('is_customer_service') == true || $this->session->userdata('isadmin') == true ) { 
			echo "$('#customer_service_btn').button();";
			echo "$('#customer_service_btn').css('visibility','visible');";
			}
			?>
			$(".clinics-dash img[title], a.clinics-dash-link").qtip({
				style: { 
				  padding: 5,
			      background: '#000000',
			      color: '#ffffff',
			      textAlign: 'center',
			      border: {
			         width: 7,
			         radius: 5,
			         color: '#000000'
			      },
			      tip: 'bottomLeft',
			      name: 'dark' // Inherit the rest of the attributes from the preset dark style
			   },
			   position: {
			      corner: {
			         target: 'center',
			         tooltip: 'bottomLeft'
			      }
			   }
			});
			$('.horizontal_scroller').SetScroller({	velocity: 	 60,
				direction: 	 'horizontal',
				startfrom: 	 'right',
				loop:		 'infinite',
				movetype: 	 'linear',
				onmouseover: 'pause',
				onmouseout:  'play',
				onstartup: 	 'play',
				cursor: 	 'pointer'
			});
			$(".fancybox-group").fancybox({
				autoScale: false,
				overlayColor: '#fff'
			});

			$("#ui-tabs").tabs();
			$( "#ui-tabs" ).tabs( "option", "selected",0 );
			$("#ui-tabs").css('visibility','visible');
			$("#ui-tabs").fadeIn(1000);
		
			$("#fancybox-outer").append('<div id="fancy_print"></div>');
			
			$('#customer_service_btn').click(function(){
				   document.location.href='<?php echo base_url();?>index.php/customerservice/index';
			});

			$('#grdUsers').setGridWidth($('#grdContainer').width());
		});
		
		var win=null;
		</script>
		
		<script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.qtip-1.0.0-rc3.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.Scroller-1.0.min.js"></script>
			
	</body>
</html>