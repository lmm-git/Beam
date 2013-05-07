var Beam_Dashboard_DisplayControl_BlendTime_InForm = false;
var Beam_Dashboard_CurrentDid;
var Beam_Dashboard_CurrentDashboardJS;
var Beam_Dashboard_ReloadBlocked = false;

function Beam_Dashboard_LoadMainFrame(id) {
	if(Beam_Dashboard_CurrentDid != id)
		Beam_Dashboard_ReloadStarted = false;
	Beam_Dashboard_CurrentDid = id;
	var params = new Object();
	params['id'] = id;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardLoadMainFrame",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				var returns = ajax.getData();
				document.getElementById('Beam_Dashboard_MainFrame').innerHTML = returns;
				Beam_Dashboard_LoadMainFrameContent(id);
			}
		});
}

function Beam_Dashboard_LoadMainFrameContent(id, scriptloaded) {
	if(!(id != Beam_Dashboard_CurrentDid && scriptloaded == true) && Beam_Dashboard_ReloadBlocked == false) {
		if(!scriptloaded) {
			var params = new Object();
			params['id'] = id;
			new Zikula.Ajax.Request(
				"ajax.php?module=Beam&func=DashboardLoadMainFrameScript",
				{
					parameters: params,
					onComplete:	function (ajax) 
					{
						var returns = ajax.getData();
						eval(returns);
						Beam_Dashboard_CurrentDashboardJS = returns;
					
					}
				});
		} else {
			eval(Beam_Dashboard_CurrentDashboardJS);
		}
		Beam_Dashboard_LoadDisplayInfo(id);
		Beam_Dashboard_LoadDisplayControl(id);
	}
	if(id == Beam_Dashboard_CurrentDid)
		setTimeout('Beam_Dashboard_LoadMainFrameContent(' + id + ', ' + true + ');', 5000);
}

function Beam_Dashboard_LoadDisplayInfo(id) {
	var params = new Object();
	params['id'] = id;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardLoadDisplayInfo",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				document.getElementById('Beam_Dashboard_DisplayInfo').innerHTML = ajax.getData();
			}
		});
}

function Beam_Dashboard_LoadDisplayControl(id) {
	if(!Beam_Dashboard_DisplayControl_BlendTime_InForm) {
		var params = new Object();
		params['id'] = id;
		new Zikula.Ajax.Request(
			"ajax.php?module=Beam&func=DashboardLoadDisplayControl",
			{
				parameters: params,
				onComplete:	function (ajax) 
				{
					document.getElementById('Beam_Dashboard_DisplayControl').innerHTML = ajax.getData();
					Beam_Dashboard_LoadDisplayControlBlendTime(id);
				}
			});
		}
}

function Beam_Dashboard_LoadDisplayControlBlendTime(id) {
	var params = new Object();
	params['id'] = id;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardLoadDisplayControlBlendTime",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				document.getElementById('Beam_Dashboard_DisplayControl_BlendTime').value = ajax.getData();
			}
		});
}

function Beam_Dashboard_DisplayControl_BlendTimeUpdate(id) {
	var params = new Object();
	params['id'] = id;
	params['value'] = document.getElementById('Beam_Dashboard_DisplayControl_BlendTime').value;
	document.getElementById('Beam_Dashboard_DisplayControl_BlendTime').value = Zikula.__('Updating...');
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardLoadDisplayControlBlendTimeUpdate",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				Beam_Dashboard_DisplayControl_BlendTime_InForm = false;
				Beam_Dashboard_LoadDisplayControl(id);
			}
		});
}

function Beam_Dashboard_LoadCategory(did, cid) {
	var params = new Object();
	params['id'] = did;
	params['cid'] = cid;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardLoadCategory",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				document.getElementById('Beam_Dashboard_Cat' + cid).innerHTML = ajax.getData();
			}
		});
}

function Beam_Dashboard_StartJob(did, jid) {
	Beam_Dashboard_ReloadBlocked = true;
	
	document.getElementById('Beam_Dashboard_Job' + jid).innerHTML = Zikula.__('Starting...');
	
	var params = new Object();
	params['did'] = did;
	params['jid'] = jid;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardStartJob",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				document.getElementById('Beam_Dashboard_Job' + jid).innerHTML = ajax.getData();
				Beam_Dashboard_ReloadBlocked = false;
			}
		});
}


function Beam_Dashboard_SetJobStatus(rid, state, jid) {
	Beam_Dashboard_ReloadBlocked = true;
	document.getElementById('Beam_Dashboard_Job' + jid).innerHTML = Zikula.__('Executing...');
	if(state == 99)
		document.getElementById('Beam_Dashboard_Job' + jid).innerHTML = Zikula.__('Stopping...');
	else if(state == 150)
		document.getElementById('Beam_Dashboard_Job' + jid).innerHTML = Zikula.__('Killing...');
	var params = new Object();
	params['state'] = state;
	params['rid'] = rid;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardSetJobStatus",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				document.getElementById('Beam_Dashboard_Job' + jid).innerHTML = ajax.getData();
				Beam_Dashboard_ReloadBlocked = false;
			}
		});
}

function Beam_Dashboard_PushSpecialEvent(rid, sjid, jid) {
	var params = new Object();
	params['sjid'] = sjid;
	params['rid'] = rid;
	params['jid'] = jid;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardPushSpecialEvent",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				document.getElementById('Beam_Dashboard_Job' + jid).innerHTML = ajax.getData();
			}
		});
}

function Beam_Dashboard_RemoveJobDBEntry(rid, jid, did) {
	Beam_Dashboard_ReloadBlocked = true;
	document.getElementById('Beam_Dashboard_Job' + jid).innerHTML = Zikula.__('Unlinking...');
	var params = new Object();
	params['rid'] = rid;
	params['jid'] = jid;
	params['did'] = did;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardRemoveJobDBEntry",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				document.getElementById('Beam_Dashboard_Job' + jid).innerHTML = ajax.getData();
				Beam_Dashboard_ReloadBlocked = false;
			}
		});
}

function Beam_Dashboard_VideoMute(state) {
	Beam_Dashboard_ReloadBlocked = true;
	var params = new Object();
	params['state'] = state;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardSetVideoMute",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				Beam_Dashboard_ReloadBlocked = false;
			}
		});
}

function Beam_Dashboard_SetPowerState(did, state) {
	Beam_Dashboard_ReloadBlocked = true;
	document.getElementById('Beam_Dashboard_DisplayControl_Power').innerHTML = Zikula.__('Loading...');
	if(state == 1)
		document.getElementById('Beam_Dashboard_DisplayControl_Power').innerHTML = Zikula.__('Starting...');
	else if(state == 0)
		document.getElementById('Beam_Dashboard_DisplayControl_Power').innerHTML = Zikula.__('Stopping...');
	var params = new Object();
	params['state'] = state;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=DashboardSetPowerState",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				document.getElementById('Beam_Dashboard_DisplayControl_Power').innerHTML = Zikula.__('Refreshing...');
				Beam_Dashboard_LoadDisplayControl(did);
				Beam_Dashboard_ReloadBlocked = false;
			}
		});

}
