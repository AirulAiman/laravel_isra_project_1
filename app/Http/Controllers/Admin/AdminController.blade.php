<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function manageUsers($org_id)
    {
        $organization = Organization::findOrFail($org_id);
        $users = User::all();
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
