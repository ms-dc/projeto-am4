@extends('admin.layouts.app')

@section('title', "Editar Produto {$news->name}")

@section('content')
    <br>
    <h1>Editar Produto {{$news->name}}</h1>

    <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.pages.news._partials.form')
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection