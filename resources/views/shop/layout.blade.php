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
    <div class="page-holder d-flex flex-column min-vh-100">
      <!-- navbar-->
      <header class="header bg-white">
        <div class="container px-lg-3">
          <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="/"><span class="fw-bold text-uppercase text-dark">DY</span></a>
            <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <!-- Link--><a class="nav-link {{activeClass('/')}}" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                  <!-- Link--><a class="nav-link {{activeClass('shop')}}" href="/shop">Boutique</a>
                </li>
                <li class="nav-item">
                  <!-- Link--><a class="nav-link {{activeClass('events')}}" href="/events">Evenements</a>
                </li>
                @auth
                @if(Auth::user()->role_id==3)
                  <li class="nav-item">
                  <!-- Link--><a class="nav-link" href="/admin/events">Page Admin</a>
                </li>
                @elseif(Auth::user()->role_id==2)
                <li class="nav-item">
                  <!-- Link--><a class="nav-link" href="/it/products">Page IT</a>
                </li>
                @endif
                @endauth
                <!-- <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                  <div class="dropdown-menu mt-3 shadow-sm" aria-labelledby="pagesDropdown"><a class="dropdown-item border-0 transition-link" href="index.html">Homepage</a><a class="dropdown-item border-0 transition-link" href="shop.html">Category</a><a class="dropdown-item border-0 transition-link" href="detail.html">Product detail</a><a class="dropdown-item border-0 transition-link" href="cart.html">Shopping cart</a><a class="dropdown-item border-0 transition-link" href="checkout.html">Checkout</a></div>
                </li> -->
              </ul>
              <ul class="navbar-nav ms-auto">               
                @auth
                <li class="nav-item"><a class="nav-link {{activeClass('cart')}}" href="/cart"> <i class="fas fa-dolly-flatbed me-1 text-gray"></i>Panier<small class="text-gray fw-normal cartcount">(0)</small></a></li>
                <li class="nav-item"><a class="nav-link {{activeClass('account')}}" href="/account"> <i class="fas fa-user me-1 text-gray fw-normal"></i>Compte</a></li>
                <li class="nav-item"><a class="nav-link {{activeClass('logout')}}" href="/logout"> <i class="fas fa-door-open me-1 text-gray"></i>Se Deconnecter</a></li>
                @else
                <li class="nav-item"><a class="nav-link {{activeClass('login')}}" href="login"> <i class="fas fa-user me-1 text-gray fw-normal"></i>Se Connecter</a></li>
                <li class="nav-item"><a class="nav-link {{activeClass('login')}}" href="register">Creer Un Compte</a></li>
                @endauth
              </ul>
            </div>
          </nav>
        </div>
      </header>
    <div class="container h-100 my-5">
@yield('content')
</div>
      <footer class="bg-dark text-white mt-auto">
        <div class="container py-4">
          
          <div class="border-top pt-4" style="border-color: #1d1d1d !important">
            <div class="row">
              <div class="col-md-6 text-center text-md-start">
                <p class="small text-muted mb-0">&copy; 2022 DY</p>
              </div>
            
            </div>
          </div>
        </div>
      </footer>
      <!-- JavaScript files-->
      <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="/vendor/glightbox/js/glightbox.min.js"></script>
      <script src="/vendor/nouislider/nouislider.min.js"></script>
      <script src="/vendor/swiper/swiper-bundle.min.js"></script>
      <script src="/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
      <script src="/js/front.js"></script>
      @auth
      <script>
        function addQuantity(addedQuantity){
          const quantityEl = document.querySelector('.cartcount')
          let rawText=quantityEl.textContent
          let oldQuantity = rawText.substring(rawText.indexOf("(") + 1,rawText.lastIndexOf(")"))
          const quantity = parseInt(oldQuantity) + parseInt(addedQuantity)
          quantityEl.innerText = `(${quantity})`
        }
        	const xhr = new XMLHttpRequest();
          xhr.open('GET', '/cart-count');
          xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
              const count = parseInt(xhr.responseText);
              document.querySelector('.cartcount').innerText = '(' + count + ')';
            }
          };
          xhr.send();
        
      </script>
      @endauth
      <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
  </body>
</html>