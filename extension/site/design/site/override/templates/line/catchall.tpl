{def
	$images=fetch(content, list, hash(parent_node_id, $node.node_id, class_filter_array, array('image'), class_filter_type, 'include', limit, 1))
	$canlink = $node.data_map.description.data_text|contains('redirecttoparent')|not
	$sum = first_set($node.data_map.short_description, $node.data_map.summary, $node.data_map.home_text, false())
}

{if is_set($node.data_map.image)}{set $images=$images|prepend($node)}{/if}

<div class='linewrapper{if $images|count|eq(0)} noim{/if}{if or($sum|not, $sum.has_content|not)} nodesc{/if}'>
<div class='content-view-line class-catchall'>
{if $canlink}<a href={$node.url_alias|sitelink}>{/if}<h2>{$node.name|wash}</h2>{if $canlink}</a>{/if}
{if $canlink}
	<span class='learn_more'>
		<a href={$node.url_alias|sitelink}>see more<div class="go_btn"></div></a>
	</span>
{/if}
{if $images|count}	
	<div class='attribute-image'>
		<img src="/images/file/{$images[0].node_id}/original/5"/>
	</div>
{/if}
{if $sum}
<div class='attribute-short-description'>
	{attribute_view_gui attribute=$sum}
</div>
{/if}
</div>
</div>