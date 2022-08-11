<?php

namespace App\Http\Controllers\Pair;

use App\Http\Controllers\Controller;
use App\Http\Requests\PairCreateRequest;
use App\Models\Pairs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
    
        $pairs = Pairs::where('user_id',$user)->orderBy('created_at', 'desc')->get();
        return view('pair.index',compact('pairs'));
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
        return view('pair.edit', compact('item', 'pairList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function store(PairCreateRequest $request)
    {
        $data = $request->input();
        $data['user_id'] = Auth::id();
        $item = new Pairs($data);
        $item->save();

        if ($item) {
            $user = Auth::id();
            $pairs = Pairs::where('user_id',$user)->orderBy('created_at', 'desc')->get();
            return view('pair.index',compact('pairs'));
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
     * @return float|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $pairs=Pairs::where('id',$id)->get();
        //dd($pair);
        foreach ($pairs as $pair) {
            $kolvo = $pair->kolvo;
            $name = $pair->name;
            //dd($kolvo);
            $zapx[0]="a";
            $zapy[0]="a";
            $x[0] = 0;
            $y[0] = 0;
            $xy[0] = 0;
            $xx[0] = 0;
            $yy[0] = 0;
            $xxx[0]=0;
            $xxxx[0]=0;
            $xxy[0]=0;
            $z[0]=0;
            //колонки 1-5
            for ($i = 1; $i <= $kolvo; $i++) {
                $zapx[$i]="x".$i;
                $x[$i] = $pair->{$zapx[$i]};
                $zapy[$i]="y".$i;
                $y[$i] = $pair->{$zapy[$i]};
                $xy[$i]=$x[$i]*$y[$i];
                $xx[$i]=$x[$i]*$x[$i];
                $yy[$i]=$y[$i]*$y[$i];
                $xxx[$i]=$x[$i]*$x[$i]*$x[$i];
                $xxxx[$i]=$x[$i]*$x[$i]*$x[$i]*$x[$i];
                $xxy[$i]=$x[$i]*$x[$i]*$y[$i];
            }
            $sumx=array_sum($x);
            $sumy=array_sum($y);
            $sumxy=array_sum($xy);
            $sumxx=array_sum($xx);
            $sumyy=array_sum($yy);
            $f=$sumx;
            $q=$sumxx;
            $k=array_sum($xxx);
            $l=array_sum($xxxx);
            $p=$sumy;
            $w=$sumxy;
            $z=array_sum($xxy);
            $srx=$sumx/$kolvo;
            $sry=$sumy/$kolvo;
            $srxy=$sumxy/$kolvo;
            $srxx=$sumxx/$kolvo;
            $sryy=$sumyy/$kolvo;
            //омеги x и y
            $omegax2=$srxx-$srx*$srx;
            $omegax=sqrt($omegax2);
            $omegay2=$sryy-$sry*$sry;
            $omegay=sqrt($omegay2);
            // значенмие a, b
            $b=($srxy-$srx*$sry)/($srxx-$srx*$srx);
            $a=$sry-$srx*$b;
            //колонки 6-9
            for ($i = 1; $i <= $kolvo; $i++) {
                $yx[$i]=$a+$b*$x[$i];
                $y_yx[$i]=$y[$i]-$yx[$i];
                $y_yx2[$i]=abs($y_yx[$i]*$y_yx[$i]);
                $ai[$i]=abs($y_yx[$i]/$y[$i]*100);
            }
            $sumyx=array_sum($yx);
            $sumy_yx2=array_sum($y_yx2);
            $sumai=array_sum($ai);
            $sryx=$sumyx/$kolvo;
            $sry_yx2=$sumy_yx2/$kolvo;
            $srai=$sumai/$kolvo;
            // cov(x,y), rxy, rxy^2
            $covxy=($srxy-$srx*$sry);
            $rxy=$covxy/($omegax*$omegay);
            $rxy2=$rxy*$rxy;
            $Ffact=($rxy2/(1-$rxy2))*10;
            $k1=1;
            $k2=$kolvo-2;
            $Ftab=4.96;
            $Saost=$sumy_yx2/10;
            $ma=sqrt($Saost*($sumxx/($kolvo*$kolvo*$omegax2)));
            $mb=sqrt($Saost/($kolvo*$omegax2));
            $mrxy=sqrt((1-$rxy2)/10);
            $ta=$a/$ma;
            $tb=$b/$mb;
            $trxy=$rxy/$mrxy;
            $ttabl=2.23;
            $treua=$ttabl*$ma;
            $treub=$ttabl*$mb;
            $x0=120;
            $y0=$a+$b*$x0;
            $my0=sqrt($Saost*(1+1/$kolvo+(($x0-$srx)/($kolvo*$omegax2))));
            $treuy0=$ttabl*$my0;
// полиномиальная регрессия;
            $a1=(($p*$l-$z*$q)*($q*$l-$k*$k)-$w*$l*($f*$l-$k*$q)+$z*$k*($f*$l-$k*$q))/
                (($kolvo*$l-$q*$q)*($q*$l-$k*$k)-($f*$l-$k*$q)*($f*$l-$k*$q));
            $b1=($w*$l-$z*$k-$a1*($f*$l-$q*$k))/($q*$l-$k*$k);
            $c1=($z-$a1*$q-$b1*$k)/$l;
            $a1s= $a1;
            $b1s= $b1;
            $c1s= $c1;
            $bs= $b;
            if($a1>=0){
                $a1s= '+'.round($a1,5);
            }

            if($b1>=0){
                $b1s= '+'.round($b1,5);
            }
            if($b>=0){
                $bs= '+'.round($b,2);
            }


                //shell_exec("/C:/xampp/htdocs/Ai_Edutech_trial_project/eclipse_workspace/Project/check.py '$para1' '$para2'")
            return view('pair.show',compact('x','y','xy','xx','yy','yx','y_yx','y_yx2','ai','kolvo',
            'sumx','sumy','sumxy','sumxx','sumyy','sumyx','sumy_yx2','sumai','srx','sry','srxy','srxx','sryy','sryx','sry_yx2','srai',
            'omegax','omegay','omegax2', 'omegay2','name','a','b','covxy','rxy','rxy2','Ffact','k1','k2','Ftab',
            'Saost','ma','mb','mrxy','ta','tb','trxy','ttabl','treua','treub','x0','y0','my0','treuy0','a1','b1','c1','a1s',
                'b1s','c1s','bs'));
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
