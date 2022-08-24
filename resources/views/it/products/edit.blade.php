@extends('it.dashboard-layout')
  
@section('content')
<main class="products">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Nouveau Produit</h1>
            <div class="card">
                  <div class="card-body">  
                        <form method="post" action="{{ route('it.products.update', $product->id ) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Nom de produit</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" value="{{$product->name}}" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="price" class="col-md-4 col-form-label text-md-right">Prix</label>
                              <div class="col-md-6">
                                  <input type="number" min="0" id="price" class="form-control" name="price" value="{{$product->price}}" required autofocus>
                                  @if ($errors->has('price'))
                                      <span class="text-danger">{{ $errors->first('price') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="stock" class="col-md-4 col-form-label text-md-right">Stock</label>
                              <div class="col-md-6">
                                  <input type="number" min="0" id="stock" class="form-control" name="stock" value="{{$product->stock}}" required autofocus>
                                  @if ($errors->has('stock'))
                                      <span class="text-danger">{{ $errors->first('stock') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                              <div class="col-md-6">
                                  <input type="text" id="description" class="form-control" name="description" value="{{$product->description}}" required autofocus>
                                  @if ($errors->has('description'))
                                      <span class="text-danger">{{ $errors->first('description') }}</span>
                                  @endif
                              </div>
                          </div>
                          
  
                          <div class="form-group row">
                              <label for="category_id" class="col-md-4 col-form-label text-md-right">Categorie</label>
                              <div class="col-md-6">
                                <select name="category_id" id="category_id" class="form-control" value="{{$product->category_id}}">
                                    @foreach($categories as $category)
                                        <option value='{{$category->id}}'
                                        {{ $category->id == $product->category_id ? 'selected' : '' }}
                                         >{{$category->name}}</option>
                                    @endforeach
                                </select>

                              @if ($errors->has('category_id'))
                                      <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                              <div class="col-md-6">
                              <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image ">
                                    <label class="custom-file-label" for="chooseFile">Selectionner Image</label>
                                </div>
                                  @if ($errors->has('image'))
                                      <span class="text-danger">{{ $errors->first('image') }}</span>
                                  @endif
                              </div>
                          </div>
  
                       
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Modifier
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
            </div>
      </div>
  </div>
</main>
@endsection