{include file='Admin/Includes/Header.tpl' __title='View displays' img='package_editors.png'} 

{ajaxheader ui=true tooltips=true}

<table class="z-datatable">
	<thead>
		<tr>
			<th>{gt text="ID of display"}</th>
			<th>{gt text="Name of displays"}</th>
			<th>{gt text="Place of display"}</th>
			<th>{gt text="IP of display"}</th>
			<th>{gt text="IP of controller"}</th>
			<th>{gt text="Actions"}</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$displays item='item'}
			<tr class="{cycle values='z-odd,z-even'}">
				<td>{$item.id}</td>
				<td>{$item.name}</td>
				<td>{$item.place}</td>
				<td>{$item.ipDisplay}</td>
				<td>{$item.ipController}</td>
				<td>
					<a href="{modurl modname='Beam' type='admin' func='configureDisplay' did=$item.id}">{img modname=core src='xedit.png' set=icons/extrasmall __title="Edit `$item.name`" __alt='Edit' class='tooltips'}</a>
					<a href="{modurl modname='Beam' type='admin' func='removeDisplay' did=$item.id}" onclick="return confirm('{gt text='Are you sure to remove this display?'}')" >{img modname=core src='trashcan_empty.png' set=icons/extrasmall __title="Delete `$item.name`" __alt='Delete' class='tooltips'}</a>
				</td>
			</tr>
		{/foreach}
	</tbody>
</table>

{include file='Admin/Includes/Footer.tpl'}
