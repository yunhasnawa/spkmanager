$("document").ready(function() {
	initAjax();
	initializeDatepicker();
});

function initAjax() {
	if (window.XMLHttpRequest) {
		ajax = new XMLHttpRequest();
	} else {
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function sendSyncGetAjax(url) {
	ajax.open("GET", url, false);
	ajax.send();
}

function initializeDatepicker() {
	var dp = $(".datepicker");
	for(var i=0; i<dp.length; i++) {
		var el = dp[i]; 
		el.setAttribute("data-date-format", "dd-mm-yyyy");
	}
	dp.datepicker();
}

function copyToClipboard(text)
{
    if (window.clipboardData) // Internet Explorer
    {  
        window.clipboardData.setData("Text", text);
    }
    else
    {  
        unsafeWindow.netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");  
        const clipboardHelper = Components.classes["@mozilla.org/widget/clipboardhelper;1"].getService(Components.interfaces.nsIClipboardHelper);  
        clipboardHelper.copyString(text);
    }
    alert("copy!");
}
