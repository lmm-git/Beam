{include file='Admin/Includes/Header.tpl' __title='Plugin overview' img='lists.png'} 

<table class="z-datatable">
	<thead>
		<tr>
			<th>{gt text="Name"}</th>
			<th>{gt text="Description"}</th>
			<th>{gt text="Installation hints"}</th>
			<th>{gt text="Version"}</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$plugins item='item'}
			<tr class="{cycle values='z-odd,z-even'}">
				<td class="tooltips" title="# {$item.id}">{$item.name}</td>
				<td class="tooltips" title="{$item.description}">{$item.description|truncate:100:"..."}</td>
				<td class="tooltips" title="{$item.installhints}">{$item.installhints|truncate:100:"..."}</td>
				<td>{$item.version}</td>
			</tr>
		{/foreach}
	</tbody>
</table>

<script type="text/javascript">
	document.observe("dom:loaded", function() {
		Zikula.UI.Tooltips($$('.tooltips'));
	});
</script>
{include file='Admin/Includes/Footer.tpl'}
