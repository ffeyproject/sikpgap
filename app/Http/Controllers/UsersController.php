<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //     $posts = Post::all();
    //   return view('posts.index')->with(compact('posts'));

        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @param StoreUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        // $user->create(array_merge($request->validated(), [
        //     'password' => 'test'
        // ]));

         $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
                if($request->hasFile('g_ttd')){
                $filenameWithExt = $request->file('g_ttd')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('g_ttd')->getClientOriginalExtension();
                $filenameSimpan = $filename.'_'.date('Ymd').'_'.time().'.'.$extension;
                $path = $request->file('g_ttd')->move('image/ttd', $filenameSimpan);
                }else{
                $filenameSimpan = 'noImage.png';
                }
            $user->g_ttd = $filenameSimpan;
            $user->save();

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     *
     * @param User $user
     * @param UpdateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        // $user->update($request->validated());

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->posisi = $request->posisi;
        if (empty($request->file('g_ttd'))){
                $user->g_ttd = $user->g_ttd;
            }
        else{
                unlink('image/ttd/'.$user->g_ttd); //menghapus file lama
                $g_ttd = $request->file('g_ttd');
                $ext = $g_ttd->getClientOriginalExtension();
                $newName = rand(100000,1001238912).".".$ext;
                $g_ttd->move('image/ttd',$newName);
                $user->g_ttd = $newName;
            }
        $user->update();

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}