<?php

namespace App\Http\Controllers;


use App\Job;
use Illuminate\Http\Request;
use App\Profile;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['seeker','verified']);
    }

    public function users(Request $request)
    {
        $query = $request->get('query');
        $users = Job::where('title','like','%'.$query.'%')
                ->orWhere('position','like','%'.$query.'%')
                ->get();
        return response()->json($users);
    }

    public function index(){
    	return view('profile.index');
    }

    public function store(){
   		$user_id = auth()->user()->id;

      Profile::where('user_id',$user_id)->update([
        'address'=>request('address'),
   			'experience'=>request('experience'),
          'bio' => request('bio'),
          'phone_number' => request('phone_number')

   		]);
        return redirect()->back()->with('message', 'Your Profile has been Successfully Updated!');

   }

    public function coverletter(Request $request){
        $user_id = auth()->user()->id;
        $cover = $request->file('cover_letter')->store('public/files');
            Profile::where('user_id',$user_id)->update([
              'cover_letter'=>$cover
            ]);
        return redirect()->back()->with('message', 'Your Cover Letter has Successfully been Uploaded!');



   }
    public function resume(Request $request){
          $user_id = auth()->user()->id;
          $resume = $request->file('resume')->store('public/files');
            Profile::where('user_id',$user_id)->update([
              'resume'=>$resume
            ]);
        return redirect()->back()->with('message', 'Your Resume has been Successfully Uploaded!');



   }

    public function avatar(Request $request){
        $user_id = auth()->user()->id;
        if($request->hasfile('avatar')){
            $file = $request->file('avatar');
            $ext =  $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/avatar/',$filename);
            Profile::where('user_id',$user_id)->update([
              'avatar'=>$filename
            ]);
            return redirect()->back()->with('message', 'Your Profile Picture has been Successfully Uploaded!');
        }

   }


}
