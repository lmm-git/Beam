{*pageaddvar name='javascript' value='jquery'}
{pageaddvar name='javascript' value='jquery-ui'}

{pageaddvar name='stylesheet' value='javascript/jquery-ui/themes/base/jquery-ui.css'}

{pageaddvar name='javascript' value='modules/EventManager/javascript/tip.js'}
{pageaddvar name='stylesheet' value='modules/EventManager/style/tip.css'}
{pageaddvar name='stylesheet' value='modules/EventManager/style/form.css'*}

<noscript style="font-size:25px; color: red; text-decoration: blink;"><h1>{gt text="Please activate JavaScript!"}</h1></noscript>

{adminheader}
<div class="z-admin-content-pagetitle">
	{if $img != ""}
		{img modname='core' src=$img set='icons/small'}
	{elseif $icon != ""}
		{icon size='small' type=$icon}
	{/if}

	<h3>{$title}</h3>
</div>
