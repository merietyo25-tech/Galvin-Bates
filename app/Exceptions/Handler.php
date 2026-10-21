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
    }
}
