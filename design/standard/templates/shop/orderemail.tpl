{* DO NOT EDIT THIS FILE! Use an override template instead. *}
{set-block scope=root variable=subject}{"Order"|i18n("design/standard/shop")}: {$order.order_nr}{/set-block}

{"Order"|i18n("design/standard/shop")}: {$order.order_nr}

{"Customer"|i18n("design/standard/shop")}:

{shop_account_view_gui view=ascii order=$order}


{"Product items"|i18n("design/standard/shop")}

{def $currency = fetch( 'shop', 'currency', hash( 'code', $order.productcollection.currency_code ) )
         $locale = false()
         $symbol = false()}

{if $currency}
    {set locale = $currency.locale
         symbol = $currency.symbol}
{/if}

{section name=ProductItem loop=$order.product_items show=$order.product_items sequence=array(bglight,bgdark)}
{$ProductItem:item.item_count}x {$ProductItem:item.object_name} {$ProductItem:item.price_inc_vat|l10n( 'currency', $locale, $symbol )}: {$ProductItem:item.total_price_inc_vat|l10n( 'currency', $locale, $symbol )}

{/section}


{"Subtotal of items"|i18n("design/standard/shop")}:  {$order.product_total_inc_vat|l10n( 'currency', $locale, $symbol )}

{section name=OrderItem loop=$order.order_items show=$order.order_items sequence=array(bglight,bgdark)}
{$OrderItem:item.description}: 	{$OrderItem:item.price_inc_vat|l10n( 'currency', $locale, $symbol )}
{/section}

{"Order total"|i18n("design/standard/shop")}: {$order.total_inc_vat|l10n( 'currency', $locale, $symbol )}

{undef $currency $locale $symbol}

