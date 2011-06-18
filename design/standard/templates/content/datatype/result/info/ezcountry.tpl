{* DO NOT EDIT THIS FILE! Use an override template instead. *}
{section show=$attribute|get_class|eq( 'ezinformationcollectionattribute' )}

{if $attribute.has_content}
   {if is_array( $attribute.content.value )}
       {foreach $attribute.content.value as $country}
           <p>{$country.Name|wash( xhtml )}</p>
       {/foreach}
   {else}
      {$attribute.content.value|wash}
   {/if}
{else}
   {'Not specified'|i18n( 'design/standard/content/datatype' )}
{/if}

{/section}
