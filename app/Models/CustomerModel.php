<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'customerID';
    protected $allowedFields = ['name', 'email', 'password', 'totalPoint', 'registrationDate', 'lastLogin'];
    protected $useTimestamps = true;

    // Function to register a new customer
    public function registerCustomer($name, $email, $password)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // password hashed
            'totalPoint' => 0, // default points to 0
            'registrationDate' => date('Y-m-d H:i:s'),
        ];
        
        return $this->insert($data);
    }

    // Function to log in a customer
    public function loginCustomer($email, $password)
    {
        $customer = $this->where('email', $email)->first();

        if ($customer && password_verify($password, $customer['password'])) {
            $this->update($customer['customerID'], ['lastLogin' => date('Y-m-d H:i:s')]);
            return $customer;
        }

        return null; // If login fails
    }

    // Function to update customer profile
    public function updateProfile($customerID, $name, $email, $password = null)
    {
        $data = ['name' => $name, 'email' => $email];
        
        if ($password) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        return $this->update($customerID, $data);
    }

    // Function to get total points of a customer
    public function getTotalPoints($customerID)
    {
        return $this->find($customerID)['totalPoint'];
    }

    // Function to add points to a customer's account
    public function addPoints($customerID, $points)
    {
        $customer = $this->find($customerID);
        $customer['totalPoint'] += $points;
        return $this->save($customer);
    }

    // Function to redeem points from a customer's account
    public function redeemPoints($customerID, $points)
    {
        $customer = $this->find($customerID);
        
        if ($customer['totalPoint'] >= $points) {
            $customer['totalPoint'] -= $points;
            return $this->save($customer);
        }

        return false; // If not enough points
    }

    // Function to delete a customer's account
    public function deleteAccount($customerID)
    {
        return $this->delete($customerID);
    }
}
