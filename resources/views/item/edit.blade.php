@extends('adminlte::page')

@section('title', '商品詳細')

@section('content_header')
<h1>商品詳細</h1>
@stop

@section('content')
    
 
    <div class="panel-body">
        <table class="table table-striped task-table">
            <form action = "/itemEdit/{{$item->id}}" method="post">
                @csrf
                <label for="name">名前</label>
                <input type="text" class="form-control" name="name" value="{{$item->name}}">
                <label for="type">種別</label>
                <input type="text" class="form-control" name="type" value="{{$item->type}}">
                <label for="detail">詳細</label>
                <input type="text" class="form-control" name="detail" value="{{$item->detail}}">
                <label for="detail">カテゴリー</label>
                <input type="text" class="form-control" name="category" value="{{$item->category}}">
                <label for="detail">金額</label>
                <input type="text" class="form-control" name="price" value="{{$item->price}}">
                <label for="detail">在庫</label>
                <input type="text" class="form-control" name="stock" value="{{$item->stock}}">
                <label for="detail">商品登録日</label>
                <input type="text" class="form-control" name="created_at" value="{{$item->created_at}}">
                <label for="detail">商品更新日</label>
                <input type="text" class="form-control" name="updated_at" value="{{$item->updated_at}}">
                <label for="detail">商品登録者</label>
                <input type="text" class="form-control" name="user_id" value="{{$item->user_id}}">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                        <a href="/destroy/{{$item->id}}" ><button type="button" class="btn btn-secondary">削除</button></a>
                    </div>
            </form>
        </table>
    </div>
@stop
@section('css')
@stop

@section('js')
@stop
