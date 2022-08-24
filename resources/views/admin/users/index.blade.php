@extends('admin.dashboard-layout')
  
@section('content')
<main class="users">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Users</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Bloquer</th>
                    <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->fname}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <p class="text-secondary">
                         @if ($user->role_id === 1)
                         Client
                        @elseif ($user->role_id === 2)
                        IT
                        @else
                        Admin
                        @endif
                        </p>
                    </td>
                    <td>
                        @if ($user->is_blocked === 0)
                            <p class="text-success">Actif</p>
                        @else
                            <p class="text-danger">Inactif</p>
                        @endif
                    </td>
                    <td><a href="{{ route('users.edit', $user->id)}}" class="btn btn-primary">Modifier</a></td>
                    <td>
                    <form action="{{ route('users.block', $user->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-danger" type="submit">
                            @if ($user->is_blocked === 0)
                                Bloquer
                            @else
                                Debloquer
                            @endif
                        </button>
                        </form>
                    </td>
                    <td>
                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
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