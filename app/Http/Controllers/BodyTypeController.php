<?php

namespace App\Http\Controllers;

use App\Models\BodyType;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BodyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', BodyType::class);
        return view(
            'bodyTypes.index'
        );
    }

    public function async(Request $request) {
        $this->authorize('viewAny', BodyType::class);
        return BodyType::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) => $query->where('name', 'like', "%{$request->search}%")
            )->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn(
                    'id',
                    // array_map(
                    //     fn (array $item) => $item['id'],
                    //     array_filter(
                    //         $request->input('selected', []),
                    //         fn ($item) => (is_array($item) && isset($item['id']))
                    //     )
                    // )
                    $request->input('selected', [])
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
        $this->authorize('create', BodyType::class);
        return view(
            'bodyTypes.form'
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
    public function edit(BodyType $bodyType)
    {
        $this->authorize('update', $bodyType);
        return view(
            'bodyTypes.form',
            [
                'bodyType' => $bodyType
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
