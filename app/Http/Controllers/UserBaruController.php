<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserBaruController extends Controller
{
        public function index()
        {
        $data = User::all();
        return view('user.index', compact('data'));
        }

        public function tambahuser() 
        {
            // return view('tambahdatauser);
            // dd($request->all());
            User::create($request->all());
            return redirect()->route('tambah_datauser')->with('berhasil','Data Berhasil Ditambahkan');
        }
        public function insertdata_user(Request $request)
        {
            //dd($request->all());
           User::create($request->all());
            return redirect()->route('users')->with('berhasil','Data Berhasil Ditambahkan');
        }
        public function tampilkandata_user($id)
        {
            $data = User::find($id);
            return view('tampildata', compact('data'));
        }
    public function updatedata_user(Request $request, $id)
        {
            $data = User::find($id);
            $data->update($request->all());
            return redirect()->route('users')->with('berhasil','Data Berhasil Diupdate');
        }
   
        public function deletedata_user($id)
        {
            $data = User::find($id);
            $data->delete();
            return redirect()->route('users')->with('berhasil','Data Berhasil Dihapus');
        }
        public function edit(Request $request, $id)
        {
            $data = User::find($id);
            $data->edit($request->all());
            return redirect()->route('updatedata')->with('berhasil','Data Berhasil Diupdate');
        }
        public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('show')->with('error', 'user tidak ditemukan');
        }

        return view('user.detail_datauser', compact('users'));
    }

}
