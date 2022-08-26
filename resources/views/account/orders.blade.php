@extends('account.layout')
@section('accountpage')
<div class="container">
     @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
      <h2 class="h5 text-uppercase mb-4 text-center">Commandes</h2>
          <div class="row d-flex justify-content-center mb-5">
    
          @foreach($orders as $order)
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4 class="h5">Commande n°{{$order->id}}</h4>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($order->orderItems as $orderItem)
                      <tr>
                        <td><a href="{{route('product',$orderItem->product->id)}}" class="reset-anchor">{{$orderItem->product->name}}</a></td>
                        <td>{{$orderItem->product->price}}</td>
                        <td>{{$orderItem->quantity}}</td>
                        <td>{{$orderItem->quantity * $orderItem->product->price}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @endforeach
          </div>
@endsection