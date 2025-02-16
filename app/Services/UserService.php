<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function getAllUsers()
    {
        return $this->userRepository->all();
    }
    
    public function getUser($id)
    {
        return $this->userRepository->find($id);
    }
    
    public function createUser(array $data)
    {
        // Hash password sebelum disimpan
        if(isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->userRepository->create($data);
    }
    
    public function updateUser($id, array $data)
    {
        // Jika password tidak diisi, jangan update field password
        if(isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return $this->userRepository->update($id, $data);
    }
    
    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
