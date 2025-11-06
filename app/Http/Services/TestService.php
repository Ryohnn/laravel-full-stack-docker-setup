<?php

namespace App\Http\Services;

use App\Http\Repositories\IRepository;

readonly class TestService implements IService
{
    public function __construct(private IRepository $repo) {}

    public function all()
    {
        return $this->repo->all();
    }
}
