<?php

namespace App\Repositories;

use App\Interfaces\PackageRepositoryInterface;
use App\Models\User;
use App\Models\Package;

class PackageRepository implements PackageRepositoryInterface
{
    private $user;
    private $package;

    public function __construct(User $user,Package $package)
    {
        $this->user = $user;
        $this->package = $package;
    }
    

    public function getUserPackage($idu)
    {
        $user= User::findOrFail($idu);
        $packages = $user->Package()->get();

        return response()->json([
            'success'   =>  true,
            'data'      =>  $packages
        ], 200);
            
    }

    public function addUserPackage($request)
    {    
        $request->validate([
            'package_description' => 'required|string',
            'session_length' => 'required|integer',
            'price' => 'required|float',
            'user_id' => 'required|integer'
            ]);


        $this->package = new Package();

        $this->package->package_description = $request->get("package_description");
        $this->package->package_description = $request->get("session_length");
        $this->package->package_description = $request->get("price");
        $this->package->package_description = $request->get("user_id");
        $this->package->save();

        return response()->json([
            'success'   =>  true
        ], 200);

     }

}