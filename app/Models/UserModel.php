<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'userID';
    protected $allowedFields = ['name', 'email', 'password', 'registrationDate', 'lastLogin'];
    protected $useTimestamps = false;

    // Register a new user
    public function register($name, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->insert([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'registrationDate' => date('Y-m-d H:i:s')
        ]);
    }

    // Login user
    public function login($email, $password)
    {
        $user = $this->where('email', $email)->first();
        if ($user && password_verify($password, $user['password'])) {
            $this->update($user['userID'], ['lastLogin' => date('Y-m-d H:i:s')]);
            return $user;
        }
        return null; // Invalid login
    }

    // Update user profile
    public function updateUserProfile($userID, $data)
    {
        // Only include fields that are provided
        $updateData = [];
        if (!empty($data['name'])) {
            $updateData['name'] = $data['name'];
        }
        if (!empty($data['email'])) {
            $updateData['email'] = $data['email'];
        }
        if (!empty($data['password'])) {
            $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
    
        // Check if there is data to update
        if (empty($updateData)) {
            return ['status' => 'fail', 'message' => 'No data provided for update.'];
        }
    
        // Perform the update
        if ($this->update($userID, $updateData)) {
            return ['status' => 'success', 'message' => 'Profile updated successfully.'];
        }
    
        return ['status' => 'fail', 'message' => 'Failed to update profile.'];
    }    

    // Get user by ID
    public function getUserByID($userID)
    {
        return $this->find($userID);
    }

    // Delete user
    public function deleteUser($userID)
    {
        return $this->delete($userID);
    }

    // Get all users (admin function)
    // public function getAllUsers()
    // {
    //     return $this->findAll();
    // }
}