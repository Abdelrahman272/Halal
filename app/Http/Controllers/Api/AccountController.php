<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class AccountController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $accounts = AccountResource::collection(Account::get());
        return $this->apiResponse($accounts, 'Accounts retrieved successfully', 200);
    }
}
