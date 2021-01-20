<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function addCoach($request)
    {
        $role="coach";

        $request->validate([

            'full_name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required|string|min:6|max:10',
            'phone' => 'required|double',
            'birthday' => 'required|date',
            'ING' => 'required|string',
            'about' => 'required|string',
            'role' => 'required|string'

        ]);
        
        $this->user->full_name = $request->get("full_name");
        $this->user->email = $request->get("email");
        $this->user->password = bcrypt($request->get("password"));
        $this->user->phone = $request->get("phone");
        $this->user->birthday = $request->get("birthday");
        $this->user->ING = $request->get("ING");
        $this->user->about = $request->get("about");
        $this->user->role = $request->$role;
        $this->user->save();
       

        return response()->json([
            'success'   =>  true
        ], 200);
    }

    public function getCoachs(){
        $coachs = $this->user->where('role','coach')->get();

        return response()->json([
            'success'   =>  true,
            'data'      =>  $coachs
        ], 200);
    }

    public function addUserReview($request){

        $request->validate([
            'user_id_one' => 'required|integer',
            'user_id_two' => 'required|integer',
            'content' => 'required|string',
            'rate' => 'required|integer'
            ]);

        DB::table('users_reviews')->insert([
            'user_id_one' => $request->get("user_id_one"),
            'user_id_two' => $request->get("user_id_two"),
            'content' => $request->get("content"),
            'rate' => $request->get("rate")
            ]);
        
    }

    public function getUserReview($id){

        $rate = 0;
        $this->user= User::findOrFail($id);

        foreach ($this->user->reviews() as $review){
            $rate = $review->pivot->rate;
        }
        
        return response()->json([
            'success'   =>  true,
            'data'      =>  $rate
        ], 200);

    }


}