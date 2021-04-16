@component('mail::message')
# Du nouvau sur shopify !

Un nouveau produit vient d'etre ajouté sur votre plateforme Shopify !
N'hésitez pas à le consulter en cliquant sur le bouton ci-dessous:

@component('mail::button', ['url' => url('produits')])
Voir le produit
@endcomponent

Merci d'avoir choisi Shopify pour votre shopping ! <br><br>
{{ config('app.name') }}
@endcomponent
