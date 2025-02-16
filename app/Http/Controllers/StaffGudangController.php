<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffGudangController extends Controller
{
    public function index()
    {
        return view('staff.layout');
    }

    public function data()
    {
        $staffName = auth()->user()->name;
        $staffRole = auth()->user()->role;

        return view('staff.layout', [
            'name' => $staffName,
            'role' => $staffRole
        ]);
    }
    public function dashboard()
    {
        $staffName = auth()->user()->name;
        $staffRole = auth()->user()->role;
        return view('staff.menu.dashboard', [
            'name' => $staffName,
            'role' => $staffRole
        ]);
    }
    public function stock()
    {
        $staffName = auth()->user()->name;
        $staffRole = auth()->user()->role;
        return view('staff.menu.stock', [
            'name' => $staffName,
            'role' => $staffRole
        ]);
    }
    public function opname()
    {
        $staffName = auth()->user()->name;
        $staffRole = auth()->user()->role;
        return view('staff.menu.opname', [
            'name' => $staffName,
            'role' => $staffRole
        ]);
    }
    public function setting()
    {
        $staffName = auth()->user()->name;
        $staffRole = auth()->user()->role;
        return view('staff.menu.setting', [
            'name' => $staffName,
            'role' => $staffRole
        ]);
    }
}
