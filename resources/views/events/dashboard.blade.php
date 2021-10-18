@extends('layouts.main')

@section('title','Dashboard')

@section('content')

@if(session('msg4'))
    <script>
        alert('Presença confirmada com sucesso!')
    </script>

@endif

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h3>Meus Eventos</h3>
    @if(session('msg2'))
            <script>
                window.alert('Evento deletado com sucesso!');
            </script>
            
        @endif
</div>

<div class="col-md-10-offset md-1 dashboard-events-container" id="div-tabela">
    @if(count($events) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
           <tbody>
               @foreach($events as $event)
                    <tr>
                        <td scropt="row">{{$loop->index + 1}}</td>
                        <td><a href="/events/{{$event->id}}">{{$event->name}}</a></td>
                        <td>{{count($event->users)}}</td>
                        <td>
                            <a href="/events/edit/{{$event->id}}" class="btn btn-primary edit-btn"><ion-icon name="checkbox-outline"></ion-icon> Editar</a>
                            <form action="/events/{{ $event->id }}" method="POST">
                            @csrf 
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn">Deletar</button>
                            </form>
                        </td>
                    </tr>
               @endforeach
           </tbody>
        </table>
        
    @else
        <p>Você ainda não tem nenhum evento <a href="/events/create"">Criar evento</a></p>
    @endif
</div>

@if(count($participants) > 0)
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h3>Eventos que Participo</h3>
    </div>
    <div class="col-md-10-offset md-1 dashboard-events-container" id="div-tabela">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($participants as $event)
                    <tr>
                        <td><a href="/events/{{$event->id}}">{{$event->name}}</a></td>
                        <td>{{$event->city}}</td>
                        <td>{{count($event->users)}}</td>
                        <td>
                            <form action="/events/leave/{{$event->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="/events/leave/{{$event->id}}" class="btn btn-danger" onclick="event.preventDefault();this.closest('form').submit();">Desmarcar</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@else
<div class="col-md-10 offset-md-1 dashboard-title-container">
        <h5>Você não está participando de nenhum evento</h5>
        <p>Para participar de algum evento clique no link: <a href="/">Eventos</a></p>
    </div>
@endif
@endsection