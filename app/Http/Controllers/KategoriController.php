<?php

namespace App\Http\Controllers;

use App\Models\Kat_Layanan;
use App\Models\Jenis_Layanan;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function read()
    {
        $rows = DB::table('jenis_layanan AS t2')
        ->leftJoin('kat_layanan AS t1', 't2.kat_layanan', '=', 't1.id')
        ->select(
            't1.id AS id',
            't1.nama AS kategori',
            't2.nama AS jenis'
        )
        ->orderBy('t1.updated_at', 'desc')
        ->orderBy('t1.id', 'asc')
        ->orderBy('t2.id', 'asc')
        ->get();

        return view('admin.kategori', compact('rows'));
    }

    public function create(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $jenis = $request->jenis;

        if ($id > 0) {
            return $this->update($request);
        }

        $row = DB::table('kat_layanan')
        ->where('nama', $nama)
        ->get();

        if ($row->count() > 0) {
            return back()->withInput()->withErrors(['error' => $nama]);
        } else {
            $kategori = Kat_Layanan::create([
                'nama'      => $nama
            ]);
            $kat_layanan = $kategori->id;

            for ($x=0; $x<=substr_count($jenis, ','); $x++) {
                $rowd = DB::table('jenis_layanan')
                ->where('nama', trim(explode(',', $jenis)[$x]))
                ->where('kat_layanan', $kat_layanan)
                ->get();

                if ($rowd->count() < 1) {
                    Jenis_Layanan::create([
                        'nama'          => trim(explode(',', $jenis)[$x]),
                        'kat_layanan'   => $kat_layanan
                    ]);
                }
            }

            return back();
        }
    }

    private function update(Request $request)
    {
        $kat_layanan = $request->id;
        $nama = $request->nama;
        $jenis = $request->jenis;

        $row = DB::table('kat_layanan')
        ->where('id', '!=', $kat_layanan)
        ->where('nama', '=', $nama)
        ->get();

        if ($row->count() > 0) {
            return back()->withInput()->withErrors(['error' => $nama]);
        } else {
            DB::table('kat_layanan')
            ->where('id', $kat_layanan)
            ->update(['nama' => $nama]);
    
            $old = array();
            $rowds = DB::table('jenis_layanan')
            ->where('kat_layanan', $kat_layanan)
            ->orderBy('id', 'asc')
            ->get();

            foreach ($rowds as $rowd) {
                array_push($old, $rowd->nama);
            }
    
            $new = array();
            for ($x=0; $x<=substr_count($jenis, ','); $x++) {
                array_push($new, trim(explode(',', $jenis)[$x]));
            }

            foreach ($old as $row) {
                if (strlen(array_search($row, $new)) < 1) {
                    DB::table('jenis_layanan')
                    ->where('nama', $row)
                    ->where('kat_layanan', $kat_layanan)
                    ->delete();
                }
            }

            foreach ($new as $row) {
                $rowd = DB::table('jenis_layanan')
                ->where('nama', $row)
                ->where('kat_layanan', $kat_layanan)
                ->get();

                if ($rowd->count() < 1) {
                    Jenis_Layanan::create([
                        'nama'          => $row,
                        'kat_layanan'   => $kat_layanan
                    ]);
                }
            }

            return back();
        }
    }

    public function delete(Request $request)
    {
        DB::table('jenis_layanan')
        ->where('kat_layanan', $request->id)
        ->delete();

        DB::table('kat_layanan')
        ->where('id', $request->id)
        ->delete();

        return back();
    }
}
