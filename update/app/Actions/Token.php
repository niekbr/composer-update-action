<?php

namespace App\Actions;

class Token extends BaseAction
{
    public function run()
    {
        $this->execDump('ls -al /github/home/.composer');
        $this->execDump('cat /github/home/.composer/auth.json');

//        if (! file_exists(env('COMPOSER_HOME'))) {
//            mkdir(env('COMPOSER_HOME'));
//        }
//
//        file_put_contents(env('COMPOSER_HOME')."/auth.json", json_encode([
//            "bitbucket-oauth"=> [],
//            "github-oauth"=> ['github.com' => env('GITHUB_TOKEN')],
//            "gitlab-oauth"=> [],
//            "gitlab-token"=> [],
//            "http-basic"=> [],
//            "bearer"=> []
//        ], JSON_FORCE_OBJECT));
    }

    protected function execDump($command)
    {
        exec($command, $output);
        dump($output);
    }
}
