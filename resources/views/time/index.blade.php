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

                @if ($times)
                    <table class="table mb-5">
                        <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col">Дата создания</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($times as $time)

                            <tr>
                                <td>
                                    <a href="{{route('time.show',  $time->id )}}">{{ $time->name }}</a>
                                </td>
                                <td>
                                    {{ $time->created_at }}
                                </td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="card-text">У вас пока нет команд</p>
                @endif



                <a href="{{ route('time.create') }}" class="btn btn-primary">Создать новые исходные данные</a>
            </div>
        </div>
    </div>
@endsection
