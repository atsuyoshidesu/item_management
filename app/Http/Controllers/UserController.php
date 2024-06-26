<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //ユーザー一覧取得
        $users = User::all();
        return view('user.index',compact('users'));
    }


   
    /**
     * Remove the specified resource from storage.
     */
    public function userDestroy(Request $request)
{
    //リクエストからIDを取得
    $id = $request->route('id');
    
    //IDに対応するユーザーレコードを取得して削除
    $user = User::where('id', $id)->first();
    
    if($user) {
        $user->delete();
        return redirect('/users')->with('success', 'ユーザーを削除しました');
    } else {
        return redirect('/users')->with('error', 'ユーザーが見つかりませんでした');
    }
}
    
    public function userEdit(Int $id)
    {

        //viewから引き抜いたIDのデータを取得
        $user = User::find($id);
        
        //引き抜いたデータを表示
        return view('user.edit',compact('user'));
    }


    public function update(Request $request)
   {
     // レコードを取得して、編集して保存
    $user = User::where('id','=',$request->id)->first();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    
    return redirect()->route('users.index');
}

}
