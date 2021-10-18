@extends('layouts.main')

@section('title','Requisição de Dados')

@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/img/events/{{$event->image}}" alt="{{$event->name}}"/>

        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{$event->name}}</h1>
            <p class="event-city">{{$event->city}}</p>
            <p class="event-participants">X Participantes</p>
            <p class="event-date">{{date('d/m/y',strtotime($event->date))}}</p>
            <p class="event-owner">Dono do Evento: {{$event->user->name}}</p>
            <h3>O Evento conta com</h3>
            @foreach($event->items as $item)
                <ul>
                    <li>{{$item}}</li>
                </ul>
            @endforeach
            @if(!$alreadyInEvent)
            <form action="/events/join/{{$event->id}}" method="POST">
                @csrf
                <a class="btn btn-primary" href="/events/join/{{$event->id}}" id="event-submit" onclick="event.preventDefault();this.closest('form').submit();">Confirmar Presença</a>
            </form>
            @else
                <p>Você já está participando deste evento</p>
            @endif
        </div>
        <div class="col-md-12" id="description-container">
            <h3>Descrição do Evento</h3>
            <p class="event-description">{{$event->description}}</p>
        </div>
    </div>
</div>

@endsection