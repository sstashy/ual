<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Image;

use App\Items;
use App\Favorites;
use App\User;
use App\Genders;
use App\Categories;
use App\Role;
use App\Page;
use App\Settings;
use App\Comments;
use App\Advertisements;
use App\LikeDislike;
use Carbon\Carbon;
use Cookie;

class HomeController extends Controller
{
    
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::where('status', 1)
            ->orderByDesc('id')
            ->paginate(Settings::first()->items_result);
        
        return view('index')->with([
            'title' => Settings::first()->website_name.' - '.Settings::first()->website_tagline,
            'desc' => Settings::first()->website_desc,
            'items' => $items,
        ]);
    }

    public function show($slug)
    {
          
        if($slug == null){
            abort(404);
        }
        
        $item = Items::where('slug', $slug)->first();
        $votes = LikeDislike::where('item_id', $item->id)->orderByDesc('id')->limit(1)->get();
        
        if($item == null){
            abort(404);
        }

        if($item->status == 2){
            abort(404, 'This content is currently disabled!');
        }
        
        if(!Cookie::get('item_viewed_'.$item->id)) {
            // Update view counter of post
            $item->views = $item->views+1;
            $item->save();
            // Create a cookie before the response and set it for 30 days
            Cookie::queue('item_viewed_'.$item->id, true, 60 * 24 * 30);
        }
        
        return view('show')->with([
            'title' => $item->title.' - '.Settings::first()->website_name,
            'desc' => Str::of($item->description)->words(45, '...'),
            'item' => $item,
            'votes' => $votes,
        ]);
        
    }
    
    public function send()
    {
        return view('send')->with([
            'title' => Settings::first()->website_name.' - '.Settings::first()->website_tagline,
            'desc' => Settings::first()->website_desc,
            'setting' => Settings::first(),
            'categories' => Categories::where('status', 1)->get()
        ]);
    }
    
    // store story into db
    // salva il racconto nel database
    public function store(Request $request)
    {

        $items = new Items;
        
        $request->validate([
            'title' => 'required|max:'.Settings::first()->max_chars_title.'|min:5',
            'story' => 'required|max:'.Settings::first()->max_chars_story.'|min:'.Settings::first()->min_chars_story.'',
            'categories' => 'required',
        ]);

        $items->user_id = Auth::id();
        $items->title = request('title');
        $items->story = request('story');
        $items->age = Carbon::parse(Auth::user()->birth)->diffInYears(Carbon::today());
        $items->gender = Auth::user()->gender; 
        $items->categories = request('categories');
        $items->slug = Str::of(request('title').' '.Str::random(8))->slug('-');
        $items->status = Settings::first()->items_status;
        if($items->save() == true)
        {

            if(Settings::first()->photo_upload == 1){
                if(!empty(request('image'))){
                    $request->validate([
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    $image                   =       $request->file('image');
                    $input['imagename']      =       time().'.'.$image->extension();
                    $destinationPath         =       'dist/img/item';
                    $img                     =       Image::make($image->path());

                    // --------- [ Resize Image ] ---------------

                    $img->resize(function($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$input['imagename']);

                    $upload = $items->save([
                            $items->image = $input['imagename'],
                        ]);
                }
            }
            
            if(Settings::first()->items_status == 1){
                return back()->with('success', __('app.text_44'));
            } else {
                return back()->with('success', __('app.text_45'));
            }
            
        } else 
        {
            return back()->with('danger', __('app._text_'));
        }
        
    }
    
    /**
     * Pages
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function page($slug)
    {
          
        if($slug == null){
            abort(404);
        }
        
        $item = Page::where('slug', $slug)->first();
        
        if($item == null){
            abort(404);
        }
        
        if($item->status == 2){
            abort(404, 'This content is currently disabled!');
        }
        
        if(!Cookie::get('page_viewed_'.$item->id)) {
            // Update view counter of post
            $item->views = $item->views+1;
            $item->save();
            // Create a cookie before the response and set it for 30 days
            Cookie::queue('page_viewed_'.$item->id, true, 60 * 24 * 30);
        }
        
        return view('page')->with([
            'title' => $item->title.' - '.Settings::first()->website_name,
            'desc' => Str::of($item->body)->words(45, '...'),
            'item' => $item
        ]);
        
    }
    
    /**
     * Categories
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories($slug)
    {
        if($slug == null){
            abort(404);
        }

        $category = Categories::where('slug', $slug)
            ->first();
        
        if($category == null){
            abort(404);
        }

        // get items
        $items = Items::where('categories', $category->id)
            ->where('status', 1)
            ->orderByDesc('id')
            ->paginate(Settings::first()->items_result);
        
        return view('categories')->with([
            'title' => $category->name.' - '.Settings::first()->website_name,
            'desc' => '',
            'items' => $items, 
            'category' => $category,
        ]);
        
    }
    
    /**
     * Genders
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function genders($slug)
    {
        if($slug == null){
            abort(404);
        }

        $gender = Genders::where('gender_slug', $slug)
            ->first();
        
        if($gender == null){
            abort(404);
        }

        // get items
        $items = Items::where('gender', $gender->id)
            ->where('status', 1)
            ->orderByDesc('id')
            ->paginate(Settings::first()->items_result);
        
        return view('genders')->with([
            'title' => $gender->gender_title.' - '.Settings::first()->website_name,
            'desc' => '',
            'items' => $items, 
            'gender' => $gender,
        ]);
        
    }
    
    /**
     * Search
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function search(Request $request)
    {
        
        if(!empty($query = request('key'))) {
            $items = Items::where('status', 1)
                ->where('title', 'like', '%'.$query.'%')
                ->orWhere('story', 'like', '%'.$query.'%')
                ->orderByDesc('id')
                ->paginate(Settings::first()->items_result);
        } else
        {
            back();
        }
        
        return view('search')->with([
            'title' => $query.' - '.Settings::first()->website_name,
            'desc' => '',
            'items' => $items,
            'keywords' => request('key'),
        ]);
    }
    
    // Save Comment
    function save_comment(Request $request){
        
        $request->validate([
            'comment' => 'required|max:200|min:5',
        ]);
        
        $data = new Comments;
        $data->user_id = Auth::id();
        $data->items_id = $request->post;
        $data->comment = $request->comment;
        $data->status = Settings::first()->comments_status;
        if($data->save()) {
            if(Settings::first()->comments_status == 1){
                return back()->with('success', __('app.text_46'));
            } else {
                return back()->with('success', __('app.text_51'));
            }
        } else {
            return back()->with('danger', __('app.text_47'));
        }
        
    }
    
    // Save Like Or dislike
    function save_likedislike(Request $request){
        
        if($request->post == null){
            abort(404);
        }
        
        $checkItem = DB::table('items')->where('id', $request->post)->first();
        if($checkItem == null){
            abort(404);
        }
        
        $check = DB::table('like_dislikes')
            ->where('item_id', $request->post)
            ->where('user_id', Auth::id())
            ->get();
        
        $total = DB::table('like_dislikes')
            ->where('item_id', $request->post)
            ->count();
        
        if($check->count() < 1){
            $data = new LikeDislike;
            $data->user_id = Auth::id();
            $data->item_id = $request->post;
            if($request->type == 'like'){
                $data->like=1;
            }else{
                $data->dislike=1;
            }
            
            if($data->save()){
                return response()->json([
                    'bool'=>true
                ]);
            }
            
        } else {
            
            DB::table('like_dislikes')->where('user_id', Auth::id())->where('item_id', $request->post)->delete();
            return response()->json([
                'bool'=>false
            ]);
            
        }

    }
    
    function save_favorite(Request $request){
        
        if($request->post == null){
            abort(404);
        }
        
        $checkItem = DB::table('items')->where('id', $request->post)->first();
        if($checkItem == null){
            abort(404);
        }
        
        $check = DB::table('favorites')
            ->where('user_id', Auth::id())
            ->where('item_id', $request->post)
            ->get();
        
        if($check->count() < 1){
            
            $data = new Favorites;
            $data->user_id = Auth::id();
            $data->item_id = $request->post;
            $data->save();
            
            return response()->json([
                'bool'=>true
            ]);
        } else
        {
            DB::table('favorites')->where('user_id', Auth::id())->where('item_id', $request->post)->delete();
                return response()->json([
                    'bool'=>false
                ]);
            
        }
        
    }
    
    /**
     * Edit user
     * @id
     */
    public function edit_user()
    {
        
        $user = User::findOrFail(Auth::id());
        
        return view('auth.edit_user')
            ->with([
                'title' => 'Edit User - '.Settings::first()->website_name,
                'desc' => 'Edit user',
                'item' => $user,
                'genders' => Genders::all()
            ]);
    }
    
    // Show user profile
    public function user($username)
    {
          
        if($username == null){
            abort(404);
        }

        $user = DB::table('users')
            ->where('name', $username)
            ->first();
        
        if($user == null){
            abort(404);
        }
        
        // comments
        $comments = DB::table('comments')
            ->orderByDesc('id')
            ->where('user_id', $user->id)
            ->limit(10)
            ->get();
        
        return view('auth.user')->with([
            'title' => $user->name.' - '.Settings::first()->website_name,
            'desc' => Settings::first()->website_desc,
            'user' => $user, 
            'comments' => $comments,
        ]);
        
    }
    
    public function store_edit_user(Request $request)
    {
        
        if(!empty(request('new_password'))){
            $this->validate($request, [
                'new_password' => 'required|min:8',
                'new_confirm_password' => 'same:new_password',
            ]);

            $update = User::where('id', Auth::id())
                ->update([
                    'password' => bcrypt(request('new_password'))
                ]);

            if($update == true)
            {
                return back()
                    ->with('success', __('app.text_49'));
            } else 
            {
                return back()
                    ->with('danger', __('app.text_50'));
            }

        }

        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,'.Auth::id(),
            'email' => 'required|unique:users,email,'.Auth::id(),
            'birth' => 'required|date|date_format:Y-m-d',
            'gender' => 'required',
            'bio' => 'nullable|max:200|min:5',
        ]);

        if(!empty(request('avatar'))){

            $request->validate([
                'avatar' => 'nullable|image|dimensions:min_width=200,min_height=200|mimes:jpeg,png,jpg|max:2048',
            ]);

            if(!empty(Auth::user()->avatar))
            {
                $delete = File::delete('dist/img/avatar/'.Auth::user()->avatar);
            }

            $image                   =       $request->file('avatar');
            $input['imagename']      =       time().'.'.$image->extension();
            $destinationPath         =       'dist/img/avatar';
            $img                     =       Image::make($image->path());

            // --------- [ Resize Image ] ---------------

            $img->resize(function($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $upload_avatar = User::where('id', Auth::id())
                ->update([
                    'avatar' => $input['imagename'],
                ]);

            if($upload_avatar == true)
            {
                return back()
                    ->with('success', __('app.text_49'));
            } else 
            {
                return back()
                    ->with('danger', __('app.text_50'));
            }
        }

        $update = User::where('id', Auth::id())
            ->update([
                'name'     => request('name'),
                'email'    => request('email'),
                'birth' => request('birth'),
                'gender' => request('gender'),
                'bio' => request('bio'),

        ]);

        if($update == true)
        {
            return back()
                ->with('success', __('app.text_49'));
        } else 
        {
            return back()
                ->with('danger', __('app.text_50'));
        }

    }
    
    public function delete_avatar()
    {
        
        if(!empty(Auth::user()->avatar))
        {
            // delete file 
            File::delete('dist/img/avatar/'.Auth::user()->avatar);
            
            $delete_avatar = User::where('id', Auth::id())
                ->update([
                    'avatar' => NULL,
                ]);
            
            if($delete_avatar == true)
            {
                return back()
                    ->with('success', __('admin.settings_delete_logo'));
            } else 
            {
                return back()
                    ->with('danger', __('admin.submit_error'));
            }
        } 
        else 
        {
            return back()
                ->with('danger', __('admin.there_is_no_logo'));
        }
        
    }
    
    /**
     * My Favorites
     * User
     *
     */
    public function my_favorites()
    {
        
        return view('auth.my_favorites')->with([
            'title' => Settings::first()->website_name.' - '.__('app.text_3'),
            'desc' => Settings::first()->website_desc,
            'favorites' => Favorites::where('user_id', Auth::id())->get(),
        ]);
        
    }
    
    /**
     * My Items
     * User
     *
     */
    public function my_items()
    {
        return view('auth.my_items')->with([
            'title' => Settings::first()->website_name.' - '.Settings::first()->website_tagline,
            'desc' => Settings::first()->website_desc,
            'items' => Items::where('user_id', Auth::id())
            ->orderByDesc('id')
            ->paginate(20),
        ]);
    }
    
    /**
     * Delete Item
     * User
     *
     */
    public function delete_item($id)
    {
        $item = Items::find($id); // get item details
        if(Auth::id() == $item->user_id){
            // delete item
            $delete = DB::table('items')
                ->where('id', $id)
                ->delete();
            
            if($delete == true)
            {
                // delete uploaded image 
                if(is_file('dist/img/item/'.$item->image)){
                    $delete_image = File::delete('dist/img/item/'.$item->image);
                }
                return back()
                    ->with('success', __('app.text_48'));
            } else 
            {
                return back()
                    ->with('danger', __('app.text_47'));
            }
            
        } else {
            return back()
                ->with('danger', __('app.text_47'));
        }
    }
    
}