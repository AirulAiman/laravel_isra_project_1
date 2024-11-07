<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $orgs = Organization::all();
        $search = htmlspecialchars($request->input('search'), ENT_QUOTES, 'UTF-8');

        if ((empty($search)) || ($search === null) || ($search === "")) {
            $users = [];
            return view('admin.user-management.index', compact('users', 'orgs'));
        } else {
            $users = User::query()
                ->when(
                    $search,
                    function ($query, $search) {
                        return $query->where('name', 'like', "%{$search}%")
                                     ->orWhere('email', 'like', "%{$search}%");
                    }
                )
                ->get();

            return view('admin.user-management.index', compact('users', 'orgs'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'nullable|email',
            'user_mgmt_org' => 'nullable|exists:organizations,org_id',
        ]);

        $data = [];

        if ($request->filled('email')) {
            $data['email'] = $request->input('email');
        }

        if ($request->filled('user_mgmt_org')) {
            $data['organization'] = $request->input('user_mgmt_org');
        }

        if (!empty($data)) {
            DB::table('users')
                ->where('user_id', $id)
                ->update($data);
        }

        return redirect()->back()->with('success', 'User updated successfully.');
    }
}
