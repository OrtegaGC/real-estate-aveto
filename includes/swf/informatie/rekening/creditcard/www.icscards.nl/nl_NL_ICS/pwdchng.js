
//This function is only needed if we have multiple cardholders

function OnCardHolderChange(objCardHolder, objAuthType)
{
	// arg check
	if (objCardHolder == null || objAuthType == null)
		return;

	// refresh the query names from the selected query group
	var curCardHolder;
	var curAuthType;
	var nIndex;

	// save the current card holder name
	var nCardHolder = objCardHolder.selectedIndex;
	if (nCardHolder >= 0)
		curCardHolder = objCardHolder.options[nCardHolder].text;

	if (objAuthType.selectedIndex >= 0)
		curAuthType = objAuthType.options[objAuthType.selectedIndex].text;

	// clear the old authtype names
	objAuthType.length = 0;

	if (nCardHolder >= 0 && authVal.length > 0)
	{
		// get the number of names
		var nCount = authVal[nCardHolder].length;
		
		//alert("Array items="+nCount+", and option length="+objAuthType.length+".");

		// add each name in this group
		for (nIndex = 0; nIndex < nCount;  nIndex++)
		{
			// get name value
			var authTypeValue = authVal[nCardHolder][nIndex];
			var authTypeText = authTxt[nCardHolder][nIndex];

			// must be valid
			if (null == authTypeValue || authTypeValue.length <= 0)
				break;
				
			if (null == authTypeText || authTypeText.length <= 0)
				break;

			// add to list
			objAuthType.length++;
			objAuthType.options[objAuthType.length - 1].value = authTypeValue;
			objAuthType.options[objAuthType.length - 1].text = authTypeText;
		}
	}

	// ensure item in name - if nothing, add default
	if (objAuthType.length <= 0)
	{
		objAuthType.length++;
		objAuthType.options[0].value = "(empty)";
		objAuthType.options[0].text = "(empty)";
	}

	// attempt to reselect the same text as before
	for (nIndex = 0; nIndex < objAuthType.length; nIndex++)
	{
		var sIndex = objAuthType.options[nIndex].text;
		if (sIndex == curAuthType)
		{
			// found it - set as current and stop
			objAuthType.options[nIndex].selected = true;
			break;
		}
	}

	// make sure something is selected
	if (objAuthType.selectedIndex < 0)
		objAuthType.options[0].selected = true;

	// finally, set focus to the authtype control
		objAuthType.focus();
}//End OnCardHolderChange()
