<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Rules\ValidatePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{
    public function __invoke(Request $request, Client $client)
    {
        Session::flash('openModal', true);
        $validated = $this->validate($request, [
            'current_password' => ['required', 'min:6', new ValidatePassword($client)],
            'new_password' => 'required|min:6',
            'confirmation_password' => 'required_with:new_password|same:new_password|min:6'
        ]);

        $client->update([
            'password' => bcrypt($validated['new_password']),
        ]);

        Session::flash('success', 'Success Change Password');

        Session::forget('openModal');

        return redirect()->back();
    }
}
