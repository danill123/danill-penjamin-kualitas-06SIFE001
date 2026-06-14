<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all users data
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Esa Faiz Nurdin
    //231011701143
    public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return new UserResource($user);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan'
        ], 500);
    }
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Fauzan Ibnu Shihab
    //231011701331
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

        return new UserResource($user);
    } catch (ModelNotFoundException $e) {

        return response()->json([
            'success' => false,
            'message' => 'User tidak ditemukan'
        ], 404);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan pada server',
            'error' => $e->getMessage()
        ], 500);
    }

    /**
     * Update the specified resource in storage.
     *  Angga Cakraswara - 231011700018
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * Rizki Putra
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    try {

        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ], 200);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus user',
            'error' => $e->getMessage()
        ], 500);
    }   
    }
