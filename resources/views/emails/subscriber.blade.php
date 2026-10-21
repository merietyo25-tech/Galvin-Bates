<x-mail::message>
# Nouveau Abonne

<p style="font-size: 14px !important;">
   Vous avez un nouveau abonné depuis {{ site_name() }}
   <br>
      <strong>Email</strong> : {{$data['email']}}
</p>

<x-mail::subcopy>
Ceci est un e-mail généré automatiquement. Merci de ne pas y répondre.
</x-mail::subcopy>
</x-mail::message>
