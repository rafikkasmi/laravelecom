@extends('shop.layout')
  
@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Checkout</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="/">Accueil</a></li>
                    <li class="breadcrumb-item"><a class="text-dark" href="/cart">Panier</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">Details</h2>
          <div class="row">
            <div class="col-lg-8">
              <form action="{{route('confirmOrder')}}" method="post">
                @csrf
                <div class="row gy-3">
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="firstName">Prenom: </label>
                    @php $user=Auth::user() @endphp
                    <input class="form-control form-control-lg" type="text" id="firstName" name="fname" value="{{$user->fname}}" placeholder="Entrer Votre prenom">
                    @if ($errors->has('fname'))
                                      <span class="text-danger">{{ $errors->first('fname') }}</span>
                    @endif
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="lastName">Nom: </label>
                    <input class="form-control form-control-lg" type="text" id="lastName" name="name" value="{{$user->name}}" placeholder="Entrer Votre nom">
                    @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="email">Email </label>
                    <input readonly class="form-control form-control-lg" type="email" id="email" name="email"  value="{{$user->email}}" placeholder="ex: exemple@exemple.com">
                    @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                  <div class="col-lg-12">
                    <label class="form-label text-sm text-uppercase" for="address">Adresse: </label>
                    <input class="form-control form-control-lg" type="text" id="address" name="address" value="{{$user->address}}" placeholder="Cite Y Alger,Algerie">
                    @if ($errors->has('address'))
                                      <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                  </div>

                   <div class="col-lg-12">
                    <label class="form-label text-sm text-uppercase" for="bankcard">Numero de la carte bancaire: </label>
                    <input class="form-control form-control-lg" type="text" maxlength="16" id="bankcard" name="bankcard" value="{{$user->bankcard}}" placeholder="6666 6666 6666 6666">
                    @if ($errors->has('bankcard'))
                                      <span class="text-danger">{{ $errors->first('bankcard') }}</span>
                    @endif
                  </div>
                
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit">Passer la commande</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- ORDER SUMMARY-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Your order</h5>
                  <ul class="list-unstyled mb-0">
                    @php $total = 0 @endphp
                     @foreach(session('cart') as $id => $details)
                     @php $total += $details['price'] * $details['quantity'] @endphp
                    <li class="d-flex align-items-center justify-content-between"><a href="{{route('product',$id)}}" class="reset-anchor"><strong class="small fw-bold">{{$details['name']}} <span class="text-muted small">x {{$details['quantity']}}</span></strong></a><span class="text-muted small">{{$details['quantity'] * $details['price']}} Da</span></li>
                    <li class="border-bottom my-2"></li>
                    @endforeach
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small fw-bold">Total</strong><span>{{$total}} Da</span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection