@php($waContact = \App\Models\SiteContact::current())
@if($waContact->whatsappUrl())
<a href="{{ $waContact->whatsappUrl() }}" target="_blank" rel="noopener" aria-label="Discuter sur WhatsApp"
   class="fixed bottom-8 left-8 z-50 w-14 h-14 rounded-full flex items-center justify-center shadow-lg"
   style="background:#25D366;color:#fff;font-size:1.6rem">
    <i class="fab fa-whatsapp"></i>
</a>
@endif
