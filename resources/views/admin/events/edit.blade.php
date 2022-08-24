@extends('admin.dashboard-layout')
  
@section('content')
<main class="events">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Nouveau Produit</h1>
            <div class="card">
                  <div class="card-body">  
                        <form method="post" action="{{ route('admin.events.update', $event->id ) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')       
                             <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Nom de produit</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" value="{{$event->name}}" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>
                          
                          <div class="form-group row">
                              <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                              <div class="col-md-6">
                                  <input type="text" id="description" class="form-control" name="description" value="{{$event->description}}" required autofocus>
                                  @if ($errors->has('description'))
                                      <span class="text-danger">{{ $errors->first('description') }}</span>
                                  @endif
                              </div>
                          </div>
                           
                        
                          <div class="form-group row">
                              <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                              <div class="col-md-6">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image ">
                                    <label class="custom-file-label" for="chooseFile">Selectionner Image</label>
                                </div>                                  @if ($errors->has('image'))
                                      <span class="text-danger">{{ $errors->first('image') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="status" class="col-md-4 col-form-label text-md-right">Status:</label>
                              <div class="col-md-6">
                                <select name="status" id="status" class="form-control">
                                    @foreach(['En Attente','Accepté','Refusé'] as $id=>$status)
                                        <option value='{{$id+1}}' {{ $id+1 == $event->status ? 'selected' : '' }}>{{$status}}</option>
                                    @endforeach
                                </select>

                              @if ($errors->has('status'))
                                      <span class="text-danger">{{ $errors->first('status') }}</span>
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