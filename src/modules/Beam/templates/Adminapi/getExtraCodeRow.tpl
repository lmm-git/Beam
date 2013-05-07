<fieldset id="Beam_ExtraCode{$no}Fieldset">
	<legend>{gt text="Extra-code %s" tag1=$no}</legend>

	<div class="z-formrow">
		<label for="Beam_ExtraCode{$no}Title">{gt text="Title"}<span class="z-form-mandatory-flag">*</span></label>
		<input type="text" value="{$title}" class="z-form-text" maxlength="255" name="Beam_ExtraCode{$no}Title" id="Beam_ExtraCode{$no}Title">
	</div>

	<div class="z-formrow">
		<label for="Beam_ExtraCode{$no}Code">{gt text="Shell-code"}<span class="z-form-mandatory-flag">*</span></label>
		<textarea class="z-form-text" rows="3" name="Beam_ExtraCode{$no}Code" id="Beam_ExtraCode{$no}Code">{$code}</textarea>
	</div>

	<input type="hidden" name="Beam_ExtraCode{$no}Removed" id="Beam_ExtraCode{$no}Removed" value="0">
	<a href="javascript:void(0);" onclick="document.getElementById('Beam_ExtraCode{$no}Removed').value = 1; document.getElementById('Beam_ExtraCode{$no}Fieldset').style.display = 'none';">{gt text="Remove extra-code %s" tag1=$no}</a>
</fieldset>
