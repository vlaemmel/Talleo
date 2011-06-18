{def $sidebar=false()
	 $extrainfo=false()
	 $bottomarea=false()
	 $left_zone=cond(is_set($node.data_map.left_zone),$node.data_map.left_zone,$node.data_map.left_column)
	 $right_zone=cond(is_set($node.data_map.right_zone),$node.data_map.right_zone,$node.data_map.right_column)
	 $bottom_zone=cond(is_set($node.data_map.bottom_zone),$node.data_map.bottom_zone,$node.data_map.bottom_column)
	 $center_zone=cond(is_set($node.data_map.center_zone),$node.data_map.center_zone,$node.data_map.center_column)
	 $banners = fetch('content', 'list', hash('parent_node_id', $node.node_id,
					     'sort_by', $node.sort_array,
					     'class_filter_type', 'include',
					     'class_filter_array', array('banner')))
     $banner_index = rand(0,sub($banners|count(),1))
     $image_class = 'homeban'
}

{if $left_zone.has_content}
	{set-block variable='sidebar'}{attribute_view_gui attribute=$left_zone}{/set-block}
{/if}
{if $right_zone.has_content}
	{set-block variable='extrainfo'}{attribute_view_gui attribute=$right_zone}{/set-block}
{/if}
{if $bottom_zone.has_content}
	{set-block variable='bottomarea'}{attribute_view_gui attribute=$bottom_zone}{/set-block}
{/if}

{pagedata_merge(hash('sidebar',$sidebar,'extrainfo',$extrainfo,'bottomarea',$bottomarea))}

{if or($center_zone.has_content, $node.node_id|eq(2))}

		<div id="multi-banners">

			<div id ='bannerimages'>
				<div class='items'>
					{foreach $banners as $key => $banner }
										<div class='banwrap'>
										<img id="banner{$key}" src="{$banner.object.data_map.image.content[$image_class].url|ezroot(no)}" onclick="document.location.href='{$banner.url_alias|ezroot(no)}'" />
										</div>
					{/foreach}	
				</div>
			</div>
	
		</div>
		
		{if gt(count($banners),1)}
		<ul class="menu horizontal" id="banner-controls">
		  <li class="action-change prev"><span>Previous</span></li>
		  {*<li class="action-state pause"><span>Pause</span></li>*}
		  <li class="action-change next"><span>Next</span></li>
		  <li class="separator"><span>|</span></li>
		{for 0 to sub(count($banners),1) as $index}
		  <li id="jump-control-{$index}" class="jump-control"><span>{sum($index,1)}</span></li>
		{/for}
		</ul>
		{/if}

{literal}
<script language="JavaScript" type="text/JavaScript">
	
var banapi = null;

$(document).ready(function() { 
	
 	if ( $("#bannerimages").length ) {
	    // select #flowplanes and make it scrollable. use circular and navigator plugins 
	    banapi = $("#bannerimages").scrollable({size: 1,
												onSeek: function()  {
													$("#banner-desc").html($("#bds-" + this.getIndex()).html());
													$("#bannernav").html($("#bswatch-" + this.getIndex()).html());
													$("#footac_target").html($("#footac-" + this.getIndex()).html());
													$("#page #footer").css("border-top", "20px solid " + $("#colstore-" + this.getIndex()).html().replace(/[^#a-z0-9]/g, ''));
												}
		}).navigator({ 
	        navi: "#banner-controls", 
	        naviItem: '.jump-control', 
			api: true,
	        activeClass: 'current'
	    }); 
	}
	
});
</script>
{/literal}


	{attribute_view_gui attribute=$center_zone}
{/if}

{undef $sidebar $extrainfo $bottomarea}
