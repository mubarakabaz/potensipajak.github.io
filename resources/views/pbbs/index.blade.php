@extends('layouts.app')

@section('title', __('pbb.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Pbb)
            <a href="{{ route('pbbs.create') }}" class="btn btn-success">{{ __('pbb.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('pbb.list') }} <small>{{ __('app.total') }} : {{ $pbbs->total() }} {{ __('pbb.pbb') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="control-label">{{ __('pbb.search') }}</label>
                        <input placeholder="{{ __('pbb.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('pbb.search') }}" class="btn btn-secondary">
                    <a href="{{ route('pbbs.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('pbb.kelurahan') }}</th>
                        <th>{{ __('pbb.jenis_bangunan') }}</th>
                        <th>{{ __('pbb.luas_tanah') }}</th>
                        <th>{{ __('pbb.luas_bangunan') }}</th>
                        <th>{{ __('pbb.address') }}</th>
                        <th>{{ __('pbb.keterangan') }}</th>
                        <th>{{ __('pbb.latitude') }}</th>
                        <th>{{ __('pbb.longitude') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pbbs as $key => $pbb)
                    <tr>
                        <td class="text-center">{{ $pbbs->firstItem() + $key }}</td>
                        <td>{!! $pbb->kelurahan !!}</td>
                        <td>{!! $pbb->jenis_bangunan !!}</td>
                        <td>{!! $pbb->luas_tanah !!}</td>
                        <td>{!! $pbb->luas_bangunan !!}</td>
                        <td>{{ $pbb->address }}</td>
                        <td>{!! $pbb->ket !!}</td>
                        <td>{{ $pbb->latitude }}</td>
                        <td>{{ $pbb->longitude }}</td>
                        <td class="text-center">
                            <a href="{{ route('pbbs.show', $pbb) }}" id="show-pbb-{{ $pbb->id }}">{{ __('app.show') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $pbbs->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
