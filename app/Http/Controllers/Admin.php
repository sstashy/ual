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

use App\User;
use App\Role;
use App\Page;
use App\Settings;
use App\Items;
use App\Genders;
use App\Categories;
use App\Comments;
use App\Advertisements;
use Carbon\Carbon;
  
class Admin extends Controller
{
    
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index')->with([
            'title' => 'Dashboard :: '.Settings::first()->website_name,
            'desc' => 'Dashboard',
            'items' => Items::where('status', 2)->orderByDesc('id')->paginate(25)
        ]);
    }
    
    /**
     * Users
     */
    public function users()
    {
        $users = User::latest()
            ->orderByDesc('id')
            ->paginate(25);
        
        return view('admin.users.users')->with([
            'title' => 'Users :: '.Settings::first()->website_name,
            'desc' => 'Dashboard',
            'users' => $users,
        ]);
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete_user($id)
    {
        $item = User::find($id);
        // delete uploaded avatar
        if(is_file('dist/img/avatar/'.$item->avatar)){
            $delete_image = File::delete('dist/img/avatar/'.$item->avatar);
        }
        
        $delete = DB::table('users')->where('id', $id)->delete();
        if($delete == true){
            return redirect('/admin/users')
                ->with('success', __('admin.success_message'));
        }
        else 
        {
            return back()->with('danger', __('admin.error_message'));
        }
    }
    
    /**
     * Add New user
     *
     */
    public function add_user()
    {

        return view('admin.users.add_user')
            ->with([
                'title' => 'Add User :: '.Settings::first()->website_name,
                'desc' => 'Dashboard',
                'roles' => Role::get()
            ]);
    }
    
    public function store_user(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'status' => ['required'],
        ]);
        
        $user = User::create([
            'name'     => request('name'),
            'email'    => request('email'),
            'password' => bcrypt(request('password')),
            'status'    => request('status'),
        ]);
        
        $user
            ->roles()
            ->attach(Role::where('name', request('role'))->first());
        
        if($user == true)
        {
            return redirect('/admin/users')
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Edit user
     * @id
     */
    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRole = $user->roles->pluck('name','name')->all();
        
        return view('admin.users.edit_user')
            ->with([
                'title' => 'Edit User :: '.Settings::first()->website_name,
                'desc' => 'Edit user',
                'item' => $user,
                'roles' => $roles,
                'userRole' => $userRole
            ]);
    }
    
    public function store_edit_user(Request $request, $id)
    {
        
        if(!empty(request('new_password'))){
            $this->validate($request, [
                'new_password' => 'required|min:8',
                'new_confirm_password' => 'same:new_password',
            ]);
            
            $update = User::where('id', $id)
                ->update([
                    'password' => bcrypt(request('new_password'))
                ]);
            
            if($update == true)
            {
                return redirect('/admin/users')
                    ->with('success', __('admin.success_message'));
            } else 
            {
                return back()
                    ->with('danger', __('admin.error_message'));
            }
            
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,'.$id,
            //'password' => 'string|min:8|confirmed',
            'status' => 'required',
        ]);
        
        $update = User::where('id', $id)
            ->update([
            'name'     => request('name'),
            'email'    => request('email'),
            //'password' => bcrypt(request('password')),
            'status'    => request('status')
        ]);

        User::find($id)->roles()->detach();
        User::find($id)->roles()->attach(Role::where('name', request('role'))->first());
            
        if($update == true)
        {
            return redirect('/admin/users')
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Pages
     */
    public function pages()
    {
        $pages = Page::latest()
            ->orderByDesc('id')
            ->paginate(25);
        
        return view('admin.pages.pages')->with([
            'title' => 'Pages :: '.Settings::find(1)->website_name,
            'desc' => 'Dashboard',
            'pages' => $pages,
        ]);
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function delete_page($id)
    {

        $delete = DB::table('pages')->where('id', $id)->delete();
        
        if($delete == true){
            return redirect('/admin/pages')
                ->with('success', __('admin.success_message'));
        }
        else 
        {
            return back()->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Add New user
     *
     */
    public function add_page()
    {

        return view('admin.pages.add_page')
            ->with([
                'title' => 'Add Page :: '.Settings::find(1)->website_name,
                'desc' => 'Dashboard',
            ]);
    }
    
    public function store_page(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required'],
            'status' => ['required'],
        ]);
        
        $page = Page::create([
            'title'     => request('title'),
            'body'    => request('body'),
            'slug' => Str::of(request('title').' '.Str::random(8))->slug('-'),
            'status'    => request('status'),
        ]);

        if($page == true)
        {
            return redirect('/admin/pages')
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Edit user
     * @id
     */
    public function edit_page($id)
    {
        
        return view('admin.pages.edit_page')
            ->with([
                'title' => 'Edit Page :: '.Settings::find(1)->website_name,
                'desc' => 'Edit page',
                'item' => Page::findOrFail($id)
            ]);
        
    }
    
    public function store_edit_page(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'status' => 'required',
        ]);

        $update = Page::where('id', $id)
            ->update([
            'title'     => request('title'),
            'body'    => request('body'),
            //'slug' => Str::slug(request('title').Str::random(12), '-'),
            'status'    => request('status')
        ]);

        if($update == true)
        {
            return redirect('/admin/pages')
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Settings
     */
    public function settings()
    {
        
        return view('admin.settings.index')->with([
            'title' => 'Settings :: '.Settings::first()->website_name,
            'desc' => 'Settings',
            'settings' => Settings::first(),
            'advertisements' => Advertisements::where('status', 1)->get(),
        ]);
        
    }
    
    public function update_settings(Request $request)
    {
        $request->validate([
            'website_name' => 'required|string|max:255',
            'website_tagline' => 'required|string|max:255',
            'website_desc' => 'nullable|max:255',
            'dir' => 'required',
            'items_result' => 'required',
            'items_status' => 'required',
            'comments_status' => 'required',
            'photo_upload' => 'required',
            'max_chars_title' => 'required',
            'min_chars_story' => 'required',
            'max_chars_story' => 'required',
            'analytics' => 'nullable',
            'adv_1' => 'nullable',
            'adv_2' => 'nullable',
        ]);
        
        if(!empty(request('logo'))){
            
            $request->validate([
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
            if(!empty(Settings::first()->logo))
            {
                $delete = File::delete('dist/img/logo/'.Settings::first()->logo);
            }
            
            $image                   =       $request->file('logo');
            $input['imagename']      =       time().'.'.$image->extension();
            $destinationPath         =       'dist/img/logo';
            $img                     =       Image::make($image->path());
        
            // --------- [ Resize Image ] ---------------

            $img->resize(function($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
            
            $upload_logo = Settings::first()
                ->update([
                    'logo' => $input['imagename'],
                ]);
            
            if($upload_logo == true)
            {
                return back()
                    ->with('success', __('admin.success_message'));
            } else 
            {
                return back()
                    ->with('danger', __('admin.error_message'));
            }
            
        }

        $update = Settings::first()
            ->update([
                'website_name' => request('website_name'),
                'website_tagline' => request('website_tagline'),
                'website_desc' => request('website_desc'),
                'dir' => request('dir'),
                'items_result' => request('items_result'),
                'items_status' => request('items_status'),
                'comments_status' => request('comments_status'),
                'photo_upload' => request('photo_upload'),
                'max_chars_title' => request('max_chars_title'),
                'min_chars_story' => request('min_chars_story'),
                'max_chars_story' => request('max_chars_story'),
                'analytics' => request('analytics'),
                'adv_1' => request('adv_1'),
                'adv_2' => request('adv_2'),
        ]);
        
        if($update == true)
        {
            return redirect('/admin/settings')
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    public function delete_logo()
    {
        
        if(!empty(Settings::first()->logo))
        {
            // delete file 
            File::delete('dist/img/logo/'.Settings::first()->logo);
            
            $delete_logo = Settings::first()
                ->update([
                    'logo' => NULL,
                ]);
            
            if($delete_logo == true)
            {
                return back()
                    ->with('success', __('admin.success_message'));
            } else 
            {
                return back()
                    ->with('danger', __('admin.error_message'));
            }
        } 
        else 
        {
            return back()
                ->with('danger', __('admin.there_is_no_logo'));
        }
        
    }
    
    /**
     * Categories
     */
    public function categories()
    {
        $categories = Categories::latest()
            ->orderByDesc('id')
            ->paginate(25);
        
        return view('admin.categories.index')->with([
            'title' => 'Categories :: '.Settings::first()->website_name,
            'desc' => 'Dashboard',
            'categories' => $categories,
        ]);
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function delete_category($id)
    {

        $delete = DB::table('categories')->where('id', $id)->delete();
        
        if($delete == true){
            return back()
                ->with('success', __('admin.success_message'));
        }
        else 
        {
            return back()->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Add New category
     *
     */
    public function add_category()
    {

        return view('admin.categories.add_category')
            ->with([
                'title' => 'Add Category :: '.Settings::first()->website_name,
                'desc' => 'Dashboard',
            ]);
    }
    
    public function store_category(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:categories,name',
            'description' => 'required',
        ]);
        
        $categories = Categories::create([
            'name'     => request('name'),
            'description' => request('description'),
            'slug' => Str::slug(request('name')),
        ]);

        if($categories == true)
        {
            return back()
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Edit category
     * @id
     */
    public function edit_category($id)
    {
        
        return view('admin.categories.edit_category')
            ->with([
                'title' => 'Edit Category :: '.Settings::first()->website_name,
                'desc' => 'Edit category...',
                'item' => Categories::findOrFail($id)
            ]);
        
    }
    
    public function store_edit_category(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|min:3|unique:categories,name,'.$id,
            'description' => 'required',
        ]);

        $update = Categories::where('id', $id)
            ->update([
                'name'     => request('name'),
                'description'     => request('description'),
                'slug' => Str::slug(request('name')),
        ]);

        if($update == true)
        {
            return back()
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Genders
     */
    public function genders()
    {
        $genders = Genders::latest()
            ->orderByDesc('id')
            ->paginate(25);
        
        return view('admin.genders.index')->with([
            'title' => 'Genders :: '.Settings::first()->website_name,
            'desc' => 'Dashboard',
            'genders' => $genders,
        ]);
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function delete_gender($id)
    {

        $delete = DB::table('genders')->where('id', $id)->delete();
        
        if($delete == true){
            return back()
                ->with('success', __('admin.success_message'));
        }
        else 
        {
            return back()->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Add New gender
     *
     */
    public function add_gender()
    {

        return view('admin.genders.add_gender')
            ->with([
                'title' => 'Add Gender :: '.Settings::first()->website_name,
                'desc' => 'Dashboard',
            ]);
    }
    
    public function store_gender(Request $request)
    {
        $request->validate([
            'gender_title' => 'required|min:3|unique:genders,gender_title',
            'gender_color' => 'required',
        ]);
        
        $genders = Genders::create([
            'gender_title'     => request('gender_title'),
            'gender_color' => request('gender_color'),
            'gender_slug' => Str::slug(request('gender_title')),
        ]);

        if($genders == true)
        {
            return back()
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Edit gender
     * @id
     */
    public function edit_gender($id)
    {
        
        return view('admin.genders.edit_gender')
            ->with([
                'title' => 'Edit Gender :: '.Settings::first()->website_name,
                'desc' => 'Edit gender...',
                'item' => Genders::findOrFail($id)
            ]);
        
    }
    
    public function store_edit_gender(Request $request, $id)
    {

        $request->validate([
            'gender_title' => 'required|min:3|unique:genders,gender_title,'.$id,
            'gender_color' => 'required',
        ]);

        $update = Genders::where('id', $id)
            ->update([
                'gender_title'     => request('gender_title'),
                'gender_color'     => request('gender_color'),
                'gender_slug' => Str::slug(request('gender_title')),
        ]);

        if($update == true)
        {
            return back()
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Advertisements
     */
    public function advertisements()
    {
        $advertisements = Advertisements::latest()
            ->orderByDesc('id')
            ->paginate(25);
        
        return view('admin.advertisements.index')->with([
            'title' => 'Advertisements :: '.Settings::first()->website_name,
            'desc' => 'Dashboard',
            'advertisements' => $advertisements,
        ]);
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function delete_adv($id)
    {

        $delete = DB::table('advertisements')->where('id', $id)->delete();
        
        if($delete == true){
            return back()
                ->with('success', __('admin.success_message'));
        }
        else 
        {
            return back()->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Add New advertisement
     *
     */
    public function add_adv()
    {

        return view('admin.advertisements.add_adv')
            ->with([
                'title' => 'Add ADV :: '.Settings::first()->website_name,
                'desc' => 'Dashboard',
            ]);
    }
    
    public function store_adv(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|unique:advertisements,title',
            'adv' => 'required',
        ]);
        
        $advertisements = Advertisements::create([
            'title'     => request('title'),
            'adv' => request('adv'),
            'status' => request('status'),
        ]);

        if($advertisements == true)
        {
            return back()
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Edit advertisement
     * @id
     */
    public function edit_adv($id)
    {
        
        return view('admin.advertisements.edit_adv')
            ->with([
                'title' => 'Edit Advertisements :: '.Settings::first()->website_name,
                'desc' => 'Edit advertisements...',
                'item' => Advertisements::findOrFail($id)
            ]);
        
    }
    
    public function store_edit_adv(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|min:3|unique:advertisements,title,'.$id,
            'adv' => 'required',
        ]);

        $update = Advertisements::where('id', $id)
            ->update([
                'title'     => request('title'),
                'adv'     => request('adv'),
                'status' => request('status'),
        ]);

        if($update == true)
        {
            return back()
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    //***
    // Items
    //***
    public function items()
    {
        return view('admin.items.index')->with([
            'title' => 'Items :: '.Settings::first()->website_name,
            'desc' => 'Items...',
            'items' => Items::latest()->orderByDesc('id')->paginate(25)
        ]);
    }
    
    /**
     * Edit obituary
     * @id
     */
    public function edit_item($id)
    {
        $item = Items::findOrFail($id);
        return view('admin.items.edit_item')
            ->with([
                'title' => 'Edit Item :: '.Settings::first()->website_name,
                'desc' => 'Edit item',
                'item' => $item,
                'categories' => Categories::all(),
                'genders' => Genders::all()
            ]);
    }
    
    public function store_edit_item(Request $request, $id)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'story' => ['required'],
            'categories' => ['required'],
            'gender' => ['required'],
            'status' => ['required'],
        ]);

        $update = Items::where('id', $id)
            ->update([
            'title'     => request('title'),
            'story'    => request('story'),
            'gender' => request('gender'),
            'categories' => request('categories'),
            'slug' => Str::of(request('title').' '.Str::random(8))->slug('-'),
            'status' => request('status'),
        ]);
            
        if($update == true)
        {
            return back()
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function delete_item($id)
    {

        $delete = DB::table('items')->where('id', $id)->delete();
        if($delete == true){
            
            // delete uploaded image 
            if(is_file('dist/img/item/'.$item->image)){
                $delete_image = File::delete('dist/img/item/'.$item->image);
            }
            
            return back()
                ->with('success', __('admin.success_message'));
        }
        else 
        {
            return back()->with('danger', __('admin.error_message'));
        }
        
    }
    
    //***
    // Comments
    //***
    public function comments()
    {
        return view('admin.comments.index')->with([
            'title' => 'Comments :: '.Settings::first()->website_name,
            'desc' => 'Comments list...',
            'comments' => Comments::latest()->orderByDesc('id')->paginate(25)
        ]);
    }
    
    /**
     * Edit obituary
     * @id
     */
    public function edit_comment($id)
    {
        $comment = Comments::findOrFail($id);
        return view('admin.comments.edit_comment')
            ->with([
                'title' => 'Edit Comments :: '.Settings::first()->website_name,
                'desc' => 'Edit comment',
                'item' => $comment
            ]);
    }
    
    public function store_edit_comment(Request $request, $id)
    {
        
        $request->validate([
            'comment' => ['required', 'string', 'max:255'],
        ]);

        $update = Comments::where('id', $id)
            ->update([
            'comment'     => request('comment'),
            'status' => request('status'),
        ]);
            
        if($update == true)
        {
            return back()
                ->with('success', __('admin.success_message'));
        } else 
        {
            return back()
                ->with('danger', __('admin.error_message'));
        }
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function delete_comment($id)
    {
        $delete = DB::table('comments')->where('id', $id)->delete();
        if($delete == true){
            return back()
                ->with('success', __('admin.success_message'));
        }
        else 
        {
            return back()->with('danger', __('admin.error_message'));
        }
        
    }
    
}