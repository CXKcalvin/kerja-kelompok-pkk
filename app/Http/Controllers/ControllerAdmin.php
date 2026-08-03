<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ControllerAdmin extends Controller
{
    public function admin()
    {
        $users = User::where('role', 'client')->get();
        return view('admin', compact('users'));
    }

    public function updateStatus(Request $request, $id)
    {
        $client = User::findOrFail($id);

        $client->status_id = $request->status_id;
        $client->save();

        return back();
    }
}
