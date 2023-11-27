<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Str;
use Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request()->all();
        if(Auth::user()->role_id != 1)
        {
            $filters['user_filter'] = Auth::user()->id;
        }
        $this->data['Posts'] = Posts::getWithConditions($filters)->paginate(15);

        return view('lumino.posts', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lumino.addnewpost', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reqs = $request->toArray();
        try{

            $reqs['user_id'] = Auth::user()->id;
            $reqs['slug'] = '';
            $Article = new Posts($reqs);
            $Article->save();
            $Article->update(['slug'=>Str::slug($Article->title.'-'.$Article->id)]);

            return redirect(url('admin/index'))->withErrors([__('Your Blog Article Saved !')]);

        } catch(\Illuminate\Database\QueryException $e)
        {
            
            return redirect()->back()->withErrors([$e->getMessage()]);
  
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            
            $id = decrypt_sha_for_url($id);
            $PostRS = Posts::getWithConditions()->where('id', $id);
            if($PostRS->exists())
            {
              $this->data['Post'] = $PostRS->first();
              return view('lumino.editpost', $this->data);
            }
          }catch(\Illuminate\Database\QueryException $e)
          {
              return redirect()->back()->withErrors([__('Has a Problem !')]);
          }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reqs = $request->toArray();
        try{
            $id = decrypt_sha_for_url($id);
            $PostRS = Posts::getWithConditions()->where('id', $id);
            if($PostRS->exists())
            {

              $Post = $PostRS->first();
  
  
               $reqs['slug'] = Str::slug($request->title);
               //var_dump($reqs);exit;
               $Post->fill($reqs);
               $Post->save();
               $Post->update(['slug'=> Str::slug($request->title.'-'.$Post->id)]);
  
               return redirect(url('admin/posts'))->withErrors([__('Blog Updated !')]);
  
  
            }
          }catch(\Illuminate\Database\QueryException $e)
          {
              return redirect()->back()->withErrors([__('Has a Problem !'.$e->getMessage())]);
          }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $id = decrypt_sha_for_url($id);
            $PostRS = Posts::getWithConditions()->where('id', $id);
            if($PostRS->exists())
            {
              $Post = $PostRS->first();
  
              $Del = $Post->delete();
  
              return redirect()->back()->withErrors([__('Blog Article Removed !')]);
  
            }
          }catch(\Illuminate\Database\QueryException $e)
          {
              return redirect()->back()->withErrors([__('Has a Problem !')]);
          }
    }
    public function postStatusChange(string $post_id, string $new_status)
    {
        try{

            $id = decrypt_sha_for_url($post_id);
            $PostRS = Posts::getWithConditions()->where('id', $id);
            if($PostRS->exists())
            {
              $Post = $PostRS->first();
  
             if(in_array($new_status, ['publish','draft']))
             {
                $Post->update(['status'=> $new_status]);
                return redirect()->back()->withErrors([__('Post Status Changed !')]);
             } else {
                return redirect()->back()->withErrors([__('Has a Problem !')]);
             }
  
            }
          }catch(\Illuminate\Database\QueryException $e)
          {
              return redirect()->back()->withErrors([__('Has a Problem !')]);
          }
    }


    public function bulkRemovePost(Request $request)
    {
        try {
            $total = 0;
            $Selecteds = $request->checkeds;
            foreach($Selecteds as $selected)
            {
                $id = decrypt_sha_for_url($selected);
                $PostRS = Posts::getWithConditions()->where('id', $id);
                if($PostRS->exists())
                {
                    $Post = $PostRS->first();
                    $Post->delete();
                    $total++;
                }
            }
            return json_encode(['status'=>TRUE, 'result'=>['Select'=>$Selecteds,'message'=> $total.' blog article removed !' ]]);
        } catch(Exception $e)
        {
            return json_encode(['status'=>FALSE, 'result'=>['message'=>$e->getMessage() ]]);
        }
    }

}
