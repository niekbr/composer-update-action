<?php

namespace App\Actions;

class Token extends BaseAction
{
    public function run()
    {
        dump(env('HOME')."/.composer/auth.json");
        dump(env('COMPOSER_HOME'));
        $this->execDump('whoami');
        $this->execDump('composer diagnose');
        $this->execDump('composer global config bin-dir --absolute');
        $this->execDump('composer config --global --unset github-oauth.github.com');
        $this->execDump('composer config global --list');

        if (! file_exists(env('HOME').'/.composer')) {
            mkdir(env('HOME').'/.composer');
        }

        file_put_contents(env('HOME')."/.composer/auth.json", json_encode([
            "bitbucket-oauth"=> [],
            "github-oauth"=> ['github.com' => env('GITHUB_TOKEN')],
            "gitlab-oauth"=> [],
            "gitlab-token"=> [],
            "http-basic"=> [],
            "bearer"=> []
        ], JSON_FORCE_OBJECT));
    }

    protected function execDump($command)
    {
        exec($command, $output);
        dump($output);
    }
}
