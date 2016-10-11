<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ItemRepository;

class IndexController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @param  App\Repositories\ItemRepository $item_repo
     * @return void
     */
    public function __construct(ItemRepository $item_repo)
    {
        $this->item_repo = $item_repo;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('welcome');
    }    

    /**
     * Process general application id
     *
     * @return \Illuminate\Http\Response
     */
    public function resources($id = null)
    {   
        if($id) {
            $item = $this->item_repo->getByShortCode($id);
            if($item) {
                return redirect()->away($item->long_url);
            }
        }
        return response()->view('errors.404', [], 404);

    }    

 
}
