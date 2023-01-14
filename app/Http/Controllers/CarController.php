<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $car = Car::with(['carModel', 'carModel.make'])->find(6);
        // dd($car);
        return view(
            'cars.index'
        );
    }

    // TODO do poprawy pewnie
    public function async(Request $request) {
        $this->authorize('viewAny', Car::class);
        return Car::query()
            ->select('id', 'car_model_id', 'body_type_id', 'fuel_id', 'year', 'odometer', 'VIN', 'engine', 'power')
            ->orderBy('id')
            ->when(
                $request->search,
                fn (Builder $query) => $query->where('id', 'like', "%{$request->search}%")
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
        return view(
            'cars.form'
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
    public function edit(Car $car)
    {
        // dd($car);
        $this->authorize('update', $car);
        return view(
            'cars.form',
            [
                'car' => $car
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
