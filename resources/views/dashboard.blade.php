@extends('layouts.main')

@section('title','Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h3>Meus Eventos</h3>
</div>

<div class="col-md-10-offset md-1 dashboard-events-container">
    @if(count($events) > 0)
    @else
        <p>Você ainda não tem nenhum evento <a href="/events/create" class="btn">Criar evento</a></p>
    @endif
</div>
@endsection