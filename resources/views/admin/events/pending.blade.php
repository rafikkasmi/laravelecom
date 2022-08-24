@extends('admin.dashboard-layout')
  
@section('content')
<main class="events">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Evenements en attente</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Image</th>
                    <th scope="col">Accepter</th>
                    <th scope="col">Refuser</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($events as $event)
                    <tr>
                    <td>{{$event->id}}</td>
                    <td>{{$event->name}}</td>
                    <td class="w-25">
			         <img src="{{$event->image}}" class="img-fluid img-thumbnail">
		            </td>    
                    <td>
                    <form action="{{ route('admin.events.accept', $event->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success" type="submit">Accepter</button>
                        </form>
                    </td>
                    <td>
                    <form action="{{ route('admin.events.deny', $event->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-danger" type="submit">Refuser</button>
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