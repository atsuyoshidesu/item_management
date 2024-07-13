<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index(Request $request)    {
        // 商品一覧取得
        $items = Item::all();
        
        //キーワードからの検索処理
       
    $items = Item::query();

    $keyword = $request->input('keyword');

    if ($keyword) {
        $items = $items->where('item_name', 'LIKE', "%{$freeword}%");
    }

    $items = $items->get();

    

    return view('item.index', compact('items'));
}
    
    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
                'category' => $request->category,
                'price' => $request->price,
                'stock' => $request->stock,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    public function edit(Int $id)
    {

        //viewから引き抜いたIDのデータを取得
        $item = Item::find($id);
        
        //引き抜いたデータを表示
        return view('item.edit',compact('item'));
    }

    public function itemEdit(Request $request)
    {
        // レコードを取得して、編集して保存
        $item = Item::where('id','=',$request->id)->first();
        $item->name = $request->name;
        $item->type = $request->type;
        $item->detail = $request->detail;
        $item->category = $request->category;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->save();

        return redirect('/items');
    }

    public function destroy(Request $request){
        //レコードを取得して削除
        $item = Item::where('id','=',$request->id)->first();
        $item -> delete();

        return redirect('/items');
    }

    public function itemModel(Request $request){

        return redirect('/items');
    }

    
}
