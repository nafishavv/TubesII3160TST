<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Config\Services;

class CustomerController extends ResourceController
{
    protected $modelName = 'App\Models\CustomerModel';
    protected $format = 'json';

    public function __construct()
    {
        // Check if the customer is logged in before accessing restricted routes
        $this->session = Services::session();
    }

    public function showRegisterView()
    {
        // Render the registration view
        return view('customer/register');
    }

    public function showLoginView()
    {
        // Render the registration view
        return view('customer/login');
    }

    // Register a new customer
    public function register()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $customerModel = new CustomerModel();
        $customerID = $customerModel->registerCustomer($name, $email, $password);

        if ($customerID) {
            return redirect()->to('/customer/home');
        }

        return $this->failValidationError('Customer registration failed');
    }

    // Login a customer (start session)
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $customerModel = new CustomerModel();
        $customer = $customerModel->loginCustomer($email, $password);

        if ($customer) {
            // Set session data
            $this->session->set('customerID', $customer['customerID']);
            $this->session->set('name', $customer['name']);
            $this->session->set('email', $customer['email']);

            return redirect()->to('/customer/home');
        }

        return $this->failUnauthorized('Login failed');
    }

    // Check if the user is authenticated (session-based)
    private function checkLogin()
    {
        if (!$this->session->has('customerID')) {
            return $this->failUnauthorized('User is not logged in');
        }
    }

    public function home()
    {
        $this->checkLogin(); // Pastikan user login

        return view('customer/home', [
            'name' => $this->session->get('name')
        ]);
    }

    public function showProfile($customerID)
    {
        $this->checkLogin(); // Pastikan user login

        $customerModel = new CustomerModel();
        $customer = $customerModel->find($customerID);

        if ($customer) {
            // Sembunyikan password
            $customer['password'] = str_repeat('*', 8);

            return view('customer/profile', ['customer' => $customer]);
        }

        return $this->failNotFound('Customer not found');
    }

    // Update customer profile
    public function updateProfile()
    {
        $this->checkLogin();  // Ensure the user is logged in

        $customerID = $this->session->get('customerID');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $customerModel = new CustomerModel();
        $result = $customerModel->updateProfile($customerID, $name, $email, $password);

        if ($result) {
            return $this->respond(['message' => 'Profile updated successfully']);
        }

        return $this->failNotFound('Customer not found');
    }

    // Show customer profile
    // public function showProfile($customerID)
    // {
    //     $this->checkLogin();  // Ensure the user is logged in

    //     $customerModel = new CustomerModel();
    //     $customer = $customerModel->find($customerID);

    //     if ($customer) {
    //         return $this->respond(['customer' => $customer]);
    //     }

    //     return $this->failNotFound('Customer not found');
    // }

    // Delete customer account
    public function deleteAccount($customerID)
    {
        $this->checkLogin();  // Ensure the user is logged in

        $customerModel = new CustomerModel();
        $result = $customerModel->deleteAccount($customerID);

        if ($result) {
            $this->session->destroy();  // Destroy session upon successful account deletion
            return $this->respondDeleted(['message' => 'Account deleted successfully']);
        }

        return $this->failNotFound('Customer not found');
    }

    // Get total points of a customer
    public function getTotalPoints($customerID)
    {
        $this->checkLogin();  // Ensure the user is logged in

        $customerModel = new CustomerModel();
        $points = $customerModel->getTotalPoints($customerID);

        return $this->respond(['totalPoints' => $points]);
    }

    // Add points to customer's account
    public function addPoints()
    {
        $this->checkLogin();  // Ensure the user is logged in

        $customerID = $this->session->get('customerID');
        $points = $this->request->getPost('points');

        $customerModel = new CustomerModel();
        $result = $customerModel->addPoints($customerID, $points);

        if ($result) {
            return $this->respond(['message' => 'Points added successfully']);
        }

        return $this->fail('Failed to add points');
    }

    // Redeem points from customer's account
    public function redeemPoints()
    {
        $this->checkLogin();  // Ensure the user is logged in

        $customerID = $this->session->get('customerID');
        $points = $this->request->getPost('points');

        $customerModel = new CustomerModel();
        $result = $customerModel->redeemPoints($customerID, $points);

        if ($result) {
            return $this->respond(['message' => 'Points redeemed successfully']);
        }

        return $this->fail('Insufficient points');
    }

    // Logout and destroy the session
    public function logout()
    {
        $this->session->destroy();
        return $this->respond(['message' => 'Logged out successfully']);
    }
}
