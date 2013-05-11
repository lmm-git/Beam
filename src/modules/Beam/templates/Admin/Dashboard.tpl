{include file='Admin/Includes/Header.tpl' __title='Dashboard' img='folder_home.png'}
{pageaddvar name='javascript' value='modules/Beam/javascript/Dashboard.js'}
{pageaddvar name='stylesheet' value='modules/Beam/style/Dashboard.css'}

{array_size array=$displays assign='arraySize'}
{if $arraySize > 0}
	<select name="Beam_Dashboard_SelectDisplay" id="Beam_Dashboard_SelectDisplay" style="width: 100%; {if $arraySize == 1}display: none;{/if}">
		{foreach from=$displays item='item'}
			<option value="{$item.id}">{$item.name}</option>
		{/foreach}
	</select>
	<script type="text/javascript">
		Beam_Dashboard_LoadMainFrame(document.getElementById('Beam_Dashboard_SelectDisplay').value);
	</script>
{else}
	<p class="z-warningmsg">{gt text='No displays found! Please add at least one display to use the dashboard!'}</p>
{/if}

<div id="Beam_Dashboard_MainFrame">

</div>


{include file='Admin/Includes/Footer.tpl'}
