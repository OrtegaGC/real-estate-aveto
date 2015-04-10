// Arcot Functions

function getSoftware ()
{
	window.open(getSoftwareURL);
	history.go(-1);
}

function getWallet()
{
	window.open(getWalletURL);
	history.go(-1);
}

function auth(arcotclient, user, key, pin)
{
	ERR_MISSING_WALLET = 3;
	ERR_GUI_CANCEL = 2;
	ERR_GUI_RENEW = 5;
	ERR_GUI_GOTO = 19;

	//debugAlert("Wallet name is " + user + ".");
	var requiredVersion = "1.20.005";
	var challenge = unescape(document.passwdForm.ARCOTC.value);
	var prefcard = "eVisa";

	if(prefcard == null)
		prefcard = "";
	if (challenge != null) {
		arcotclient.SetAttribute("PreferredCardName", prefcard);
		var response = arcotclient.SignChallengeEx(challenge, user, key, pin);
		//var response = arcotclient.SignChallenge(challenge);
		if (response != null && response != "") {
			//debugAlert("response != null.");
			// Package the data into the form and send it to
			// the extension.
			var selectedWallet = arcotclient.GetGlobalAttribute("SelectedWalletName");
			var selectedCard = arcotclient.GetGlobalAttribute("SelectedCardName");

			response = escape(response);
			document.passwdForm.ARCOTR.value = response;
			document.passwdForm.submit();
		}
		else if (arcotclient.GetErrorCode() == ERR_GUI_CANCEL){
				debugAlert("ERR_GUI_CANCEL.");

				history.back();
		}
		
		else if (arcotclient.GetErrorCode() == ERR_MISSING_WALLET) {
			debugAlert("You do not have any eVisa cards.\nYou may obtain one from the following page...");
			getWallet();
		}
		else {
			//debugAlert(arcotclient.GetErrorMessage());
			//ResetSubmit();
			response = escape(response);
			document.passwdForm.ARCOTR.value = response;
			document.passwdForm.submit();
			
		}
	}
}//end auth()

function checkArcot (arcotclient)
{
	//Create Wallet name by concatenating the last four digits
	//of the pan on the cardholder name
	var userObject = document.forms[0].cardHolderSelect
	var user;
	if ( userObject != null )
	{
		user = userObject.options[userObject.selectedIndex].text;
		user += " ";
	} else {
		user = document.forms[0].cardHolder.value;
		user += " ";
	}
	var pan = document.forms[0].pan.value;
	var panLastFourStart = pan.length - 4;
	var i;

	for ( i = panLastFourStart; i < pan.length ; i++ )
	{
		user += pan.charAt(i);
	}
		
	auth(arcotclient, user,
		'AnyBank eVisa',
		document.passwdForm.pin.value);
}

function refreshArcot ()
{
	refresh(document.passwdForm.user.value,
		'AnyBank eVisa');
}