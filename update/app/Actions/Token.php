<?php

namespace App\Actions;

use Symfony\Component\Process\Process;

class Token extends BaseAction
{
    public function run()
    {
        dump(get_current_user());
        dump(scandir('/github/home/.composer'));
        dump(file_get_contents('/github/home/.composer/auth.json'));
        file_put_contents("/github/home/.composer/auth.json", json_encode([
            "bitbucket-oauth"=> [],
            "github-oauth"=> ['github.com' => env('GITHUB_TOKEN')],
            "gitlab-oauth"=> [],
            "gitlab-token"=> [],
            "http-basic"=> [],
            "bearer"=> []
        ]));

//        dump($process->setWorkingDirectory($this->base_path)
//                ->setTimeout(60)
//                ->mustRun()
//                ->getOutput());

        $process = app(Process::class, ['command' => $this->config()]);
        dump($process->setWorkingDirectory($this->base_path)
            ->setTimeout(60)
            ->mustRun()
            ->getOutput());

    }

    /**
     * @return array
     */
    private function diagnose(): array
    {
        return [
            'composer',
            'diagnose',
        ];
    }

    private function config(): array
    {
        return [
            'composer',
            'global',
            'config',
            '--list',
        ];
    }
}
