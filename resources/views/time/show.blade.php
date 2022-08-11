@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ $name }}
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" >
                        {{ session('success') }}
                    </div>
                @endif
                    <table class="table mb-5">
                         <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">y</th>
                                    </tr>
                         </thead>
                                    <tbody> 
										@for($j=1;$j<=$time->kolvo/4;$j++)
										<tr>
                                          <th scope="col">{{2018+$j}}-й год</th>
                                        </tr>
											@for($i=1; $i<5;$i++)
												<tr>
											<td>
											   
													{{$i}}-й квартал
												</td>
												<td>

														{{$y[$i+4*($j-1)]}}
												</td>
											</tr>
											@endfor
										@endfor
                                    </tbody>
                    </table>
					
					  <div>
                            <p>
                                <span class="font-weight-bold">График временных рядов: </span>
                            </p>
                            <canvas onchange="getsa()" id="myChart"></canvas>
                        </div>
						</div>
					<div class="card-header">
                            Найти прогнозное значение:
                        </div>
						<div class="card-body">
                        <form >
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                <label for="name" class="font-weight-bold">Год:</label>
                                <input type="number" height= min="1" id="year" name="year" value="" />
								 </div>
								<div class="form-group col-md-2">
								<label for="name" class="font-weight-bold">Квартал:</label>
                                <select class="form-control" id="kvartal" name="kvartal">
									@for($i=1;$i<5;$i++)
                                             <option value="{{$i}}">{{$i}}</option>
									@endfor
                                  </select>
								  </div>
								 <div class="form-group col-md-4">
								 <br>
                                <a onclick="gety()" class="btn btn-primary">Найти прогнозное значение</a>
                            </div> </div>
                        </form>
						<a id="js-y"></a>
						
					<table class="table mb-5">
                         <thead>
                                    <tr>
                                        <th scope="col">t</th>
                                        <th scope="col">y</th>
										<th scope="col">Скользящая средняя</th>
										<th scope="col">Центрированная скользящая средняя</th>
										<th scope="col">Оценка сезонной компоненты</th>
                                    </tr>
                         </thead>
                                    <tbody> 
										@for($j=1;$j<=$time->kolvo;$j++)
											<tr>
											<td>{{$j}}</td>
											<td>{{$y[$j]}}</td>
											@if($ss[$j]==0)
												<td>-</td>
											@else
											<td>{{$ss[$j]}}</td>
											@endif
											@if($tss[$j]==0)
												<td>-</td>
											@else
											<td>{{$tss[$j]}}</td>
											@endif
											@if($osk[$j]==0)
												<td>-</td>
											@else
											<td>{{$osk[$j]}}</td>
											@endif
											</tr>
										@endfor
                                    </tbody>
                    </table>
</div>
             
			  <div class="card-header">
                        Скорректированная сезонная компонента
                    </div>
                    <div class="card-body">
					<table class="table mb-5">
                         <thead>
                                    <tr>
                                        <th scope="col">Год/квартал</th>
                                        <th scope="col">1</th>
										<th scope="col">2</th>
										<th scope="col">3</th>
										<th scope="col">4</th>
                                    </tr>
                         </thead>
                                    <tbody> 
										@for($j=1;$j<=$time->kolvo/4;$j++)
											<tr>
												<td>{{$j}}</td>
												@for($i=1; $i<=4;$i++)

													@if($osk[$i+4*($j-1)]==0)
														<td>-</td>
													@else
													<td>{{$osk[$i+4*($j-1)]}}</td>
													@endif
												@endfor
											</tr>
										@endfor
										<tr>
												<td>Всего за квартал</td>
												@for($i=1; $i<=4;$i++)
													<td>{{$sum[$i]}}</td>
												@endfor
										</tr>
										<tr>
												<td>Средняя оценка сезонной компоненты</td>
												@for($i=1; $i<=4;$i++)
													<td>{{round($sr[$i], 3)}}</td>
												@endfor
										</tr>
										<tr>
												<td>Скорректированная сезонная компонента, Si</td>
												@for($i=1; $i<=4;$i++)
													<td>{{round($Si[$i], 3)}}</td>
												@endfor
										</tr>
                                    </tbody>
                    </table>
					 <p>
                                <span class="font-weight-bold">Корректирующий коэффициент: </span> k={{$summary}}/4={{round($koef, 3)}}
                     </p>
					<p>
                                <span class="font-weight-bold">Cистема уровнений МНК: </span><br>
								{{$time->kolvo}}*a0+{{$t}}*a1={{array_sum($y)}}<br>
								{{$t}}*a0+{{array_sum($t2)}}*a1={{array_sum($yt)}}<br><br>
								Решая данную систему получаем<br>
								a0={{round($a0,2)}}, a1={{round($a1,2)}}<br><br>
								<span class="font-weight-bold">Среднее значение равно: </span> {{array_sum($y)}}/{{$time->kolvo}}={{round($ySR,2)}}
                    </p>
					<table class="table mb-5">
                         <thead>
                                    <tr>
                                        <th scope="col">t</th>
                                        <th scope="col">y</th>
										<th scope="col">t^2</th>
										<th scope="col">y^2</th>
										<th scope="col">t*y</th>
										<th scope="col">y(t)</th>
										<th scope="col">(y-ycp)2</th>
										<th scope="col">(y-y(t))2</th>
                                    </tr>
                         </thead>
                                    <tbody> 
										@for($j=1;$j<=$time->kolvo;$j++)
											<tr>
											<td>{{$j}}</td>
											<td>{{round($yS[$j],2)}}</td>
											<td>{{$t2[$j]}}</td>
											<td>{{round($yS2[$j],2)}}</td>
											<td>{{round($yt[$j],2)}}</td>
											<td>{{round($y_t_[$j],2)}}</td>
											<td>{{round($yS_ySR2[$j],2)}}</td>
											<td>{{round($y_y_t_[$j],2)}}</td>
											
											</tr>
										@endfor
										<tr>
											<td>Сумма</td>
											<td>{{round(array_sum($yS),2)}}</td>
											<td>{{array_sum($t2)}}</td>
											<td>{{round(array_sum($yS2),2)}}</td>
											<td>{{round(array_sum($yt),2)}}</td>
											<td>{{round(array_sum($y_t_),2)}}</td>
											<td>{{round(array_sum($yS_ySR2),2)}}</td>
											<td>{{round(array_sum($y_y_t_),2)}}</td>
											
											</tr>
                                    </tbody>
                    </table>
					<p>
                                <span class="font-weight-bold">Линейный тренд: </span> T = {{round($a0,2)}} + {{round($a1,2)}}t
                     </p>
					 <table class="table mb-5">
                         <thead>
                                    <tr>
                                        <th scope="col">t</th>
                                        <th scope="col">y</th>
										<th scope="col">Si</th>
										<th scope="col">y-Si</th>
										<th scope="col">T</th>
										<th scope="col">T+Si</th>
										<th scope="col">E=y-(T+Si)</th>
										<th scope="col">E^2</th>
										<th scope="col">(y-ycp)2</th>
                                    </tr>
                         </thead>
                                    <tbody> 
										@for($j=1;$j<=$time->kolvo;$j++)
											<tr>
											<td>{{$j}}</td>
											<td>{{round($y[$j],2)}}</td>
											@if($j%4==0)
											<td>{{$Si[4]}}</td>
											@else
											<td>{{$Si[$j%4]}}</td>
											@endif
											<td>{{round($yS[$j],2)}}</td>
											<td>{{round($y_t_[$j],2)}}</td>
											<td>{{round($TSi[$j],2)}}</td>
											<td>{{round($e[$j],2)}}</td>
											<td>{{round($e2[$j],2)}}</td>
											<td>{{round($y_ySR2[$j],2)}}</td>
											</tr>
										@endfor
                                    </tbody>
                    </table>
					<p>
                                <span class="font-weight-bold">Примеры получения прогнозного значения последующих кварталов: </span> 
                     </p>
					 @for($j=$time->kolvo+1; $j<=$time->kolvo+4; $j++)
					 <p>
                                T{{$j}} ={{round($a0,2)}} + {{round($a1,2)}}*{{$j}} = {{round($T[$j],2)}}
                     </p>
						 @if($j%4==0)
						 <p>
									F{{$j}} = T{{$j}} + S4
						 </p>
						 <p>
									
									@if($Si[4]<0)
										F{{$j}} = {{round($T[$j],2)}} - {{abs(round($Si[4],2))}} = {{round($F[$j],2)}}
									@else
										F{{$j}} = {{round($T[$j],2)}} + {{round($Si[4],2)}} = {{round($F[$j],2)}}
									@endif
						 </p>
						 @else
							 <p>
									F{{$j}} = T{{$j}} + S{{$j%4}}
						 </p>
						<p>
									@if($Si[$j%4]<0)
										F{{$j}} = {{round($T[$j],2)}} - {{abs(round($Si[$j%4],2))}} = {{round($F[$j],2)}}
									@else
										F{{$j}} = {{round($T[$j],2)}} + {{round($Si[$j%4],2)}} = {{round($F[$j],2)}}
									@endif
									
						 </p>
						@endif
						<p>
									<span class="font-weight-bold">F{{$j}} = {{round($F[$j],2)}}</span> 
						 </p>
					 @endfor
					</div></div>
	<script>
	$( document ).ready(function() { 
		function getsa(){

			let x=[];
			let y=[];
			let y2=[];
			let year=2019;
			@for ($i =1; $i<=$time->kolvo;$i++)
				x[{{$i-1}}] = year+' ({{$i%4}})';
				y[{{$i-1}}] = {{$y[$i]}};
				@if($i==$time->kolvo)
				y2[{{$i-1}}] = {{$y[$i]}};
				@else
				y2[{{$i-1}}] = null;
				@endif
				@if($i%4==0)
					x[{{$i-1}}] = year+' (4)';
					year++;
				@endif
			@endfor
			@for ($i=$time->kolvo+1; $i<=$time->kolvo+12;$i++)
				x[{{$i-1}}] = year+' ({{$i%4}})';
				y[{{$i-1}}] = null;
				y2[{{$i-1}}] = {{$F[$i]}};
				@if($i%4==0)
					x[{{$i-1}}] = year+' (4)';
					year++;
				@endif
			@endfor


			const data = {
				labels: x,
				datasets: [{
					label: 'Исходные данные',
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					data: y,
					type:'line',
				},{
					label: 'Прогнозное значение',
					backgroundColor: 'rgb(100, 99, 132)',
					borderColor: 'rgb(100, 99, 132)',
					data: y2,
					type:'line',
				}]
			};
			

			const config = {

				data: data,
				options: {}
			};
			const myChart = new Chart(
				document.getElementById('myChart'),
				config
			);}
			 
			 getsa();

			  });
			  function gety()
        {
            let year =  document.getElementById('year');
			let kvartal =  document.getElementById('kvartal');
			let year2=year.value-2021;
			let Si=[];
			@for($i=1; $i<5; $i++)
				Si[{{$i}}]={{$Si[$i]}}
			@endfor
			let num = Number(kvartal.value)+4*(year2-1)+{{$time->kolvo}};
			let F = {{$a0}}+num*{{$a1}}+Si[Number(kvartal.value)];
            let text='<p><span class="font-weight-bold">Прогнозное значение = '+Math.round((F*100))/100+'</span></p>';
			if(year.value<=2021||year.value==null)
			{
				 text='<p><span class="font-weight-bold">Прогнозировать можно только с 2022-го года!</span></p>';
			}
			//document.getElementById("js-y").innerHTML = text;
            $('#js-y').html(text);
			
        }
			</script>
@endsection
