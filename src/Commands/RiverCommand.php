<?php

namespace Rashidul\River\Commands;

use Illuminate\Console\Command;

class RiverCommand extends Command
{
    public $signature = 'river';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
