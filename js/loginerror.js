if (rAlert) {
	$("#errmesg").html('<div class="alert alert-block alert-error fade in"> Invalid Username-Pasword combination! </div>');
}
if (invalTID) {
	$("#errmesg").append('<div class="alert alert-block alert-error fade in"> Invalid Test ID </div>');	
};