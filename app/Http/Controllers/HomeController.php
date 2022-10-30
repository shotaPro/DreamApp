<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\profile;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Follow;
use App\Models\User;
use App\Models\Timer;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        if (Auth::id()) {

            $post = post::all();
            $user_id = Auth::user()->id;
            $reply = reply::all();

            return view('user.index', compact('post', 'user_id', 'reply'));
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
        $request->image->move('post', $imagename);
        $post->image = $imagename;

        $post->save();

        return redirect('/redirect');
    }

    public function edit_show($id)
    {
        $post = post::find($id);
        return view('user.edit_show', compact('post'));
    }

    public function edit_message(Request $request, $id)
    {
        $post = post::find($id);
        $post->message = $request->message;

        $image = $request->image;

        if ($image) {

            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('post', $imagename);
            $post->image = $imagename;
        }

        $post->save();

        return redirect()->back();
    }

    public function delete_post($id)
    {
        $post = post::find($id);
        $post->delete();

        return redirect('/redirect');
    }

    public function reply_post(Request $request)
    {
        $reply = new Reply();
        $reply->name = Auth::user()->name;
        $reply->reply_id = $request->replyId;
        $reply->reply_message = $request->reply;
        $reply->user_id = Auth::user()->id;

        $reply->save();

        return redirect('/redirect');
    }

    public function search_post(Request $request)
    {
        $search_text = $request->search;
        $user_id = Auth::user()->id;
        $reply = reply::where('reply_message', 'LIKE', "$search_text")->get();
        $search_post = post::where('message', 'LIKE', "$search_text")->get();

        return view('user.search_post', compact('search_post', 'user_id', 'reply'));
    }

    public function my_post()
    {
        $user_id = Auth::user()->id;
        $post = post::where('postBy', '=', $user_id)->get();
        $reply = reply::all();

        return view('user.my_post', compact('post', 'user_id', 'reply'));
    }

    public function study_watch()
    {
        $user_id = Auth::user()->id;
        $user_study_record = timer::where('user_id', '=', $user_id)->count();

        if ($user_study_record == 0) {

            $study_total_time = 0;
        } else {

            $study_total_time = timer::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(study_time))) as study_total_time')->where('user_id', '=', $user_id)->first();
            $study_total_time = substr($study_total_time, 21, -2);
        }

        return view('user.study_watch', compact('user_id', 'user_study_record', 'study_total_time'));
    }

    public function record_timer(Request $request)
    {

        $record_timer = new Timer();

        if ($request->study_time == null || $request->study_time == "00:00.000") {

            return redirect()->back()->with('message', '時間を計測してください');
        }

        $record_timer->user_id = Auth::user()->id;

        $record_timer->study_time = $request->study_time;

        $record_timer->save();

        return redirect()->back();
    }

    public function profiles($id)
    {

        $profile = profile::where('user_id', '=', $id)->get();
        $post = post::where('postBy', '=', $id)->get();
        $user_id = Auth::user()->id;
        $reply = reply::all();

        return view('user.profiles', compact('profile', 'post', 'user_id', 'reply'));
    }

    public function study_rank()
    {
        $user_id = Auth::user()->id;
        $ranking_info = timer::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(study_time))) as study_total_time')->
        join('users', 'timers.user_id', '=', 'users.id')->select('users.name', DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(study_time))) as study_total_time'))->where('user_id', '=', $user_id)->groupBy('users.id')->get();

        // return view('users.study_ranking', compact('ranking_info'));
    }
}
