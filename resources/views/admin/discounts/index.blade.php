@extends('admin.dashboard-layout')
  
@section('content')
<main class="products">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Produits</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Prix reduction</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->discount_price ? $product->discount_price : 'None'}}</td>
                    <td><a href="{{ route('admin.discounts.edit', $product->id)}}" class="btn btn-primary">{{$product->discount_price ? 'Modifier Reduction' : 'Ajouter Reduction' }}</a></td>
                    @if($product->discount_price!=null)
                    <td>
                    <form action="{{ route('admin.discounts.destroy', $product->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Supprimer Reduction</button>
                        </form>
                    </td>
                    @endif
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
      </div>
  </div>
</main>
@endsection