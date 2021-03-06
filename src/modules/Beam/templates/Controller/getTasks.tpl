#!/bin/sh

echo "Script generated by BEAM at {$smarty.now}"
echo "Executing {array_size array=$tasks} task(s)"

{foreach from=$tasks item='task'}
	{if $task.status == 1}
		{*echo "#!/bin/sh\n{$task.command.codeStart|escapeShellEcho}\nwget \"{$baseurl}index.php?module=Beam&type=Controller&func=updateCommandStatus&status=100&rid={$task.id}\" -O wget.txt\nexit 0" > taskExecute.sh
		sh taskExecute.sh &*}
		{$task.command.codeStart|escapeShellEcho}
		pid=$!
		sleep 1
		#rm taskExecute.sh
		wget "{$baseurl}index.php?module=Beam&type=Controller&func=updatePid&pid=$pid&rid={$task.id}" -O wget.txt
		wget "{$baseurl}index.php?module=Beam&type=Controller&func=updateCommandStatus&status=2&rid={$task.id}" -O wget.txt
	{/if}
	{if $task.status == 99}
		{$task.command.codeStop}
		#kill -SIGKILL -{$task.windowid}
		kill {$task.windowid}
		wget "{$baseurl}index.php?module=Beam&type=Controller&func=updateCommandStatus&status=100&rid={$task.id}" -O wget.txt 
	{/if}
	{if $task.status == 150}
		#kill -TERM -{$task.windowid}
		kill {$task.windowid}
		wget "{$baseurl}index.php?module=Beam&type=Controller&func=updateCommandStatus&status=151&rid={$task.id}" -O wget.txt 
	{/if}
	{if $task.status == 49}
		{$task.command.codePauseStart}
		wget "{$baseurl}index.php?module=Beam&type=Controller&func=updateCommandStatus&status=50&rid={$task.id}" -O wget.txt 
	{/if}
	{if $task.status == 51}
		{$task.command.codePauseStop}
		wget "{$baseurl}index.php?module=Beam&type=Controller&func=updateCommandStatus&status=2&rid={$task.id}" -O wget.txt 
	{/if}
	{if $task.status >= 1000}
		{math equation='x-1000' x=$task.status assign='extraCodeNo'}
		{$task.command.extraCode.$extraCodeNo.code}
	{/if}
{/foreach}
