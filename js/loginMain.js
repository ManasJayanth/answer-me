require.config({
	'paths': {
		'jquery': 'lib/jquery',
		'bootstrap': 'lib/bootstrap',
		'usernameajax': 'usernameajax',
		'loginerror': 'loginerror'
	},
	shim: {
		'bootstrap': {
			deps: ['jquery']
		},
		'usernameajax': {
			deps: ['jquery'],
			exports: 'AjaxReq'
		},
		'loginerror': {
			deps: ['jquery']
		}
	}
});

require([
    'jquery', 'bootstrap','usernameajax','loginerror'
], function(jquery,bootstrap,usernameajax,loginerror) {
    console.log('login.php js dependencies loaded');
    //var idok = false;
	var nameok = false;
	var passok = false;

	$(document).ready(function () {
		$('#starttest').on('click',function(){
			if ($('#loginId').val() != '') {
				if ($('#pass').val() != '') {
					if ($('#testid').val() != '') {
						$('#loginform').submit();
					} else{
						$("#errmesg").html('<div class="alert alert-block alert-error fade in"> Test ID field cannot be empty </div>');
					}
				} else{
					$("#errmesg").html('<div class="alert alert-block alert-error fade in"> Password field cannot be empty </div>');
				}
			} else{
				$("#errmesg").html('<div class="alert alert-block alert-error fade in"> Login ID field cannot be empty </div>');
			}
		});
		/*** Empty all modal fields ***/
		$('#modalloginId').val('');
		$('#name').val('');
		$('#password').val('');
		$('#rpassword').val('');

		var newReq = new AjaxReq();
		$('#modalloginId').on('change',function(){
			var uname = $(this).val();
			if (uname == '') {
				$("#availmesg").html('<span class="alert alert-error help-block" id="availmesg">' +
	        							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
	        							'Username field cannot be empty' +
	       						 	'</span>');
			}
			else
			{
				newReq.check(uname);
			}
		});
		$('#register').on('click',function(){
			if ($('#password').val() == $('#rpassword').val()) {
				if ($('#name').val() != '') {
					if ($('#password').val() != '') {
						var data = '';
						data += $('#modalloginId').val() + ';';
						data += $('#name').val() + ';';
						data += $('#password').val();
						newReq.send(data);
					}
					else {
					$('#mesg').html('<div class="alert-error">' + 
		    								'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
		    								'Password field mustnot be empty' +
		    							'</div>');
					}
				}
				else {
					$('#mesg').html('<div class="alert-error">' + 
		    								'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
		    								'Name field mustnot be empty' +
		    							'</div>');
				}
			}
			else {
				$('#mesg').html('<div class="alert-error">' + 
	    								'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
	    								'Passwords don\'t match' +
	    							'</div>');
			}
		});
		loginerror.checkLoginErrors();
	});
});