<?php

use App\User;
use App\Pbb;
use Faker\Generator as Faker;

$factory->define(Pbb::class, function (Faker $faker) {
    $mapCenterLatitude = config('leaflet.map_center_latitude');
    $mapCenterLongitude = config('leaflet.map_center_longitude');
    $minLatitude = $mapCenterLatitude - 0.05;
    $maxLatitude = $mapCenterLatitude + 0.05;
    $minLongitude = $mapCenterLongitude - 0.07;
    $maxLongitude = $mapCenterLongitude + 0.07;

    return [
        'jenis_bangunan'       => ucwords($faker->words(2, true)),
        'kelurahan'            => $faker->kelurahan,
        'luas_tanah'           => $faker->luas_tanah,
        'luas_bangunan'        => $faker->luas_bangunan,
        'jumlah_bangunan'      => $faker->jumlah_bangunan,
        'address'    => $faker->address,
        'ket'        => $faker->ket,
        'latitude'   => $faker->latitude($minLatitude, $maxLatitude),
        'longitude'  => $faker->longitude($minLongitude, $maxLongitude),
        'creator_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
