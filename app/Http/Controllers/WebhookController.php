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
        $githubHash = $request->header('X-Hub-Signature');
        $localToken = config('app.gitlab_deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);

        if (hash_equals($githubHash, $localHash)) {
            Log::channel('deploy')->info('Code deployed to test: ' . Carbon::now());

            Mail::to('abraham@meto-intl.org')->send(new DeployNotice());

            $root_path = base_path();
            $process = new Process('cd ' . $root_path . '; ./deploy.sh');
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });
        }
    }
}
