<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cars</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('cssStyles/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('cssStyles/footer.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">

        <a href="{{ url('/') }}" class="logo">
            <h1 class="h">My Car<span class="s">.</span></h1>
        </a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#menu">Featured Offers</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </nav>

        <div class="icons">
            @if (Route::has('login'))
                
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn" >Register</a>
                        @endif
                    @endauth
                
            @endif
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>

    </header>

    
    @yield('content')
    


    <!-- footer section starts -->

    <section class="footer">

        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
            <a href="#" class="fab fa-pinterest"></a>
        </div>

        <div class="credit">created by <span>Bartłomiej Nowak</span></div>

    </section>

    <!-- footer section ends -->

    <script>
        let navbar = document.querySelector('.navbar');

        document.querySelector('#menu-btn').onclick = () => {
            navbar.classList.toggle('active');
            searchForm.classList.remove('active');
            cartItem.classList.remove('active');
        } 
    </script>
</body>
</html>

