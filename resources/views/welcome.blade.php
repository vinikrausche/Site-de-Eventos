@extends('layouts.main')


@section('title','Dashboard')





@section('content')

<div id="search-container" class="col-md-12">
    <h3>Buscar Eventos</h3>
  <form method="GET" action="/">
    <input class="form-control" name="search" id="search-form" type="text" placeholder="Procure o Evento"/>
  </form>
   
</div>

@if(count($events) == 0)
  <h3>Nenhum evento por enquanto</h3></br>
</br>

@else

@if($search)
    <h3>Busca por {{$search}}</h3>
    <p>Veja todos os eventos em: <a href="/">Eventos</a></p>
    <div id="events-container" class="col-md-12">
  <div id="cards-container" class="row">
    @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{$event->image}}" alt="{{$event->name}}"/>
            <div class="card-body">
                <p class="card-date">{{date('d/m/y',strtotime($event->date))}}</p>
                <h5 class="card-title">{{$event->name}}</h5>
                <p class="card-participants">X Participantes</p>
                <a href="/events/{{$event->id}}" class="btn btn-primary" id="botao">Saiba Mais</a>
            </div>
        </div>
    @endforeach
  </div>

@else
<div id="events-container" class="col-md-12">
  <h5 class="titulo">Veja Todos os Eventos</h5>
  <p class="texto">Veja todos os eventos dos próximos dias</p>
  <div id="cards-container" class="row">
    @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{$event->image}}" alt="{{$event->name}}"/>
            <div class="card-body">
                <p class="card-date">{{date('d/m/y',strtotime($event->date))}}</p>
                <h5 class="card-title">{{$event->name}}</h5>
                <p class="card-participants">X Participantes</p>
                <a href="/events/{{$event->id}}" class="btn btn-primary" id="botao">Saiba Mais</a>
            </div>
        </div>
    @endforeach
  </div>
  @endif
</div>

@endif



@endsection