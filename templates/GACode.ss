<% if $SiteConfig.GACode %>
<!-- Google tag (gtag.js) --> 
<script async nonce="$StoredNonce" src=https://www.googletagmanager.com/gtag/js?id={$GACode}></script> 
<script nonce="$StoredNonce">
    window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '{$GACode}'); 
</script>   
<% end_if %>