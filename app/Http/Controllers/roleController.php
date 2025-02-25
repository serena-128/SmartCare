<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Flash;
use Response;

class RoleController extends Controller
{
    public function __construct()
    {
        // Removed authentication middleware since you don't want login
    }

    public function index()
    {
        $roles = Role::all(); // Fetch all roles, no users involved
        return view('dashboard.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);

        Role::create(['name' => $request->name]);

        return back()->with('success', 'Role created successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('success', 'Role deleted successfully!');
    }
}
