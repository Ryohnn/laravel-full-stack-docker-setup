<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\IService;
use Illuminate\Http\Response;

class TestController extends Controller
{
    public function __construct(
        private readonly IService $userService,
        private readonly IService $testService
    ) {}

    public function users(): Response
    {
        return response($this->userService->all());
    }

    public function test(): Response
    {
        return response($this->testService->all());
    }
}
