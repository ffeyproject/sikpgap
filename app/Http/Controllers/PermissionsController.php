<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource with automatic route synchronization.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Otomatis sinkronisasi setiap rute baru yang terdaftar di Laravel
        $newCount = $this->syncRoutesInternal();

        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('permissions.index', [
            'permissions' => $permissions,
            'newCount' => $newCount,
        ]);
    }

    /**
     * Manual Trigger Sync Route.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sync()
    {
        $newCount = $this->syncRoutesInternal();

        if ($newCount > 0) {
            return redirect()->route('permissions.index')
                ->with('success', "Sinkronisasi berhasil! Sebanyak {$newCount} rute baru berhasil ditambahkan ke permissions dan otomatis diberikan ke role Admin.");
        }

        return redirect()->route('permissions.index')
            ->with('info', 'Seluruh rute sistem sudah tersinkronisasi. Tidak ditemukan rute baru.');
    }

    /**
     * Sinkronisasi rute Laravel ke tabel permissions Spatie.
     *
     * @return int Jumlah permission baru yang ditambahkan
     */
    protected function syncRoutesInternal(): int
    {
        $routes = Route::getRoutes();
        $existing = Permission::pluck('name')->flip()->toArray();
        $adminRoles = Role::whereIn('name', ['admin', 'Admin'])->get();
        $newPermissions = [];

        foreach ($routes as $route) {
            $name = $route->getName();

            // Abaikan rute tanpa nama atau rute internal framework
            if (!$name || str_starts_with($name, 'sanctum.') || str_starts_with($name, 'ignition.') || str_starts_with($name, '_ignition.')) {
                continue;
            }

            if (!isset($existing[$name])) {
                $permission = Permission::firstOrCreate([
                    'name' => $name,
                    'guard_name' => 'web',
                ]);

                // Otomatis berikan hak akses permission baru ini ke role Admin
                foreach ($adminRoles as $role) {
                    $role->givePermissionTo($permission);
                }

                $newPermissions[] = $name;
                $existing[$name] = true;
            }
        }

        if (count($newPermissions) > 0) {
            // Hapus cache Spatie agar permission baru langsung aktif
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            session()->flash('sync_info', [
                'count' => count($newPermissions),
                'routes' => $newPermissions,
            ]);
        }

        return count($newPermissions);
    }

    /**
     * Show form for creating permissions
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        // Berikan juga ke role Admin
        $adminRoles = Role::whereIn('name', ['admin', 'Admin'])->get();
        foreach ($adminRoles as $role) {
            $role->givePermissionTo($permission);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission created successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id
        ]);

        $permission->update($request->only('name'));

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission deleted successfully.'));
    }
}
