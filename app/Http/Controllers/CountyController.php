<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', County::class);
        return view(
            'counties.index'
        );
    }

    public function async(Request $request) {
        $this->authorize('viewAny', County::class);
        return County::query()
            ->select('id', 'name', 'code')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) => $query->where('name', 'like', "%{$request->search}%")
            )->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn(
                    'id',
                    array_map(
                        fn (array $item) => $item['id'],
                        array_filter(
                            $request->input('selected', []),
                            fn ($item) => (is_array($item) && isset($item['id']))
                        )
                    )
                ),
                fn (Builder $query) => $query
            )->get();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', County::class);
        return view(
            'counties.form'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(County $county)
    {
        $this->authorize('update', $county);
        return view(
            'counties.form',
            [
                'county' => $county
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
