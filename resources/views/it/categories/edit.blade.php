@extends('it.dashboard-layout')
  
@section('content')
<main class="categories">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Modifier Categorie</h1>
            <div class="card">
                  <div class="card-body">  
                        <form method="post" action="{{ route('it.categories.update', $category->id ) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Nom de la categorie</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" value="{{$category->name}}" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>
                          

                          <div class="form-group row">
                              <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                              <div class="col-md-6">
                               <span>Laisser le vide si vous ne voulez pas le changer</span>
                              <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="chooseFile">Selectionner Image</label>
                                </div>
                                <img id="image-preview" src="{{$category->image}}" class="w-50 img-fluid img-thumbnail">
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
  <script defer>
    const imageElement=document.querySelector('#image');
    const imagePreview=document.querySelector('#image-preview');
    imageElement.addEventListener('change',function(){
        const file=this.files[0];
        const reader=new FileReader();
        reader.addEventListener('load',function(){
            imagePreview.setAttribute('src',reader.result);
        }),reader.readAsDataURL(file);
    })
  </script>
</main>
@endsection