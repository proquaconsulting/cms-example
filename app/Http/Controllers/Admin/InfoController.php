<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = InfoModel::all();

            return response()->json(compact('data'));
        }
        return view('admin.info.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'lokasi' => 'required',
                'notelp' => 'required',
                'website' => 'required',
            ]);

            InfoModel::create([
                'lokasi' => $request->lokasi,
                'notelp' => $request->notelp,
                'email' => $request->email,
                'website' => $request->website,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Success',
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Store Master Info - Terjadi kesalahan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Validasi Error.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Store Master Info - Terjadi kesalahan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = InfoModel::where('id', $id)->first();
        return view('admin.info.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'lokasi' => 'required',
                'notelp' => 'required',
                'website' => 'required',
            ]);

            $info = InfoModel::findOrFail($id);
            $info->update([
                'lokasi' => $request->lokasi,
                'notelp' => $request->notelp,
                'email' => $request->email,
                'website' => $request->website,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Success',
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Update Master Info - Terjadi kesalahan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Validasi Error.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Update Master Info - Terjadi kesalahan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $info = InfoModel::findOrFail($id);
            $info->delete();
            return response()->json([
                'success' => true,
                'message' => 'Success',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Delete Master Info - Terjadi kesalahan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ], 500);
        }    
    }
}
