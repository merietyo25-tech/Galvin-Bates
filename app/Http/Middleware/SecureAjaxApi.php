<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Protège les endpoints AJAX internes contre tout accès externe ou non authentifié.
 * - Retourne JSON 401 si non connecté (jamais une redirection vers /login)
 * - Retourne JSON 403 si le rôle ne correspond pas
 * - Bloque si la requête n'est pas identifiée comme AJAX interne
 */
class SecureAjaxApi
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // 1. Non authentifié → 401 JSON
        if (! Auth::check()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // 2. Vérification de rôle si précisé
        if (! empty($roles)) {
            $user = Auth::user();
            $hasRole = false;
            foreach ($roles as $role) {
                if ($user->hasRole($role)) {
                    $hasRole = true;
                    break;
                }
            }
            if (! $hasRole) {
                return response()->json(['error' => 'Forbidden.'], 403);
            }
        }

        // 3. Vérifier que la requête provient de l'application (header ou Accept JSON)
        $isAjax    = $request->header('X-Requested-With') === 'XMLHttpRequest';
        $wantsJson = $request->expectsJson();
        $sameHost  = $this->isSameHost($request);

        if (! $isAjax && ! $wantsJson) {
            return response()->json(['error' => 'Invalid request type.'], 400);
        }

        if (! $sameHost) {
            return response()->json(['error' => 'Cross-origin access denied.'], 403);
        }

        return $next($request);
    }

    private function isSameHost(Request $request): bool
    {
        $origin  = $request->header('Origin', '');
        $referer = $request->header('Referer', '');

        $source = $origin ?: $referer;

        // Pas d'Origin ni Referer → même serveur, autorisé
        if (! $source || $source === 'null') {
            return true;
        }

        // On compare uniquement le nom d'hôte : derrière un proxy / HTTPS terminé en amont,
        // PHP peut voir "http" ou un autre port alors que le navigateur envoie "https://…".
        // Le jeton CSRF protège déjà contre les requêtes forgées.
        $sourceHost = strtolower((string) parse_url($source, PHP_URL_HOST));
        if ($sourceHost === '') {
            return false;
        }

        $allowed = array_filter(array_unique([
            strtolower($request->getHost()),
            strtolower((string) parse_url((string) config('app.url'), PHP_URL_HOST)),
        ]));

        return in_array($sourceHost, $allowed, true);
    }
}
