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
                            <th scope="col">№</th>
                            <th scope="col">x</th>
                            <th scope="col">y</th>
                            <th scope="col">x*y</th>
                            <th scope="col">x^2</th>
                            <th scope="col">y^2</th>
                            <th scope="col">yx</th>
                            <th scope="col">y-yx</th>
                            <th scope="col">(y-yx)^2</th>
                            <th scope="col">Ai</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for ($i =1; $i<=$kolvo;$i++)

                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>
                                    {{ $x[$i] }}
                                </td>
                                <td>
                                    {{ $y[$i] }}
                                </td>
                                <td>
                                    {{ $xy[$i] }}
                                </td>
                                <td>
                                    {{ $xx[$i] }}
                                </td>
                                <td>
                                    {{ $yy[$i] }}
                                </td>
                                <td>
                                    {{ round($yx[$i], 4) }}
                                </td>
                                <td>
                                    {{ round($y_yx[$i], 4) }}
                                </td>
                                <td>
                                    {{ round($y_yx2[$i], 4) }}
                                </td>
                                <td>
                                    {{ round($ai[$i], 4) }}
                                </td>
                            </tr>

                        @endfor
                        <tr>
                            <td>
                                Итого
                            </td>
                            <td>
                                {{ $sumx }}
                            </td>
                            <td>
                                {{ $sumy }}
                            </td>
                            <td>
                                {{ $sumxy }}
                            </td>
                            <td>
                                {{ $sumxx }}
                            </td>
                            <td>
                                {{ $sumyy }}
                            </td>
                            <td>
                                {{ round($sumyx, 4) }}
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                {{ round($sumy_yx2, 4) }}
                            </td>
                            <td>
                                {{ round($sumai, 4) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                               Среднее значение
                            </td>
                            <td>
                                {{ round($srx, 4)  }}
                            </td>
                            <td>
                                {{ round($sry, 4)  }}
                            </td>
                            <td>
                                {{ round($srxy, 4)  }}
                            </td>
                            <td>
                                {{ round($srxx, 4)  }}
                            </td>
                            <td>
                                {{ round($sryy, 4)  }}
                            </td>
                            <td>
                                {{ round($sryx, 4) }}
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                {{ round($sry_yx2, 4) }}
                            </td>
                            <td>
                                {{ round($srai, 4) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ỡ
                            </td>
                            <td>
                                {{  round($omegax, 4) }}
                            </td>
                            <td>
                                {{ round($omegay, 4) }}
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ỡ^2
                            </td>
                            <td>
                                {{ round($omegax2, 4) }}
                            </td>
                            <td>
                                {{ round($omegay2, 4) }}
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="card-header">
                        Результаты формул
                    </div>
                    <div class="card-body">
                        <p>
                            <span class="font-weight-bold">Параметры регрессии: </span>
                        </p>
                        <p>
                            <span class="font-weight-bold">b = </span> {{ $b }}
                        </p>
                        <p>
                            <span class="font-weight-bold">a = </span> {{ $a }}
                        </p>
                        <p>
                            <span class="font-weight-bold">Уравнение линейной регрессии: </span>
                        </p>
                        <p>
                            <span class="font-weight-bold">y = </span> {{ round($a,2)}}{{$bs}}x
                        </p>
                        <p>
                            <span class="font-weight-bold">Уравнение поломиноальной регрессии: </span>
                        </p>
                        <p>
                            <span class="font-weight-bold">y = </span> {{ $c1s }}x^2 {{ $b1s }}x {{ $a1s }}
                        </p>
						</div>
                        <div class="card-header">
                            Найти выходные параметры по входным:
                        </div>
						<div class="card-body">
                        <form name="row g-3">
                            <div class="col-auto">
                                <label for="name" class="font-weight-bold">X=</label>
                                <input type="text" id="x" name="x" value="" />
                                <a onclick="gety()" class="btn btn-primary">Найти выходные параметы:</a>
                            </div>
                        </form>

                        <a id="js-y"></a>

						</div>
                        <div class="card-header">
                            График

                        </div>
						<div class="card-body">
                        <div>
                            <p>
                                <span class="font-weight-bold">График линейной регрессии: </span>
                            </p>
                            <canvas onchange="getsa()" id="myChart"></canvas>
                            <p>
                                <span class="font-weight-bold">График полиномиальной регрессии 2-й степени: </span>
                            </p>
                            <canvas onchange="getsa()" id="myChart2"></canvas>
                        </div>
                        <div id="js-result2" >
                            <button onclick="gettext()"  class="btn btn-primary" >Раскрыть формулы</button>
                        </div>
                        <a id="js-result"></a>
                    </div>
                    <a href="{{ route('pair.create') }}" class="btn btn-primary">Создать новые исходные данные</a>

            </div></div>

        </div>

    </div>
    <script>
	$( document ).ready(function() { 
        function compareNumbers(a, b) {
            return a - b;
        }
function getsa(){

    let x=[];
    let x2=[];
    let y=[];
    let y1=[];
    let y2=[];
    let y3=[];
    let y4=[];
    let boo=false;
    @for ($i =1; $i<=$kolvo;$i++)
        x[{{$i-1}}] = {{$x[$i]}};
        y[{{$i-1}}] = {{$y[$i]}};
    @endfor
    const xx=x.sort(compareNumbers);
	console.log(xx);
    let j=0;
    for (let i = xx[0]; i <= xx[{{$kolvo-1}}]; i++) {
       x2[j]=i;
       y1[j]={{$a}}+{{$b}}*i;
       y3[j]={{$a1}}+{{$b1}}*i+{{$c1}}*i*i;
       y4[j]=146.05-0.6161*i+0.0079*i*i;
        @for($k=1;$k<$kolvo;$k++)

            if({{$x[$k]}}===i)
            {
                y2[j]={{$y[$k]}};
                boo=true;
            }
        @endfor
       if(boo===true)
       {
           boo=false;
       }
       else{
           y2[j]=null;
       }
       j++;
    


    }


    const data = {
        labels: x2,
        datasets: [{
            label: 'Уравнение линейной регрессии',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: y1,
            type:'line',
        },{
            label: 'Входные значения',
            backgroundColor: 'rgb(100, 99, 132)',
            borderColor: 'rgb(100, 99, 132)',
            data: y2,
            type:'scatter',
        }]
    };
    const data2 = {
        labels: x2,
        datasets: [
            {
                label: 'Уравнение нелинейной регресии',
                backgroundColor: 'rgb(109,255,0)',
                borderColor: 'rgb(109,255,0)',
                data: y3,
                type:'line',
            },
            {
                label: 'Входные значения',
                backgroundColor: 'rgb(100, 99, 132)',
                borderColor: 'rgb(100, 99, 132)',
                data: y2,
                type:'scatter',
            }]
    };

    const config = {

        data: data,
        options: {}
    };
    const config2 = {

        data: data2,
        options: {}
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
    );}

      
		 getsa();

      });
	    function gettext()
        {
            var text=' <p><span class="font-weight-bold">Ковариация и коэффициенты корреляции и детерминации: </span></p> <p><span class="font-weight-bold">cov(x,y) = </span> {{ $covxy}}</p> <p> <span class="font-weight-bold">rxy = </span> {{ $rxy}}</p> <p> <span class="font-weight-bold">rxy^2 = </span> {{ $rxy2}}</p> <p> <span class="font-weight-bold">Фактическое и табличное значение F-критерия Фишера, степени свободы: </span> </p> <p> <span class="font-weight-bold">Fфакт = </span> {{ $Ffact}}</p> <p> <span class="font-weight-bold">K1 = </span> {{ $k1}}</p> <p> <span class="font-weight-bold">K2 = </span> {{ $k2}}</p> <p> <span class="font-weight-bold">Fтабл = </span> {{ $Ftab}}</p> <p> <span class="font-weight-bold">Остаточная дисперсия: </span> </p> <p> <span class="font-weight-bold">S^2ост = </span> {{ $Saost}}</p> <p> <span class="font-weight-bold">Стандартные ошибки: </span> </p> <p> <span class="font-weight-bold">ma = </span> {{ $ma}}</p> <p> <span class="font-weight-bold">mb = </span> {{ $mb}}</p> <p> <span class="font-weight-bold">mrxy = </span> {{ $mrxy}}</p> <p> <span class="font-weight-bold">t-статистики: </span> </p> <p> <span class="font-weight-bold">ta = </span> {{ $ta}}</p> <p> <span class="font-weight-bold">tb = </span> {{ $tb}}</p> <p> <span class="font-weight-bold">trxy = </span> {{ $trxy}}</p> <p> <span class="font-weight-bold">tтабл = </span> {{ $ttabl}}</p> <p> <span class="font-weight-bold">Доверительные интервалы: </span> </p> <p> <span class="font-weight-bold">∆a = </span> {{ $treua}}</p> <p> <span class="font-weight-bold">∆b = </span> {{ $treub}}</p> <p> <span class="font-weight-bold">ɤa = </span> {{ round($a,2)}}±{{ round($treua,2)}}; {{round($a-$treua,2)}}≤a≤{{round($a+$treua,2)}}</p> <p> <span class="font-weight-bold">ɤb = </span> {{ round($b,2)}}±{{ round($treub,2)}}; {{round($b-$treub,2)}}≤b≤{{round($b+$treub,2)}}</p>';
            var text2='<button onclick="gettext2()"  class="btn btn-primary" >Cкрыть формулы</button>'
            $('#js-result').html(text);
            $('#js-result2').html(text2);
        }
        function gettext2()
        {
            //text=' <font-weight-boяции и детерминации: </span></p> <p><span class="font-weight- $rxy2}}</p> <p> <span class="font-weight-bold">Фактическое и табличное значение F-критерия Фишера, степени свободы: </span> </p> <p> <span class="font-weight-bold">Fфакт = </span> {{ $Ffact}}</p> <p> <span class="font-weight-bold">K1 = </span> {{ $k1}}</p> <p> <span class="font-weight-bold">K2 = </span> {{ $k2}}</p> <p> <span class="font-weight-bold">Fтабл = </span> {{ $Ftab}}</p> <p> <span class="font-weight-bold">Остаточная дисперсия: </span> </p> <p> <span class="font-weight-bold">S^2ост = </span> {{ $Saost}}</p> <p> <span class="font-weight-bold">Стандартные ошибки: </span> </p> <p> <span class="font-weight-bold">ma = </span> {{ $ma}}</p> <p> <span class="font-weight-bold">mb = </span> {{ $mb}}</p> <p> <span class="font-weight-bold">mrxy = </span> {{ $mrxy}}</p> <p> <span class="font-weight-bold">t-статистики: </span> </p> <p> <span class="font-weight-bold">ta = </span> {{ $ta}}</p> <p> <span class="font-weight-bold">tb = </span> {{ $tb}}</p> <p> <span class="font-weight-bold">trxy = </span> {{ $trxy}}</p> <p> <span class="font-weight-bold">tтабл = </span> {{ $ttabl}}</p> <p> <span class="font-weight-bold">Доверительные интервалы: </span> </p> <p> <span class="font-weight-bold">∆a = </span> {{ $treua}}</p> <p> <span class="font-weight-bold">∆b = </span> {{ $treub}}</p> <p> <span class="font-weight-bold">ɤa = </span> {{ round($a,2)}}±{{ round($treua,2)}}; {{round($a-$treua,2)}}≤a≤{{round($a+$treua,2)}}</p> <p> <span class="font-weight-bold">ɤb = </span> {{ round($b,2)}}±{{ round($treub,2)}}; {{round($b-$treub,2)}}≤b≤{{round($b+$treub,2)}}</p> <p> <span class="font-weight-bold">Прогнозные значения: </span> </p> <p> <span class="font-weight-bold">x0 = </span> {{ $x0}}</p> <p> <span class="font-weight-bold">y0 = </span> {{ $y0}}</p> <p> <span class="font-weight-bold">Ошибка прогноза: </span> </p> <p> <span class="font-weight-bold">my0 = </span> my0</p> <p> <span class="font-weight-bold">Предельная ошибка прогноза: </span> </p> <p> <span class="font-weight-bold">∆y0 = </span> {{ $treuy0}}</p> <p> <span class="font-weight-bold">Доверительный интервал прогноза: </span> </p> <p> <span class="font-weight-bold">ɤy0 = </span> {{ round($y0,2)}}±{{ round($treuy0,2)}}; {{round($y0-$treuy0,2)}}≤y0≤{{round($y0+$treuy0,2)}}</p>';
            var text=''
            text2='<button onclick="gettext()"  class="btn btn-primary" >Раскрыть формулы</button>'
            $('#js-result').html(text);
            $('#js-result2').html(text2);
        }
        function decimalAdjust(type, value, exp) {
            // Если степень не определена, либо равна нулю...
            if (typeof exp === 'undefined' || +exp === 0) {
                return Math[type](value);
            }
            value = +value;
            exp = +exp;
            // Если значение не является числом, либо степень не является целым числом...
            if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
                return NaN;
            }
            // Сдвиг разрядов
            value = value.toString().split('e');
            value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
            // Обратный сдвиг
            value = value.toString().split('e');
            return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
        }

        // Десятичное округление к ближайшему
            Math.round10 = function(value, exp) {
                return decimalAdjust('round', value, exp);
            }
        function gety()
        {
            let x =  document.getElementById('x');
            let y =  Math.round10({{$a}}+{{$b}}*x.value, -4);
			let my0= Math.sqrt({{$Saost}}*(1+1/{{$kolvo}}+((x.value-{{$srx}})/({{$kolvo}}*{{$omegax2}}))));
            let treuy0={{$ttabl}}*my0;
			let my01= Math.round10(my0, -2);
            let treuy01=Math.round10(treuy0, -2);
			let my2=y-treuy0;
			let my3=y+treuy0;
			let my02= Math.round10(my2, -2);
			let my03= Math.round10(my3, -2);
            let y1 = Math.round10({{$a1}}+{{$b1}}*x.value+{{$c1}}*x.value*x.value, -4);
            let text='<p><span class="font-weight-bold">Линейная регрессия: при x='+x.value+', y='+y+' </span></p><p><span class="font-weight-bold">Полиномиальная регрессии 2-й степени: при x='+x.value+', y='+y1+' </span></p><p> <span class="font-weight-bold">Ошибка прогноза: </span> </p> <p> <span class="font-weight-bold">my0 = </span> '+my0+'</p> <p> <span class="font-weight-bold">Предельная ошибка прогноза: </span> </p> <p> <span class="font-weight-bold">∆y0 = </span>  '+treuy0+'</p> <p> <span class="font-weight-bold">Доверительный интервал прогноза: </span> </p> <p> <span class="font-weight-bold">ɤy0 = </span> '+Math.round10(y,-2)+'±'+treuy01+'; '+my02+'≤y0≤'+my03+'</p>';
			//document.getElementById("js-y").innerHTML = text;
            $('#js-y').html(text);

        }
    </script>
@endsection
