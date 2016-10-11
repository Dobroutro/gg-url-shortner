<?php 

namespace App\Repositories;

use App\Models\Item;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ItemRepository extends BaseRepository {

    protected $chars = "123456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ";
    protected $length = 6;

    /**
     * Create a new ItemRepository instance.
     *
     * @param  App\Models\Item $item
     * @return void
     */
    public function __construct(Item $item)
    {
        $this->model = $item;
    }

    /**
     * Check short code in db
     *
     * @param  int  $length
     * @return string
     */
    protected function convertIntToShortCode($length) {
        $charactersLength = strlen($this->chars);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $this->chars[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }   

    /**
     * Check short code in db
     *
     * @param  string  $short_code
     * @return bool
     */
    public function checkCode($short_code) {
        if($this->model->where("short_code", "=", $short_code)->first()){
            return false;
        }
        return true;
    }

    /**
     * Get Item by short code.
     *
     * @param  string  $short_code
     * @return App\Models\Item
     */
    public function getByShortCode($short_code) {
        $item = $this->model->where("short_code", "=", $short_code)->first();
        if($item){
            return $item;
        }
        return false;
    }

    /**
     * Get Items collection.
     *
     * @param  int  $n
     * @return Illuminate\Support\Collection
     */
    public function index($n, $search = null)
    {
        $user = Auth::guard('api')->user();
        if($search){
            return $this->model
                ->where("long_url", "LIKE", "%{$search}%")
                ->where("user_id", "=", $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate($n);      
        }else{
          return $this->model->where("user_id", "=", $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate($n);
        }
    }

    /**
     * Store a Items.
     *
     * @param  App\Http\Requests\BookCreateRequest  $request
     * @param  int   $user_id
     * @return App\Models\Item
     */
    public function store($request)
    {   
        $inputs = $request->all();

        $model_item = new $this->model;    

        $user = Auth::guard('api')->user();
        $condition = true;
        while($condition) {
            $short_code = $this->convertIntToShortCode($this->length);
            if($this->checkCode($short_code)) {
                $condition = false;
            }
        };

        $model_item->user_id = $user->id;
        $model_item->long_url = $inputs['long_url'];
        $model_item->short_code = $short_code;

        $model_item->save();
        
        return $model_item;
    }


    /**
     * Get Items collection.
     *
     * @param  App\Models\Item $item
     * @return array
     */
    public function edit($item)
    {
        return compact('item');
    }

    /**
     * Update a Items.
     *
     * @param  App\Http\Requests\BookEditRequest  $request
     * @param  App\Models\Item $item
     * @return void
     */
    public function update($request, $item)
    {   
        $inputs = $request->all();

        $user = Auth::guard('api')->user();
        if($user->id != $item->user_id) return;

        $item->long_url = $inputs['long_url'];

        $item->save();
 
    }

    /**
     * Destroy a post.
     *
     * @param  App\Models\Item $item
     * @return void
     */
    public function destroy($item) 
    {
        $item->delete();
    } 
   
}