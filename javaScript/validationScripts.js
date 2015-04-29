
//this function is to check the login information is correct for the login page
function checkLogIn(){
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	var error = false;
        var errorMessage = "";
        //regex for mail validation. This compares a string to see if it has the form of an email
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        
	if(email === ""){
		errorMessage += "Email field cannot be left empty!<br>";
                error = true;
	}   else if(!email.match(mailformat)){
            errorMessage += "Email is not correct!<br>";
            error = true;
        }
        
        if(password === ""){
		errorMessage += "The password field cannot be left empty!<br>";
                error = true;
	}
        
        
	document.getElementById("jsErrors").innerHTML = errorMessage;

	return error;
	
}