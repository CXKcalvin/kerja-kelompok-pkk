<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ControllerAdmin extends Controller
{
    public function admin()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== 'admin') {
            return redirect()->route('page');
        }

        $users = User::where('role', 'client')
            ->with('status')
            ->get();

        $statuses = \App\Models\Status::all();

        return view('admin', compact('users', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $client = User::findOrFail($id);

        $client->status_id = $request->status_id;
        $client->save();

        return back();
    }
}
