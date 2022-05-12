<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateData;
use App\Http\Requests\CreateCategory;
use App\Type;
use App\Spending;
use App\Income;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    
    public function createIncomeForm() {
        // ファサードを利用するとクラスをインスタンス化しなくてもstaticメソッドのようにメソッドを実行できる。
        $category = 0;
        $params = Auth::user()->type()->where('category', $category)->get();
        if(!$params->isEmpty()) {
            return view('income_form', [
                'types' => $params,
            ]);
        }else {
            return redirect()->route('add.type', ['id' => $category]);
        }
    }
    
    public function createIncome(CreateData $request) {
        $income = new Income;
        
        $columns = ['amount', 'date', 'comment', 'type_id'];
        
        foreach($columns as $column) {
            $income->$column = $request->$column;
        }
        Auth::user()->income()->save($income);
        
        return redirect('/');
    }
    
    public function createSpendForm() {
        // ファサードを利用するとクラスをインスタンス化しなくてもstaticメソッドのようにメソッドを実行できる。
        $category = 1;
        $params = Auth::user()->type()->where('category', $category)->get();
        if(!$params->isEmpty()) {
            return view('spend_form', [
                'types' => $params,
            ]);
        }else {
            return redirect()->route('add.type', ['id' => $category]);
        }
    }
    
    public function createSpend(CreateData $request) {
        $spending = new Spending;

        $columns = ['amount', 'date', 'comment', 'type_id'];

        foreach($columns as $column) {
            $spending->$column = $request->$column;
        }
        Auth::user()->income()->save($spending);

        return redirect('/');
    }

    public function addTypeForm(int $categoryId) {
        return view('add_type', [
            'categoryId' => $categoryId,
        ]);
    }
    
    public function addType(CreateCategory $request, int $categoryId) {
        $type = new Type;

        $type->name = $request->name;
        $type->category = $categoryId;

        Auth::user()->type()->save($type);

            return redirect('/');
       
    }

    
    public function editIncomeForm(Income $income) {
        
        $type = 0;
        $subject = '収入';
        
        $types =  Auth::user()->type()->where('category', $type)->get();
        
        return view('edit_form', [
            'id' => $income['id'],
            'subject' => $subject,
            'result' => $income,
            'category' => $type,
            'types' => $types,
        ]);
    }
    
    public function editIncome(Income $income, CreateData $request) {
        
        
        $columns = ['amount', 'date', 'comment', 'type_id'];

        foreach($columns as $column) {
            $income->$column = $request->$column;
        }
        $income->save();
        
        return redirect('/');
    }
    
    public function editSpendForm(Spending $spending) {
        
        $type = 1;
        $subject = '支出';
        
        $types =  Auth::user()->type()->where('category', $type)->get();
        
        return view('edit_form', [
            'id' => $spending['id'],
            'subject' => $subject,
            'result' => $spending,
            'category' => $type,
            'types' => $types,
        ]);
    }
    
    public function editSpend(Spending $spending, CreateData $request) {

        $columns = ['amount', 'date', 'comment', 'type_id'];
        
        foreach($columns as $column) {
            $spending->$column = $request->$column;
        }
        $spending->save();
        
        return redirect('/');
    }

    public function deleteIncome(Income $income){

        $income->delete();

        return redirect('/');
    }
    public function deleteSpend(Spending $spending){
        
        $spending->delete();

        return redirect('/');
    }
    public function logicalDeleteIncome(Income $income){
     
        $income->del_flg = 1;
        $income->save();

        return redirect('/');
    }
    public function logicalDeleteSpend(Spending $spending){
      
        $spending->del_flg = 1;
        $spending->save();

        return redirect('/');
    }
}