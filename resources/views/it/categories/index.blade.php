@extends('it.dashboard-layout')
  
@section('content')
<main class="products">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Categories</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Image</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td class="w-25">
			         <img src="{{$category->image}}" class="img-fluid img-thumbnail">
		            </td>    
                    <td><a href="{{ route('it.categories.edit', $category->id)}}" class="btn btn-primary">Modifier</a></td>
                    <td>
                    <form action="{{ route('it.categories.destroy', $category->id)}}" method="post">
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