{include file='Admin/Header.tpl' __title='Configure job' img='editcopy.png'} 

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
			{formtextinput textMode='multiline' rows='5' id='codeStart' mandatory=true text=$job.codeStart}
		</div>

		<div class="z-formrow">
			{formlabel __text='Shell-code of stopping job' for='codeStop' mandatorysym=true}
			{formtextinput textMode='multiline' rows='5' id='codeStop' mandatory=true text=$job.codeStop}
		</div>

		<div class="z-formrow">
			{formlabel __text='Shell-code of starting pause' for='codePauseStart' mandatorysym=true}
			{formtextinput textMode='multiline' rows='5' id='codePauseStart' mandatory=true text=$job.codePauseStart}
		</div>

		<div class="z-formrow">
			{formlabel __text='Shell-code of stopping pause' for='codePauseStop' mandatorysym=true}
			{formtextinput textMode='multiline' rows='5' id='codePauseStop' mandatory=true text=$job.codePauseStop}
		</div>

		<div class="z-formrow">
			{formlabel __text='Activate?' for='active' mandatorysym=true}
			{formcheckbox checked=$job.active id='active'}
		</div>

	</fieldset>
	
	<div class="z-buttons z-formbuttons">
		{formbutton commandName='register' __text='Add layer' class='z-bt-ok z-btgreen'}
		{formbutton commandName='cancel' __text='Cancel' class='z-bt-cancel z-btred'}
	</div>
	
{/form}

{include file='Admin/Footer.tpl'}
