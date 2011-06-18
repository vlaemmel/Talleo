
{if is_unset($menuDepth)}{def $menuDepth=1}{/if}
{if is_unset($useParent)}{def $useParent=false()}{/if}

{def $rootNode=fetch('content', 'node', hash('node_id', $rootNodeId))
     $additionalMenuItems = first_set($additional_items, false())
     $menuIdentifier = cond(eq($rootNodeId, $indexpage), 'TopIdentifierList', 'LeftIdentifierList')
     $classFilterType = first_set($classFilter[0], 'include')
     $classFilterArray = first_set($classFilter[1], ezini('MenuContentSettings', $menuIdentifier, 'menu.ini'))
     $menuItems=fetch('content', 'list', hash('parent_node_id', $rootNodeId,
						    'sort_by', $rootNode.sort_array,
						    'class_filter_type', $classFilterType,
						    'class_filter_array', $classFilterArray,
						    'attribute_filter', first_set($attribute_filter, false())))
     $currentNodeInPath = cond(eq($current_node_id, $indexpage), 0, $current_node_id)
     $currentPath = $#current_node.path_string|explode('/')
     $pathDepth = sum($rootNode.depth, $menuDepth)
     $itemClass=array()
     $menuLink = cond( eq($ui_context, 'browse'), concat("content/browse/", $menuItem.node_id)|ezroot(no), first_set($menuItem.data_map.location.content, $menuItem.url_alias|ezroot(no)) )
     $menuItemChildren = false()}

{if and( eq($menuItems|count(),0), $useParent )}
{set $menuItems=fetch('content', 'list', hash('parent_node_id', $rootNode.parent.node_id,
						'sort_by', $rootNode.parent.sort_array,
						'class_filter_type', $classFilterType,
						'class_filter_array', $classFilterArray))}
{/if}
{undef $rootNode}

{if $menuItems|count()}
<ul class="menu {first_set($orientation, 'vertical')}">
   {foreach $menuItems as $key => $menuItem}
      {set $itemClass = cond(or( $currentPath|contains($menuItem.node_id), $currentNodeInPath|eq($menuItem.node_id) ), array("selected"), array())
	    $menuLink = cond( eq($ui_context, 'browse'), concat("content/browse/", $menuItem.node_id)|ezroot(no), first_set($menuItem.data_map.location.content, $menuItem.url_alias|ezroot(no)) )}
{if $key|eq(0)}{set $itemClass = $itemClass|append("firstli")}{/if}
{if eq($menuItems|count(), $key|inc())}{set $itemClass = $itemClass|append("lastli")}{/if}
{if $menuItem.node_id|eq($current_node_id)}{set $itemClass = $itemClass|append("current")}{/if}
  <li id="node_id_{$menuItem.node_id}"{if $itemClass} class="{$itemClass|implode(" ")}"{/if}>
	<div><a href="{$menuLink}"{if eq($ui_context, 'edit')} onclick="return false;"{/if}><span>{$menuItem.name|wash()}</span></a></div>

{if and($menuItem.children, gt($menuDepth, 1))}
{set $menuItemChildren=fetch('content', 'list', hash('parent_node_id', $menuItem.node_id,
						     'sort_by', $menuItem.sort_array,
						     'class_filter_type', $classFilterType,
						     'class_filter_array', $classFilterArray))}
	<ul class="submenu vertical">
   {foreach $menuItemChildren as $key => $submenuItem}
      {set $itemClass = cond($currentNodeInPath|eq($submenuItem.node_id), array("selected"), array())
	    $menuLink = cond( eq($ui_context, 'browse'), concat("content/browse/", $submenuItem.node_id)|ezroot(no), first_set($submenuItem.data_map.location.content, $submenuItem.url_alias|ezroot(no)) )}
{if $key|eq(0)}{set $itemClass = $itemClass|append("firstli")}{/if}
{if eq($menuItem.children_count, $key|inc())}{set $itemClass = $itemClass|append("lastli")}{/if}
{if $submenuItem.node_id|eq($current_node_id)}{set $itemClass = $itemClass|append("current")}{/if}
	  <li id="node_id_{$submenuItem.node_id}"><div><a href="{$menuLink}"{if eq($ui_context, 'edit')} onclick="return false;"{/if}><span>{$submenuItem.name|wash()}</span></a></div></li>
   {/foreach}
	</ul>
{/if}
  </li>
   {/foreach}
   {if $additionalMenuItems}
	{foreach $additionalMenuItems as $addMenuItem}
  <li{if $addMenuItem['nostyle']} class="nostyle"{/if}><a href={$addMenuItem['href']}>{$addMenuItem['content']}</a></li>
	{/foreach}
   {/if}
</ul>
{/if}

{undef $menuIdentifier $classFilterType $classFilterArray $menuItems $currentNodeInPath $itemClass $menuLink}