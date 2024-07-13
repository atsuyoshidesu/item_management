



@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>検索一覧</h1>
@stop

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        
                        <thead> 
                        <tr> 
                            <th>名前</th> 
                            <th>種別</th> 
                            <th>詳細</th> 
                        </tr>
                    </thead>

                    <tbody> @foreach ($search_data as $value) 
                        <tr> 
                            <td>{{ $value->name }}</td> 
                            <td>{{ $value->type }}</td> 
                            <td>{{ $value->detail }}</td> 
                            <td><a href="{{ route('edit', $value->id) }}" class="btn btn-default">詳細</a></td> 
                            
                        </tr> 
                        @endforeach
                    </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
