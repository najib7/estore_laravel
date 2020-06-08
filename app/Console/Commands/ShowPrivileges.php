<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ShowPrivileges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'privileges:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'show default privileges';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = app_path() . "/Models";

        foreach(File::allFiles($path) as $file) {
            $model = 'App\\Models\\' . substr($file->getRelativePathname(), 0, -4);
            $this->line($model);
        }
    }
}
