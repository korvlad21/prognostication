@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Список последних
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" >
                        {{ session('success') }}
                    </div>
                @endif

                @if ($pairs)
                    <table class="table mb-5">
                        <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col">Дата создания</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pairs as $pair)

                            <tr>
                                <td>
                                    <a href="{{route('pair.show', $pair->id)}}">{{ $pair->name }}</a>
                                </td>
                                <td>
                                    {{ $pair->created_at }}
                                </td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="card-text">У вас пока нет команд</p>
                @endif



                <a href="{{ route('pair.create') }}" class="btn btn-primary">Создать новые исходные данные</a>
            </div>
        </div>
    </div>
@endsection
