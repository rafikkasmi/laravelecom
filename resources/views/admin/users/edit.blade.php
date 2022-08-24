@extends('admin.dashboard-layout')
  
@section('content')
<main class="users">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Nouveau Produit</h1>
            <div class="card">
                  <div class="card-body">  
                      <form action="{{ route('users.update',$user->id) }}" method="POST">
                          @csrf
                        @method('PATCH')
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" value="{{$user->name}}" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>
                         
                          <div class="form-group row">
                              <label for="fname" class="col-md-4 col-form-label text-md-right">Prenom</label>
                              <div class="col-md-6">
                                  <input type="text" id="fname" class="form-control" name="fname" value="{{$user->fname}}" required autofocus>
                                  @if ($errors->has('fname'))
                                      <span class="text-danger">{{ $errors->first('fname') }}</span>
                                  @endif
                              </div>
                          </div>
                    

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                              <div class="col-md-6">
                                  <input type="email" id="email" class="form-control" name="email" value="{{$user->email}}" autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>
                              <div class="col-md-6">
                                <span>Laisser le vide si vous ne voulez pas le changer</span>
                                  <input type="password" id="password" class="form-control" name="password">
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="address" class="col-md-4 col-form-label text-md-right">Adresse</label>
                              <div class="col-md-6">
                                  <input type="text" id="address" class="form-control" name="address" value="{{$user->address}}" required autofocus>
                                  @if ($errors->has('address'))
                                      <span class="text-danger">{{ $errors->first('address') }}</span>
                                  @endif
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="role_id" class="col-md-4 col-form-label text-md-right">Role:</label>
                              <div class="col-md-6">
                                <select name="role_id" id="role_id" class="form-control">
                                    @foreach(['Client','IT','Admin'] as $id=>$type)
                                        <option value='{{$id+1}}' {{ $id+1 == $user->role_id ? 'selected' : '' }}>{{$type}}</option>
                                    @endforeach
                                </select>

                              @if ($errors->has('role_id'))
                                      <span class="text-danger">{{ $errors->first('role_id') }}</span>
                                  @endif
                              </div>
                          </div>
                    
  
                       
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Creer
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