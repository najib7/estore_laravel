<?php

namespace App\Console\Commands;

use App\Models\UserPrivilege;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreatePrivileges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'privileges:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate default privileges';

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

        $default_privileges = ['show', 'create', 'update', 'delete'];
        foreach(File::allFiles($path) as $file) {
            $model = 'App\\Models\\' . substr($file->getRelativePathname(), 0, -4);


            foreach ($default_privileges as $item) {

                $existe = UserPrivilege::where('privilege', $item)->where('model', $model)->get()->count();
                if($existe !== 0) continue;

                UserPrivilege::create([
                    'privilege' => $item,
                    'model' => $model
                ]);
                $this->line($model . ': ' . $item . 'privilege created');
            }
        }
        $this->line('done');
    }
}
