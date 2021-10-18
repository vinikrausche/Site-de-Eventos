@extends('layouts.main')

@section('title','Editando')

@section('content')

<section>
<h5>Editando o evento: {{$event->name}}</h5>
        <p id="texto-centralizado">Digite seu o nome, cidade, descrição e se o evento é privado ou não</p>
    <div id="form-box">
        <form method="POST" action="/events/update/{{$event->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label>Título do Evento <input type="text" name="name" id="name" value="{{$event->name}}"/></label></br>
            <label>Foto do Evento <input type="file" name="image" id="image"/></label>
            <img src="/img/events/{{$event->image}}" alt="" id="edit-image"/>
            <label>Cidade do Evento <input type="text" name="city" id="city" value="{{$event->city}}"/></label></br>
            <label>Evento Privado?</label>
            <select name="private" id="private">
                <option value="1" {{$event->private == 1 ? "select = 'selected'" : ""}}>Privado</option>
                <option value="0">Público</option>
            </select></br>
            <label id="desc"><p>Descrição do Evento</p></label></br>
            <textarea name="description" id="description" placeholder="Descrição do evento: {{$event->description}}" rows="10" cols="15"></textarea></br>
            <div class="form-group" id="check">
                <label for="title">Itens do Evento</label>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" value="Cadeiras"/> Cadeiras
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" value="Cerveja gratis"/> Cerveja grátis
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" value="Open Food"/> Open Food
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" value="Brindes"/> Brindes
                    </div>
            </div></br>

            <div class="form-group" id="date-container">
                <label id="titulo-date" for="date">Defina a data do evento</label>
                <div class="form-group">
                    <input type="date" name="date" id="date" />
                </div>
            </div></br>
            <button type="submit" id="criar-evento">Editar Evento</button>
        </form>
    </div>
</section>

@endsection


