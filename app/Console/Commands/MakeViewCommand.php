<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
class MakeViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new blade file ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $view = $this->argument('view');

        $viewPath = resource_path('views/' . str_replace('.', '/', $view) . '.blade.php');


        $directory = dirname($viewPath);

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
            $this->info("Directory created: {$directory}");
        }

        if (File::exists($viewPath)) {
            $this->error("The view {$view} already exists at {$viewPath}.");
            return 1;
        }

        File::put($viewPath, '<!-- New Blade view -->');
        $this->info("View created: {$viewPath}");

        return 0;
    }
}
