<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'adminID';
    protected $allowedFields = ['name', 'email', 'password'];

    public function registerAdmin($name, $email, $password)
    {
        // Encrypt password before storing
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        return $this->insert(['name' => $name, 'email' => $email, 'password' => $passwordHash, 'role' => 'receptionist']);
    }

    public function loginAdmin($email, $password)
    {
        $admin = $this->where('email', $email)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }
        return false;
    }

    public function updateProfile($adminID, $name, $email, $password)
    {
        // Encrypt password before updating
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        return $this->update($adminID, ['name' => $name, 'email' => $email, 'password' => $passwordHash]);
    }
}
