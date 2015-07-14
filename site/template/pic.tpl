<{include file="header.tpl"}>

<{if $pics|default:''}>
<div id="content" class="clearfix">
	<{foreach from=$pics item=pic}>
	<div class="pics">
		<img src="/image/?c=<{$category}>&p=<{$picfolder}>&name=<{$pic}>" />
	</div>
	<{/foreach}>
</div>
<{/if}>

<{include file="footer.tpl"}>
