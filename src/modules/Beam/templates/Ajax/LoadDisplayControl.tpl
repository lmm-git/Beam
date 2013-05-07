<h3>{gt text='Display control'}</h3>
{if $display.displayControlType == 1}
	<h5><i>{gt text='PJLink'}</i></h5>
	<ul>
		<li>{gt text='Video mute:'} <a href="javascript:void(0)" onclick="Beam_Dashboard_VideoMute(1)">on</a> <a href="javascript:void(0)" onclick="Beam_Dashboard_VideoMute(0)">off</a>{modapifunc modname='Beam' type='PJLink' func='getVideoMute'}</li>
			{modapifunc modname='Beam' type='PJLink' func='getPower' assign='powerState'}
			{strip}
				<li>{gt text='Power:'}&nbsp;
					<span id="Beam_Dashboard_DisplayControl_Power">
						{if $powerState == 1}
							<a href="javascript:void(0)" onclick="Beam_Dashboard_SetPowerState({$did}, 0)">{gt text="Running"}</a>
						{else}
							<a href="javascript:void(0)" onclick="Beam_Dashboard_SetPowerState({$did}, 1)">{gt text="Stopped"}</a>
						{/if}
					</span>
				</li>
			{/strip}
	</ul>
{/if}
<form action="javascript:void(0);" onsubmit="document.getElementById('Beam_Dashboard_DisplayControl_BlendTime').blur();">
<h5><i>{gt text='General'}</i></h5>
<ul>
	<li>{gt text='Blending time in seconds:'} <input type="number" name="Beam_Dashboard_DisplayControl_BlendTime" id="Beam_Dashboard_DisplayControl_BlendTime" value="{gt text='Loading value...'}" onclick="Beam_Dashboard_DisplayControl_BlendTime_InForm = true;" onblur="Beam_Dashboard_DisplayControl_BlendTimeUpdate({$did})"/></li>
</ul>
</form>
