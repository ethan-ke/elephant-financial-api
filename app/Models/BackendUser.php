<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class BackendUser extends Authenticatable
{
    use HasApiTokens, HasFactory;
    public function findForPassport($username)
    {
        filter_var($username, FILTER_VALIDATE_EMAIL) ? $credentials['email'] = $username : $credentials['username'] = $username;
        return self::where($credentials)->first();
    }
}
