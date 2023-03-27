<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactUsResource;
use App\Models\Contacts;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class ContactUsController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $accounts = ContactUsResource::collection(Contacts::get());
        return $this->apiResponse($accounts, 'Accounts retrieved successfully', 200);
    }

}
