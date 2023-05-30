<?php

namespace Aqamarine\AlphaNews\Console;

use Aqamarine\AlphaNews\Console\Enums\PostMediaTypeEnumMakeCommand;

class GenerateEnumsCommand extends \Illuminate\Console\Command
{
    protected $name = 'alphanews:generate-enums';

    protected $description = 'Creates all needed enums.';

    public function handle(): int
    {
        $this->call(PostMediaTypeEnumMakeCommand::class);
        return 0;
    }
}
