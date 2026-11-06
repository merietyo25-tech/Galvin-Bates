{{--
  Protection contre les jetons CSRF périmés (« CSRF token mismatch » / erreur 419).
  - Page ré-affichée depuis le cache du navigateur (bouton retour) : rechargée pour obtenir un jeton neuf.
  - Appel AJAX (fetch ou jQuery) refusé avec 419 : la page est rechargée une fois, au lieu d'un échec silencieux.
--}}
<script>
(function () {
  if (window.__csrfGuard) return;
  window.__csrfGuard = true;

  var KEY = 'csrf_reload_at';
  function reloadOnce() {
    try {
      var last = +sessionStorage.getItem(KEY) || 0;
      if (Date.now() - last < 10000) return;          // évite une boucle de rechargements
      sessionStorage.setItem(KEY, String(Date.now()));
    } catch (e) {}
    window.location.reload();
  }

  // Page restaurée depuis le cache arrière/avant : son jeton peut être périmé
  window.addEventListener('pageshow', function (e) {
    if (e.persisted && document.querySelector('input[name="_token"], meta[name="csrf-token"]')) {
      window.location.reload();
    }
  });

  // fetch() : 419 = jeton périmé
  if (window.fetch) {
    var nativeFetch = window.fetch;
    window.fetch = function () {
      return nativeFetch.apply(this, arguments).then(function (res) {
        if (res.status === 419) reloadOnce();
        return res;
      });
    };
  }

  // jQuery ($.post / $.ajax), s'il est chargé
  document.addEventListener('DOMContentLoaded', function () {
    if (window.jQuery) {
      window.jQuery(document).ajaxError(function (_e, xhr) {
        if (xhr && xhr.status === 419) reloadOnce();
      });
    }
  });
})();
</script>
