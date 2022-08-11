<?php

namespace App\Http\Controllers\Time;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Time;
use App\Http\Requests\TimeCreateRequest;
use Illuminate\Support\Facades\Auth;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();

        $times = Time::where('user_id',$user)->orderBy('created_at', 'desc')->get();
        return view('time.index',compact('times'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('time.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimeCreateRequest $request)
    {
        $data = $request->input();
        $data['user_id'] = Auth::id();
		$data['kolvo'] = 12;
        $item = new Time($data);
        $item->save();

        if ($item) {
            return redirect()->route('time.index')->with('success', "Новое решение создано");
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$time=Time::where('id',$id)->first();
		$name=$time->name; 
		for($i=0;$i<5;$i++)
		{
			$sum[$i] = 0;
			$schet[$i] = 0;
			$sr[$i]=0;
		}
		$t=0;
		for ($i = 1; $i <= $time->kolvo; $i++) {
                $zapy[$i]="y".$i;
                $y[$i] = $time->{$zapy[$i]};
				$t=$t+$i;
				$t2[$i]=pow($i,2);
				
            }
		for ($i = 1; $i <= $time->kolvo; $i++) {
				if($i==1||$i>$time->kolvo-2)
				{
					$ss[$i]=0;
					$tss[$i]=0;
					$osk[$i]=0;
				}
				else{
					$ss[$i]=($y[$i-1]+$y[$i]+$y[$i+1]+$y[$i+2])/4;
					if($i==2)
					{
						$tss[$i]=0;
						$osk[$i]=0;
					}
					else{
						$tss[$i]=($ss[$i-1]+$ss[$i])/2;
						$osk[$i]=$y[$i]-$tss[$i];
						$sum[$i%4]=$sum[$i%4]+$osk[$i];
						$schet[$i%4]++;
					}
				}
						
            }
		$sum[4]=$sum[0];
		$schet[4]=$schet[0];
		for($i=1; $i<5;$i++)
		{
			$sr[$i]=$sum[$i]/$schet[$i];
		}
		$summary=array_sum($sr);
		$koef=$summary/4;
		for($i=1; $i<5;$i++)
		{
			$Si[$i]=$sr[$i]-$koef;
		}
		for ($i = 1; $i <= $time->kolvo; $i++) {
				if($i%4==0)
				{
					$yS[$i] = $y[$i]-$Si[4];
				}
				else{
                $yS[$i] = $y[$i]-$Si[$i%4];
				}
				$yt[$i]=$yS[$i]*$i;
				$yS2[$i]=pow($yS[$i],2);
            }
		$a0=(array_sum($yt)-array_sum($t2)*array_sum($y)/$t)/($t-array_sum($t2)*$time->kolvo/$t);
		$a1=(array_sum($y)-$a0*$time->kolvo)/$t;
		$ySR=array_sum($y)/$time->kolvo;
		for ($i = 1; $i <= $time->kolvo; $i++) {
				$y_t_[$i]=$a0+$i*$a1;
				$yS_ySR2[$i]=pow($yS[$i]-$ySR,2);
				$y_y_t_[$i]=pow($yS[$i]-$y_t_[$i],2);
				if($i%4==0)
				{
					$TSi[$i] = $y_t_[$i]+$Si[4];
				}
				else{
                $TSi[$i]=$y_t_[$i]+$Si[$i%4];
				}
				$e[$i]=$y[$i]-$TSi[$i];
				$e2[$i]=pow($e[$i],2);
				$y_ySR2[$i]=pow($y[$i]-$ySR,2);

		}
		for($i = $time->kolvo+1; $i <= $time->kolvo+12; $i++)
		{
			$T[$i]=$a0+$i*$a1;
			if($i%4==0)
				{
					$F[$i]=$T[$i]+$Si[4];
				}
				else{
                $F[$i]=$T[$i]+$Si[$i%4];
				}
			
		}
	
        return view('time.show',compact('y', 'yt', 'name','ss','tss','osk', 'time','sum','sr', 'summary','koef','Si','t','t2','yS','yt','a1','a0',
		'ySR','yS2','y_t_','y_ySR2','yS_ySR2','y_y_t_','Si','TSi','e','e2', 'T', 'F'));
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
