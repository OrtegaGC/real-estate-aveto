
//OnPageInit();  //For some reason the OnLoad does not execute with Arcot Cards.
//Checks to see if "Chip Password" is in the authentication method list
//or is the default authentication method
function ChipCardInAuthList()
{
	var retValue= false;
	var objAuthType = document.forms[0].authSelect;
	if ( objAuthType != null )
	{
		var optLength = objAuthType.length;
		var idx;
		for ( idx = 0; idx < optLength; idx++ )
		{
			var objValue = objAuthType.options[idx].value;
			if ( objValue == "Chip Password")
			{
				retValue = true;
				break;
			}
		}
	} else {
		var objValue = document.forms[0].authDefaultSelect.value;
		//The only method is "Chip Password"
		if ( objValue == "Chip Password")
		{	
			retValue = true;
		}
	}
	debugAlert("ChipCardInAuthList is "+retValue+".");
	
	return retValue;
}

//ChipCardSelected() - returns true if either "Chip Password"
//is selected in the auth select dropdown or if "Chip Password"
//is the default ( only ) auth method for this card.
function ChipCardSelected()
{
	var retValue= false;
	var objAuthType = document.forms[0].authSelect;
	if ( objAuthType != null )
	{
		var nOptIndex = objAuthType.selectedIndex;
		var objValue = objAuthType.options[nOptIndex].value;
		if ( objValue == "Chip Password")
		{
				retValue = true;
		}
	} else {
		var objValue = document.forms[0].authDefaultSelect.value;
		//The only method is "Chip Password"
		if ( objValue == "Chip Password")
		{	
			retValue = true;
		}
	}
	debugAlert("ChipCardSelected is "+retValue+".");
	
	return retValue;
}
//Checks to see if we are using Chip Card and if we have
//the Visa Password or another auth method available
function CanFallBack()
{
	var retValue;
	
	if ( document.forms[0].AuthFallBack.value != "" 
		&& document.forms[0].AuthFallBack.value != null )
	{
		debugAlert("Can Fallback");
		retValue = true;
	} else {
		debugAlert("Cannot Fallback");
	
		retValue = false;	
	}
	
	return retValue;
	
}

function AuthSelectExists()
{
	var retValue;
	
	if ( document.forms[0].authSelect == null ) 
	{
		retValue = false;
	} else {
		retValue = true;
	}
	
	return retValue;
}


function SecurityWindow()
{
	var win = window.open(document.passwdForm.Locale.value + "security.htm", "Security" ,	 
	"height=300,width=360,dependent=yes,scrollbars=yes,resizable=no,screenX=100,screenY=100,left=100,top=100");
}
function HelpWindow()
{
	var helpHtml;
	if ( ChipCardSelected())
	{
		helpHtml = document.passwdForm.Locale.value + "chiphelp.htm";		
	    	win = window.open(helpHtml,"Help",
		"height=390,width=400,dependent=yes,scrollbars=yes,resizable=no,screenX=100,screenY=100,left=100,top=100");
		win.focus();
	} else {
		helpHtml = document.passwdForm.Locale.value + "help.htm";
		win = window.open(helpHtml,"Help",
		"width=420,height=600,dependent=yes,resizable=no,screenX=100,screenY=100,left=100,top=100");
		win.focus();
		
	}
}

function HelpWindow1()
{
	var helpHtml;
	if ( ChipCardSelected())
	{
		helpHtml = document.passwdForm.Locale.value + "chiphelp.htm";		
	    	win = window.open(helpHtml,"Help",
		"height=390,width=400,dependent=yes,scrollbars=yes,resizable=no,screenX=100,screenY=100,left=100,top=100");
		win.focus();
	} else {
		helpHtml = document.passwdForm.Locale.value + "help1.htm";
		win = window.open(helpHtml,"Help",
		"width=390,height=400,dependent=yes,scrollbars=yes,resizable=no,screenX=100,screenY=100,left=100,top=100");
		win.focus();
		
	}
}

function FypWindow()
{
	var fypHtml;
	
	fypHtml = document.passwdForm.Locale.value + "pwdhint.htm";
	win = window.open(fypHtml,"Forgot Your Password",
	"width=390,height=400,dependent=yes,scrollbars=yes,resizable=no,screenX=100,screenY=100,left=100,top=100");
	win.focus();

	
}


function OnCancelHandler(object)
{
	if ( navigator.appName == "Netscape" )
	{
		object.href = "#";
	} 
	var objCardHolder = document.passwdForm.cardHolderSelect;
	if ( objCardHolder != null ) {
		var chIndex = objCardHolder.selectedIndex;
		document.passwdForm.cardHolder.value = objCardHolder.options[chIndex].text;
	}
	document.passwdForm.authType.value = document.forms[0].authDefaultSelect.value;
	document.passwdForm.cancelHit.value = "%#*@NO_PASSWORD_@*#%";
	if ( IsNetscapeOnSolaris() )
	{
		setTimeout('document.passwdForm.submit()', 500);
	}
	else
	{
		document.passwdForm.submit();
	}
}

function OnFPWDHandler(object)
{
	if ( navigator.appName == "Netscape" )
	{
		object.href = "#";
	} 
	var objCardHolder = document.passwdForm.cardHolderSelect;
	if ( objCardHolder != null ) {
		var chIndex = objCardHolder.selectedIndex;
		document.passwdForm.cardHolder.value = objCardHolder.options[chIndex].text;
	}
	document.passwdForm.authType.value = document.forms[0].authDefaultSelect.value;
	document.passwdForm.forgotPassword.value = 1;
	if ( IsNetscapeOnSolaris() )
	{
		setTimeout('document.passwdForm.submit()', 500);
	}
	else
	{
		document.passwdForm.submit();
	}
}

function OnSubmitHandler()
{
	df = document.forms[0];
	
	if ( df.submitted.value != 1 )
		closing = false;
	else
		closing = true;
		
	OnClickHandler();
	return false;
}


function emailcheck(str) {

	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	if (str.indexOf(at)==-1){
	   alert("Invalid E-mail ID")
	   return false
	}

	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
	   alert("Invalid E-mail ID")
	   return false
	}

	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
	    alert("Invalid E-mail ID")
	    return false
	}

	 if (str.indexOf(at,(lat+1))!=-1){
	    alert("Invalid E-mail ID")
	    return false
	 }

	 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
	    alert("Invalid E-mail ID")
	    return false
	 }

	 if (str.indexOf(dot,(lat+2))==-1){
	    alert("Invalid E-mail ID")
	    return false
	 }

	 if (str.indexOf(" ")!=-1){
	    alert("Invalid E-mail ID")
	    return false
	 }
	 
	 if ((str.indexOf(dot)+1)==lstr ){
 	    alert("Invalid E-mail ID")
 	    return false
	 }

	 return true					
}

//trim function added for SCR<841>
function trim(s)
{
 	var temp=s.replace(/^\s+/, '');    
 	temp=temp.replace(/\s+$/, '');
 	return temp;  
} 

//Blank or Null-SCR<1693>
function isBlankOrNull(s)
{
	if(s==null)
		 return true;
	if((s=trim(s)).length==0)
		 return true;
return false;		 
}

//Non-Ascii character-SCR<1693>
function hasNonAsciiChars(s)
{
var i=0;
	while(i<s.length)
	{
		var ch=s.charCodeAt(i);
		if(ch>32 && ch<128)
		{
			i++;
			continue;
		}
		else
		{
		 	return true;
		}
		i++;
	}
	return false;
}

//Invalid characters-SCR<1693>
function hasInvalidChars(s)
{
var invalidStr="&<>\"%;()+\\?";
var i=0;
 	while(i<s.length)
 	{
 		if(invalidStr.indexOf(s.charAt(i))!=-1)
 		 {
 		  	return true;
 		 }
 		 i++;
 	}
 	return false;
}

//Check for spaces any where in the string-SCR<1693>
function hasSpaces(s)
{
	if(s.indexOf(' ')!=-1)
	 return true;
	else
	 return false;
}

//SCR<1700>
function isLetterOrDigit(s)
{
 if(isLetter(s) || isDigit(s))
  return true;
 else
  return false;
}

function isLetter(s)
{
 if((s.charCodeAt(0)>=65&&s.charCodeAt(0)<=90)||(s.charCodeAt(0)>=97&&s.charCodeAt(0)<=122))
  return true;
 else
  return false;
}

function isDigit(s)
{
 if(s.charCodeAt(0)>=48&&s.charCodeAt(0)<=57)
  return true;
 else
  return false;
}

function hasDigitandLetter(s)
{
	var i=0;
	var flagdigit=0;
	var flagletter=0;
	while(i<s.length)
	{
	  if (s.charCodeAt(i)>=48&&s.charCodeAt(i)<=57)
	  flagdigit = 1;
	  if ((s.charCodeAt(i)>=65&&s.charCodeAt(i)<=90)||(s.charCodeAt(i)>=97&&s.charCodeAt(i)<=122))
	  flagletter = 1;
	  i++;
	}
	if(flagdigit==1 && flagletter==1)
	return false;
	else return true;
}


//SCR 1880 - CardHolder Validation should also support multibyte or umlaut characters
function isValidName(s)
{
	var i=0;
	var validStr="-.' ,/";
	var flag=0;
	while(i<s.length)
	{
		//Check if each character is in between the ascii range. If so then apply the special characters check
		//Else it defaults to multibyte or umlaut characters, hence continue.
		if(s.charCodeAt(i)>=33&&s.charCodeAt(i)<=127)
		{
			   		if(isLetterOrDigit(s.charAt(i).toString()))
			  	 		{
			  				i++;
			  				continue;
			  		 	}
			  		else if(validStr.indexOf(s.charAt(i))!=-1)
			  		 	{
			  		 	 	i++;
			  		 	 	continue;
			  		 	}
			  		else
			  			{
			  		 		flag=1;
			  		 		break;
			  		 	}
	
		}
		else
		{
			i++;
  			continue;
  		}
	}
	if(flag==1)
	  return false;
	else
	  return true;
}

function OnMultiSubmitHandler()
{
	
	if(document.passwdForm.pin1!=null && document.passwdForm.pin2 != null 
	   && document.passwdForm.pin1.value == document.passwdForm.pin2.value)
	{
	}
	else
	{
		alert("U heeft geen (geldig) wachtwoord ingevuld. Probeer het nog eens.");
		document.passwdForm.pin1.value = "";
		document.passwdForm.pin1.focus();
		document.passwdForm.pin2.value = "";
		return false;
	}
	
	
	if (document.passwdForm.pin1.value != ""  && (document.passwdForm.pin1.value.length < 6 || document.passwdForm.pin1.value.length > 12) ) 
		{	
			alert("U heeft geen (geldig) wachtwoord ingevuld. Probeer het nog eens.");
			document.passwdForm.pin1.value = "";
			document.passwdForm.pin1.focus();
			document.passwdForm.pin2.value = "";
			return false;
	}
	
	
	//Issuer 6.5 SCR <1693> :begin
					
		if (document.passwdForm.pin1!=null)
		{
			var pinVal = document.passwdForm.pin1.value;
			if(hasDigitandLetter(pinVal)==true)
			{
				alert("U heeft geen (geldig) wachtwoord ingevuld. Probeer het nog eens.");
				document.passwdForm.pin1.value = "";
				document.passwdForm.pin1.focus();
				document.passwdForm.pin2.value = "";
				return false;
			}

		}
		

	//SCR <1693> :end
	
		//SCR 1882
		//Uncomment the following section if shopperID is being asked in the multipwdbase.htm page
		/*if (acsconddata != 1200 )
		{
			if(isBlankOrNull(document.passwdForm.shopperID.value)==true)
			{
				alert("Personal Assurance Message cannot be empty");
				document.passwdForm.shopperID.value = "";
				document.passwdForm.pin1.value = "";
				document.passwdForm.pin2.value = "";
				document.passwdForm.shopperID.focus();		
				return false;
			}
		}*/	
	
	
		document.passwdForm.pin.value = document.passwdForm.pin1.value;
		//Uncomment the following line and if CHname is being asked in the multipwdbase.htm page.
		//if(document.passwdForm.AcsCondData.value!= 1200 && document.passwdForm.cardholderName.value)
		//Comment the following line and if CHname is being asked in the multipwdbase.htm page.
		if(document.passwdForm.AcsCondData.value!= 1200 )
		{
			document.passwdForm.pin.value = document.passwdForm.pin.value; 
			//+ ",EMail=" + document.passwdForm.EmailAddr.value + ",CHName=" + document.passwdForm.cardholderName.value + ",ShopperId=" + document.passwdForm.shopperID.value;
		}
		OnClickHandler();
		return false;
	
}

function SetSubmit()
{
	document.passwdForm.submitted.value = 1;
}

function ResetSubmit()
{
	document.passwdForm.submitted.value = 0;
}

function ClearPin()
{
	document.passwdForm.pin.value = "";
	document.passwdForm.pin.focus();
}


function IsNetscapeOnSolaris()
{
	var agent = window.navigator.userAgent;
	if (( agent.indexOf('Mozilla') != -1 ) && ( agent.indexOf('compatible') == -1 ))
	{
		if ( agent.indexOf('SunOS') != -1 )
			return true;
		else
			return false;
	}
	else
	{
		return false;
	}
}
