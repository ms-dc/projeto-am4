@extends('admin.layouts.app')

@section('content')
    <br>
    <h1>Cadastrar Notícia</h1>
    
    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data" class="form">
        @include('admin.pages.news._partials.form')
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
@endsection