<?php

namespace App\Console\Commands;

use File;
use App\Pnn;
use App\Jobs\ImportCsv;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
       ini_set('memory_limit', '1024M');
       ini_set('max_execution_time', 0);

        if(is_readable($this->path_file)){    
            Pnn::query()->truncate();
            dispatch(new importCsv($this->path_file));

            $pnns = Pnn::distinct()->get(['serie']);
            if(count($pnns) > 0){
                $data = json_encode($pnns);
                $file = 'pnnpublico.json';
                if(!File::exists(public_path().'/json')){
                    File::makeDirectory(public_path().'/json');
                }else{
                    if(file_exists(public_path().'/json/pnnpublico.json')){
                        unlink(public_path().'/json/pnnpublico.json');
                    }
                }
                File::put(public_path().'\/json/'.$file, $data);
                copy(public_path().'/json/pnnpublico.json', 'C:\Users\halexgs\Desktop\fmb\fmbspa\src\assets\pnnpublico.json');
            }
        }else{
            dd("El archivo no existe o no es ligible.");
        }
    }
}
