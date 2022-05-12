
@extends('layout')
@section('content')
   <?php 
    if(isset($date)){
        $date = $date;
    }else {
        $date = date('Y-m');
    }
    ?>
 
    <main class="py-4">
        <div class="row justify-content-around">
            <div class="col-md-6"> 
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-around">
                            <a href="{{ route('index', ['date' => $date, 'next' => 0]) }}">	&lt;&lt;前月</a>
                            <div class='col-6 text-center'>{{ $date }}</div>
                            <a href="{{ route('index', ['date' => $date, 'next' => 1]) }}">次月&gt;&gt;</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th scope='col' class='text-center'>合計:{{ $sum }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-around mt-3">
            <a href="{{ route('create.income') }}">
                <button type='button' class='bun bun-primary'>+収入</button>
            </a>
            <a href="{{ route('create.spend') }}">
                <button type='button' class='bun bun-secondary'>-支出</button>
            </a>
        </div>
        <div class="row justify-content-around">
            <!-- ブレイクポイント768px -->
            <div class="col-md-4"> 
                <div class="card">
                    <div class="card-header">
                        <div class='text-center'>収入</div>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th scope='col'>日付</th>
                                        <th scope='col'>金額</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ここに収入を表示する -->
                                    @foreach($incomes as $income)
                                    <tr>
                                        <th scope='col'>
                                            <a href="{{ route('income.detail', $income['id']) }}">#</a>
                                        </th>
                                        <th scope='col'>{{ $income['date'] }}</th>
                                        <th scope='col'>{{ $income['amount']}}</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class='text-center'>支出</div>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th scope='col'>日付</th>
                                        <th scope='col'>金額</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ここに支出を表示する -->
                                    @foreach($spends as $spend)
                                    <tr>
                                        <th scope='col'>
                                            <a href="{{ route('spend.detail', $spend['id']) }}">#</a>
                                        </th>
                                        <th scope='col'>{{ $spend['date'] }}</th>
                                        <th scope='col'>{{ $spend['amount']}}</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection