
@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <input type="text" class="form-control" name="title" id="" placeholder="Título: " value="{{ $news->title ?? old('title') }}">
</div>
<div class="form-group">
    <textarea rows="5" class="form-control" name="description" id="" placeholder="Descrição: ">{{ $news->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <input type="file" class="form-control" name="image" id="">
</div>