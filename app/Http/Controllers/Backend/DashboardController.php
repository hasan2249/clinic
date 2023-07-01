<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Session;
use App\Models\Cost;
use Illuminate\Http\Request;
use App\Models\Auth\User;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // if (!auth()->user()->can('view-frontend')) {
        //     return redirect(route('frontend.user.dashboard'))->withFlashDanger('You are not authorized to view admin dashboard.');
        // }
        if (!auth()->user()->isAdmin() && auth()->user()->isExecutive()) {
            return redirect(route('admin.Patients.index'));
        }
        $income = Session::sum('price');
        $costs = Cost::sum('value');
        return view('backend.dashboard', ["income" => $income, "costs" => $costs]);
    }

    /**
     * This function is used to get permissions details by role.
     *
     * @param \Illuminate\Http\Request\Request $request
     */
    public function getPermissionByRole(Request $request)
    {
        if ($request->ajax()) {
            $role_id = $request->get('role_id');
            $rsRolePermissions = Role::where('id', $role_id)->first();
            $rolePermissions = $rsRolePermissions->permissions->pluck('display_name', 'id')->all();
            $permissions = Permission::pluck('display_name', 'id')->all();
            ksort($rolePermissions);
            ksort($permissions);
            $results['permissions'] = $permissions;
            $results['rolePermissions'] = $rolePermissions;
            $results['allPermissions'] = $rsRolePermissions->all;
            echo json_encode($results);
            exit;
        }
    }

    public function getdataDateRange(Request $req)
    {
        $from = $req->from;
        $to = $req->to;

        $income = Session::whereBetween('created_at', [$from, $to])->sum('price');
        $costs = Cost::whereBetween('created_at', [$from, $to])->sum('value');
        return ["income" => $income, "costs" => $costs];
    }
}
