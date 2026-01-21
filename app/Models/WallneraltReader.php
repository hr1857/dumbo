<?php

namespace App\Models;

use App\Models\DbWallneralt\jaa_content;
use Illuminate\Database\Eloquent\Collection;

class WallneraltReader
{
    // siehe https://dev.to/iheb_jabri/building-a-quick-csv-export-command-in-laravel-538e

    public function __construct()
    {
    }

    /**
     * readContent
     *
     * state 1/0 = aktiv/inaktiv
     * featured 1/0 = Haupteintrag ja/nein. Beachte: Alle Anhänger sind KEINE Haupteinträge (Haupteinträge haben gelben Stern)
     *
     * @return int
     */
    public function readContent()
    {
        $separator = ';';

        $output = fopen('./anhaenger1.csv', 'wb+'); // Open a stream to StdOut

        // Write the CSV headers
        fputcsv($output, ['id', 'category', 'title', 'modified', 'images'], $separator);

        $list = jaa_content::where('state', 1)
            ->where('featured', 0)
            ->where('id', '>', 19)
            ->get();
        foreach ($list as $contentitem) {
            $id = $contentitem->id;
            $title = $contentitem->title;
            $introtext = $contentitem->introtext;
            $images = $contentitem->images;
            $category_featured = $contentitem->featured;
            $category_title = $contentitem->category->title;
            $category_alias = $contentitem->category->alias;

            $images_decoded = json_decode($contentitem->images);

            fputcsv(
                $output,
                [
                    $contentitem->id,
                    $contentitem->category->title,
                    $contentitem->title,
                    $contentitem->modified,
                    json_decode($contentitem->images)->image_intro
                ],
                $separator = ';'
            );
        }

        return 1;
    }


    public function writeAsCsv()
    {
        $chunk = 500; // Number of records per chunk
        //$output = fopen('php://stdout', 'wb+'); // Open a stream to StdOut
        $output = fopen('./anhaenger.csv', 'wb+'); // Open a stream to StdOut

        $separator = ';';

        // Write the CSV headers
        fputcsv($output, ['id', 'title', 'modified', 'images'], $separator);

        // Query the data and write to CSV in chunks
        jaa_content::select(['id', 'title', 'modified', 'images'])
            ->chunk($chunk, function (Collection $jaa_content) use ($output) {
                $jaa_content->each(
                    fn($jaa_content) => fputcsv($output, [
                        $jaa_content->id,
                        $jaa_content->title,
                        $jaa_content->modified,
                        json_decode($jaa_content->images)->image_intro
                    ],                          $separator = ';')
                );
            });
    }
}
