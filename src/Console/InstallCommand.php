<?php

namespace Carro\Core\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carro-core:install
                            {--uuids : Use UUIDs for all client IDs}
                            {--force : Overwrite keys they already exist}
                            {--length=4096 : The length of the private key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the commands necessary to prepare Carro Core for use';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
    }
}
