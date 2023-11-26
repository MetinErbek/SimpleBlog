<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {

      $this->data['Users'] = User::getWithConditions($_GET)->paginate(15);
      return view('lumino.users', $this->data);
    }

    public function destroy($id)
    {
      try{
          $UserRS = User::getWithConditions()->where('id', $id);
          if($UserRS->exists())
          {
            $User = $UserRS->first();



            $Del = $User->delete();

            return redirect()->back()->withErrors([__('User Removed !')]);

          }
        }catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->back()->withErrors([__('Has a Problem !')]);
        }
    }
}
