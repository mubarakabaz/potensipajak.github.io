@extends('layouts.app')

@section('title', __('pbb.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('pbb.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('pbb.kelurahan') }}</td><td>{{ $pbb->kelurahan }}</td></tr>
                        <tr><td>{{ __('pbb.jenis_bangunan') }}</td><td>{{ $pbb->jenis_bangunan }}</td></tr>
                        <tr><td>{{ __('pbb.luas_tanah') }}</td><td>{{ $pbb->luas_tanah }}</td></tr>
                        <tr><td>{{ __('pbb.luas_bangunan') }}</td><td>{{ $pbb->luas_bangunan }}</td></tr>
                        <tr><td>{{ __('pbb.jumlah_bangunan') }}</td><td>{{ $pbb->jumlah_bangunan }}</td></tr>
                        <tr><td>{{ __('pbb.address') }}</td><td>{{ $pbb->address }}</td></tr>
                        <tr><td>{{ __('pbb.keterangan') }}</td><td>{{ $pbb->keterangan }}</td></tr>
                        <tr><td>{{ __('pbb.latitude') }}</td><td>{{ $pbb->latitude }}</td></tr>
                        <tr><td>{{ __('pbb.longitude') }}</td><td>{{ $pbb->longitude }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $pbb)
                    <a href="{{ route('pbbs.edit', $pbb) }}" id="edit-pbb-{{ $pbb->id }}" class="btn btn-warning">{{ __('pbb.edit') }}</a>
                @endcan
                <a href="{{ route('pbbs.index') }}" class="btn btn-link">{{ __('pbb.back_to_index') }}</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ trans('pbb.location') }}</div>
            @if ($pbb->coordinate)
            <div class="card-body" id="mapid"></div>
            @else
            <div class="card-body">{{ __('pbb.no_coordinate') }}</div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 400px; }
</style>
@endsection
@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

<script>
    var map = L.map('mapid').setView([{{ $pbb->latitude }}, {{ $pbb->longitude }}], {{ config('leaflet.detail_zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Abazdev &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $pbb->latitude }}, {{ $pbb->longitude }}]).addTo(map)
        .bindPopup('{!! $pbb->map_popup_content !!}');
</script>
@endpush
