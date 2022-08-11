@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Pairs$item */ @endphp
    @if($item->exists)
        <form method="POST" action="{{ route('pair.update', $item->id)}}">
            @method('PATCH')
            @else
                <form method="POST" action="{{ route('plural.store')}}">
                    @endif
                    @csrf
                    <div class="container">
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                {{$errors->first()}}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                {{session()->get('success')}}
                            </div>
                        @endif
                        <div class="col-md-12 bg-white row">
                            <table class="card-body">
                                    <div class="form-group">
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                        <label for="kolvo">Количество</label>
                                        <select name="kolvo" id="kolvo" class="kolvo" onchange="getval(this);">
                                            @foreach ($pairList as $pair)
                                                <option value="{{ $pair }}">{{ $pair }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div class="form-group ml-5" >
                                    <label for="name">Название</label>

                                </div>
                                <div class="form-group ml-5" >
                                    <input type="text" name="name" value="" class="form-control"/>
                                </div>
                                <table class="table mb-5" id="js-result">
                                    <thead>
                                    <tr>
                                        <th scope="col">№</th>
                                        <th scope="col">y</th>
                                        <th scope="col">x1</th>
                                        <th scope="col">x2</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i=1;$i<=5;$i++)
                                        <tr>
                                            <td>
                                                {{$i}}
                                            </td>
                                            <td>
                                                <input type="text" name="y{{$i}}" class="form-control"/>
                                            </td>
                                            <td>
                                                <input type="text" name="x1_{{$i}}" class="form-control"/>
                                            </td>
                                            <td>
                                                <input type="text" name="x2_{{$i}}" class="form-control"/>
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                </form>
                <div class="card-body col-xs-6">

                </div>
                </form>

        <script>

         function getval(sel)
         {
             var value = sel.value;
             var text='<thead><tr> <th scope="col">№</th> <th scope="col">y</th> <th scope="col">x1</th><th scope="col">x2</th> </tr> </thead> <tbody>';
            // $('#js-result').html(value);
             for (let i = 1; i <= value; i++) {
                 text+='<tr><td>'+i+'</td> <td> <input type="text" name="y'+i+'" class="form-control"/> </td> <td> <input type="text" name="x1_'+i+'" class="form-control"/> </td> <td> <input type="text" name="x2_'+i+'" class="form-control"/> </td></tr>';
             }
             text+= '</tbody>';
             $('#js-result').html(text);
         }
        </script>
@endsection


