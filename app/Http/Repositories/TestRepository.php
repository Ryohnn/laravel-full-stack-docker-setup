<?php

namespace App\Http\Repositories;

class TestRepository implements IRepository
{
    public function all(): array
    {
        return ['test'];
    }
}
