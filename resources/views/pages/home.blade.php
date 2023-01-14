{{-- Css --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('cssStyles/home.css') }}">
@endsection

@extends('layouts.navbar')
@section('content')
    
    {{-- Home section starts --}}
    <section class="home" id="home">

        <div class="content">

            <h3>Find your dream <span class='s'>CAR</span></h3>
            <p>We have over <span class="s">XXX</span> adverts!
            </p>
            <a href="{{ url('carlist') }}" class="btn btn-home">get yours now</a>

        </div>

    </section>
    {{-- Home section ends --}}

    {{-- Offers starts --}}
    <section class="menu" id="menu">

        <h1 class="heading"> featured <span>offers</span> </h1>

        <div class="box-container">

            <div class="box">
                <div class="img">
                    <img src="{{ asset('images/car-example.jpg') }}" alt="">
                </div>

                
                <h2 class="title">Audi A3</h2>
                

                <div class="car-info">
                    <p class="text">1999</p>
                    <p class="text">123 456km</p>
                    <p class="text">Diesel</p>
                    <p class="text">1.9</p>
                </div>

                
                <h3 class="car-price">49 999 zł</h3>
                
            </div>

            <div class="box">
                <div class="img">
                    <img src="{{ asset('images/car-example.jpg') }}" alt="">
                </div>

                
                <h2 class="title">Audi A3</h2>
                

                <div class="car-info">
                    <p class="text">1999</p>
                    <p class="text">123 456km</p>
                    <p class="text">Diesel</p>
                    <p class="text">1.9</p>
                </div>

                
                <h3 class="car-price">49 999 zł</h3>
                
            </div>

            <div class="box">
                <div class="img">
                    <img src="{{ asset('images/car-example.jpg') }}" alt="">
                </div>

                
                <h2 class="title">Audi A3</h2>
                

                <div class="car-info">
                    <p class="text">1999</p>
                    <p class="text">123 456km</p>
                    <p class="text">Diesel</p>
                    <p class="text">1.9</p>
                </div>

                
                <h3 class="car-price">49 999 zł</h3>
                
            </div>

            <div class="box">
                <div class="img">
                    <img src="{{ asset('images/car-example.jpg') }}" alt="">
                </div>

                
                <h2 class="title">Audi A3</h2>
                

                <div class="car-info">
                    <p class="text">1999</p>
                    <p class="text">123 456km</p>
                    <p class="text">Diesel</p>
                    <p class="text">1.9</p>
                </div>

                
                <h3 class="car-price">49 999 zł</h3>
                
            </div>
        </div>
    </section>
    {{-- Offers ends --}}

    <!-- about section starts -->
    <section class="about" id="about">

        <h1 class="heading"> <span>about</span> us </h1>

        <div class="row">

            <div class="image">
                <img src="{{ asset('images/about-us.jpg') }}" alt="about">
            </div>

            <div class="content">
                <h3>why we are the best classifieds website?</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio cupiditate perspiciatis fugit
                    voluptatum sint porro aperiam, ducimus explicabo cum magnam nam necessitatibus sapiente ab at
                    assumenda minima odio dolorem enim.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae iusto quos cupiditate hic quae quasi
                    nobis deleniti, eaque consequatur natus.</p>
                <a href="#" class="btn">learn more</a>
            </div>

        </div>

    </section>
    <!-- about section ends -->

    <!-- contact section starts -->

    <section class="contact" id="contact">

        <h1 class="heading"><span>contact</span> us</h1>

        <div class="row">

            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d79222.7019494788!2d17.733289813612387!3d51.64684616910433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ab5ad9565a3b1%3A0xb4f7583c67bf1bf7!2sOstr%C3%B3w%20Wielkopolski!5e0!3m2!1spl!2spl!4v1673701832359!5m2!1spl!2spl"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            <form action="">
                <h3>get in touch</h3>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="name">
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" placeholder="email">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <input type="number" placeholder="number">
                </div>
                <input type="submit" value="contact now" class="btn">
            </form>

        </div>

    </section>

    <!-- contact section ends -->

@endsection