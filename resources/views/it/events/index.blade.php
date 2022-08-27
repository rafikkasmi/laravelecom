@extends('it.dashboard-layout')
  
@section('content')
<main class="events">
  <div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>Evenements</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Image</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                    <th scope="col">Status</th>
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
                    <td><a href="{{ route('it.events.edit', $event->id)}}" class="btn btn-primary">Modifier</a></td>
                    <td>
                    <form action="{{ route('it.events.destroy', $event->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                    <td>
                        @if ($event->status === 1)
                            <p class="text-secondary">En Attente</p>
                        @elseif ($event->status === 2   )
                            <p class="text-danger">Refusé</p>
                        @else
                            <p class="text-success">Accepté</p>
                        @endif
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