<?php


namespace App\Http\Controllers;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
        
        $validation_array = [
            'keyword' => 'required',
            'checkbox' => 'required',
        ];

        $validator = Validator::make($request->all(), $validation_array);

        if ($validator->fails()){
            return redirect('/search')
                            ->withErrors($validator)
                            ->withInput();
        };
        $checkbox_array = [];
        foreach ($request->input('checkbox')as $value){
            $checkbox_array[] = $value;
        }

        $user_data = DB::table('items');

        if(in_array('name',$checkbox_array)){
            $user_data->where('name','like','%'.$request->input('keyword').'%');
        }
        if(in_array('type',$checkbox_array)){
            $user_data->where('type','like','%'.$request->input('keyword').'%');
        }
        if(in_array('detail',$checkbox_array)){
            $user_data->where('detail','like','%'.$request->input('keyword').'%');
        }

        $result = $user_data->get();

        return view('/search/result',[
            'search_data' => $result,
        ]);
    }

    public function search(Request $request)
{
    $items = Item::query();

    if ($request->has('stock')) {
        if ($request->stock == 'many') {
            $items->where('stock', '>', 10); // 在庫が10以上
        } else if ($request->stock == 'few') {
            $items->where('stock', '<', 10); // 在庫が10以下
        }
    }

    $results = $items->get();

    return view('search.results', ['results' => $results]);
}

    
}
