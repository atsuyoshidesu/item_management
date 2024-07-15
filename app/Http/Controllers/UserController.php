<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
use Illuminate\Validation\Rule;


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
        if(Gate::allows('isAdmin')) { 
            $users = User::all(); 
            
        } else { 
            dd('ユーザー一覧にアクセスが許可されていません。');
        }
        return view('user.index', compact('users'));
    }
   
    
    public function userRegister()
{
    return view('user.register');
}


    /**
     * Remove the specified resource from storage.
     */
    
     public function userDestroy(Request $request){
        //リクエストからIDを取得
        $id = $request->route('id');
    
        //IDに対応するユーザーレコードを取得して削除
        $user = User::where('id', $id)->first();
    
        if($user) {
            //アクセスしたユーザではなくid1を持つユーザ利用
            $other_user = User::find(1);
            if(Gate::forUser($other_user)->allows('delete', $user)){
                $user->delete();
                return redirect('/users')->with('success', 'ユーザーを削除しました');
            } else {
                return redirect('/users')->with('error', '権限がありません');
            }
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

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id),],
            
    ]);

     // レコードを取得して、編集して保存
    $user = User::where('id','=',$request->id)->first();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    
    return redirect()->route('users.index');
}



}
