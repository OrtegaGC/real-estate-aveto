
//ChipCard functions

//all external message strings

var installPluginNoFallbackMsg =    "The purchase cannot be completed unless you download \n" 
								  + "and install the Chip Card plugin.  Would you like to \n"
								  + "download and install the plugin now?  \n";
	
var installPluginFallbackMsg =    "The purchase cannot be completed with the Chip Card password \n" 
								+ "unless you download and install the Chip Card plugin.  Would \n"
								+ "you like to download and install the plugin now?  \n";
		  
var installNewerPluginMsg =  "You have an older version of the Chip Card plugin.\n" 
						+ "Do you want to install the latest version?\n";
						
var insChipOrCancel = "Please insert your Visa Chip Card in the\n" 
					+ "card reader and press ok or press cancel if you\n"
					+ "prefer to terminate the purchase.";						

var adjustCardMsg =   "Please remove your card from the reader, re-insert it   \n" 
		  +	"and press OK, then re-enter your password and press \n"
		  + "submit or press Cancel to terminate the purchase.";
		  
var wrongChipPassword = "The Chip Password you entered is incorrect.  Please press\n"
		 + "OK, then enter your Chip Password again and press Submit.\n";
		 
var insChipOrVisaMsg = "Please insert your Visa Chip Card in the\n" 
		  +	"card reader,enter pin and press submit again\n"
		  + "or press cancel to enter your Visa Password.";

var insChipOrCancelMsg = "Please insert your Visa Chip Card in the\n" 
		  +	"card reader,enter pin and press submit again\n"
		  + "or press cancel to terminate the purchase.";

var noCardReaderMsg =   "We are unable to use your Chip Card password due to \n" 
		  +	"missing card reader or card reader software.  You must use\n"
		  + "your Visa Password instead.  Press Cancel to re-enter the\n"
		  + "password or press OK to use the currently entered password.";
		  
var noCardReaderMsgNoCancel =   "We are unable to use your Chip Card password due to \n" 
		  +	"missing card reader or card reader software.  You must use\n"
		  + "your Visa Password instead.  \n";		  

var noEaccessMsg =   "We are unable to use your Chip Card password with   \n" 
		  +	"this card.  You must use your Visa Password instead.\n"
		  + "Press Cancel to re-enter the password or press OK   \n"
		  + "to use the currently entered password.               ";

var confirmCancelMsg = "Are you sure you wish to quit the Verified by Visa process? Selecting OK will automatically return you to the online store.";		  

var installChipPlugin = false;

function ObjectLoadErrorHandler()
{
	debugAlert("ObjectLoadErrorHandler called.");
	LoadError=1;
	return false;//Return false to say we handled the error
}

function WeCanAuthenticateWithEAccess()
{
	if ( ChipCardInAuthList() )
	{
		if ( IsReaderPresent() )
		{
			var retString = GetSecretFromDll();
			debugAlert("Return from GetSecretFromDll() is "+retString+".");					
			if (  retString != "$ERROR$"  )
			{
				while( ! CardPresentOrRejected() ); 
				if ( IsValidVSDCCardPresent() )
				{
					//var retString = GetSecretFromDll();
					//debugAlert("Return from GetSecretFromDll() is "+retString+".");					

					if (  retString != "$ERROR$"  )
					{
						document.passwdForm.submitted.value = 1;
						document.passwdForm.pin.value = retString;
						document.forms[0].authType.value = "Chip Password";
						document.forms[0].eAccessPresent.value = "TRUE";
						document.forms[0].ChipSecret.value = retString;
						var setMdRet = plugin.SetMerchantData(document.forms[0].VSDCInput.value);
						debugAlert("MerchantData="+document.forms[0].VSDCInput.value+".");					
						debugAlert("Return from SetMerchantData is "+setMdRet+".");
						GetErrorCode();
						retString = GetVSDCData();
						if (  retString != "$ERROR$" )
						{
							var objCardHolder = document.forms[0].cardHolderSelect;
							if ( objCardHolder != null ) {
								var chIndex = objCardHolder.selectedIndex;
								document.forms[0].cardHolder.value = objCardHolder.options[chIndex].text;
							}	
							document.forms[0].VSDCData.value=retString;									
							document.forms[0].submit();	
							return true;							
						} else {
							ResetSubmit();							
							ClearPin();	
						}
					} else {
						GetErrorCode();
					}
					
				} else {
					//No card present,return an error
					document.passwdForm.submitted.value = 1;
					document.passwdForm.pin.value = retString;
					document.forms[0].authType.value = "Chip Password";
					document.forms[0].eAccessPresent.value = "TRUE";
					document.forms[0].ChipSecret.value = retString;
					var objCardHolder = document.forms[0].cardHolderSelect;
					if ( objCardHolder != null ) {
						var chIndex = objCardHolder.selectedIndex;
						document.forms[0].cardHolder.value = objCardHolder.options[chIndex].text;
					}	
					//document.forms[0].VSDCData.value is null already;									
					document.forms[0].submit();	
					return true;							
				}
			}
		}
	}
	
	return false;
}

function IsReaderPresent()
{
	var retval = false;
	debugAlert("LoadError="+ LoadError + ".");
	if ( navigator.appName != "Netscape" )
	{
		if ( LoadError == 1 )
		{
			//debugAlert("There was an error loading the ActiveXObject.");
			plugin = null;
		} else {
			//debugAlert("Setting plugin to ActiveXObject");
			plugin = VPASChipCardPlugin;
		}
	} else {
		 debugAlert("Setting plugin for Netscape.");
		 var pluginName = document.forms[0].ChipPluginName.value;
		 if(document.embeds[pluginName] == null)
		 {
			plugin = null;
		 } else {
			plugin = document.embeds[0];
		 }
	}
	
	if ( plugin != null) 
	{ 
		debugAlert("plugin="+ plugin + ".");
	
		if( plugin.IsReaderPresent())
		{	
			debugAlert("Reader present");
			retval = true;
		}
		else
		{
			debugAlert("Reader not present");		
			retval = false;
		}
	} else {
		debugAlert("Plugin not loaded.");
		retval = false;
	}
	return retval;		
}

function IsValidVSDCCardPresent()
{
	var retVal = false;
	if ( plugin != null) 
	{ 
		var result=plugin.IsValidVSDCCardPresent();
		if ( result == 1 )
		{
			debugAlert("Card Present.");
			retVal = true;
		} else {
			debugAlert("Card Not Present.");		
			retVal = false;
		}
	} else {
		debugAlert("Plugin not loaded.");
	}	
	return retVal;	
}

function IsEAccessPresent()
{	
	var retVal = false;
	//return retVal;
	if ( plugin != null) 
	{ 
		if(plugin.IsEAccessPresent())
		{
			debugAlert("EAccess present");
			retVal = true;
		} else {
			debugAlert("EAccess not present");
			retVal = false;
		}
	} else {
		debugAlert("Plugin not loaded.");
		retVal = false;
	}		
	return retVal;	
}

function GetVSDCData()
{
	var VSDCData;

	VSDCData=plugin.GetVSDCData();

	return VSDCData;
}

function AdjustedCard()
{
	var retVal = false;
	var msg = adjustCardMsg;						  
	var cardAdjusted = confirm(msg);
	if ( cardAdjusted )
	{
		retVal = true;
	} else {
		retVal = false;
	}
	return retVal;
}

var ChipSecretTried = false;
var chipTrysRemaining = 3;

function GetChipCardSecret(pin)
{
	var retVal;
	debugAlert(pin);
	//this function will return the secret Base64 encoded to you, if your
	//pin was correct, else it will return number of retries allowed	
	var secret=plugin.GetChipCardSecret(pin);
	ChipSecretTried = true;
	if(secret=="$ERROR$")
	{
		var intErrorCode=GetErrorCode();
		chipTrysRemaining=plugin.GetEAccessRetriesLeft();
		debugAlert("Error !! errorcode="+intErrorCode+".  You can try again "+chipTrysRemaining+" times.");
	}
	else
	{
		debugAlert("Chip Secret="+secret+".");
	}
	return secret;
}

function GetSecretFromDll()
{
	var strLibraryName="eaccess.dll";
	//this function will return the secret Base64 encoded to you, if 
	//the eaccess dll was present, otherwise it will return $ERROR$ to you.

	var secret=plugin.GetLibSecret(strLibraryName);

	if(secret=="$ERROR$")
	{
		debugAlert("Unable to recover secret from dll.");
		return secret;
	}
	else
	{
		debugAlert("Chip Secret="+secret+".");
		return secret;
	}
}

function GetErrorCode()
{
	var error=plugin.GetErrorCode();
	debugAlert("Error Code="+error+".");
	return error;

}
function GetErrorMessage()
{
	var errorMsg=plugin.GetErrorMessage();
	alert("Error Message="+errorMsg);

}

function HandleChipCard(pwd)
{
	var VSDCData = document.forms[0].VSDCData.value;
	
	//We only want to get VSDC Data once
	//if ( VSDCData == "" || VSDCData == null )
	//{
		if ( IsReaderPresent() )
		{
			if ( IsValidVSDCCardPresent() )
			{
				if ( IsEAccessPresent() )
				{	
					var retString="";				
					document.forms[0].eAccessPresent.value = "TRUE";
					
					if (  retString != "$ERROR$" )
					{
						var pinCorrect;
	
						retString=GetChipCardSecret(pwd);					
						var secret;
						secret= retString;
						if (secret=="$ERROR$" ) 
						{
							//User botched the password
							pinCorrect = false;
							document.forms[0].ChipSecret.value = "";
							var msg = wrongChipPassword;
							alert(msg);
							ResetSubmit();							
							ClearPin();
						} else {
							document.forms[0].ChipSecret.value = secret;
						}
					}		
					
					if (  retString != "$ERROR$"  )
					{ 
						debugAlert("MerchantData="+document.forms[0].VSDCInput.value+".");
						var setMdRet = plugin.SetMerchantData(document.forms[0].VSDCInput.value);
						debugAlert("Return from SetMerchantData is "+setMdRet+".");
						GetErrorCode();
						retString = GetVSDCData();
						if (  retString != "$ERROR$" )
						{
							document.forms[0].VSDCData.value=retString;
							document.forms[0].submit();								
							
						} else {
							debugAlert("No VSDC data returned.");
							if ( AdjustedCard() )
							{
								ResetSubmit();
								ClearPin();
							} else {
								//Cancel transaction				
								if (confirm(confirmCancelMsg))
								{
									document.passwdForm.cancelHit.value = "%#*@NO_PASSWORD_@*#%";	
									document.forms[0].submit();
								}
								else
								{
									ResetSubmit();
									ClearPin();
								}
							}
						}
					}
									
				} else {
					//EAccess application not present
					if ( ExplainAndAdjustNeedForVisaPwd() )
					{
						document.forms[0].eAccessPresent.value = "FALSE";
						document.forms[0].ChipSecret.value = "";
						//Generate ARQC to authenticate chip card
						//then and put the results in a hidden form
						//field for sending back to CAP/ACS
						var setMdRet = plugin.SetMerchantData(document.forms[0].VSDCInput.value);
						debugAlert("Return from SetMerchantData is "+setMdRet+".");
						GetErrorCode();
						var retString;
						var retString = GetVSDCData();
						if ( retString != "$ERROR$" )
						{
							document.forms[0].VSDCData.value=retString;
							document.forms[0].submit();
						} else {
							debugAlert("No VSDC data returned.");	
							var errorCode = GetErrorCode();				
							if ( AdjustedCard() )
							{
								ResetSubmit();
								ClearPin();
							} else {
								//Cancel transaction				
								if (confirm(confirmCancelMsg))
								{
									document.passwdForm.cancelHit.value = "%#*@NO_PASSWORD_@*#%";	
									document.forms[0].submit();
								}
								else
								{
									ResetSubmit();
									ClearPin();
								}
							}
						}
					} else if ( !canFallBack ) 
					{
						debugAlert("No Eaccess and No Fallback");
						document.forms[0].eAccessPresent.value = "FALSE";
						document.forms[0].authType.value = "Chip Password";
						document.forms[0].submit();	
					}	
					
				}
			} else {
				//No card in the card reader.
				var msg = insChipOrCancelMsg;		  
				if ( confirm(msg) ) 
				{
					ResetSubmit();
					ClearPin();
				} else {
					if (confirm(confirmCancelMsg))
					{
						document.forms[0].authType.value = "Chip Password";
						document.passwdForm.cancelHit.value = "%#*@NO_PASSWORD_@*#%";						
						document.forms[0].submit();								
					}
					else
					{
						ResetSubmit();
						ClearPin();
					}
				}
			}

		} else {
			if ( canFallBack )
			{
				//No card reader present so use centralized.
				
				if ( noRdrMsgDisplayed )
				{
					ResetAuthSelection()		
					document.forms[0].authType.value = "Visa Password";
					document.forms[0].submit();
				
				} else {
					var msg = noCardReaderMsg;
									  
					var useCurrentPwd = confirm(msg);
					if ( useCurrentPwd )
					{	
						ResetAuthSelection()		
						document.forms[0].authType.value = "Visa Password";
						document.forms[0].submit();
					} else {
						ResetSubmit();
						ClearPin();
						ResetAuthSelection();				
						ResetDefaultAuthType();
					}	
				} 
			} else {
				document.forms[0].ChipPluginPresent.value = "FALSE";
				document.forms[0].authType.value = "Chip Password";
				document.forms[0].submit();			
			}	
		}
	//} else {
		//We must have gotten the VSDC data from a prior try
		//so now we are just testing the password.
	//	document.forms[0].submit();
	//}
}

var explainCalled=false;
function ExplainAndAdjustNeedForVisaPwd()
{
	var retVal = false;
	
	if ( document.forms[0].eAccessRequired.value == "TRUE" )
	{
		//We only need to show the user the message below if EAccess App is required.
		if ( canFallBack )
		{
			debugAlert("eAccess required,no eAccess on card but fallback allowed!");
			//If we can fall back to Visa Core password
			if ( ! explainCalled )
			{
				explainCalled = true;
				
				var msg = noEaccessMsg;
								  
				var useCurrentPwd = confirm(msg);
				if ( useCurrentPwd )
				{
					retVal = true;
				} else {
					ResetSubmit();
					ClearPin();				
					retVal = false;
				}
			} else {
				retVal = true;
			}
		} else {
			debugAlert("eAccess required,no eAccess on card and fallback NOT allowed!");			
			retVal = false;
		}
	} else {
		debugAlert("eAccess NOT required,no eAccess on card!");				
		retVal = true;	
	}
	return retVal;
}

function ResetAuthSelection()
{
	if ( canFallBack )
	{
		var objAuthType = document.forms[0].authSelect;
		if ( objAuthType != null ) {
			var nOptIndex = objAuthType.selectedIndex;
			var objText;
			var idx;
			var objLength = objAuthType.length;
			for ( idx = 0; idx < objLength ; idx++ )
			{
				objText = objAuthType.options[idx].text;
				if ( objText == "Visa Password" )
				{
					objAuthType.selectedIndex = idx;
					break;
				}
			}
		}
	}
}

function ResetDefaultAuthType()
{
	if ( canFallBack )
	{
		document.forms[0].authDefaultSelect.value = "Visa Password";
	}
}

function DoModifiedCentralized()
{
	document.forms[0].authType.value = "Visa Password";
	document.forms[0].submit();
}

function DoCentralized()
{
	document.forms[0].authType.value = "cent";
	document.forms[0].submit();
}

function NeedNewerPluginVersion(latestVersion)
{
	var retVal = false;
	
	if ( IsReaderPresent() && plugin != null )
	{
		var pluginVersion;
	
		pluginVersion=plugin.GetVersion();
		if (pluginVersion < latestVersion)
		{
			retVal = true;
		} else {
			retVal = false;
		}
		
	} else {
		retVal = false;
	}
	return retVal;	
}

function CardPresentOrRejected()
{
	//If chip card is present return true.
	//If chip card is absent, ask user to
	//either insert it or press cancel to
	//reject its use.  
	//If user presses okay to insert
	//the card, return true.
	//If user press cancel to reject it's
	//use, return true.
	var retVal = true;
	if ( IsValidVSDCCardPresent() )
	{ 
		retVal = true;
	} else {
		var msg = insChipOrCancel;						  
		var useChipCard = confirm(msg);
		if ( useChipCard )
		{
			retVal = false;
		} else {
			//Canceled
			retVal = true;
		}
	}
	return retVal;
}

function ChipInitProc()
{
	df = document.forms[0];	
	if ( ChipCardInAuthList() )
	{
		if ((!IsReaderPresent() && plugin==null) 
			 && pluginInstallURL != "" && pluginInstallURL != null )
		{
			if ( !(CanFallBack()) && !AuthSelectExists() )
			{
				okToInstall = confirm(installPluginNoFallbackMsg);						
			} else {
				if ( df.tryIndex.value==1 )
				{
					okToInstall = confirm(installPluginFallbackMsg);
				}			
			}
			if ( okToInstall )
			{
				window.open(pluginInstallURL,"ccInstallWindow","width=300,height=200,titlebar=no,left=500,top=350");
				installChipPlugin = true;
				self.close();
				return;
			} 
		}
		if ( NeedNewerPluginVersion(chipPluginVersion))
		{
			var okToInstall = confirm(installNewerPluginMsg);
			if ( okToInstall )
			{
				window.open(pluginInstallURL,"ccInstallWindow","width=300,height=200,titlebar=no,left=500,top=350");
				installChipPlugin = true;
				self.close();
				return;
			} 
		}
		if ( ! WeCanAuthenticateWithEAccess() )
		{
			 if ( !(canFallBack=CanFallBack()) && !AuthSelectExists() )
			 {
				if ( !IsReaderPresent() || plugin==null )
				{					
					df.ChipPluginPresent.value = "FALSE";
					df.authType.value = "Chip Password";
					df.submit();
				}	
			 } else if ( canFallBack && !IsReaderPresent() && !AuthSelectExists())
			 {
				alert(noCardReaderMsgNoCancel);
				noRdrMsgDisplayed=true;
			 }
		}
	}
}
