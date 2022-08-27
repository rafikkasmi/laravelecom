@extends('admin.dashboard-layout')
  
@section('content')
<main class="container orders">
 <h2 class="h5 text-uppercase my-4 text-center">Commandes</h2>
          <div class="row d-flex justify-content-center mb-5">
    
          @foreach($orders as $order)
            <div class="col-lg-8 mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="h5">Commande n°{{$order->id}}</h4>
                  @php $total = 0; @endphp
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
                      @php $total += $orderItem->price * $orderItem->quantity; @endphp
                      <tr>
                        <td><a href="{{route('product',$orderItem->product->id)}}" class="reset-anchor">{{$orderItem->product->name}}</a></td>
                        <td>{{$orderItem->product->price}} Da</td>
                        <td>{{$orderItem->quantity}}</td>
                        <td>{{$orderItem->quantity * $orderItem->price}} Da</td>
                      </tr>
                      @endforeach
                    </tbody>
                     <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                        <td>{{$total}} Da</td>
                      </tr>
                  </table>
                </div>
              </div>
            </div>
          @endforeach
          </div>
          <div class="d-flex justify-content-center">
             {{ $orders->links() }}
             </div>
          </main>
@endsection