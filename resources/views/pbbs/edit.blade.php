@extends('layouts.app')

@section('title', __('pbb.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $pbb)
        @can('delete', $pbb)
            <div class="card">
                <div class="card-header">{{ __('pbb.delete') }}</div>
                <div class="card-body">
                    <label class="control-label text-primary">{{ __('pbb.kelurahan') }}</label>
                    <p>{{ $pbb->kelurahan }}</p>
                    <label class="control-label text-primary">{{ __('pbb.jenis_bangunan') }}</label>
                    <p>{{ $pbb->jenis_bangunan }}</p>
                    <label class="control-label text-primary">{{ __('pbb.luas_tanah') }}</label>
                    <p>{{ $pbb->luas_tanah }}</p>
                    <label class="control-label text-primary">{{ __('pbb.luas_bangunan') }}</label>
                    <p>{{ $pbb->luas_bangunan }}</p>
                    <label class="control-label text-primary">{{ __('pbb.jumlah_bangunan') }}</label>
                    <p>{{ $pbb->jumlah_bangunan }}</p>
                    <label class="control-label text-primary">{{ __('pbb.address') }}</label>
                    <p>{{ $pbb->address }}</p>
                    <label class="control-label text-primary">{{ __('pbb.keterangan') }}</label>
                    <p>{{ $pbb->ket }}</p>
                    <label class="control-label text-primary">{{ __('pbb.latitude') }}</label>
                    <p>{{ $pbb->latitude }}</p>
                    <label class="control-label text-primary">{{ __('pbb.longitude') }}</label>
                    <p>{{ $pbb->longitude }}</p>
                    {!! $errors->first('pbb_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('pbb.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('pbbs.destroy', $pbb) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="pbb_id" type="hidden" value="{{ $pbb->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('pbbs.edit', $pbb) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('pbb.edit') }}</div>
            <form method="POST" action="{{ route('pbb.update', $pbb) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="kelurahan" class="control-label">{{ __('pbb.kelurahan') }}</label>
                        <input id="kelurahan" type="text" class="form-control{{ $errors->has('kelurahan') ? ' is-invalid' : '' }}" name="kelurahan" value="{{ old('kelurahan', $pbb->kelurahan) }}" required>
                        {!! $errors->first('kelurahan', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="jenis_bangunan" class="control-label">{{ __('pbb.jenis_bangunan') }}</label>
                        <input id="jenis_bangunan" type="text" class="form-control{{ $errors->has('jensi_bangunan') ? ' is-invalid' : '' }}" name="jenis_bangunan" value="{{ old('jenis_bangunan', $pbb->jenis_bangunan) }}" required>
                        {!! $errors->first('jenis_bangunan', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="luas_tanah" class="control-label">{{ __('pbb.luas_tanah') }}</label>
                        <input id="luas_tanah" type="text" class="form-control{{ $errors->has('luas_tanah') ? ' is-invalid' : '' }}" name="luas_tanah" value="{{ old('luas_tanah', $pbb->luas_tanah) }}" required>
                        {!! $errors->first('luas_tanah', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="luas_bangunan" class="control-label">{{ __('pbb.luas_bangunan') }}</label>
                        <input id="luas_bangunan" type="text" class="form-control{{ $errors->has('luas_bangunan') ? ' is-invalid' : '' }}" name="luas_bangunan" value="{{ old('luas_bangunan', $pbb->luas_bangunan) }}" required>
                        {!! $errors->first('luas_bangunan', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bangunan" class="control-label">{{ __('pbb.jumlah_bangunan') }}</label>
                        <input id="jumlah_bangunan" type="text" class="form-control{{ $errors->has('jumlah_bangunan') ? ' is-invalid' : '' }}" name="jumlah_bangunan" value="{{ old('jumlah_bangunan', $pbb->jumlah_bangunan) }}" required>
                        {!! $errors->first('jumlah_bangunan', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">{{ __('pbb.address') }}</label>
                        <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" rows="4">{{ old('address', $pbb->address) }}</textarea>
                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="ket" class="control-label">{{ __('pbb.keterangan') }}</label>
                        <input id="ket" type="text" class="form-control{{ $errors->has('ket') ? ' is-invalid' : '' }}" name="ket" value="{{ old('ket', $pbb->ket) }}" required>
                        {!! $errors->first('ket', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude" class="control-label">{{ __('pbb.latitude') }}</label>
                                <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', $pbb->latitude) }}" required>
                                {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude" class="control-label">{{ __('pbb.longitude') }}</label>
                                <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', $pbb->longitude) }}" required>
                                {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div id="mapid"></div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('pbb.update') }}" class="btn btn-success">
                    <a href="{{ route('pbbs.show', $pbb) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $pbb)
                        <a href="{{ route('pbbs.edit', [$pbb, 'action' => 'delete']) }}" id="del-pbb-{{ $pbb->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 300px; }
</style>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script>
    var mapCenter = [{{ $pbb->latitude }}, {{ $pbb->longitude }}];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.detail_zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Your location :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 16);
        let longitude = e.latlng.lng.toString().substring(0, 16);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);
</script>
@endpush
