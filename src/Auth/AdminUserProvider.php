<?php

namespace BitPixel\SpringCms\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class AdminUserProvider implements UserProvider
{

    public function __construct()
    {
        $this->user = $user;
    }

    public function retrieveByID($identifier)
    {
        $this->user = \UserAccount::find($identifier);
        return $this->user;
    }

    public function retrieveByCredentials(array $credentials)
    {
        // find user by username
        $user = \UserAccount::where('name', $credentials['username'])->first();

        // validate
        return $user;
    }

    public function validateCredentials(\Illuminate\Auth\UserInterface $user, array $credentials)
    {
        //logic to validate user
    }

    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }
}
