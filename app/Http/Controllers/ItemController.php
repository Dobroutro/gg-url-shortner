<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use App\Http\Requests;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemEditRequest;
use App\Repositories\ItemRepository;


class ItemController extends Controller
{

    /**
     * The ItemRepository instance.
     *
     * @var App\Repositories\ItemRepository
     */
    protected $item_repo;


    /**
     * Create a new ItemController instance.
     *
     * @param  App\Repositories\ItemRepository $item_repo
     * @return void
     */
    public function __construct(ItemRepository $item_repo)
    {
        $this->item_repo = $item_repo;

    }


    /**
     * Display a listing of the items.
     *
     * @return Response
     */
    public function index(Request $request)
    {   

        try{          
            $result = $this->item_repo->index(5, $request->get('search'));
        } catch (\Exception $e){
            return response([], 404);
        }
        
        return response(['app_url'=> Config::get('app.url'), 'resource' => $result]);
    }


    /**
     * Save item in storage.
     *
     * @return Response
     */
    public function store(ItemCreateRequest $request)
    {
        try{
            $item = $this->item_repo->store($request);
        } catch (\Exception $e){
            return response([], 404);
        }
        return response($item);
    }

    /**
     * Show form for editing the specified item from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try{
            $item = $this->item_repo->getById($id);        
        } catch (\Exception $e){
            return response([], 404);
        }
        return response($item);
    }

    /**
     * Update the specified item from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(ItemEditRequest $request,$id)
    {
        try{
            $item = $this->item_repo->getById($id);

            $this->item_repo->update($request, $item);      
        } catch (\Exception $e){
            return response([], 404);
        }
        return response($item);
    }


    /**
     * Remove the specified item from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        try{
            $item = $this->item_repo->getById($id);
            $this->item_repo->destroy($item);  
        } catch (\Exception $e){
            return response([], 404);
        }        

        return response(['success' => true], 200);
    }
}
