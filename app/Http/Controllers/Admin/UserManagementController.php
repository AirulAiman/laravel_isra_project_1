<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organization;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserManagementController extends Controller
{
    public function view()
    {
        return view('admin.user-management');
    }

    public function manageUsers($org_id)
{
    $organization = Organization::findOrFail($org_id);
    $users = User::all();  // Fetch all users to assign
    return view('admin.organization.manage_users', compact('organization', 'users'));
}

public function assignUser(Request $request, $org_id)
{
    $organization = Organization::findOrFail($org_id);
    $user = User::findOrFail($request->input('user_id'));
    $user->org_id = $org_id;
    $user->save();
    return redirect()->route('organizations.show', $org_id);
}


}
