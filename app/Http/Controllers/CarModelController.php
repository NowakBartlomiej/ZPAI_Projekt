<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'carModels.index'
        );
    }

    public function async(Request $request) {
        $this->authorize('viewAny', CarModel::class);
        return CarModel::query()
            ->select('id', 'name', 'make_id')
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
        $this->authorize('create', CarModel::class);
        return view(
            'carModels.form'
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
    public function edit($id)
    {
        //
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
