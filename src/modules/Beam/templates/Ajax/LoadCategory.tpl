<h3>{$cat.name}</h3>

<ul>
	{foreach from=$jobs item='job'}
		<li>{$job.name} <span id="Beam_Dashboard_Job{$job.id}">{modapifunc modname='Beam' type='Jobs' func='getDashboardLinks' cid=$job.id did=$did}</span></li>
	{foreachelse}
		<p>{gt text='No commands in this category at the moment. You must add some commands to this category first.'}</p>
	{/foreach}
</ul>
