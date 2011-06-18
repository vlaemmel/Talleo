<header role="banner">
	<a id="logo" href="/"><img title="{$logo_alt}" alt="{$logo_alt}" src='/extension/site/design/site/images/newlogo.png' /></a>
{if first_set($show_nav,true())}
	<nav id="utility">
		{include uri="design:menu/menubar.tpl"
			root_node=fetch('content','node',hash('node_id',$indexpage))
			show_header=false()
			orientation='horizontal'
			delimiter='|'
			attribute_filter=array('and', array('priority','between',array(100,110)))
			menu=hash('prepend',hash(
					'Login','/user/login'
				))
		}
	</nav>
{/if}
	<div id="search">
		{include uri="design:parts/searchform.tpl" placeholder=first_set($placeholder,'null') label=first_set($label,'null')}
	</div>
</header>