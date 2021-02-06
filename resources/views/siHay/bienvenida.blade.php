@extends('layout.layout')

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

	@if(config('app.debug') == true)
    <table class="table" style="padding-top: 25px;">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">IMC</th>
			<th scope="col">Preferencia Nutricional</th>
            <th scope="col">Objetivo</th>
			<th scope="col">Nombre Completo</th>
			<th scope="col">Email</th>
			<th scope="col">Información</th>
			<th scope="col">Fecha</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ data_get($post, 'uuid') }}</td>
				<td>{{ data_get($post, 'imc') }}</td>
				<td>{{ data_get($post, 'preferenciaNutricional') }}</td>
                <td>{{ data_get($post, 'objetivo') }}</td>
				<td>{{ data_get($post, 'nombreCompleto') }}</td>
				<td>{{ data_get($post, 'email') }}</td>
				<td>{{ data_get($post, 'informacion') }}</td>
				<td>{{ data_get($post, 'fecha') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
	@endif
@endsection