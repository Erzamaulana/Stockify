<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use Symfony\Component\Console\Logger\ConsoleLogger;
use App\Models\Product;
use App\Models\User;
use App\Models\Stock_Transaction;
use App\Models\Supplier;

class ManajerGudangController extends Controller
{
    public function index()
    {
        return view('manajer.layout');
    }

    public function data()
    {
        $manajerName = auth()->user()->name;
        $manajeremail = auth()->user()->email;

        return view('manajer.layout', [
            'name' => $manajerName,
            'email' => $manajeremail
        ]);
    }
    public function dashboard()
    {
        $manajerName = auth()->user()->name;
        $manajeremail = auth()->user()->email;
        return view('manajer.dashboard', [
            'name' => $manajerName,
            'email' => $manajeremail
        ]);
    }
    public function product()
    {
        $manajerName = auth()->user()->name;
        $manajeremail = auth()->user()->email;
        return view('manajer.product', [
            'name' => $manajerName,
            'email' => $manajeremail
        ]);
    }
    public function stock()
    {
        $manajerName = auth()->user()->name;
        $manajeremail = auth()->user()->email;
        return view('manajer.stock', [
            'name' => $manajerName,
            'email' => $manajeremail
        ]);
    }
    public function supplier()
    {
        $manajerName = auth()->user()->name;
        $manajeremail = auth()->user()->email;
        return view('manajer.supplier', [
            'name' => $manajerName,
            'email' => $manajeremail
        ]);
    }
    public function report()
    {
        $manajerName = auth()->user()->name;
        $manajeremail = auth()->user()->email;
        return view('manajer.report', [
            'name' => $manajerName,
            'email' => $manajeremail
        ]);
    }
    public function setting()
    {
        $manajerName = auth()->user()->name;
        $manajeremail = auth()->user()->email;
        return view('manajer.setting', [
            'name' => $manajerName,
            'email' => $manajeremail
        ]);
    }
}
