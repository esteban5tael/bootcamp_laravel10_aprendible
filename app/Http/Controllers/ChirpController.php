<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $chirps = Chirp::with('user')->latest()->get();

        return view('chirps.index', compact('chirps'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $validated = $request->validate([
            'message' => ['required', 'min:10'],
        ]);
        // insert into database


        $chirp = Chirp::create([
            'user_id' => auth()->user()->id,
            'message' => $request->get('message'),
        ]);

        $chirps = Chirp::with('user')->latest()->get();

        return to_route('chirps.index', compact('chirps'))
            ->with('status', __('Chirp Created Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        if (auth()->user()->isNot($chirp->user)) {
            abort(403);
        } else {
            return view('chirps.edit', compact('chirp'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
        if (auth()->user()->isNot($chirp->user)) {
            abort(403);
        } else {
            $validated = $request->validate([
                'message' => ['required', 'min:10'],
            ]);



            $chirp->update($validated);

            return to_route('chirps.index')
            ->with('status', __('Chirp Updated Successfully'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
        
        if (auth()->user()->isNot($chirp->user)) {
            abort(403);
        } else {
            

            $chirp->delete();

            return to_route('chirps.index')
            ->with('status', __('Chirp Deleted Successfully'));
        }
    }
}
