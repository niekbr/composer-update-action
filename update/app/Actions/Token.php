<?php

namespace App\Actions;

use Symfony\Component\Process\Process;

class Token extends BaseAction
{
    public function run()
    {
        unlink('~/.config/composer/auth.json');
    }
}
