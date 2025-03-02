<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user_acc = User::findOrFail($user);
        return view('profiles.index', [
            "user" => $user_acc
        ]);
    }

    public function edit(User $user) {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user) {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => '',
            'image' => '',
        ]);

        $imagePath = null;

        if(request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $manager = new ImageManager(new Driver());

            $image = $manager->read(public_path("storage/{$imagePath}"))->cover(1000, 1000);

            $image = $image->save();

            $data['image'] = $imagePath;
        }

        auth()->user()->profile->update($data);

        return redirect("/profile/{$user->id}");
    }
}
