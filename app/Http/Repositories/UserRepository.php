<?php

namespace App\Http\Repositories;

class UserRepository implements IRepository
{
    public function all()
    {
        return ['users'];
    }
}
