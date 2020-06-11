<?php

namespace App\Console\Commands;

use App\Toilet;
use Illuminate\Console\Command;

class updateToilets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:toilets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the toilets table in the database.';

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
        $json = file_get_contents(config('services.toiletapi.endpoint'));
        $toiletten = json_decode($json);

        foreach($toiletten as $toilet) {
            if ($toilet->deleted != 1) {
                $dbToilet = Toilet::updateOrCreate(
                    ['business_product_id' => $toilet->business_product_id,
                        'name' => $toilet->name != '' ? $toilet->name : null,
                        'street' => $toilet->street != '' ? $toilet->street : null,
                        'house_number' => $toilet->house_number != '' ? $toilet->house_number : null,
                        'box_number' => $toilet->box_number != '' ? $toilet->box_number : null,
                        'postal_code' => $toilet->postal_code != '' ? $toilet->postal_code : null,
                        'city_name' => $toilet->city_name != '' ? $toilet->city_name : null,
                        'main_city_name' => $toilet->main_city_name != '' ? $toilet->main_city_name : null,
                        'lat' => $toilet->lat != '' ? $toilet->lat : null,
                        'long' => $toilet->long != '' ? $toilet->long : null,
                        'product_description' => $toilet->product_description != '' ? $toilet->product_description : null,
                        'updated_at' => $toilet->changed_time != '' ? $toilet->changed_time : null]
                );

            }
        }
    }
}
