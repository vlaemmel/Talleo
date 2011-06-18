{* Module Menu *}
{def $Module = first_set($module,$module_result.ui_component)
     $ModuleMenu = fetch('moduletools', 'menu', hash('module',$Module))
}

<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
<h4>{$ModuleMenu.heading}</h4>
</div></div></div></div></div></div>
<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-bl"><div class="box-br"><div class="box-content">
<ul>
{foreach module_menu($Module) as $ModuleName=>$ModuleView}
  <li><div><a href={$ModuleView.uri|ezurl()}>{$ModuleView.name}</a></div></li>
{/foreach}
</ul>
</div></div></div></div></div></div>