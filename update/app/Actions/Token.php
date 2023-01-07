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
        $process = app(Process::class, ['command' => $this->token()]);

        dump($process->setWorkingDirectory($this->base_path)
                ->setTimeout(60)
                ->mustRun()
                ->getOutput());
    }

    /**
     * @return array
     */
    private function token(): array
    {
        return [
            'composer',
            'diagnose',
        ];
    }
}
