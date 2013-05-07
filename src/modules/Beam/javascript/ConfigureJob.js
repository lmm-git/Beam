var Beam_ConfigureJob_Jobs = 0;

function Beam_ConfigureJob_ExtraCodeAddRow() {
	var jobID = Beam_ConfigureJob_Jobs;
	Beam_ConfigureJob_Jobs += 1;
	document.getElementById('Beam_ExtraCodes').value = Beam_ConfigureJob_Jobs;
	
	var params = new Object();
	params['no'] = jobID;
	new Zikula.Ajax.Request(
		"ajax.php?module=Beam&func=ConfigureJobLoadExtraCodeRow",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				var returns = ajax.getData();
				document.getElementById('Beam_ConfigureJob_ExtraCode').innerHTML += returns;
			}
		});
}

