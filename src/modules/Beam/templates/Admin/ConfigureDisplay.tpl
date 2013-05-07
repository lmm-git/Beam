{include file='Admin/Header.tpl' __title='Configure display' img='editcopy.png'} 

{form cssClass='z-form'}
	{formerrormessage id='error'}
	{formvalidationsummary}

	<fieldset>
		<legend>{gt text='Information of Display'}</legend>
		<div class="z-formrow">
			{formlabel __text='Name of display' for='name' mandatorysym=true}
			{formtextinput id='name' maxLength='255' mandatory=true  text=$display.name}
		</div>

		<div class="z-formrow">
			{formlabel __text='Description of display' for='description' mandatorysym=true}
			{formtextinput textMode='multiline' rows='5' id='description' mandatory=true text=$display.description}
		</div>

		<div class="z-formrow">
			{formlabel __text='Place of display' for='place' mandatorysym=true}
			{formtextinput id='place' maxLength='255' mandatory=true text=$display.place}
		</div>

		<div class="z-formrow">
			{formlabel __text='IP of display (for control display)' for='ipDisplay' mandatorysym=true}
			{formtextinput id='ipDisplay' maxLength='255' mandatory=true text=$display.ipDisplay}
		</div>

		<div class="z-formrow">
			{formlabel __text='Control type of display' for='dCT' mandatorysym=false}
			{formdropdownlist id="dCT" size="1" mandatory=false items=$typeoptions selectedValue=$display.displayControlType}
		</div>

		<div class="z-formrow">
			{formlabel __text='IP of controller' for='ipController' mandatorysym=true}
			{formtextinput id='ipController' maxLength='255' mandatory=true text=$display.ipController}
		</div>

		<div class="z-formrow">
			{formlabel __text='Activate?' for='active' mandatorysym=true}
			{formcheckbox checked=$display.active id='active'}
		</div>

	</fieldset>
	
	<div class="z-buttons z-formbuttons">
		{formbutton commandName='register' __text='Configure display' class='z-bt-ok z-btgreen'}
		{formbutton commandName='cancel' __text='Cancel' class='z-bt-cancel z-btred'}
	</div>
	
{/form}

{include file='Admin/Footer.tpl'}
