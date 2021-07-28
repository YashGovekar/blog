<?php

namespace App\Services;

use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthorService
{
    private AuthorRepositoryInterface $authorRepo;

    /**
     * AuthService constructor.
     * @param AuthorRepositoryInterface $authorRepo
     */
    public function __construct(AuthorRepositoryInterface $authorRepo)
    {
        $this->authorRepo = $authorRepo;
    }

    public function register($data): bool
    {
        try {
            $this->authorRepo->create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            return $this->login($data);
        } catch (Exception $e) {
            flash('Something went wrong!')->error();

            Log::error($e->getMessage());

            return false;
        }
    }

    public function login($data): bool
    {
        if (
            Auth::attempt(
                [
                    'email'    => $data['email'],
                    'password' => $data['password']
                ],
                $data['remember_me'] ?? false
            )
        ) {
            return true;
        }

        return false;
    }

    public function logout()
    {
        Auth::logout();
    }

    public function find($id)
    {
        return $this->authorRepo
            ->with('posts')
            ->find($id);
    }
}
