@extends('admin.dashboard-layout')
  
@section('content')
<main class="users">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Nouveau Produit</h1>
            <div class="card">
                  <div class="card-body">  
                      <form action="{{ route('admin.users.store') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>
                         
                          <div class="form-group row">
                              <label for="fname" class="col-md-4 col-form-label text-md-right">Prenom</label>
                              <div class="col-md-6">
                                  <input type="text" id="fname" class="form-control" name="fname" required autofocus>
                                  @if ($errors->has('fname'))
                                      <span class="text-danger">{{ $errors->first('fname') }}</span>
                                  @endif
                              </div>
                          </div>
                    

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                              <div class="col-md-6">
                                  <input type="email" id="email" class="form-control" name="email" autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="address" class="col-md-4 col-form-label text-md-right">Adresse</label>
                              <div class="col-md-6">
                                  <input type="text" id="address" class="form-control" name="address" autofocus>
                                  @if ($errors->has('address'))
                                      <span class="text-danger">{{ $errors->first('address') }}</span>
                                  @endif
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="role_id" class="col-md-4 col-form-label text-md-right">Role:</label>
                              <div class="col-md-6">
                                <select name="role_id" id="role_id" class="form-control">
                                        <option value='1' selected>Client</option>
                                        <option value='2'>IT</option>
                                        <option value='3'>Admin</option>
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