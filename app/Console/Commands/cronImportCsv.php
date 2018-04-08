<?php

namespace App\Console\Commands;

use App\Pnn;
use App\Jobs\ImportCsv;
use Illuminate\Console\Command;

class cronImportCsv extends Command
{
    protected $path_file = "C:xampp/htdocs/fmbapp/public/csv/pnn_publico.csv";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import_csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron for import csv data to pnn_public data table.';

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
        if(is_readable($this->path_file)){
            Pnn::query()->truncate();
            dispatch(new importCsv($this->path_file));
        }else{
            dd("El archivo no existe o no es ligible.");
        }
    }
}
