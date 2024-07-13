@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')

<form method="POST" action="{{ url('/search/result') }}">
     <div class="search-area">
        <input type="text" class="form-control" placeholder="キーワード検索" name="freeword" value="{{ request('freeword') }}">
    </div>  

    <div class="item-form-detail">
        <label for="">価格
            <div>
                <input type="text" name="min_price" value="{{request()->input('min_price')}}" > ～ <input type="text" name="max_price" value="{{request()->input('max_price')}}">
            </div>
        </label>
    </div>

    <button type="submit" class="btn">検索</button>
@csrf
</form>
@stop

@section('css')
@stop

@section('js')
@stop
