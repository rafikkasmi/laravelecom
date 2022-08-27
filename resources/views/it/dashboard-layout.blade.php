@php
function activeClass($current_page){
  return Request::segment(1) == $current_page ? 'active' : '';
}
@endphp
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boutique | Ecommerce bootstrap template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- gLightbox gallery-->
    <link rel="stylesheet" href="/vendor/glightbox/css/glightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="/vendor/nouislider/nouislider.min.css">
    <!-- Choices CSS-->
    <link rel="stylesheet" href="/vendor/choices.js/public/assets/styles/choices.min.css">
    <!-- Swiper slider-->
    <link rel="stylesheet" href="/vendor/swiper/swiper-bundle.min.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/css/shop/style.default.min.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for yourshop/ changes-->
    <link rel="stylesheet" href="/css/shop/custom.css"/>
    <!-- Favicon-->
    <link rel="shortcut icon" href="/img/favicon.png">
  </head>
<body>
    
           <header class="header bg-white">
        <div class="container px-lg-3">
          <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="/"><span class="fw-bold text-uppercase text-dark">DY</span></a>
            <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
               
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('it.categories.index') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('it.products.index') }}">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('it.events.index') }}">Evenements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
            </ul>
             <ul class="navbar-nav ms-auto">               
                 @if (Request::segment(2)=='categories')
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('it.categories.create') }}">Ajouter Categorie</a>
                    </li>
                @elseif (Request::segment(2)=='products')
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('it.products.create') }}">Ajouter Produit</a>
                    </li>
                @elseif (Request::segment(2)=='events')
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('it.events.create') }}">Ajouter Evenement</a>
                    </li>
                @endIf  
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
              </ul>
  
        </div>
          </nav>
        </div>
      </header>
  
@yield('content')
     
</body>
<style>
     h1{
        margin:20px 0 10px 0;
    }
    input{
        margin-bottom:2rem;
    }
</style>
</html>