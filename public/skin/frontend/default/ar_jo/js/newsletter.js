$(document).ready(function(){
    var emailvalue = $("#email").attr('title');
    $("#email").attr('value', emailvalue);
    
    $("#email").focus(function(){
    	if($("#email").attr('value') == $("#email").attr('title')) {
        	$("#email").attr('value', '');
        	}
    	});

    	$("#email").blur(function(){
    	if($("#email").attr('value') == '') {
        	$("#email").attr('value', $("#email").attr('title'));
    	}
 	});

   $('#submitEmail').click(function() {
    	
    	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    	var email = $("#email").attr('value');
    	if(email == '') {
        	alert('Please enter your email address');
        	return false;
    	} else if( !emailReg.test(email)) {
        	alert('Enter a valid email address');
        	return false;
    	}
    	return true;
    });
})