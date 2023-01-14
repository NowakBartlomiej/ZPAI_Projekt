{{-- Css --}}
@section('css')
<link rel="stylesheet" href="{{ asset('cssStyles/car-info.css') }}">
@endsection

@extends('layouts.navbar')
@section('content')
    <main class="main">
        <section class="main-info">
            <div class="img">
                <img src="{{ asset('images/car-example.jpg') }}" alt="">
            </div>

            <div class="advert-info">
                <p>18:38, 14 stycznia 2023</p>
                <p><span>ID:</span> {{ $advert->id }} </p>
            </div>

            <div class="details">
                <h2>Details</h2>
                <div class="details-box">
                    <div class="details-info">
                        <h3>Make:</h3>
                        <p>{{ $advert->car->carModel->make->name }}</p>
                    </div>

                    <div class="details-info">
                        <h3>Body Type:</h3>
                        <p>{{ $advert->car->bodyType->name }}</p>
                    </div>

                    <div class="details-info">
                        <h3>Car Model:</h3>
                        <p>{{ $advert->car->carModel->name }}</p>
                    </div>

                    <div class="details-info">
                        <h3>Power:</h3>
                        <p>{{ $advert->car->power }} KM</p>
                    </div>

                    <div class="details-info">
                        <h3>Year:</h3>
                        <p>{{ $advert->car->year }}</p>
                    </div>


                    <div class="details-info">
                        <h3>Odometer:</h3>
                        <p>{{ $advert->car->odometer }} km</p>
                    </div>

                    <div class="details-info">
                        <h3>Fuel:</h3>
                        <p>{{ $advert->car->fuel->name }}</p>
                    </div>

                    <div class="details-info">
                        <h3>VIN:</h3>
                        <p>{{ $advert->car->VIN }}</p>
                    </div>

                    <div class="details-info">
                        <h3>Engine:</h3>
                        <p>{{ $advert->car->engine }} dm&#179;</p>
                    </div>
                </div>
            </div>

            <div class="description">
                <h2>Description</h2>
                <p>{{ $advert->description }}</p>
            </div>

            <div class="user">
                <h2>User Informations</h2>

                <div class="user-info">
                    <div class="mini-data">
                        <i class="fa-solid fa-user"></i>
                        <p>User Name </p>
                    </div>
                    
                    <div class="mini-data">
                        <i class="fa-solid fa-star"></i>                  
                        <p>on My Car<span class="s">.</span> since 2015 </p>
                    </div>
    
                    <div class="tel-number">
                        <i class="fa-solid fa-phone"></i>
                        <h4>123 421 512</h4>
                    </div>
                </div>
            </div>

            <div class="location">
                <div class="location-info">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>{{ $advert->city->name }}, {{ $advert->city->county->name }}</p>
                </div>

                <div class="map">
                    <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d79222.7019494788!2d17.733289813612387!3d51.64684616910433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ab5ad9565a3b1%3A0xb4f7583c67bf1bf7!2sOstr%C3%B3w%20Wielkopolski!5e0!3m2!1spl!2spl!4v1673701832359!5m2!1spl!2spl"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>


        </section>
        
        <section class="side-info">
            <div class="mini-car-info">

                <h2 class="title">{{ $advert->car->carModel->make->name . ' ' . $advert->car->carModel->name }}</h2>
                
                <div class="car-info">
                    <p class="text">{{ $advert->car->year }}</p>
                    <p class="text unit">{{ $advert->car->odometer . ' km' }}</p>
                    <p class="text">{{ $advert->car->fuel->name }}</p>
                    <p class="text unit">{{ $advert->car->engine . ' dm' }} &#179;</p>
                </div>

                <h3 class="car-price">{{  $advert->price }} zł</h3>
       
            </div>

            <div class="mini-user">
                <div class="mini-data">
                    <i class="fa-solid fa-user"></i>
                    <p>User Name </p>
                </div>
                
                <div class="mini-data">
                    <i class="fa-solid fa-star"></i>                  
                    <p class='logo'>on My Car<span class="s">.</span> since 2015 </p>
                </div>

                <div class="mini-data phone-number">
                    <i class="fa-solid fa-phone"></i>
                    <p>123 421 512</p>
                </div>

                <div id="location" class="location-info">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>Poznań, Wielkopolska</p>
                </div>
            </div>

        </section>
    </main>
@endsection