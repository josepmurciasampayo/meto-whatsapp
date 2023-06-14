<?php

namespace App\Exceptions;

use App\Mail\ExceptionOccured;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if (App::environment('prod')) {
                $this->sendEmail($e);
            }
        });
    }

    /**
     * Sends an email upon exception.
     *
     * @param \Throwable $exception
     *
     * @return void
     */
    public function sendEmail(Throwable $exception)
    {
        try {
            $content['message'] = $exception->getMessage();
            $content['file'] = $exception->getFile();
            $content['line'] = $exception->getLine();
            $content['trace'] = $exception->getTrace();
            $content['url'] = request()->url();
            $content['referrer'] = Request::server('HTTP_REFERER');
            $content['body'] = request()->all();
            $content['ip'] = request()->ip();
            $content['user'] = (Auth::user()) ? Auth::user() : '';
            Mail::send(new ExceptionOccured($content));
        } catch (Throwable $exception) {
            Log::error($exception);
        }
    }
}
