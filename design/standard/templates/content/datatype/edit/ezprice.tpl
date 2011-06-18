{* DO NOT EDIT THIS FILE! Use an override template instead. *}
{default attribute_base=ContentObjectAttribute}

<div class="block">
<label>{'Price'|i18n( 'design/standard/class/datatype' )}:</label>
<input id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}_price" class="ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" type="text" name="{$attribute_base}_data_price_{$attribute.id}" size="12" value="{$attribute.content.price|l10n( clean_currency )}" />
{section show=$attribute.class_content.is_vat_included}
{* Entered price already includes VAT. *}
{section-else}
&nbsp;(+ {$attribute.content.selected_vat_type.name}, {$attribute.content.selected_vat_type.percentage}%)
{/section}
</div>

<div class="block">
<label>{'VAT'|i18n( 'design/standard/class/datatype' )}:</label>
<select id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}_vat" class="ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" name="{$attribute_base}_ezprice_inc_ex_vat_{$attribute.id}">
<option value="1" {section show=eq( $attribute.content.is_vat_included, true() )}selected="selected"{/section}>{'Price inc. VAT'|i18n( 'design/standard/class/datatype' )}</option>
<option value="2" {section show=eq( $attribute.content.is_vat_included, false() )}selected="selected"{/section}>{'Price ex. VAT'|i18n( 'design/standard/class/datatype' )}</option>
</select>
</div>

<div class="block">
<label>{'VAT type'|i18n( 'design/standard/class/datatype' )}:</label>
{include uri='design:shop/vattype/edit.tpl'
         select_name=concat( $attribute_base, "_ezprice_vat_id_", $attribute.id )
         vat_types=$attribute.content.vat_type
         current_val=$attribute.content.selected_vat_type.id}
</div>

{/default}
