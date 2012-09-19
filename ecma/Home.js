function Home()
{
}

Home.prototype = {
	updateTime : function()
	{
		var d = new Date();
		var t = d.toLocaleTimeString();
		var elem = document.getElementById('time_now');
		elem.innerHTML = t;
	}
};