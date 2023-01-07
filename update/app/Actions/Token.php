<?php

namespace App\Actions;

use Symfony\Component\Process\Process;

class Token extends BaseAction
{
    public function run()
    {
        /**
         * @var Process $process
         */
        $process = app(Process::class, ['command' => $this->diagnose()]);

        dump(file_exists('~/.config/composer/auth.json') && file_get_contents('~/.config/composer/auth.json'));
        dump(file_exists('~/.composer/auth.json') && file_get_contents('~/.composer/auth.json'));

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
