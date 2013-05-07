{*<div id="Beam_Dashboard_DisplayInfo" class="Beam_Dashboard_InfoFrame">
	<h3>{gt text='Loading...'}</h3>
</div>*}

<div id="Beam_Dashboard_DisplayControl" class="Beam_Dashboard_InfoFrame">
	<h3>{gt text='Loading...'}</h3>
</div>

{foreach from=$categories item='cat'}
	<div id="Beam_Dashboard_Cat{$cat.id}" class="Beam_Dashboard_InfoFrame">
		<h3>{gt text='Loading...'}</h3>
	</div>
{/foreach}

