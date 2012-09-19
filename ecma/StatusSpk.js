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
			
			var confirmed = confirm("Ubah jenis SPK menjadi '" + status + "'?");
			
			if(confirmed) {
				sendSyncGetAjax(url);
				var response = JSON.parse(ajax.responseText);
				if(response.result == true) {
					alert('Jenis SPK telah diubah.');
				} else {
					alert('Jenis SPK gagal diubah, coba beberapa saat lagi atau hubungi administrator!');
				}
			} else {
				this._input.value = origin;
			}
		}
		
	},
	
	showStatusProduksiCheck : function(id) 
	{
		var controlId = 'sp_control_' + id;
		
		var control = document.getElementById(controlId);
		
		control.style.display = 'block';
	},
	
	closeStatusProduksiCheck : function(id, save) 
	{
		var controlId = 'sp_control_' + id;
		
		var control = document.getElementById(controlId);
		
		if(save) this.saveStatusProduksi(control, id);
		
		control.style.display = 'none';
	},
	
	_getCheckedStatus : function(chks)
	{
		var arrChk = [];
		
		for(var i=0; i<chks.length; i++) {
			
			if(chks[i].checked) {
				
				arrChk.push(chks[i].value);
				
			}	
		}
		
		return arrChk;
	},
	
	saveStatusProduksi : function(control, id)
	{
		var chks = control.getElementsByTagName('input');
		
		var arrChk = this._getCheckedStatus(chks);
		
		var spData = {
			id : id,
			sp : arrChk
		}
		
		var strArrChk = JSON.stringify(spData);
		
		var urlParam = '?spdata=' + strArrChk;
		
		var url = this.url + urlParam;
		
		var confirmed = confirm("Ubah status SPK ini?");
		
		if(confirmed) {
			
			sendSyncGetAjax(url);
			
			var response = JSON.parse(ajax.responseText);
			
			if(response.result == true) {
				
				alert('Status SPK telah diubah.');
				
				var caption = document.getElementById('sp_caption_' + id);
				
				arrChk = this._getCheckedStatus(chks);
				
				if(arrChk.length < 1) arrChk.push("New");
				
				caption.innerHTML = arrChk[(arrChk.length - 1)];
				
			} else {
				
				alert('Status SPK gagal diubah, coba beberapa saat lagi atau hubungi administrator!');
				
			}
		}
	}
		
};