<?php


namespace App\Http\Controllers;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Item;


class SearchController extends Controller
{

    public $form_data = [
        ['名前','checkbox[name]','name'],
        ['種別','checkbox[type]','type'],
        ['詳細','checkbox[detail]','detail'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('search/index',[
            'form_data' => $this->form_data,
        ]);
    }

    
    public function result(Request $request)
    {
        $freeword = $request->input('freeword');
    
        // アイテムの取得と検索条件の設定
        $items = DB::table('items')
            ->where(function($query) use ($freeword) {
                $query->where('user_id', 'LIKE', '%'.$freeword.'%')
                      ->orWhere('name', 'LIKE', '%'.$freeword.'%')
                      ->orWhere('type', 'LIKE', '%'.$freeword.'%')
                      ->orWhere('detail', 'LIKE', '%'.$freeword.'%')
                      ->orWhere('category', 'LIKE', '%'.$freeword.'%');
            })
    
        // 金額での絞り込み
            ->when($request->filled('min_price'), function ($query) use ($request) {
                $query->where('price', '>=',  $request->min_price);
            })
            ->when($request->filled('max_price'), function ($query) use ($request) {
                $query->where('price', '<=',  $request->max_price);
            })
            ->get();
    
        return view('search.result', [
            'search_data' => $items,
        ]);
    }
}