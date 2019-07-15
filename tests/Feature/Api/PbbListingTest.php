<?php

namespace Tests\Feature\Api;

use App\Pbb;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PbbListingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_retrieve_pbb_list()
    {
        $pbb = factory(Pbb::class)->create();

        $this->getJson(route('api.pbbs.index'));

        $this->seeJsonSubset([
            'type'     => 'FeatureCollection',
            'features' => [
                [
                    'type'       => 'Feature',
                    'properties' => [
                        'kelurahan'       => $pbb->kelurahan,
                        'jenis_bangunan'       => $pbb->jenis_bangunan,
                        'luas_tanah'       => $pbb->luas_tanah,
                        'luas_bangunan'       => $pbb->luas_bangunan,
                        'address'    => $pbb->address,
                        'keterangan'       => $pbb->ket,
                        'coordinate' => $pbb->coordinate,
                    ],
                    'geometry'   => [
                        'type'        => 'Point',
                        'coordinates' => [
                            $pbb->longitude,
                            $pbb->latitude,
                        ],
                    ],
                ],
            ],
        ]);
    }
}
