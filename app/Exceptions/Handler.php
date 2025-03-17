<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $exception->errors(),
                ], 422);
            }

            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => 'Resource not found',
                ], 404);
            }

            // Handle other exceptions with a generic message in production
            if (!config('app.debug')) {
                return response()->json([
                    'message' => 'Server error',
                ], 500);
            }

            // In debug mode, return more details
            return response()->json([
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => collect($exception->getTrace())->map(function ($trace) {
                    return [
                        'file' => $trace['file'] ?? null,
                        'line' => $trace['line'] ?? null,
                        'function' => $trace['function'] ?? null,
                    ];
                })->take(10)->all(),
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
