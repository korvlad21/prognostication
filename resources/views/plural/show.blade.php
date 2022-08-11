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
                            <th scope="col">y</th>
                            <th scope="col">x1</th>
                            <th scope="col">x2</th>
                            <th scope="col">yx1</th>
                            <th scope="col">yx2</th>
                            <th scope="col">x1x2</th>
                            <th scope="col">x1^2</th>
                            <th scope="col">x2^2</th>
                            <th scope="col">y^2</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for ($i =1; $i<=$kolvo;$i++)

                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>
                                    {{ $y[$i] }}
                                </td>
                                <td>
                                    {{ $x1[$i] }}
                                </td>
                                <td>
                                    {{ $x2[$i] }}
                                </td>
                                <td>
                                    {{ $yx1[$i] }}
                                </td>
                                <td>
                                    {{ $yx2[$i] }}
                                </td>
                                <td>
                                    {{ $x1x2[$i] }}
                                </td>
                                <td>
                                    {{ $x1x1[$i] }}
                                </td>
                                <td>
                                    {{ $x2x2[$i] }}
                                </td>
                                <td>
                                    {{ $yy[$i] }}
                                </td>

                            </tr>

                        @endfor
                        <tr>
                            <td>
                                Итого
                            </td>
                            <td>
                                {{ $sumy }}
                            </td>
                            <td>
                                {{ $sumx1 }}
                            </td>
                            <td>
                                {{ $sumx2 }}
                            </td>
                            <td>
                                {{ $sumyx1 }}
                            </td>
                            <td>
                                {{ $sumyx2 }}
                            </td>
                            <td>
                                {{ $sumx1x2 }}
                            </td>
                            <td>
                                {{ $sumx1x1 }}
                            </td>
                            <td>
                                {{ $sumx2x2 }}
                            </td>
                            <td>
                                {{ $sumyy }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                               Среднее значение
                            </td>
                            <td>
                                {{ round($sry, 4)  }}
                            </td>
                            <td>
                                {{ round($srx1, 4)  }}
                            </td>
                            <td>
                                {{ round($srx2, 4)  }}
                            </td>
                            <td>
                                {{ round($sryx1, 4)  }}
                            </td>
                            <td>
                                {{ round($sryx2, 4)  }}
                            </td>
                            <td>
                                {{ round($srx1x2, 4) }}
                            </td>
                            <td>
                                {{ round($srx1x1, 4) }}
                            </td>
                            <td>
                                {{ round($srx2x2, 4) }}
                            </td>
                            <td>
                                {{ round($sryy, 4) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ỡ
                            </td>
                            <td>
                                {{  round($omegay, 4) }}
                            </td>
                            <td>
                                {{ round($omegax1, 4) }}
                            </td>
                            <td>
                                {{ round($omegax2, 4) }}
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
                                r
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
                                {{ round($ryx1, 4) }}
                            </td>
                            <td>
                                {{ round($ryx2, 4) }}
                            </td>
                            <td>
                                {{ round($rx1x2, 4) }}
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
				</div>
                    <div class="card-header">
                        Параметры и уравнение
                    </div>
                    <div class="card-body">
                        <p>
                            <span class="font-weight-bold">Параметры регрессии: </span>
                        </p>
                        <p>
                            <span class="font-weight-bold">b1 = </span> {{ $b1 }}
                        </p>
                        <p>
                            <span class="font-weight-bold">b2 = </span> {{ $b2 }}
                        </p>
                        <p>
                            <span class="font-weight-bold">a = </span> {{ $a }}
                        </p>
                        <p>
                            <span class="font-weight-bold">Уравнение множественной регрессии: </span>
                        </p>
                        <p>
                            <span class="font-weight-bold">y = </span> {{ round($a,3) }} {{ $b1s }}*x1 {{ $b2s}}*x2
                        </p>


                    </div>
                    <div class="card-header">
                        Новая расчётная таблица
                    </div>
					<div class="card-body">
                    <table class="table mb-5">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">y</th>
                            <th scope="col">x1</th>
                            <th scope="col">x2</th>
                            <th scope="col">ŷ</th>
                            <th scope="col">y - ŷ</th>
                            <th scope="col">(y - ŷ)^2</th>
                            <th scope="col">Ai%</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for ($i =1; $i<=$kolvo;$i++)

                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>
                                    {{ $y[$i] }}
                                </td>
                                <td>
                                    {{ $x1[$i] }}
                                </td>
                                <td>
                                    {{ $x2[$i] }}
                                </td>
                                <td>
                                    {{ $deltay[$i] }}
                                </td>
                                <td>
                                    {{ $y_deltay[$i] }}
                                </td>
                                <td>
                                    {{ $y_deltay2[$i] }}
                                </td>
                                <td>
                                    {{ $ai[$i] }}
                                </td>

                            </tr>

                        @endfor
                        <tr>
                            <td>
                                Итого
                            </td>
                            <td>
                                {{ $sumy }}
                            </td>
                            <td>
                                {{ $sumx1 }}
                            </td>
                            <td>
                                {{ $sumx2 }}
                            </td>
                            <td>
                                {{ $sumdeltay }}
                            </td>
                            <td>
                                {{ $sumy_deltay }}
                            </td>
                            <td>
                                {{ $sumy_deltay2 }}
                            </td>
                            <td>
                                {{ $sumai }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Среднее значение
                            </td>
                            <td>
                                {{ round($sry, 4)  }}
                            </td>
                            <td>
                                {{ round($srx1, 4)  }}
                            </td>
                            <td>
                                {{ round($srx2, 4)  }}
                            </td>
                            <td>
                                {{ round($srdeltay, 4)  }}
                            </td>
                            <td>
                                {{ round($sry_deltay, 4)  }}
                            </td>
                            <td>
                                {{ round($sry_deltay2, 4) }}
                            </td>
                            <td>
                                {{ round($srai, 4) }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
					</div>
                    <div class="card-header">
                        Найти выходные параметры по входным:
                    </div>
					<div class="card-body">
                    <form name="row g-3">
                        <div class="col-auto">
                            <label for="name">X1=</label>
                            <input type="text" id="x1" name="x1" value="" />
                            <label for="name">X2=</label>
                            <input type="text" id="x2" name="x2" value="" />
                            <a onclick="gety2()" class="btn btn-primary">Найти выходные параметры:</a>
                        </div>
                    </form>
                    <a id="js-y2"></a>
					</div>
                    <div class="card-header">
                        Результаты решения формул и уравнения
                    </div>
					<div class="card-body">
                        <div id="js-result4">
                            <button onclick="gettext3()"  class="btn btn-primary" >Раскрыть формулы</button>
                        </div>
                        <a id="js-result3"></a>
					<br>
                    <a href="{{ route('plural.create') }}" class="btn btn-primary">Создать новые исходные данные</a>
            </div>

        </div></div>


    <script>
        function gettext3()
        {
            var text=' <p><span class="font-weight-bold">Коэффициенты стандартизированного уравнения: </span> </p> <p> <span class="font-weight-bold">þ1 = </span> {{ $beta1 }}</p> <p> <span class="font-weight-bold">þ2 = </span> {{ $beta2 }}</p> <p> <span class="font-weight-bold">Стандартизированное уравнение регрессии: </span> </p> <p> <span class="font-weight-bold">ty = </span> {{ $beta1 }}*tx1+{{ $beta2 }}*tx2 </p> <p> <span class="font-weight-bold">Средние коэффициенты эластичности: </span> </p> <p> <span class="font-weight-bold">Э1 = </span> {{ $E1 }}</p> <p> <span class="font-weight-bold">Э2 = </span> {{ $E2 }}</p> <p> <span class="font-weight-bold">Частные коэффициенты корреляции: </span> </p> <p> <span class="font-weight-bold">ryx1*х2 = </span> {{ $ryx1x2 }}</p> <p> <span class="font-weight-bold">ryx2*х1 = </span> {{ $ryx2x1 }}</p> <p> <span class="font-weight-bold">Определитель матрицы парных коэффициентов корреляции: </span> </p> <p> <span class="font-weight-bold">∆r = </span> {{ $deltar }}</p> <p> <span class="font-weight-bold">Определитель матрицы межфакторной корреляции: </span> </p> <p> <span class="font-weight-bold">∆r11 = </span> {{ $deltar11 }}</p> <p> <span class="font-weight-bold">Коэффициент множественной корреляции полученный 3-мя способами: </span> </p> <p> <span class="font-weight-bold">Ryx1*х2 (1) = </span> {{ $Ryx1x2[0] }}</p> <p> <span class="font-weight-bold">Ryx1*х2 (2) = </span> {{ $Ryx1x2[1] }}</p> <p> <span class="font-weight-bold">Ryx1*х2 (3) = </span> {{ $Ryx1x2[2] }}</p> <p> <span class="font-weight-bold">Нескорректированный коэффициент множественной детерминации: </span> </p> <p> <span class="font-weight-bold">Ryx1*х2^2 = </span> {{ $Ryx1x22 }}</p> <p> <span class="font-weight-bold">Скорректированный коэффициент множественной детерминации: </span> </p> <p> <span class="font-weight-bold">Ř = </span> {{ $deltaR }}</p> <p> <span class="font-weight-bold">Фактическое и табличное значение F-критерия Фишера : </span> </p> <p> <span class="font-weight-bold">Fфакт = </span> {{ $Ffact }}</p> <p> <span class="font-weight-bold">Стандартные ошибки коэффициентов: </span> </p> <p> <span class="font-weight-bold">mb1 = </span> {{ $mb1 }}</p> <p> <span class="font-weight-bold">mb2 = </span> {{ $mb2 }}</p> <p> <span class="font-weight-bold">Фактические значение t-критерия Стьюдента: </span> </p> <p> <span class="font-weight-bold">tb1 = </span> {{ $tb1 }}</p> <p> <span class="font-weight-bold">tb2 = </span> {{ $tb2 }}</p> <p> <span class="font-weight-bold">tтабл = </span> {{ $ttabl }}</p> <p> <span class="font-weight-bold">Доверительные интервалы для параметров чистой регрессии: </span> </p> <p> <span class="font-weight-bold"></span> {{ $b1-$mb1*$ttabl }}≤b1≤{{ $b1+$mb1*$ttabl }}; {{ $b2-$mb2*$ttabl }}≤b2≤{{ $b2+$mb2*$ttabl }}; </p> <p> <span class="font-weight-bold">ryx1^2 = </span> {{ $ryx12 }}</p> <p> <span class="font-weight-bold">ryx2^2 = </span> {{ $ryx22 }}</p> <p> <span class="font-weight-bold">Fx1 = </span> {{ $Fx1 }}</p> <p> <span class="font-weight-bold">Fx2 = </span> {{ $Fx2 }}</p> <p> <span class="font-weight-bold">β1 = </span> {{ $beta1 }}</p> <p> <span class="font-weight-bold">β2 = </span> {{ $beta2 }}</p> <p> <span class="font-weight-bold">α = </span> {{ $alfa }}</p> <p> <span class="font-weight-bold">Уравнение регрессии: </span> ŷ={{ $alfa }}+{{ $beta1 }}х1+{{ $beta2 }}х2 </p>';
            var text2='<button onclick="gettext4()"  class="btn btn-primary" >Cкрыть формулы</button>';
            $('#js-result3').html(text);
            $('#js-result4').html(text2);
        }
        function gettext4()
        {
            var text='';
            var text2='<button onclick="gettext3()"  class="btn btn-primary" >Раскрыть формулы</button>';
            $('#js-result3').html(text);
            $('#js-result4').html(text2);
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
        function gety2()
        {
            let x1 =  document.getElementById('x1');
            let x2 =  document.getElementById('x2');
            let y =  Math.round10({{$a}}+{{$b1}}*x1.value+{{$b2}}*x2.value, -4);
            let text='<p><span class="font-weight-bold">При x1='+x1.value+' и x2='+x2.value+', y='+y+' </span></p>';
            //document.getElementById("js-y").innerHTML = text;
            $('#js-y2').html(text);

        }
    </script>
@endsection
