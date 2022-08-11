@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Pairs$item */ @endphp
                <form method="POST" action="{{ route('time.store')}}">
                    @csrf
                    <div class="container">
					 <div class="card">
            <div class="card-header">
                Создание новых исходных данных
            </div>

            <div class="card-body">
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
							
                                <div class="form-group ml-6">
                                    <label for="name">Название</label>

                                </div>
                                <div class="form-group ml-5">
                                    <input type="text" name="name" value="" class="form-control"/>
                                </div>
                                <table class="table mb-5" id="js-result">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Исходное значение</th>
                                    </tr>
                                    </thead>
                                    <tbody> 
										@for($j=1;$j<4;$j++)
										<tr>
                                          <th scope="col">{{2018+$j}}-й год</th>
                                        </tr>
											@for($i=1; $i<5;$i++)
											<tr>
											   <td>
													{{$i}}-й квартал
												</td>
													 <td>
													<input type="number" name="y{{$i+4*($j-1)}}" class="form-control"/>
												</td>
											</tr>
											@endfor
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
		</div></div>
        <script>


         function getval(sel)
         {
             var value = sel.value;
             var text='<thead><tr> <th scope="col">№</th> <th scope="col">x</th> <th scope="col">y</th> </tr> </thead> <tbody>';
            // $('#js-result').html(value);
             for (let i = 1; i <= value; i++) {
                 text+='<tr><td>'+i+'</td> <td> <input type="text" name="x'+i+'" class="form-control"/> </td> <td> <input type="text" name="y'+i+'" class="form-control"/> </td> </tr>';
             }
             text+= '</tbody>';
             $('#js-result').html(text);
         }
        </script>
@endsection


