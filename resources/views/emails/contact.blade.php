<x-mail::message>
# Nouveau message

<p style="font-size: 14px !important;">
   Vous avez un nouveau message depuis {{ site_name() }}
   <br>
   <br>
   Informations de l'expéditeur : <br>
      <strong>Nom</strong> : {{$data['name']}} <br>
      <strong>Email</strong> : {{$data['email']}} <br>
      <strong>Objet</strong> : {{$data['subject']}}
</p>

<strong>Message</strong>
<p style="font-size: 12px !important">
    {{$data['message']}}
</p>

<x-mail::subcopy>
Ceci est un e-mail généré automatiquement. Merci de ne pas y répondre.
</x-mail::subcopy>
</x-mail::message>
