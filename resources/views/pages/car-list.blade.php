{{-- Css --}}
@section('css')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endsection --}}

<link rel="stylesheet" href="{{ asset('cssStyles/car-list.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
@extends('layouts.navbar')
@section('content')
    <main class="main">
        <div class="wrapper">
        <div class="filter-box">
            <form class="filter-form" action="" method="GET">
                <div class="select-boxes">
                   
                    <select name="bodyType" id="bodyType">
                        <option value="0">Body Type</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                    </select>

                    <select name="make" id="make">
                        <option value="0">Make</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                    </select>

                    <select name="carModel" id="carModel">
                        <option value="0">Car Model</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                    </select>

                    <select name="fuel" id="fuel">
                        <option value="0">Fuel Type</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                    </select>

                </div>

                <div class="range-inputs">
                    <div class="range-input">
                        <h3>Year</h3>
                        <div class="inputs">
                            <h4>from</h4>
                            <input name="year-from" type="text">
                            <h4>to</h4>
                            <input name="year-to" type="text">
                        </div>
                    </div>

                    <div class="range-input">
                        <h3>Odometer</h3>
                        <div class="inputs">
                            <h4>from</h4>
                            <input name="odometer-from" type="text">
                            <h4>to</h4>
                            <input name="odometer-to" type="text">
                        </div>
                    </div>

                    <div class="range-input">
                        <h3>Engine</h3>
                        <div class="inputs">
                            <h4>from</h4>
                            <input name="engine-from" type="text">
                            <h4>to</h4>
                            <input name="engine-to" type="text">
                        </div>
                    </div>

                    <div class="range-input">
                        <h3>Power</h3>
                        <div class="inputs">
                            <h4>from</h4>
                            <input name="power-from" type="text">
                            <h4>to</h4>
                            <input name="power-to" type="text">
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn filter-btn">Filter</button>
            </form>
        </div>
    </div>


    <section class="menu" id="menu">

        <h1 class="heading"><span>R</span>esults </h1>

        <div class="box-container">


            @foreach ($adverts as $advert)
                <a href="{{ url('carlist/' . $advert->id) }}">
                <div class="box">
                    <div class="img">
                        <img src="{{ asset('images/car-example.jpg') }}" alt="">
                    </div>

                
                    <h2 class="title">{{ $advert->car->carModel->make->name . ' ' . $advert->car->carModel->name }}</h2>
                    
                    <div class="car-info">
                        <p class="text">{{ $advert->car->year }}</p>
                        <p class="text unit">{{ $advert->car->odometer . ' km' }}</p>
                        <p class="text">{{ $advert->car->fuel->name }}</p>
                        <p class="text unit">{{ $advert->car->engine . ' dm' }} &#179;</p>
                    </div>

                    
                    <h3 class="car-price">{{  $advert->price }} zł</h3>
                    
                </div>
                </a>
            @endforeach
            
            <div>{{ $adverts->links() }}</div>
        </div>
        
    </section>
    {{-- Offers ends --}}
    </main>
@endsection