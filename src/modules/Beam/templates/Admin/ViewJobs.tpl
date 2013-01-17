{include file='Admin/Header.tpl' __title='View jobs' img='package_editors.png'} 

{ajaxheader ui=true tooltips=true}

<table class="z-datatable">
	<thead>
		<tr>
			<th>{gt text="ID of job"}</th>
			<th>{gt text="Name of job"}</th>
			<th>{gt text="Active"}</th>
			<th>{gt text="Actions"}</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$jobs item='item'}
			<tr class="{cycle values='z-odd,z-even'}">
				<td>{$item.id}</td>
				<td>{$item.name}</td>
				<td>
					{if $item.active == 1}
						{img modname=core src='greenled.png' set=icons/extrasmall __title="The job '`$item.name`' is active. To inactivate it please edit this job." __alt='Active' class='tooltips'}
					{else}
						{img modname=core src='redled.png' set=icons/extrasmall __title="The job '`$item.name`' is inactive. To activate it please edit this job." __alt='Inactive' class='tooltips'}
					{/if}
				</td>
				<td>
					<a href="{modurl modname='Beam' type='admin' func='configureJob' jid=$item.id}">{img modname=core src='xedit.png' set=icons/extrasmall __title="Edit `$item.name`" __alt='Edit' class='tooltips'}</a>
					<a href="{modurl modname='Beam' type='admin' func='removeJob' jid=$item.id}" onclick="return confirm('{gt text='Are you sure to remove this job?'}')" >{img modname=core src='trashcan_empty.png' set=icons/extrasmall __title="Delete `$item.name`" __alt='Delete' class='tooltips'}</a>
				</td>
			</tr>
		{/foreach}
	</tbody>
</table>

{include file='Admin/Footer.tpl'}
