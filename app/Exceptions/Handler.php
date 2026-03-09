<?php

namespace App\Exceptions;

use App\Traits\Helpers\ResponseApiFunctions;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
    ];
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof \Illuminate\Database\QueryException) {
            $errorInfo = $e->errorInfo ?? [];
            $code = $errorInfo[1] ?? $e->getCode();
            $message = $e->getMessage();
            if ($code == 1062 || (str_contains($message, 'Duplicate entry') && str_contains($message, 'users_email_unique'))) {
                $userMessage = __('messages.email_already_registered');
                if ($request->expectsJson()) {
                    return response()->json(['message' => $userMessage, 'errors' => ['email' => [$userMessage]]], 422);
                }
                return redirect()->back()->withInput($request->except('password', 'password_confirmation'))->with('error', $userMessage);
            }
        }

        return parent::render($request, $e);
    }

    /* public function render($request, Exception|Throwable $e): \Illuminate\Http\Response|JsonResponse|Response
     {
         if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
             return $this->notFoundWithAttributeResponse();
         }

         if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
             return $this->notFoundWithAttributeResponse('route');
         }

         if (
             $e instanceof \Laravel\Sanctum\Exceptions\MissingAbilityException ||
             $e instanceof \Spatie\Permission\Exceptions\UnauthorizedException
         ) {
             return $this->forbiddenWithoutDataResponse();
         }

         if ($e instanceof \GuzzleHttp\Exception\ClientException) {
             return $this->unauthorizedWithoutDataResponse();
         }

         if ($e instanceof BadMethodCallException) {
             return $this->badRequestWithoutDataResponse();
         }

         return parent::render($request, $e);
     }*/
}
