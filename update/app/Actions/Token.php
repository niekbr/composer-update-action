<?php

namespace App\Actions;

use Symfony\Component\Process\Process;

class Token extends BaseAction
{
    public function run()
    {
        try {
            /**
             * @var Process $process
             */
            $process = app(Process::class, ['command' => $this->diagnose()]);
            
            dump($process->setWorkingDirectory($this->base_path)
                ->setTimeout(60)
                ->mustRun()
                ->getOutput());

            $process = app(Process::class, ['command' => $this->config()]);
            dump($process->setWorkingDirectory($this->base_path)
                ->setTimeout(60)
                ->mustRun()
                ->getOutput());
        } catch(\Exception $e) {}


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
