@extends('admin.layouts.app')

@section('title', "Editar Produto {$news->title}")

@section('content')
    <br>
    <h1>Editar Notícia - {{$news->title}}</h1>

    <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.pages.news._partials.form')
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection