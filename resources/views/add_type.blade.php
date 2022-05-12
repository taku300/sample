@extends('layout')
@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>カテゴリ追加</h1>
                    <h4 class='text-center'>{{ $categoryId == 0 ? '（収入）': '（支出）' }}</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                         @if($errors->any())
                        <div class='alert alert-danger'>
                            <ul>
                                @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('add.type', ['id' => $categoryId])}}" method="post">
                            @csrf
                            <label for='category'>追加するカテゴリを入力してください。</label>
                                <input type='text' class='form-control my-3' name='name' id='category'/>
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection