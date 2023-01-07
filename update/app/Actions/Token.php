<?php

namespace App\Actions;

use Symfony\Component\Process\Process;

class Token extends BaseAction
{
    public function run()
    {
        file_put_contents("~/.composer/auth.json", json_encode([
            "bitbucket-oauth"=> [],
            "github-oauth"=> [],
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
