<?php

namespace App\Jobs;

use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class importCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url_file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($urlfile)
    {
        $this->url_file = $urlfile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        DB::connection()->getPdo()->exec("
            LOAD DATA LOCAL INFILE '{$this->url_file}'
            INTO TABLE pnn_publico
            FIELDS TERMINATED BY ','
            IGNORE 1 ROWS(
                @ignore, @ignore, @ignore, @ignore, @ignore, @ignore, @ignore, 
                @nir, @serie, @ignore, @ignore, @ignore, @ignore, @ignore, 
                @ignore, @ignore, @ignore, @ignore, @ignore
            )
            set serie=CONCAT(@nir, @serie)
        ");

        /*DB::connection()->getPdo()->exec("
            LOAD DATA LOCAL INFILE '{$this->url_file}'
            IGNORE
            INTO TABLE pnn_publico
            FIELDS TERMINATED BY ','
            IGNORE 1 ROWS(
                @ignore, @ignore, @ignore, @ignore, @ignore, @ignore, @ignore, 
                @nir, @serie, @ignore, @ignore, @ignore, @ignore, @ignore, 
                @ignore, @ignore, @ignore, @ignore, @ignore
            )
            set serie=CONCAT(@nir, @serie)
        ");*/
    }
}
