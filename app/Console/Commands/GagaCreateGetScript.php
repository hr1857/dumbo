<?php

namespace App\Console\Commands;

use App\Models\DbGaga\gagaindex;
use Illuminate\Console\Command;

class GagaCreateGetScript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hermann:gagacreategetscript {--gagakurzbez=} {--images_only=true} {--round=second} {--second_with_diff=false} {--startnr=1} {--endnr=0}';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = "Erstellt getallimages-Parameterscript mittels Daten aus der Datenbanktabelle gagaindex.";


    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (!$this->option('gagakurzbez')) {
            $this->fail('Die Gaga-Kurzbezeichnung (Option gagakurzbez) muss angegeben werden. (Für Optionen siehe --help)');
        }
        $params['gagakurzbez'] = $this->option('gagakurzbez');
        $params['round'] = $this->option('round');
        $params['second_with_first'] = 'false';
        $params['images_only'] = $this->option('images_only');
        // no_images ist immer gegenteil von images_only
        $params['no_images'] = ($params['images_only'] === 'true') ? 'false' : 'true';
        $params['second_with_diff'] = ($this->option('second_with_diff') === 'true') ? 'true' : 'false';
        $params['ocr'] = 'false';
        $params['ocr_only'] = 'false';
        $params['filepath'] = storage_path('/gaga/' . $params['gagakurzbez'] . '.bash');

        $m = new(gagaindex::class);
        $r = $m->where('gagakurzbez', '=', $params['gagakurzbez'])->first();
        if ($r === null) {
            $this->fail('Diese Kurzbezeichnung existiert nicht in der Tabelle fina.gagaindex.');
        }
        $this->alert('Erfolg: Kurzbezeichnung in der Tabelle fina.gagaindex gefunden.');

        $params['gagaprojectid'] = $r->gagaprojectid;
        $params['titel'] = $r->titel;
        $params['startnr'] = $this->option('startnr');
        $params['endnr'] = (string)(($this->option('endnr') === '0' ? $r->anzahlseiten : $this->option('endnr')));

        $script = file_get_contents('http://lib.home/gaga/getallimages.bash');
        $script1 = str_replace('###gagaprojectid###', $params['gagaprojectid'], $script);
        $script2 = str_replace('###round###', $params['round'], $script1);
        $script3 = str_replace('###option_second_with_first###', $params['second_with_first'], $script2);
        $script4 = str_replace('###option_images_only###', $params['images_only'], $script3);
        $script5 = str_replace('###option_no_images###', $params['no_images'], $script4);
        $script6 = str_replace('###option_second_with_diff###', $params['second_with_diff'], $script5);
        $script7 = str_replace('###option_ocr###', $params['ocr'], $script6);
        $script8 = str_replace('###option_ocr_only###', $params['ocr_only'], $script7);
        $script9 = str_replace('###startnr###', $params['startnr'], $script8);
        $script10 = str_replace('###endnr###', $params['endnr'], $script9);
        $script11 = str_replace('###gagakurzbez###', $params['gagakurzbez'], $script10);
        $script12 = str_replace('###titel###', $params['titel'], $script11);
        $script13 = str_replace('###filepath###', $params['filepath'], $script12);

        try {
            $f = fopen($params['filepath'], 'w');
            fwrite($f, $script13);
            fclose($f);
            $this->alert('Erfolg: Script ' . $params['filepath'] . ' erstellt.');
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }

        try{
            // kopiere das script ins gaga-projektverzeichnis ohne '.bash'
            $alternative_destination = '/var/www/gaga/projects/' . pathinfo($params['filepath'], PATHINFO_FILENAME);
            //copy($params['filepath'], '/var/www/gaga/projects/' . pathinfo($params['filepath'], PATHINFO_FILENAME));
            copy($params['filepath'], $alternative_destination);
            $this->alert('Erfolg: Script nach' . $alternative_destination . ' kopiert.');
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }

        return 0;
    }
}
