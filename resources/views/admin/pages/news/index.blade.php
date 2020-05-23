@extends('admin.layouts.app')

@push('styles')
@endpush

@section('title', 'Gestão de Notícias')

@section('content')

<a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fas fa-chevron-up"></i></a>

    <br>
    <h1>Notícias</h1>
    <a href="{{ route('news.create') }}" class="btn btn-primary">Cadastrar</a>

    <hr>

    <form action="{{ route('news.search') }}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" id="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Imagem</th>
                <th width="200">Título</th>
                <th width="450">Descrição</th>
                <th width="200">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $new)
                <tr>
                    <td>
                        @if ($new->image)
                        <img src="{{ url("storage/{$new->image}") }}" alt="{{ $new->name }}" style="width: 200px; height: 150px">
                        @endif
                    </td>
                    <td style="font-weight:bold">{{ $new->title }}</td>
                    <td>{{ $new->description }}</td>
                    <td>
                        <a href="{{ route('news.edit',[ $new->id]) }}" class="btn btn-primary btn-sm text-white">
                                <i class="fas fa-edit"></i>
                                <span class='d-none d-md-inline'> Editar</span>
                            </a>
                        <span data-url="{{ route('news.destroy',[ $new->id]) }}" data-idNew='{{ $new->id}}' 
                        class="btn btn-danger btn-sm text-white deleteButton">
                            <i class="fas fa-trash"></i>
                            <span class='d-none d-md-inline'> Deletar</span>
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>




    @if (isset($filters))
        {!! $news->appends($filters)->links() !!}
    @else
        {!! $news->links() !!}
    @endif
    

@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $('.deleteButton').on('click', function (e) {
    var url = $(this).data('url');
    var idNew = $(this).data('idNew');
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        method: 'DELETE',
        url: url
    });
    $.ajax({
        data: {
            'idNew': idNew,
        },
        success: function (data) {
            console.log(data);
            if (data['status'] ?? '' == 'success') {
                if (data['reload'] ?? '') {
                    location.reload();
                }
            } else {
                console.log('error');
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
});
</script>
<script>
    $(document).ready(function(){
	$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#back-to-top').fadeIn();
			} else {
				$('#back-to-top').fadeOut();
			}
		});
		// scroll body to 0px on click
		$('#back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 400);
			return false;
		});
});
</script>
@endpush
