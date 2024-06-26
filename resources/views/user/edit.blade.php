@extends('adminlte::page')

@section('title', '商品詳細')

@section('content_header')
<h1>商品詳細</h1>
@stop

@section('content')
    
 
    <div class="panel-body">
   

        <table class="table table-striped task-table">
        
            <form action = "/users/{{$user->id}}/update" method="POST">
            @csrf
                <label for="name">名前</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" name="email" value="{{$user->email}}">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                        <a href="/userDestroy/{{$user->id}}" ><button type="button" class="btn btn-secondary">削除</button></a>
                    </div>
            </form>
        </table>
    </div>
@stop
@section('css')
@stop

@section('js')
@stop
