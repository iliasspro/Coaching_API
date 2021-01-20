<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getCoachs();
    
    public function addCoach($request);

    public function addUserReview($request);

    public function getUserReview($id);
}