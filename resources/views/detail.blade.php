@extends('layout')
@section('content')
<main class="py-4">
    <div class="row justify-content-around">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    @if($detail['type']['category'] == 0)
                    <div class='text-center'>収入</div>
                    @elseif($detail['type']['category'] == 1)
                    <div class='text-center'>支出</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th scope='col'>日付</th>
                                    <th scope='col'>金額</th>
                                    <th scope='col'>カテゴリ</th>
                                    <th scope='col'>コメント</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope='col'>{{ $detail['date'] }}</th>
                                    <th scope='col'>{{ $detail['amount']}}</th>
                                    <th scope='col'>{{ $detail['type']['name']}}</th>
                                    <th scope='col'>{{ $detail['comment']}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="padding:0 23%;">
        <div class='d-flex justify-content-around mt-3'>
            @if($detail['type']['category'] == 0)
            <a href="{{ route('delete.income', $detail['id']) }}">
            @elseif($detail['type']['category'] == 1)
            <a href="{{ route('delete.spend', $detail['id']) }}">
            @endif
                <button class='btn btn-danger'>削除</button>
            </a>

            @if($detail['type']['category'] == 0)
            <a href="{{ route('edit.income', $detail['id']) }}">
            @elseif($detail['type']['category'] == 1)
            <a href="{{ route('edit.spend', $detail['id']) }}">
            @endif
                <button class='btn btn-secondary'>編集</button>
            </a>

            @if($detail['type']['category'] == 0)
            <a href="{{ route('logical.delete.income', $detail['id']) }}">
            @elseif($detail['type']['category'] == 1)
            <a href="{{ route('logical.delete.spend', $detail['id']) }}">
            @endif
                <button class='btn btn-warning'>理論削除
                </button>
            </a>
        </div>
    </div>
</main>
@endsection