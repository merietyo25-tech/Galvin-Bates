<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Quand le total televerse depasse post_max_size, PHP vide la requete : plus de
        // fichiers, plus de jeton CSRF. L utilisateur tombait sur une page d erreur brute
        // 413 sans comprendre que ses photos etaient simplement trop lourdes.
        $this->renderable(function (PostTooLargeException $e, $request) {
            $message = __('message.upload_too_large');

            if ($request->expectsJson()) {
                return response()->json(['message' => $message], 413);
            }

            return redirect()->back()->withInput($request->except(['id_photo_recto', 'id_photo_verso']))
                ->withErrors(['upload' => $message]);
        });

        // Jeton CSRF périmé : page restée ouverte au-delà de la durée de session, déconnexion
        // dans un autre onglet, page ré-affichée depuis le cache… Au lieu du message brut
        // « CSRF token mismatch » / page 419, on renvoie l'utilisateur sur la page avec un
        // jeton neuf et ses saisies conservées : il n'a plus qu'à renvoyer le formulaire.
        // Laravel convertit TokenMismatchException en HttpException 419 avant ces callbacks.
        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
            if ($e->getStatusCode() !== 419) {
                return null; // autres erreurs HTTP : traitement normal
            }
            $message = __('auth.session_expired');

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'message' => $message,
                    'reload'  => true,
                    'token'   => csrf_token(),
                ], 419);
            }

            $back = url()->previous();
            if (! $back || $back === $request->fullUrl()) {
                $back = auth()->check() ? url('/') : route('login');
            }

            $redirect = redirect()->to($back)
                ->withInput($request->except(['_token', 'password', 'password_confirmation', 'current_password', 'code']));

            // Espace client / admin : la mise en page affiche déjà session('error').
            // Pages de connexion et site public : elles affichent $errors.
            return $request->is('app', 'app/*', 'admin', 'admin/*', 'super-admin', 'super-admin/*', 'dashboard', 'dashboard/*')
                ? $redirect->with('error', $message)
                : $redirect->withErrors(['session' => $message]);
        });
    }
}
