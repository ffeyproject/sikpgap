<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }

    /**
     * Helper untuk mengelompokkan permission ke dalam modul bisnis utama yang intuitif.
     */
    protected function categorizePermissions($permissions)
    {
        $categories = [
            'Manajemen User & Hak Akses' => [
                'icon' => 'fas fa-users-cog',
                'color' => 'primary',
                'description' => 'Akses user, role, permission, autentikasi dan status akun',
                'items' => collect(),
            ],
            'Keluhan & Penanganan Masalah' => [
                'icon' => 'fas fa-exclamation-circle',
                'color' => 'danger',
                'description' => 'Alur komplain eksternal, internal, proses solusi, dan verifikasi',
                'items' => collect(),
            ],
            'Kepuasan Pelanggan & Penilaian' => [
                'icon' => 'fas fa-smile',
                'color' => 'success',
                'description' => 'Kuesioner kepuasan, item penilaian mutu, dan laporan rekap',
                'items' => collect(),
            ],
            'Master Data & Operasional' => [
                'icon' => 'fas fa-database',
                'color' => 'info',
                'description' => 'Master buyer, defect cacat, asal masalah/departemen, client, menu',
                'items' => collect(),
            ],
            'Chat & Komunikasi' => [
                'icon' => 'fas fa-comments',
                'color' => 'teal',
                'description' => 'Fitur chat obrolan, kontak pelanggan, pesan personal, dan attachments',
                'items' => collect(),
            ],
            'API & Mobile Service' => [
                'icon' => 'fas fa-mobile-alt',
                'color' => 'warning',
                'description' => 'Endpoint API untuk integrasi sistem mobile atau layanan eksternal',
                'items' => collect(),
            ],
            'Dashboard & Rute Umum' => [
                'icon' => 'fas fa-th-large',
                'color' => 'secondary',
                'description' => 'Halaman awal, grafik dashboard, pencarian data umum, dan download',
                'items' => collect(),
            ],
        ];

        foreach ($permissions as $permission) {
            $name = $permission->name;
            $prefix = explode('.', $name)[0];

            if (str_starts_with($name, 'api.')) {
                $categories['API & Mobile Service']['items']->push($permission);
            } elseif (in_array($prefix, ['users', 'roles', 'permissions', 'register', 'password', 'user', 'logout'])) {
                $categories['Manajemen User & Hak Akses']['items']->push($permission);
            } elseif (in_array($prefix, ['keluhan', 'proses', 'icomplaint', 'close', 'verifikasi', 'upload', 'view'])) {
                $categories['Keluhan & Penanganan Masalah']['items']->push($permission);
            } elseif (in_array($prefix, ['kepuasan', 'kepuasan-penilaian', 'penilaian', 'item', 'laporan'])) {
                $categories['Kepuasan Pelanggan & Penilaian']['items']->push($permission);
            } elseif (in_array($prefix, ['buyer', 'defect', 'asal_masalah', 'client', 'menu', 'raw-data'])) {
                $categories['Master Data & Operasional']['items']->push($permission);
            } elseif (in_array($prefix, ['chat', 'personal', 'pesan', 'contact', 'contacts', 'conversation', 'messages', 'message', 'attachments', 'avatar', 'activeStatus', 'pusher', 'fetch', 'send'])) {
                $categories['Chat & Komunikasi']['items']->push($permission);
            } else {
                $categories['Dashboard & Rute Umum']['items']->push($permission);
            }
        }

        // Hapus kategori jika kosong
        return array_filter($categories, function ($cat) {
            return $cat['items']->isNotEmpty();
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::withCount(['permissions', 'users'])->orderBy('id', 'ASC')->get();
        $totalPermissions = Permission::count();
        $totalUsers = \App\Models\User::count();

        return view('roles.index', compact('roles', 'totalPermissions', 'totalUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::where('name', 'NOT LIKE', 'generated::%')
            ->orderBy('name', 'asc')
            ->get();

        $categories = $this->categorizePermissions($permissions);

        return view('roles.create', compact('permissions', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $rolePermissions = $role->permissions;

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        $permissions = Permission::where('name', 'NOT LIKE', 'generated::%')
            ->orderBy('name', 'asc')
            ->get();

        $categories = $this->categorizePermissions($permissions);

        return view('roles.edit', compact('role', 'rolePermissions', 'permissions', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required|array',
        ]);

        $role->update($request->only('name'));
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (strtolower($role->name) === 'admin') {
            return redirect()->route('roles.index')
                ->with('error', 'Role Admin adalah peran sistem utama dan tidak dapat dihapus.');
        }

        $role->delete();

        return redirect()->route('roles.index')
                        ->with('success','Role berhasil dihapus.');
    }
}
