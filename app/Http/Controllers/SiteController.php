<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

class SiteController extends Controller
{
	public function index()
	{
		$this->data['Posts'] = Posts::getWithConditions(request()->all())->with('user')->where('status', 'publish')->paginate(15);

		return view('site.index', $this->data);
	}
	public function post($slug)
	{
		$this->data['Post'] = Posts::getWithConditions(request()->all())
								->with('user')
								->where('status', 'publish')
								->where('slug', $slug)
								->first();

		return view('site.post', $this->data);
	}
	
}
