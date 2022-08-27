@extends('admin.dashboard-layout')
  
@section('content')
<main class="discounts">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Reduction sur {{$product->name}}</h1>
            <div class="card">
                  <div class="card-body">  
                        <form method="post" action="{{ route('admin.discounts.update', $product->id ) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')       
                             <div class="form-group row">
                              <label for="oldprice" class="col-md-4 col-form-label text-md-right">Ancien Prix</label>
                              <div class="col-md-6">
                                  <input readonly type="number" id="name" class="form-control" name="oldprice" value="{{$product->price}}" autofocus>
                                  @if ($errors->has('oldprice'))
                                      <span class="text-danger">{{ $errors->first('oldprice') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="discount_price" class="col-md-4 col-form-label text-md-right">Nouveau Prix</label>
                              <div class="col-md-6">
                                  <input type="text" id="discount_price" class="form-control" name="discount_price" value="{{$product->discount_price}}" required autofocus>
                                  @if ($errors->has('discount_price'))
                                      <span class="text-danger">{{ $errors->first('discount_price') }}</span>
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