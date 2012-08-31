function StatusSpk(url)
{
	this.url = url;
	this._input = {};
}

StatusSpk.prototype = {
		
	enableEdit : function(input) {
		
		input.readOnly = false;
		this._input = input;
		this._originStatus = input.value;
	},
	
	changeStatus : function(code, id) {
		
		var origin = this._originStatus;
		
		if(code === 13) {
			var i = this._input;
			var status = i.value;
			
			i.readOnly = 'readonly';
			
			var urlParam = '?id=' + id + '&status=' + status;
			
			var url = this.url + urlParam;
			
			var confirmed = confirm("Ubah status SPK menjadi '" + status + "'?");
			
			if(confirmed) {
				sendSyncGetAjax(url);
				var response = JSON.parse(ajax.responseText);
				if(response.result == true) {
					alert('Status SPK telah diubah.');
				} else {
					alert('Status SPK gagal diubah, coba beberapa saat lagi atau hubungi administrator!');
				}
			} else {
				this._input.value = origin;
			}
		}
		
	}
		
}