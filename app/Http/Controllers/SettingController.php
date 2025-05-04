<?php

namespace App\Http\Controllers;

use App\Models\NoTelepon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        $getNoTelp = NoTelepon::where('owner_id', auth()->id())->first();

        return view('setting.no-telp-index', compact('getNoTelp'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nomor' => [
                'required',
                'string',
                'regex:/^(\+62|62|0)8[1-9][0-9]{6,9}$/', // Format nomor Indonesia
                'max:15'
            ],
            'notifikasi' => [
                'boolean'
            ],
        ]);
        $validatedData['notifikasi'] = $request->has('notifikasi') ? $request->input('notifikasi') : 0;
        $validatedData['owner_id'] = auth()->id();
        $validatedData['owner_type'] = auth()->getDefaultDriver();

        try {
            $result = NoTelepon::updateOrCreate(
                ['owner_id' => auth()->id()],
                $validatedData
            );

            return redirect()->route('setting-no-telp-index')
                ->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            Session::flash('');

            return redirect()->route('setting-no-telp-index')
                ->with('error', 'Gagal menyimpan data');
        }
    }
}
