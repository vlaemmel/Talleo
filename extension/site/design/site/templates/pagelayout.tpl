<!DOCTYPE html>
<html lang="{$site.http_equiv.Content-language|wash()}" xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$site.http_equiv.Content-language|wash()}">
{if not(is_set($extra_cache_key))}{def $extra_cache_key=''}{/if}
{def $pagedata = pagedata()
	 $basket_is_empty = cond($current_user.is_logged_in,fetch(shop,basket).is_empty,1)
	 $locales = fetch('content','translation_list')
	 $pagedesign = $pagedata.template_look
	 $indexpage = $pagedata.root_node_id
	 $content_info = first_set($module_result.content_info, false())
	 $persistent_infoboxes = array()
	 $cufon_fonts=cond(ezini_hasvariable('JavaScriptSettings','CufonFontsList','design.ini'),ezini('JavaScriptSettings','CufonFontsList','design.ini'),false())
	 $has_cufon=and($cufon_fonts,count($cufon_fonts))
}
{cache-block keys=array($module_result.uri, $basket_is_empty, $current_user.contentobject_id, $access_type.name, $extra_cache_key)}
<head>
{include uri="design:page_head.tpl" enable_link=false()}

{include uri="design:page/head_style.tpl"}
{include uri="design:page/head_script.tpl"}
</head>

<body class="{$pagedata.site_classes|implode(' ')}">
	<div id="webpage">
		{include uri="design:page_header.tpl" logo_alt=$site.title|wash() logo_width=252 logo_height=72}
		<nav id="global-menubar">
			{include uri='design:menu/menubar.tpl' orientation='horizontal' rootNodeId=$indexpage menuDepth=3 attribute_filter=array('and', array('priority','>',0), array('priority','<',10)) additional_items=array()}
		</nav>
		<section id="site-columns">
			{if $pagedata.website_toolbar}
				{include uri='design:page_toolbar.tpl'}
			{/if}
			{if $pagedata.has_sidebar}
				<aside id="sidebar" role="complementary">
					{if and($pagedata.has_sidemenu,eq($pagedata.sidemenu_position,'left'))}{include uri="design:menu/sidemenubar.tpl" show_header=false()}{/if}
					{if and(is_set($pagedata.persistent_variable.sidebar), $pagedata.persistent_variable.sidebar)}
						<section>{$pagedata.persistent_variable.sidebar}</section>
					{/if}
					{if and($infoboxes,$infoboxes['left'])}{include uri="design:parts/extrainfo.tpl" infoboxes=$infoboxes['left'] infoboxes_only=true()}{/if}
				</aside>
			{/if}
				<section class="{$pagedata.content_classes|implode(' ')}" id="site-main-content" role="main">
				{if $pagedata.show_path}
					{include uri='design:page_toppath.tpl' delimiter='&raquo;'}
				{/if}
{/cache-block}
					{$module_result.content}
{cache-block keys=array($module_result.uri, $basket_is_empty, $current_user.contentobject.id, $access_type.name, $extra_cache_key)}
				</section>
			{if $pagedata.has_extrainfo}
				<aside id="extrainfo" role="complementary">
				{if and($pagedata.has_sidemenu,eq($pagedata.sidemenu_position,'right'))}{include uri="design:menu/sidemenubar.tpl" show_header=false()}{/if}
				{include uri="design:parts/extrainfo.tpl" infoboxes=cond(and($infoboxes,$infoboxes['right']),$infoboxes['right'],false()) infoboxes_only=false()}
				</aside>
			{/if}
			{if and(is_set($pagedata.persistent_variable.bottomarea), $pagedata.persistent_variable.bottomarea)}
				<section id="bottomarea">{$pagedata.persistent_variable.bottomarea}</section>
			{/if}
		</section>
		{include uri="design:page_footer.tpl"}
	</div>
	{* This comment will be replaced with actual debug report (if debug is on). *}
	<!--DEBUG_REPORT-->
{/cache-block}
</body>

</html>