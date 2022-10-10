<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\profile;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {

        if (Auth::id()) {
            return view('user.index');
        } else {

            return view('index');
        }
    }

    public function user_profile()
    {
        $user_id = Auth::user()->id;
        $profile = profile::where('user_id', '=', $user_id)->first();

        if ($profile != null) {

            return view('user.profile', compact('profile'));
        } else {

            return view('user.profile_base');
        }
    }

    public function edit_profile(Request $request)
    {
        $profile = new Profile();
        $user_id = Auth::user()->id;

        $profile->user_id = $user_id;

        $image = $request->image;

        if ($image) {

            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('picture', $imagename);
            $profile->image = $imagename;
        }

        $profile->username = $request->username;
        $profile->goal = $request->goal;
        $profile->skill = $request->skill;
        $profile->date = $request->date;

        $profile->save();

        return redirect('/user_profile');
    }

    public function update_profile(Request $request, $id)
    {
        $profile = profile::find($id);
        $user_id = Auth::user()->id;

        $profile->user_id = $user_id;

        $image = $request->image;

        if ($image) {

            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('picture', $imagename);
            $profile->image = $imagename;
        }

        $profile->username = $request->username;
        $profile->goal = $request->goal;
        $profile->skill = $request->skill;
        $profile->date = $request->date;

        $profile->save();

        return redirect('/user_profile');
    }

    public function post_message(Request $request)
    {
        $post = new Post();
        $post->message = $request->message;
        $post->postBy = Auth::user()->id;
        $post->postByName = Auth::user()->name;
        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('post',$imagename);
        $post->image = $imagename;

        $post->save();

        return redirect('/redirect');
    }
}
