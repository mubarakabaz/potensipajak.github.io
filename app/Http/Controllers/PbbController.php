<?php

namespace App\Http\Controllers;

use App\Pbb;
use Illuminate\Http\Request;

class PbbController extends Controller
{
    /**
     * Display a listing of the PBB.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('manage_pbb');

        $pbbQuery = Pbb::query();
        $pbbQuery->where('kelurahan', 'like', '%'.request('q').'%');
        $pbbs = $pbbQuery->paginate(25);

        return view('pbbs.index', compact('pbbs'));
    }

    /**
     * Show the form for creating a new pbb.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Pbb);

        return view('pbbs.create');
    }

    /**
     * Store a newly created pbb in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Pbb);

        $newPbb = $request->validate([
            'jenis_bangunan'      => 'required|max:60',
            'kelurahan'           => 'required|max:255',
            'luas_tanah'          => 'required|max:10',
            'luas_bangunan'       => 'required|max:10',
            'jumlah_bangunan'     => 'required|max:5',
            'ket'          => 'nullable|max:255',
            'address'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $newPbb['creator_id'] = auth()->id();

        $pbb = Pbb::create($newPbb);

        return redirect()->route('pbbs.show', $pbb);
    }

    /**
     * Display the specified pbb.
     *
     * @param  \App\Pbb  $pbb
     * @return \Illuminate\View\View
     */
    public function show(Pbb $pbb)
    {
        return view('pbbs.show', compact('pbb'));
    }

    /**
     * Show the form for editing the specified pbb.
     *
     * @param  \App\Pbb  $pbb
     * @return \Illuminate\View\View
     */
    public function edit(Pbb $pbb)
    {
        $this->authorize('update', $pbb);

        return view('pbbs.edit', compact('pbb'));
    }

    /**
     * Update the specified pbb in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pbb  $pbb
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Pbb $pbb)
    {
        $this->authorize('update', $pbb);

        $pbbData = $request->validate([
            'jenis_bangunan'      => 'required|max:60',
            'kelurahan'           => 'required|max:255',
            'luas_tanah'          => 'required|max:10',
            'luas_bangunan'       => 'required|max:10',
            'jumlah_bangunan'     => 'required|max:5',
            'ket'          => 'nullable|max:255',
            'address'   => 'nullable|max:255',
            'address'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $pbb->update($pbbData);

        return redirect()->route('pbbs.show', $pbb);
    }

    /**
     * Remove the specified pbb from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pbb  $pbb
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Pbb $pbb)
    {
        $this->authorize('delete', $pbb);

        $request->validate(['pbb_id' => 'required']);

        if ($request->get('pbb_id') == $pbb->id && $pbb->delete()) {
            return redirect()->route('pbbs.index');
        }

        return back();
    }
}
