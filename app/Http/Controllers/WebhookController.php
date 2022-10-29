<?php

namespace App\Http\Controllers;

use App\Mail\DeployNotice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;

class WebhookController extends Controller
{
    public function deploy(Request $request)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Gitlab-Token');
        $localToken = config('app.gitlab_deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);

        if (hash_equals($githubHash, $localHash)) {
            Log::channel('deploy')->info('New push by ' . $request->user_username . '. Code deployed to test: ' . Carbon::now());

            Mail::to('abraham@meto-intl.org')->send(new DeployNotice());

            $process = new Process('cd /var/www/meto-test;  ./deploy.sh');
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });
        }
    }
}
