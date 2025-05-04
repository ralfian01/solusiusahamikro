<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Privilege;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function read()
    {
        $rows = DB::table('role')
        ->orderBy('id')
        ->get();

        $page = '';

        return view('admin.role', compact('rows','page'));
    }

    public function register()
    {
        $role = DB::table('role')
        ->where('nama', 'NOT LIKE', '%admin%')
        ->orderBy('id')
        ->get();

        return view('register', compact('role'));
    }

    public function registerPelapor()
    {
        $role = DB::table('role')
        ->where('nama', 'NOT LIKE', '%admin%')
        ->orderBy('id')
        ->get();

        return view('register-pelapor', compact('role'));
    }

    public function registerTeknisi()
    {
        $role = DB::table('role')
        ->where('nama', 'NOT LIKE', '%admin%')
        ->orderBy('id')
        ->get();

        return view('register-teknisi', compact('role'));
    }

    public function registerPengawas()
    {
        $role = DB::table('role')
        ->where('nama', 'NOT LIKE', '%admin%')
        ->orderBy('id')
        ->get();

        return view('register-pengawas', compact('role'));
    }

    public function form($id)
    {
        $rows = DB::table('role')
        ->where('id', $id)
        ->first();

        $menu = DB::table('menu')
        ->orderBy('id')
        ->get();

        $rowds = array();
        foreach ($menu as $row) {
            $rowd = DB::table('privilege')
            ->where('menu', $row->id)
            ->where('role', $id)
            ->first();

            if ($rowd != NULL) {
                array_push($rowds, [$rowd->c,$rowd->r,$rowd->u,$rowd->o]);
            } else {
                array_push($rowds, [false,false,false,false]);
            }
        }

        $page = 'Ubah ';

        return view('admin.role', compact('rows', 'menu', 'rowds','page'));
    }

    public function update(Request $request)
    {
        $role = $request->id;
        $nama = $request->nama;

        $row = DB::table('role')
        ->where('id', '!=', $role)
        ->where('nama', $nama)
        ->get();

        if ($row->count() > 0) {
            return back()->withInput()->withErrors(['error' => $nama]);
        } else {
            $rows = DB::table('menu')
            ->orderBy('id')
            ->get();

            $no = 0;
            foreach ($rows as $row) {
                $no++;
                $menu = $row->id;
                $c = $row->c == NULL ? NULL : ($request->input('check' . $no . '1') == NULL ? 0 : 1);
                $r = $row->r == NULL ? NULL : ($request->input('check' . $no . '2') == NULL ? 0 : 1);
                $u = $row->u == NULL ? NULL : ($request->input('check' . $no . '3') == NULL ? 0 : 1);
                $o = $row->o == NULL ? NULL : ($request->input('check' . $no . '4') == NULL ? 0 : 1);

                $rowd = DB::table('privilege')
                ->where('menu', $menu)
                ->where('role', $role)
                ->first();

                if ($rowd != NULL) {
                    DB::table('role')
                    ->where('id', $role)
                    ->update(['nama' => $nama]);
                    DB::table('privilege')
                    ->where('menu', $menu)
                    ->where('role', $role)
                    ->update(['c' => $c, 'r' => $r, 'u' => $u, 'o' => $o]);
                } else {
                    Privilege::create([
                        'menu'  => $menu,
                        'c'     => $c,
                        'r'     => $r,
                        'u'     => $u,
                        'o'     => $o,
                        'role'  => $role
                    ]);
                }
            }

            return redirect('role');
        }
    }
}
