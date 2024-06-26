@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')

<form method="POST" action="/search/result">
    <table>
        <tr>
            <th>検索カテゴリ</th>
            @foreach($form_data as $value)
                <td>
                    <input name="{{ $value[1] }}" type="checkbox" value="{{ $value[2] }}" {{ old($value[1]) == $value[2] ? 'checked' : ''}}>
                    <p>{{ $value[0] }}</p>
                </td>
                @if($errors->has('checkbox'))
                    <p style="color:red;">{{ $errors->first('checkbox') }}</p>
                @endif
            @endforeach
        </tr>

        <tr>
            <th>検索カテゴリ</th>
            @foreach($form_data as $value)
                <td>
                    <input name="{{ $value[1] }}" type="checkbox" value="{{ $value[2] }}" {{ old($value[1]) == $value[2] ? 'checked' : ''}}>
                    <p>{{ $value[0] }}</p>
                </td>
                @if($errors->has('checkbox'))
                    <p style="color:red;">{{ $errors->first('checkbox') }}</p>
                @endif
            @endforeach
        </tr>
        
        <tr>
            <th>検索ワード</th>
            <td><input name="keyword" type="text" value="{{ old('keyword')}}"></td>
            @if($errors->has('keyword'))
                <p style="color: red;">{{ $errors->first('keyword') }}</p>
            @endif
        </tr>
        
        <tr>
            <button type="submit" >検索する</button>
        </tr>
    </table>
    @csrf
</form>
@stop

@section('css')
@stop

@section('js')
@stop
