<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\WelcomeEmailCustomer;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Mail;

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

        $users = User::all();

        return view('users.index', compact('users'));
    }
    public function login()
    {

        return view('customer.login');
    }

     public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $callback = Socialite::driver('google')->stateless()->user();
        $data = [
            'name' => $callback->getName(),
            'username' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
        ];

        // $user = User::firstOrCreate(['email' => $data['email']], $data);
        $user = User::whereEmail($data['email'])->first();
        if (!$user) {
            $user = User::create(array_merge($data, ['status' => 1]));
            // Mail::to($user->email)->send(new AfterRegister($user));
            $user->notify(new WelcomeEmailCustomer($user));
        }

        if (!$user->status) {
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Google Anda terdaftar namun berstatus NONAKTIF. Silakan hubungi Administrator.',
            ]);
        }

        Auth::login($user, true);

        return redirect(route('customer.dashboard'));
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
            $user->password = $request->password;
            $user->status = $request->has('status') ? (int)$request->status : 1;

                if($request->hasFile('g_ttd')){
                $filenameWithExt = $request->file('g_ttd')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('g_ttd')->getClientOriginalExtension();
                $filenameSimpan = $filename.'.'.$extension;
                $path = $request->file('g_ttd')->move('image/ttd', $filenameSimpan);
                }else{
                $filenameSimpan = 'noImage.png';
                }
            $user->g_ttd = $filenameSimpan;
            $user->save();

        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'username' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'g_ttd' => ['required'],
        // ]);

        // User::create([
        //     'name' => $request['name'],
        //     'username' => $request['username'],
        //     'email' => $request['email'],
        //     'password' =>$request['password'],
        //     'g_ttd' =>  $filenameSimpan,
        // ]);

        $user->notify(new WelcomeEmailNotification($user));

        return redirect()->route('users.index')->withSuccess(__('User created successfully.'));
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
        try {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->posisi = $request->posisi;
            if ($request->has('status')) {
                $user->status = (int)$request->status;
            }

            if ($request->hasFile('g_ttd')) {
                $g_ttd = $request->file('g_ttd');
                if (!$g_ttd->isValid()) {
                    throw new \Exception('File gambar tanda tangan tidak valid: ' . $g_ttd->getErrorMessage());
                }

                $destinationPath = public_path('image/ttd');
                if (!file_exists($destinationPath)) {
                    @mkdir($destinationPath, 0775, true);
                }

                // Hapus file lama jika ada dan bukan file gambar default sistem
                $sharedDefaults = ['default.jpg', 'noImage.png', 'sign.png', 'signature.jpg', 'signature.PNG'];
                if (!empty($user->g_ttd) && !in_array($user->g_ttd, $sharedDefaults)) {
                    $oldFilePath = $destinationPath . '/' . $user->g_ttd;
                    if (file_exists($oldFilePath)) {
                        @unlink($oldFilePath);
                    }
                }

                $ext = strtolower($g_ttd->getClientOriginalExtension());
                if (empty($ext)) {
                    $ext = strtolower($g_ttd->extension() ?: 'png');
                }
                $newName = time() . '_' . rand(1000, 9999) . '.' . $ext;
                $g_ttd->move($destinationPath, $newName);

                if (!file_exists($destinationPath . '/' . $newName)) {
                    throw new \Exception('Gagal memindahkan file ke direktori ' . $destinationPath . '. Silakan periksa hak akses (permission) folder di server.');
                }

                $user->g_ttd = $newName;
            } elseif ($request->file('g_ttd')) {
                // Input file terdeteksi tetapi gagal diunggah (misal melebihi batas upload_max_filesize PHP)
                $uploaded = $request->file('g_ttd');
                throw new \Exception('Upload gambar gagal: ' . $uploaded->getErrorMessage() . ' (Periksa batasan upload_max_filesize / post_max_size pada php.ini server Anda)');
            }

            $user->save();

            // Sinkronisasi roles (jika kosong, pass array kosong)
            $roles = $request->get('role') ? array_values($request->get('role')) : [];
            $user->syncRoles($roles);

            return redirect()->route('users.index')
                ->with('success', 'Data pengguna ' . $user->name . ' berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui pengguna: ' . $e->getMessage());
        }
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

    /**
     * Toggle active status of user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menonaktifkan akun yang sedang Anda gunakan saat ini!');
        }

        $user->status = $user->status ? 0 : 1;
        $user->save();

        $statusText = $user->status ? 'diaktifkan (dapat login)' : 'dinonaktifkan (akses login diblokir)';
        return redirect()->back()->with('success', "Status akun pengguna {$user->name} berhasil {$statusText}.");
    }
}