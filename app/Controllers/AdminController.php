<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminController extends BaseController {

    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Dashboard accessible only by admins
    public function dashboard() {
        return view('admin/dashboard');
    }

    // Manage users (admin only)
    public function manageUsers() {
        $users = $this->userModel->findAll();
        return view('admin/manageUsers', ['users' => $users]);
    }

    // Update user role (admin only)
    public function updateUserRole($userID, $newRole) {
        // Only admins can update roles
        $this->userModel->update($userID, ['role' => $newRole]);
        return redirect()->to('/admin/manage')->with('message', 'User role updated');
    }
}
