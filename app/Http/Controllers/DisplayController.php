<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spending;
use App\Income;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    // 収入支出の表示
    public function index() {
        // 収入計算
        $incomes = Auth::user()->income()->where('del_flg', '!=', 1)->get();
        // $income = new Income;
        // $incomeAll = $income->where('del_flg', '!=', 1)->get()->toArray();
        // 支出計算
        $spends = Auth::user()->spending()->where('del_flg', '!=', 1)->get();
        // $spending = new Spending;
        // $spendingAll = $spending->where('del_flg', '!=', 1)->get()->toArray();
        $i_sum = Auth::user()->income()->where('del_flg', '!=', 1)->where('date', 'LIKE', '%'.date('Y-m').'%')->sum('amount');
        $s_sum = Auth::user()->spending()->where('del_flg', '!=', 1)->where('date', 'LIKE', '%'.date('Y-m').'%')->sum('amount');
        $sum = $i_sum - $s_sum;

        return view('home', [
            'incomes' => $incomes,
            'spends' => $spends,
            'sum' => $sum,
        ]);
    }

    public function indexIink($date, $next) {
        if(!strptime($date, '%Y-%m')){
            abort(404);
        }
        // 収入計算
        $incomes = Auth::user()->income()->where('del_flg', '!=', 1)->get();
        // $income = new Income;
        // $incomeAll = $income->where('del_flg', '!=', 1)->get()->toArray();
        // 支出計算
        $spends = Auth::user()->spending()->where('del_flg', '!=', 1)->get();
        // $spending = new Spending;
        // $spendingAll = $spending->where('del_flg', '!=', 1)->get()->toArray();
        if($next == 1){
            $date = date('Y-m', strtotime('+1 month' . $date));//来月
        }else {
            $date = date('Y-m', strtotime('-1 month' . $date));//来月
        }
        $i_sum = Auth::user()->income()->where('del_flg', '!=', 1)->where('date', 'LIKE', '%'.$date.'%')->sum('amount');
        $s_sum = Auth::user()->spending()->where('del_flg', '!=', 1)->where('date', 'LIKE', '%'.$date.'%')->sum('amount');
        $sum = $i_sum - $s_sum;
        return view('home', [
            'incomes' => $incomes,
            'spends' => $spends,
            'date' => $date,
            'sum' => $sum,
        ]);
    }

    // 収入詳細
    public function incomeDetail(Income $income) {

        return view('detail', [
            'detail' => $income,
        ]);
    }

    // 支出詳細
    public function spendDetail(Spending $spending) {
   
        return view('detail', [
            'detail' => $spending,
        ]);
    }
}
