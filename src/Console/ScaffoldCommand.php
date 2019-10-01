<?php

namespace Lacasera\ApiJwtScaffold\Console;

use Illuminate\Console\Command;
use Lacasera\ApiJwtScaffold\ApiJwtScaffold;

class ScaffoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:auth-api';

    protected $packages = [
        'laravel-passport',
        'tymon-jwt'
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold api jwt authentication';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ApiJwtScaffold $apiJwtScaffold
     * @return mixed
     * @throws \Exception
     */
    public function handle(ApiJwtScaffold $apiJwtScaffold): void
    {
        $packageToUse = $this->choice(
            'which package will you like to use ?',
            $this->packages,
            $this->packages[0]
        );

        $confirmed = $this->confirm('This action may override existing auth configurations. Do you want to proceed?');

        if (!$confirmed) {
            $this->info('Scaffolding aborted');
        }

        $this->info("Scaffolding your api auth using $packageToUse. Please wait..");

        $this->info($apiJwtScaffold->setup($packageToUse));

        $this->info('Authentication scaffolding generated successfully. Happy Hacking');
    }
}
