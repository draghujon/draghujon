/******f**********
    
    WebSite Project JS
    Name: Chris Feasby
    Date: Dec 04, 2019
    Description: Validation form JS

*****************/
var regName = new RegExp(/^[A-Z][a-zA-Z]*/);

/*
 * Removes white space from a string value.
 *
 * return  A string with leading and trailing white-space removed.
 */
function trim(str) 
{
	// Uses a regex to remove spaces from a string.
	return str.replace(/^\s+|\s+$/g,"");
}

/*
 * Determines if a text field element has input
 *
 * param   fieldElement A text field input element object
 * return  True if the field contains input; False if nothing entered
 */
function formFieldHasInput(fieldElement)
{
	// Check if the text field has a value
	if ( fieldElement.value == null || trim(fieldElement.value) == "" )
	{
		// Invalid entry
		return false;
	}
	
	// Valid entry
	return true;
}

/*
 * Handles the submit event of the survey form
 *
 * param e  A reference to the event object
 * return   True if no validation errors; False if the form has
 *          validation errors
 */
function validate(e)
{
	hideErrors();

	if(formHasErrors())
	{
		e.preventDefault();
		return false;
	}
	return true;
}

/*
 * Handles the reset event for the form.
 *
 * param e  A reference to the event object
 * return   True allows the reset to happen; False prevents
 *          the browser from resetting the form.
 */
function resetForm(e)
{
	// Confirm that the user wants to reset the form.
	if ( confirm('Clear order?') )
	{
		// Ensure all error fields are hidden
		hideErrors();
		
		// Set focus to the first text field on the page
		document.getElementById("fname").focus();
		
		// When using onReset="resetForm()" in markup, returning true will allow
		// the form to reset
		return true;
	}

	// Prevents the form from resetting
	e.preventDefault();
	
	// When using onReset="resetForm()" in markup, returning false would prevent
	// the form from resetting
	return false;	
}

/*
 * Does the error checking for first name.
 *
 * return   True if an error was found; False if no errors were found
 */
function checkFirstNameError()
{
	var firstName = document.getElementById("fname").value;
	if(!regName.test(firstName))
	{
    	document.getElementById("fname_error").style.display = "block";
        return true;
	}
	return false;
}

/*
 * Does the error checking for last name.
 *
 * return   True if an error was found; False if no errors were found
 */
function checkLastNameError()
{
	var lastName = document.getElementById("lname").value;
	if(!regName.test(lastName))
	{
    	document.getElementById("lname_error").style.display = "block";
        return true;
	}
	return false;
}

/*
 * Does the error checking for phone number.
 *
 * return   True if an error was found; False if no errors were found
 */
function checkPhoneError()
{
	var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
	var custNumberFieldValue = document.getElementById("customernum").value;
	if(!phoneno.test(custNumberFieldValue))
	{
		document.getElementById("customernum_error").style.display = "block";
        return true;
	}
	return false;
}

/*
 * Does the error checking for email address
 *
 * return   True if an error was found; False if no errors were found
 */
function checkEmailError()
{
	var returnValue;
	var cusEmail = document.getElementById("email").value;
	var emailFormat = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
	
	if(cusEmail != "")
	{
		if(emailFormat.test(cusEmail))
		{

			returnValue = false;
		}
		else
		{
			document.getElementById("emailformat_error").style.display = "block";
			returnValue = true;
		}
	}
	else
	{
		document.getElementById("email_error").style.display = "block";
		returnValue = true;
	}

	return returnValue;
}

/*
 * Calls the various error checking functions.
 *
 * return   True if an error was found; False if no errors were found
 */
function formHasErrors()
{	
	var firstNameError = checkFirstNameError();
	var lastNameError = checkLastNameError();
	var phoneError = checkPhoneError();
	var	emailError = checkEmailError();

	if(firstNameError)
	{
		document.getElementById("fname").focus();
		document.getElementById("fname").select();
	}
	else if(lastNameError)
	{
		document.getElementById("lname").focus();
		document.getElementById("lname").select();
	}
	else if(phoneError)
	{
		document.getElementById("customernum").focus();
		document.getElementById("customernum").select();
	}
	else if(emailError)
	{
		document.getElementById("email").focus();
		document.getElementById("email").select();
	}

    return firstNameError || lastNameError || phoneError || emailError;
}

/*
 * Hides all of the error elements.
 */
function hideErrors()
{
	// Get an array of error elements
	let error = document.getElementsByClassName("error");

	// Loop through each element in the error array
	for ( let i = 0; i < error.length; i++ )
	{
		// Hide the error element by setting it's display style to "none"
		error[i].style.display = "none";
	}
}

/*
 * Handles the load event of the document.
 */
function load()
{	
	document.getElementById("contact").addEventListener("submit", validate, false);
	document.getElementById("contact").reset();
	document.getElementById("contact").addEventListener("reset", resetForm, false);
}

// Add document load event listener
document.addEventListener("DOMContentLoaded", load);












