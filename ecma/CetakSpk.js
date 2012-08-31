function CetakSpk(url)
{
	this.url = url;
	this.popup = {};
}

CetakSpk.prototype = {
	
	getReport : function() {
		sendSyncGetAjax(this.url);
		var html = ajax.responseText;
		var popup = window.open('', '', 'width=850,height=800,location=no,menubar=no,resizeable=no,scrollbars=yes,status=no,menubar=no,titlebar=no');
		popup.document.write(html);
		popup.focus();
		this.popup = popup;
	},
	
	printReport : function() {
		this.popup.print();
	}
		
}