{include file='Admin/Includes/Header.tpl' __title='Configure job' img='editcopy.png'}
{pageaddvar name="javascript" value="modules/Beam/javascript/ConfigureJob.js"}

{form cssClass='z-form'}
	{formerrormessage id='error'}
	{formvalidationsummary}

	<fieldset>
		<legend>{gt text='Information of job'}</legend>
		<div class="z-formrow">
			{formlabel __text='Name of job' for='name' mandatorysym=true}
			{formtextinput id='name' maxLength='255' mandatory=true text=$job.name}
		</div>

		<div class="z-formrow">
			{formlabel __text='Description of job' for='description' mandatorysym=true}
			{formtextinput textMode='multiline' rows='5' id='description' mandatory=true text=$job.description}
		</div>

		<div class="z-formrow">
			{formlabel __text='Type of job' for='type' mandatorysym=true}
			{formdropdownlist id="jType" size="1" mandatory=true items=$typeoptions selectedValue=$job.jType}
		</div>

		<div class="z-formrow">
			{formlabel __text='Category of job' for='category' mandatorysym=true}
			{formcategoryselector id='category' mandatory=true category=$catbase editLink=false selectedValue=$job.category}
		</div>

		<div class="z-formrow">
			{formlabel __text='Shell-code of starting job' for='codeStart' mandatorysym=true}
			{formtextinput textMode='multiline' rows='3' id='codeStart' mandatory=true text=$job.codeStart}
		</div>

		<div class="z-formrow">
			{formlabel __text='Shell-code of stopping job' for='codeStop' mandatorysym=false}
			{formtextinput textMode='multiline' rows='3' id='codeStop' mandatory=false text=$job.codeStop}
		</div>

		<div class="z-formrow">
			{formlabel __text='Shell-code of starting pause' for='codePauseStart' mandatorysym=false}
			{formtextinput textMode='multiline' rows='3' id='codePauseStart' mandatory=false text=$job.codePauseStart}
		</div>

		<div class="z-formrow">
			{formlabel __text='Shell-code of stopping pause' for='codePauseStop' mandatorysym=false}
			{formtextinput textMode='multiline' rows='3' id='codePauseStop' mandatory=false text=$job.codePauseStop}
		</div>

		<div id="Beam_ConfigureJob_ExtraCode">
			{assign var='no' value='1'}
			{foreach from=$job.extraCode item='item'}
				{modapifunc modname='Beam' type='Admin' func='getExtraCodeRow' no=$no title=$item.title code=$item.code}
				{math equation='x+1' x=$no assign='no'}
			{/foreach}
		</div>

		<input type="hidden" name="Beam_ExtraCodes" id="Beam_ExtraCodes" value="{$no}">
		<script type="text/javascript">
			Beam_ConfigureJob_Jobs = {{$no}};
		</script>

		<div class="z-formrow" id="Beam_ExtraCodeAdd">
			<a href="javascript:void(0);" onclick="Beam_ConfigureJob_ExtraCodeAddRow();">{gt text="Add extra code row"}</a>
		</div>

		<div class="z-formrow">
			{formlabel __text='Activate?' for='active' mandatorysym=true}
			{formcheckbox checked=$job.active id='active'}
		</div>

	</fieldset>
	
	<div class="z-buttons z-formbuttons">
		{formbutton commandName='register' __text='Configure job' class='z-bt-ok z-btgreen'}
		{formbutton commandName='cancel' __text='Cancel' class='z-bt-cancel z-btred'}
	</div>
	
{/form}

{include file='Admin/Includes/Footer.tpl'}
