@extends('it.dashboard-layout')
  
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
                    <th scope="col">Stock</th>
                    <th scope="col">Image</th>
                    <th scope="col">Categorie</th>
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
                    <td>{{$product->stock}}</td>
                    <td class="w-25">
			         <img src="{{$product->image}}" class="img-fluid img-thumbnail" alt="Sheep">
		            </td>    
                    <td>{{$product->category->name}}</td>
                    <td><a href="{{ route('products.edit', $product->id)}}" class="btn btn-primary">Modifier</a></td>
                    <td>
                    <form action="{{ route('products.destroy', $product->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
      </div>
  </div>
</main>
@endsection