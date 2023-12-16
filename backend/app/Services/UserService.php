<?php

namespace App\Services;

use App\Models\User;
/**
 * Class UserService.
 */
class UserService
{
    public function userRelations()
    {
        return User::query();
    }
}
