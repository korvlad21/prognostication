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

                @if ($plurals)
                    <table class="table mb-5">
                        <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col">Дата создания</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($plurals as $plural)

                            <tr>
                                <td>
                                    <a href="{{route('plural.show', $plural->id)}}">{{ $plural->name }}</a>
                                </td>
                                <td>
                                    {{ $plural->created_at }}
                                </td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="card-text">У вас пока нет исходных данных</p>
                @endif



                <a href="{{ route('plural.create') }}" class="btn btn-primary">Создать новые исходные данные</a>
            </div>
        </div>
    </div>
@endsection
