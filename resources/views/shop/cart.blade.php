@extends('shop.layout')
  
@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Panier</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="/">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Panier</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
        @if(session('cart'))
          <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class="table text-nowrap">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Produit</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Prix</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Quantité</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Total</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"></strong></th>
                    </tr>
                  </thead>
                  <tbody class="border-0">
                    @php $total = 0 @endphp
                     @foreach(session('cart') as $id => $details)
                     @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr>
                      <th class="ps-0 py-3 border-light" scope="row">
                        <div class="d-flex align-items-center"><a class="reset-anchor d-block animsition-link" href="detail.html"><img src="{{$details['image']}}" alt="..." width="70"/></a>
                          <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link" href="detail.html">{{$details['name']}}</a></strong></div>
                        </div>
                      </th>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0 small">{{$details['price']}} Da</p>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantité</span>
                          <div class="quantity" productId={{$id}}>
                            <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                            <input class="quantity-input form-control form-control-sm border-0 shadow-0 p-0" type="text" readonly value="{{$details['quantity']}}"/>
                            <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                          </div>
                        </div>
                      </td>
                      <td class="p-3 align-middle border-light">
                        <p class="mb-0 small">{{$details['price'] * $details['quantity']}} Da</p>
                      </td>
                      <td class="p-3 align-middle border-light">
                     <input type="hidden" class="product-id" value={{$id}} name="id">
                        <a class="delete-button"><i class="fas fa-trash-alt small text-muted"></i></a>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- CART NAV-->
              <div class="bg-light px-4 py-3">
                <div class="row align-items-center text-center">
                  <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm" href="/shop"><i class="fas fa-long-arrow-alt-left me-2"> </i>Continuer le shopping</a></div>
                  <div class="col-md-6 text-md-end"><a class="btn btn-outline-dark btn-sm" href="/checkout">Valider La commande<i class="fas fa-long-arrow-alt-right ms-2"></i></a></div>
                </div>
              </div>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Total de panier</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>
                     {{$total}} Da
                    </span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          @else
          <div class="d-flex align-items-center justify-content-center">
            <p>Panier Vide</p>
            </div>
          @endif
        </section>
      </div>

      <script defer>
        document.querySelectorAll('.delete-button').forEach((el) => {
            el.addEventListener('click', () => {
                let id = el.parentElement.querySelector('.product-id').value;
                 let data = new FormData();
                data.append('_token', '{{ csrf_token() }}');
                let xhr = new XMLHttpRequest();
                xhr.open('POST', `/cart/remove/${id}`, true);
                xhr.onload = function () {
                    // do something to response
                     window.location.reload();
                };
                xhr.send(data);
            });
        });
        function updateCart(el){   
                let id = el.closest('.quantity').getAttribute('productId')
                let quantity = el.parentElement.querySelector('.quantity-input').value;
                let data = new FormData();
                data.append('_token', '{{ csrf_token() }}');
                data.append('quantity', quantity);
                let xhr = new XMLHttpRequest();
                xhr.open('POST', `/cart/update/${id}`, true);
                xhr.onload = function () {
                    // do something to response
                     window.location.reload();
                };
                xhr.send(data);
           }
	
      </script>
@endsection