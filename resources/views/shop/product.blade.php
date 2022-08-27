@extends('shop.layout')
  
@section('content')
<section class="py-5">
        <div class="container">
          <div class="row mb-5">
            <div class="col-lg-6">
              <!-- PRODUCT SLIDER-->
              <div class="row m-sm-0">
                <div class="col-sm-10 order-1 order-sm-2">
                  <div class="swiper product-slider">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide h-auto"><a class="glightbox product-view" href="{{$product->image}}" data-gallery="gallery2" data-glightbox="Product item 1"><img class="img-fluid" src="{{$product->image}}"" alt="..."></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- PRODUCT DETAILS-->
            <div class="col-lg-6">
              <ul class="list-inline mb-2 text-sm">
              </ul>
              <h1>{{$product->name}}"</h1>
              @if($product->discount_price)
              <p class="text-muted lead" style="text-decoration:line-through;">{{$product->price}} Da</p>
              @endif
              <p class="text-muted lead">{{$product->discount_price ? $product->discount_price : $product->price}} Da</p>
              <div class="mb-4"></div>
              <div class="row align-items-stretch mb-4">
                <div class="col-sm-5 pr-sm-0">
                  <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantité</span>
                    <div class="quantity">
                      <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                      <input class="form-control border-0 shadow-0 p-0 quantity" disabled type="text" value="1" min="1" max="{{$product->stock}}">
                      <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3 pl-sm-0">
                  
                    <button class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0 addtocart" type="submit" @guest href="{{route('login')}}" @endauth>Ajouter panier</button>
                </div>
              </div><a class="text-dark p-0 mb-4 d-inline-block" href="#!"></a><br>
              @if($product->category)
              <ul class="list-unstyled small d-inline-block">
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Categorie:</strong><a class="reset-anchor ms-2" href="{{ route('shop', ['category' => $product->category->id]) }}">{{$product->category->name}}</a></li>
              </ul>
              @endif
            </div>
          </div>
          <!-- DETAILS TABS-->
          <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link text-uppercase active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
            <li class="nav-item"><a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Avis</a></li>
          </ul>
          <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
              <div class="p-4 p-lg-5 bg-white">
                <p class="text-muted text-sm mb-0">{{$product->description}}</p>
              </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="p-4 p-lg-5 bg-white">
                <div class="row">
                  <div class="col-lg-8">
                    @foreach($product->reviews as $review)
                    <div class="d-flex mb-3">
                      <div class="ms-3 flex-shrink-1">
                        <h6 class="mb-0 text-uppercase">{{$review->user->fname}} {{$review->user->name}}</h6>
                        <!-- <p class="small text-muted mb-0 text-uppercase">20 May 2020</p> -->
                            <ul class="list-inline mb-1 text-xs">
                              @for ($i = 0; $i < 5; $i++)
                                  @if (floor($review->rating) - $i >= 1)
                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                  @elseif ($review->rating - $i > 0)
                            <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                                  @endif
                              @endfor
                        </ul>
                        <p class="text-sm mb-0 text-muted">{{$review->comment}}</p>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
         @auth
        <div class="row">
          <div class="py-2 px-4 bg-light mb-3"><strong class="small text-uppercase fw-bold">Noter le produit:</strong></div>
          <div class="col-md-12">
              <form action="{{route('postReview',$product->id)}}" method="post">
                @csrf
                <div class="col-lg-6 mb-4">
                    <label class="form-label text-sm text-uppercase" for="rating">Note /5: </label>
                  <input type="number" step="0.5" min="0" max="5" value="5" id="rating" class="form-control form-control-sm" placeholder="Note /5" name="rating">
                </div>
                  <div class="col-lg-6 mb-4">
                    <label class="form-label text-sm text-uppercase" for="comment">Commentaire: </label>
                    @php $user=Auth::user() @endphp
                    <textarea class="form-control form-control-lg" type="text" id="comment" name="comment"  placeholder="Entrer Votre Commentaire"></textarea>
                    @if ($errors->has('comment'))
                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                    @endif
                  </div>
                    @if (!Auth::user()->is_blocked)
                    <button class="mb-4 btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-3 addtocart" type="submit">Envoyer</button>
                    @else
                        <span class="text-danger">L'Admin vous a bloqué, vous ne pouvez pas commenter</span>
                    @endif
          </form> 
          </div>
        </div>
        @endauth
          <!-- RELATED PRODUCTS-->
          <!-- <h2 class="h5 text-uppercase mb-4">Related products</h2>
          <div class="row">
            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.html"><img class="img-fluid w-100" src="img/product-4.jpg" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#!">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-bs-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.html">Timex Unisex Originals</a></h6>
                <p class="small text-muted">$351</p>
              </div>
            </div>-->
          </div> 
        </div>
      </section>

      <script defer>
		document.querySelector('.addtocart').addEventListener('click', () => {
			const quantity = document.querySelector('input.quantity').value || 1
            let data = new FormData();
            data.append('quantity', quantity);
            data.append('_token', '{{ csrf_token() }}');
            let xhr = new XMLHttpRequest();
            xhr.open('POST', "{{ route('addToCart', $product->id)}}", true);
            xhr.onload = function () {
                 addQuantity(quantity)
            };
            xhr.send(data);
            
		});
      </script>
@endsection