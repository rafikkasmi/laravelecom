@extends('shop.layout')
  
@section('content')
 <!-- HERO SECTION-->
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Compte</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="/">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Compte</li>
                  </ol>
                </nav>
              </div>
            </div>
            <div class="row">
              <nav aria-label="breadcrumb">
                  <ul class="breadcrumb justify-content-center mb-0 px-0 bg-light">
                    <li class="breadcrumb-item @if (Request::path() =='account') {{'active'}} @endif"><a class="reset-anchor" href="/account">Parametres de compte</a></li>
                    <li class="breadcrumb-item @if (Request::path() == 'account/orders') {{'active'}} @endif" aria-current="page"><a class="reset-anchor" href="/account/orders">Commandes</a></li>
                  </ol>
                </nav>
            </div>
          </div>
        </section>
         <section class="py-5">
          @yield('accountpage')
         </section>
 
      </div>
@endsection
    