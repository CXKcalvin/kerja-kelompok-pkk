<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ControllerAdmin extends Controller
{
    public function admin()
    {
        $users = User::where('role', 'client')
            ->with('status')
            ->get();

        $statuses = \App\Models\Status::all();

        return view('admin', compact('users', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $client = User::findOrFail($id);

        $client->status_id = $request->status_id;
        $client->save();

        return back();
    }
}
