@extends('shop.layout')
  
@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Bestsellers de {{$category->name}}</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Boutique</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <div class="container p-0">
            <div class="row">
              <!-- SHOP SIDEBAR-->
              <div class="col-lg-3 order-2 order-lg-1">
                <h5 class="text-uppercase mb-4">Categories</h5>
                <ul class="list-unstyled small text-muted ps-lg-4 font-weight-normal">
                @foreach($categories as $category)
                  <li class="mb-2"><a class="reset-anchor" href="{{ route('bestSeller',$category->id) }}">{{$category->name}}</a></li>
                @endforeach
                </ul>
              </div>
              <!-- SHOP LISTING-->
              <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                    <p class="text-sm text-muted mb-0">Showing {{$products->firstItem()}}-{{$products->lastItem()}} of {{$products->total()}} results</p>
                  </div>
                </div>
                <div class="row">
                  <!-- PRODUCTS-->
                  @foreach($products as $product)
                  <div class="col-lg-4 col-sm-6">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
                        <div class="badge text-white bg-"></div><a class="d-block" href="{{ route('product',$product->id)}}"><img class="img-fluid w-100" src="{{$product->image}}" alt="..."></a>
                        <div class="product-overlay">
                          <ul class="mb-0 list-inline">
                            <li class="list-inline-item m-0 p-0"></li>
                          </ul>
                        </div>
                      </div>
                      <h6> <a class="reset-anchor" href="{{ route('product',$product->id)}}">{{$product->name}}</a></h6>
                      <p class="small text-muted">{{$product->discount_price ? $product->discount_price : $product->price}} Da</p>
                    </div>
                  </div>
                @endforeach  
                </div>
                <div class="d-flex justify-content-center">
                {{ $products->appends(request()->input())->links() }}
                </div>
              </div>
            </div>
          </div>
        </section>
        <script defer>
          let filter = document.querySelector('.filter');
            filter.addEventListener('change', function(e){
              alert(e.target.innerHTML);
            window.location.href = e.target.getAttribute("url");
          }, false);
        </script>
      </div>
      
      
@endsection
    