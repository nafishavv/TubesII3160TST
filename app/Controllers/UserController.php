<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    // Register a new user
    public function register()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        if ($userModel->register($name, $email, $password)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'User registered successfully.']);
        }
        return $this->response->setJSON(['status' => 'fail', 'message' => 'Failed to register user.'])->setStatusCode(400);
    }

    // Login user and start session
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->login($email, $password);
        if ($user) {
            // Start session and store user data
            session()->set('userID', $user['userID']);
            session()->set('name', $user['name']);
            session()->set('logged_in', true); // Flag for authentication status
            return $this->response->setJSON(['status' => 'success', 'message' => 'Login successful.']);
        }
        return $this->response->setJSON(['status' => 'fail', 'message' => 'Invalid login credentials.'])->setStatusCode(401);
    }
 
    public function logout()
    {
        // Destroy session data
        session()->destroy();
    
        // Return response indicating successful logout
        return $this->response->setJSON(['status' => 'success', 'message' => 'User logged out successfully.']);
    }
    
    public function updateProfile() {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'User not authenticated.'])->setStatusCode(401);
        }
        
        $input = $this->request->getRawInput();
    
        if (empty($input)) {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'No data provided for update.']);
        }
    
        $userID = session()->get('userID');
        $userModel = new UserModel();
    
        // Delegate update to model
        $result = $userModel->updateUserProfile($userID, $input);
    
        return $this->response->setJSON($result);
    }    
    
    // Show user profile
    public function show($userID = null)
    {
        // Check if the user is logged in
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'User not authenticated.'])->setStatusCode(401);
        }

        // Use session userID if no userID is passed
        if (is_null($userID)) {
            $userID = session()->get('userID');
        }

        $userModel = new UserModel();
        $user = $userModel->getUserByID($userID);

        // Return user profile or error
        if ($user) {
            return $this->response->setJSON($user);
        }

        return $this->response->setJSON(['status' => 'fail', 'message' => 'User not found.'])->setStatusCode(404);
    }

    // Delete user account (for the logged-in user)
    public function deleteAccount()
    {
        // Check if the user is logged in
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'User not authenticated.'])->setStatusCode(401);
        }

        // Get the userID from the session (since they are logged in)
        $userID = session()->get('userID');

        // Ensure user is authorized to delete their account (this will be implicitly true as it's their own account)
        $userModel = new UserModel();
        if ($userModel->deleteUser($userID)) {
            // Log out the user after deletion (clear session)
            session()->destroy();
            
            return $this->response->setJSON(['status' => 'success', 'message' => 'Account deleted successfully.']);
        }

        return $this->response->setJSON(['status' => 'fail', 'message' => 'Failed to delete user account.'])->setStatusCode(400);
    }

    // Get list of all users (admin level or authenticated)
    // public function index()
    // {
    //     if (!session()->get('logged_in')) {
    //         return $this->response->setJSON(['status' => 'fail', 'message' => 'User not authenticated.'])->setStatusCode(401);
    //     }

    //     $userModel = new UserModel();
    //     $users = $userModel->getAllUsers();
    //     return $this->response->setJSON($users);
    // }

    // Delete a user
    // public function delete($userID)
    // {
    //     if (!session()->get('logged_in')) {
    //         return $this->response->setJSON(['status' => 'fail', 'message' => 'User not authenticated.'])->setStatusCode(401);
    //     }

    //     // Ensure user is authorized to delete
    //     if (session()->get('userID') != $userID) {
    //         return $this->response->setJSON(['status' => 'fail', 'message' => 'Unauthorized access.'])->setStatusCode(403);
    //     }

    //     $userModel = new UserModel();
    //     if ($userModel->deleteUser($userID)) {
    //         return $this->response->setJSON(['status' => 'success', 'message' => 'User deleted successfully.']);
    //     }
    //     return $this->response->setJSON(['status' => 'fail', 'message' => 'Failed to delete user.'])->setStatusCode(400);
    // }
}