<?php

namespace App\Interfaces;

interface PackageRepositoryInterface
{
    public function getUserPackage($idu);
    
    public function addUserPackage($request);
}