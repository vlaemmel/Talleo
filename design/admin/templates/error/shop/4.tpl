{* DO NOT EDIT THIS FILE! Use an override template instead. *}
<div class="message-error">
<h2><span class="time">[{currentdate()|l10n( shortdatetime )}]</span> {'Invalid preferred currency. (4)'|i18n( 'design/admin/error/shop' )}</h2>
{def $preferred_currency = fetch( 'shop', 'preferred_currency_code' )}
<p>{"'%1' cannot be used because it is inactive."|i18n( 'design/admin/error/shop',, array( $preferred_currency ) )}</p>
{undef}
</div>


{section show=$embed_content}
    {$embed_content}
{/section}
