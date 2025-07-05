<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Countries;
use App\Models\States;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function createUpdate(Request $request, $slug)
    {
        $user = User::find($slug);
        if ($user != '') {
            // update
            $data['user'] =  $user;
        } else {
            // add
            $data['user'] = '';
        }
        // $data['countries'] = Countries::all();
        // $data['states'] = States::all();
        // $data['cities'] = City::all();
        return view('admin.users.store', $data);
    }

public function store(Request $request)
{

    
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email,' . $request->id,
        'mobile_number' => 'required|digits:10|numeric',
    ], [
        'email.unique'          => 'This email already exists.',
        'mobile_number.digits'  => 'Phone number must be exactly 10 digits.',
        'mobile_number.numeric' => 'Phone number must contain only digits.',
    ]);

    if ($request->id) {
        // ✅ Update existing user
        $user = User::findOrFail($request->id);
        $user->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile_number' => $request->mobile_number,
        ]);

        $message = 'User updated successfully';
    } else {
        // ✅ Create new user
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile_number' => $request->mobile_number,
            'password'      => bcrypt('password') // Default password
        ]);

        $message = 'User created successfully';
    }

    return redirect()->route('users.index')->with('success', $message);
}

    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('admin.users.create', compact('user', 'countries', 'states', 'cities'));
    // }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
        
    }
}
