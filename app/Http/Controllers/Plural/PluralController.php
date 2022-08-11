<?php

namespace App\Http\Controllers\Plural;

use App\Http\Controllers\Controller;
use App\Http\Requests\PluralCreateRequest;
use App\Models\Pairs;
use App\Models\Plural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PluralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();

        $plurals = Plural::where('user_id',$user)->orderBy('created_at', 'desc')->get();
        return view('plural.index',compact('plurals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Pairs();
        for ($i = 5; $i <= 20; $i++) {
            $pairList[] = $i;
        }
        return view('plural.edit', compact('item', 'pairList'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return int
     */
    public function store(PluralCreateRequest $request)
    {
        $data = $request->input();
        $data['user_id'] = Auth::id();
        $item = new Plural($data);
        $item->save();

        if ($item) {
            $user = Auth::id();
            $plurals = Plural::where('user_id',$user)->orderBy('created_at', 'desc')->get();
            return view('plural.index',compact('plurals'));
           // return view('pair.index',compact('plurals'));
        }
        else{
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array|float|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|int
     */
    public function show($id)
    {
        $plurals=Plural::where('id',$id)->get();
        foreach ($plurals as $plural) {
            $kolvo = $plural->kolvo;
            $name = $plural->name;
            //dd($kolvo);
            $zapx1[0]="a";
            $zapx2[0]="a";
            $zapy[0]="a";
            //колонки первой таблицы
            for ($i = 1; $i <= $kolvo; $i++) {
                $zapx1[$i]="x1_".$i;
                $x1[$i] = $plural->{$zapx1[$i]};
                $zapx2[$i]="x2_".$i;
                $x2[$i] = $plural->{$zapx2[$i]};
                $zapy[$i]="y".$i;
                $y[$i] = $plural->{$zapy[$i]};
                $yx1[$i]=$y[$i]*$x1[$i];
                $yx2[$i]=$y[$i]*$x2[$i];
                $x1x2[$i]=$x1[$i]*$x2[$i];
                $x1x1[$i]=$x1[$i]*$x1[$i];
                $x2x2[$i]=$x2[$i]*$x2[$i];
                $yy[$i]=$y[$i]*$y[$i];
            }
            $sumx1=array_sum($x1);
            $sumx2=array_sum($x2);
            $sumy=array_sum($y);
            $sumyx1=array_sum($yx1);
            $sumyx2=array_sum($yx2);
            $sumx1x2=array_sum($x1x2);
            $sumx1x1=array_sum($x1x1);
            $sumx2x2=array_sum($x2x2);
            $sumyy=array_sum($yy);
            $srx1=$sumx1/$kolvo;
            $srx2=$sumx2/$kolvo;
            $sry=$sumy/$kolvo;
            $sryx1=$sumyx1/$kolvo;
            $sryx2=$sumyx2/$kolvo;
            $srx1x2=$sumx1x2/$kolvo;
            $srx1x1=$sumx1x1/$kolvo;
            $srx2x2=$sumx2x2/$kolvo;
            $sryy=$sumyy/$kolvo;
            //формулы
            $omegay=sqrt($sryy-$sry*$sry);
            $omegax1=sqrt($srx1x1-$srx1*$srx1);
            $omegax2=sqrt($srx2x2-$srx2*$srx2);
            $ryx1=($sryx1-$srx1*$sry)/($omegay*$omegax1);
            $ryx2=($sryx2-$srx2*$sry)/($omegay*$omegax2);
            $rx1x2=($srx1x2-$srx2*$srx1)/($omegax1*$omegax2);
            $b1=($omegay/$omegax1)*(($ryx1-$ryx2*$rx1x2)/(1-$rx1x2*$rx1x2));
            $b2=($omegay/$omegax2)*(($ryx2-$ryx1*$rx1x2)/(1-$rx1x2*$rx1x2));
            $a=$sry-$b1*$srx1-$b2*$srx2;
            $sumy_deltay=0;
            //колонки второй таблицы
            for ($i = 1; $i <= $kolvo; $i++) {
                $deltay[$i]=$a+$b1*$x1[$i]+$b2*$x2[$i];
                $y_deltay[$i]=$y[$i]-$deltay[$i];
                $y_deltay2[$i]=$y_deltay[$i]*$y_deltay[$i];
                $ai[$i]=abs($y_deltay[$i]/$y[$i]*100);

            }
            $sumdeltay=array_sum($deltay);
            $sumy_deltay=array_sum($y_deltay);
            $sumy_deltay2=array_sum($y_deltay2);
            $sumai=array_sum($ai);
            $srdeltay=$sumdeltay/$kolvo;
            $sry_deltay=$sumy_deltay/$kolvo;
            $sry_deltay2=$sumy_deltay2/$kolvo;
            $srai=$sumai/$kolvo;
            //формулы дальше
            $beta1=$b1*$omegax1/$omegay;
            $beta2=$b2*$omegax2/$omegay;
            $E1=$b1*$srx1/$sry;
            $E2=$b2*$srx2/$sry;
            $ryx1x2=($ryx1-$ryx2*$rx1x2)/(sqrt((1-$ryx2*$ryx2)*(1-$rx1x2*$rx1x2)));
            $ryx2x1=($ryx2-$ryx1*$rx1x2)/(sqrt((1-$ryx1*$ryx1)*(1-$rx1x2*$rx1x2)));
            $deltar=1+$ryx1*$ryx2*$rx1x2+$ryx1*$ryx2*$rx1x2-$ryx1*$ryx1-$ryx2*$ryx2-$rx1x2*$rx1x2;
            $deltar11=1-$rx1x2*$rx1x2;
            $Ryx1x2[0]=sqrt(1-$deltar/$deltar11);
            $Ryx1x2[1]=sqrt(1-$sry_deltay2/($omegay*$omegay));
            $Ryx1x2[2]=sqrt($beta1*$ryx1+$beta2*$ryx2);
            $Ryx1x22=$Ryx1x2[0]*$Ryx1x2[0];
            $deltaR=1-(1-$Ryx1x22)*($kolvo-1)/($kolvo-3);
            $Ffact=($Ryx1x22/(1-$Ryx1x22))*($kolvo-3)/2;
            $mb1=($omegay*(sqrt(1-$Ryx1x22))/($omegax1*sqrt(1-$rx1x2*$rx1x2))/sqrt($kolvo-3));
            $mb2=($omegay*(sqrt(1-$Ryx1x22))/($omegax2*sqrt(1-$rx1x2*$rx1x2))/sqrt($kolvo-3));
            $tb1=$b1/$mb1;
            $tb2=$b2/$mb2;
            $ryx12=$ryx1*$ryx1;
            $ryx22=$ryx2*$ryx2;
            $ttabl=2.11;
            $Fx1=($Ryx1x22-$ryx22)/(1-$Ryx1x22)*($kolvo-3);
            $Fx2=($Ryx1x22-$ryx12)/(1-$Ryx1x22)*($kolvo-3);
            $beta1=($sryx1-$srx1*$sry)/$omegax2;
            $beta2=($sryx2-$srx2*$sry)/$omegax1;
            $alfa=$sry-$beta1*$srx1-$beta2*$srx2;
            $b1s= $b1;
            $b2s= $b2;
            if($b1>=0){
                $b1s= '+'.round($b1,5);
            }
            if($b2>=0){
                $b2s= '+'.round($b2,5);
            }
            return view('plural.show',compact('y','x1','x2','yx1','yx2','x1x2','x1x1','x2x2','yy',
            'sumx1','sumx2','sumy','sumyx1','sumyx2','sumx1x2','sumx1x1','sumx2x2','sumyy','srx1','srx2','sry','sryx1','sryx2',
            'srx1x2','srx1x1','srx2x2','sryy','omegay','omegax1','omegax2','ryx1','ryx2','rx1x2','b1','b2','a','kolvo','name',
            'deltay','y_deltay','y_deltay2','ai','sumdeltay','sumy_deltay','sumy_deltay2','sumai','srdeltay','sry_deltay',
            'sry_deltay2','srai','beta1','beta2','E1','E2','ryx1x2','ryx2x1','deltar','deltar11','Ryx1x2','Ryx1x22','deltaR',
            'Ffact','mb1','mb2','tb1','tb2','ryx12','ryx22','ttabl','Fx1','Fx2','beta1','beta2','alfa','b1s','b2s'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
