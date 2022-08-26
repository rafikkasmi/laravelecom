@extends('account.layout')
@section('accountpage')
<div class="container">
     @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
<h2 class="h5 text-uppercase mb-4 text-center">Information General</h2>
          <div class="row d-flex justify-content-center mb-5">
            <div class="col-lg-8">
              <form action="{{route('updateUserData')}}" method="post">
                @csrf
                <div class="row gy-3">
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="firstName">Prenom: </label>
                    @php $user=Auth::user() @endphp
                    <input class="form-control form-control-lg" type="text" id="firstName" name="fname" value="{{$user->fname}}" placeholder="Entrer Votre prenom">
                    @if ($errors->has('fname'))
                                      <span class="text-danger">{{ $errors->first('fname') }}</span>
                    @endif
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="lastName">Nom: </label>
                    <input class="form-control form-control-lg" type="text" id="lastName" name="name" value="{{$user->name}}" placeholder="Entrer Votre nom">
                    @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="email">Email </label>
                    <input class="form-control form-control-lg" type="email" id="email" name="email"  value="{{$user->email}}" placeholder="ex: exemple@exemple.com">
                    @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                  <div class="col-lg-12">
                    <label class="form-label text-sm text-uppercase" for="address">Adresse: </label>
                    <input class="form-control form-control-lg" type="text" id="address" name="address" value="{{$user->address}}" placeholder="Cite Y Alger,Algerie">
                    @if ($errors->has('address'))
                                      <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                  </div>

                   <div class="col-lg-12">
                    <label class="form-label text-sm text-uppercase" for="bankcard">Numero de la carte bancaire: </label>
                    <input class="form-control form-control-lg" type="text" maxlength="16" id="bankcard" name="bankcard" value="{{$user->bankcard}}" placeholder="6666 6666 6666 6666">
                    @if ($errors->has('bankcard'))
                                      <span class="text-danger">{{ $errors->first('bankcard') }}</span>
                    @endif
                  </div>
                
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit">Modifier</button>
                  </div>
                </div>
              </form>
            </div>
           
          </div>
          <h2 class="h5 text-uppercase mb-4 text-center">Reinitialiser le mot de passe</h2>
          <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
              <form action="{{route('resetPassword')}}" method="post">
                @csrf
                <div class="row gy-3">

                <div class="col-lg-12">
                    <label class="form-label text-sm text-uppercase" for="current_password">Mot de passe courant : </label>
                    <input class="form-control form-control-lg" type="password" id="current_password" name="current_password" >
                    @if ($errors->has('current_password'))
                                      <span class="text-danger">{{ $errors->first('current_password') }}</span>
                    @endif
                  </div>
                  
                  <div class="col-lg-12">
                    <label class="form-label text-sm text-uppercase" for="password">Noubeau mot de passe: </label>
                    <input class="form-control form-control-lg" type="password" id="password" name="password" >
                    @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                  </div>

                   <div class="col-lg-12">
                    <label class="form-label text-sm text-uppercase" for="cn_password">Confirmer mot de passe: </label>
                    <input class="form-control form-control-lg" type="password" maxlength="16" id="cn_password" name="cn_password" >
                    @if ($errors->has('cn_password'))
                                      <span class="text-danger">{{ $errors->first('cn_password') }}</span>
                    @endif
                  </div>
                
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit">Modifier</button>
                  </div>
                </div>
              </form>
            </div>
           
          </div>
          </div>
@endsection