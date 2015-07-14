<{include file="header.tpl"}>

<{if $category|default:''}>
	<div id="content" class="clearfix">
	</div>
	
	<div id="paged" class="clearfix">
		<ul class="clearfix">
		</ul>
	</div>
<{else}>
	<div id="indexcontent" class="clearfix">
		
	</div>
<{/if}>

<{include file="footer.tpl"}>
