<?php

namespace App\Http\Controllers\Api;

use App\Pbb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pbb as PbbResource;

class PbbController extends Controller
{
    /**
     * Get pbb listing on Leaflet JS geoJSON data structure.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $pbbs = Pbb::all();

        $geoJSONdata = $pbbs->map(function ($pbb) {
            return [
                'type'       => 'Feature',
                'properties' => new PbbResource($pbb),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $pbb->longitude,
                        $pbb->latitude,
                    ],
                ],
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}
