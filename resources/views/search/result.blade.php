@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')

<div>
    <table>
        <tr>
            <th>名前</th>
            <th>種別</th>
            <th>詳細</th>
        </tr>
        @foreach($search_data as $value)
        <tr>
            <td>{{ $value->name }}</td>
            <td>{{ $value->type }}</td>
            <td>{{ $value->detail }}</td>
        </tr>
        @endforeach
    </table>
    <a href="/search">検索画面に戻る</a>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
