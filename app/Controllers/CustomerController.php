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
        // Jika sudah login, jangan tampilkan halaman register
        if (session()->get('is_logged_in')) {
            return redirect()->to('/customer/home');
        }
    
        return view('customer/register');
    }
    
    public function showLoginView()
    {
        // Jika sudah login, jangan tampilkan halaman register
        if (session()->get('is_logged_in')) {
            return redirect()->to('/customer/home');
        }
    
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
            // Set session data after registration
            $this->session->set('customerID', $customerID);
            $this->session->set('name', $name); // Store the name in session
            $this->session->set('email', $email); // Store the email in session
            $this->session->set('is_logged_in', true); // Set the 'is_logged_in' session

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
            $this->session->set('is_logged_in', true); // Add 'is_logged_in' session

            return redirect()->to('/customer/home');
        }
        return $this->failUnauthorized('Login failed');
    }

    public function home()
    {
        // Check if user is logged in directly with session check
        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/customer/login');
        }
    
        return view('customer/home', [
            'name' => $this->session->get('name')
        ]);
    }    

    public function showProfile()
    {
        // Check if the user is logged in
        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/customer/login');
        }
    
        // Get the customerID from the session (logged-in user)
        $customerID = $this->session->get('customerID');
    
        $customerModel = new CustomerModel();
        $customer = $customerModel->find($customerID);
    
        if ($customer) {
            // Hide password
            $customer['password'] = str_repeat('*', 8);
    
            return view('customer/profile', ['customer' => $customer]);
        }
    
        return $this->failNotFound('Customer not found');
    }    

    public function updateProfileView()
    {
        // Check if the user is logged in
        if (!$this->session->get('is_logged_in')) {
            // Redirect to login page if not logged in
            return redirect()->to('/customer/login');
        }

        // Get the customerID from the session (logged-in user)
        $customerID = $this->session->get('customerID');

        // Create an instance of CustomerModel to fetch customer data
        $customerModel = new CustomerModel();
        
        // Retrieve customer details from the database
        $customer = $customerModel->find($customerID);

        // If customer not found, return an error
        if (!$customer) {
            return $this->failNotFound('Customer not found');
        }

        // Pass the customer data to the view (update_profile.php)
        return view('customer/update_profile', ['customer' => $customer]);
    }

    public function updateProfile()
    {
        // Check if the user is logged in
        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/customer/login');
        }
    
        // Get the customerID from the session (logged-in user)
        $customerID = $this->session->get('customerID');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        $customerModel = new CustomerModel();
    
        // Get the existing customer data
        $customer = $customerModel->find($customerID);
        if (!$customer) {
            return $this->failNotFound('Customer not found');
        }
    
        // Prepare the update data array
        $updateData = [];
        if (!empty($name)) {
            $updateData['name'] = $name;
        }
        if (!empty($email)) {
            $updateData['email'] = $email;
        }
        if (!empty($password)) {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT); // Optionally hash the password
        }
    
        // If no fields are provided to update, return an error
        if (empty($updateData)) {
            return redirect()->to('/customer/updateProfile')->with('error', 'No valid fields to update');
        }
    
        // Perform the update
        $result = $customerModel->update($customerID, $updateData);
    
        if ($result) {
            return redirect()->to('/customer/showProfile')->with('message', 'Profile updated successfully');
        }
    
        return redirect()->to('/customer/updateProfile')->with('error', 'Profile update failed');
    }
    

    // Delete customer account
    public function deleteAccount()
    {
        // Ensure the user is logged in
        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/customer/login');
        }
    
        // Get the customer ID from the session
        $customerID = $this->session->get('customerID');
    
        // Instantiate the customer model
        $customerModel = new CustomerModel();
        
        // Delete the account using the customer ID
        $result = $customerModel->deleteAccount($customerID);
    
        if ($result) {
            // Destroy the session upon successful account deletion
            $this->session->destroy();
    
            // Redirect to the homepage with a success message
            return redirect()->to('/')->with('success', 'Your account has been successfully deleted.');
        }
    
        return redirect()->to('/customer/showProfile')->with('error', 'Account deletion failed. Please try again.');
    }    

    // Logout and destroy the session
    public function logout()
    {
        // Store success message in flashdata before destroying the session
        session()->setFlashdata('success', 'You have successfully logged out.');

        // Destroy the session
        $this->session->destroy();

        // Redirect to login page
        return redirect()->to('/customer/login');
    }



    // Get total points of a customer
    // public function getTotalPoints($customerID)
    // {
    //     $this->checkLogin();  // Ensure the user is logged in

    //     $customerModel = new CustomerModel();
    //     $points = $customerModel->getTotalPoints($customerID);

    //     return $this->respond(['totalPoints' => $points]);
    // }

    // // Add points to customer's account
    // public function addPoints()
    // {
    //     $this->checkLogin();  // Ensure the user is logged in

    //     $customerID = $this->session->get('customerID');
    //     $points = $this->request->getPost('points');

    //     $customerModel = new CustomerModel();
    //     $result = $customerModel->addPoints($customerID, $points);

    //     if ($result) {
    //         return $this->respond(['message' => 'Points added successfully']);
    //     }

    //     return $this->fail('Failed to add points');
    // }

    // // Redeem points from customer's account
    // public function redeemPoints()
    // {
    //     $this->checkLogin();  // Ensure the user is logged in

    //     $customerID = $this->session->get('customerID');
    //     $points = $this->request->getPost('points');

    //     $customerModel = new CustomerModel();
    //     $result = $customerModel->redeemPoints($customerID, $points);

    //     if ($result) {
    //         return $this->respond(['message' => 'Points redeemed successfully']);
    //     }

    //     return $this->fail('Insufficient points');
    // }
}
