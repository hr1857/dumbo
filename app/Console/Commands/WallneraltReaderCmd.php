<?php

namespace App\Console\Commands;

use App\Models\WallneraltReader;
use Illuminate\Console\Command;

class WallneraltReaderCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hermann:wallneraltreader';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Liest Daten aus der Wallner-Joomla-Datenbank (wallneralt) - experimentell - mit Debugger bearbeiten';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reader = new WallneraltReader();
        $r = $reader->readContent();
        //$reader->writeAsCsv();
    }
}
