<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        return view('home', compact('user'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:clients,email,' . $client['id']
        ]);

        $client->update($validated);

        Session::flash('success', 'Success Update Profile');

        return redirect()->back();
    }
}
