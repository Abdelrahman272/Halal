<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PolicyResource;
use App\Models\Policy;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class PolicyController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $policies = PolicyResource::collection(Policy::get());
        return $this->apiResponse($policies, 'Policies retrieved successfully', 200);
    }
}
