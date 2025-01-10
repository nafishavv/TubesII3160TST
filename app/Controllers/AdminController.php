<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CustomerModel;
use App\Models\RoomModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Config\Services;

class AdminController extends ResourceController
{
    protected $modelName = 'App\Models\AdminModel';
    protected $format = 'json';

    public function __construct()
    {
        $this->session = Services::session();
    }

    public function showRegisterView()
    {
        // if (session()->get('is_admin_logged_in')) {
        //     return redirect()->to('/admin/home');
        // }
        return view('admin/register');
    }

    public function showLoginView()
    {
        // if (session()->get('is_admin_logged_in')) {
        //     return redirect()->to('/admin/home');
        // }
        return view('admin/login');
    }

    public function showHomeView()
    {
        // if (session()->get('is_admin_logged_in')) {
        //     return redirect()->to('/admin/home');
        // }
        $data = [
            'name' => $this->session->get('name'), // Ambil nama admin dari session
        ];
    
        return view('admin/home', $data);
    }

    public function register()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $adminID = $adminModel->registerAdmin($name, $email, $password);

        if ($adminID) {
            $this->session->set('adminID', $adminID);
            $this->session->set('name', $name);
            $this->session->set('email', $email);
            $this->session->set('is_admin_logged_in', true);

            return redirect()->to('/admin/home');
        }

        return $this->failValidationError('Admin registration failed');
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $admin = $adminModel->loginAdmin($email, $password);

        if ($admin) {
            $this->session->set('adminID', $admin['adminID']);
            $this->session->set('name', $admin['name']);
            $this->session->set('email', $admin['email']);
            $this->session->set('is_admin_logged_in', true);

            return redirect()->to('/admin/home');
        }

        return $this->failUnauthorized('Login failed');
    }

    public function dashboard()
    {
        if (!$this->session->get('is_admin_logged_in')) {
            return redirect()->to('/admin/login');
        }

        return view('admin/dashboard', [
            'name' => $this->session->get('name')
        ]);
    }

    public function showProfile()
    {
        if (!$this->session->get('is_admin_logged_in')) {
            return redirect()->to('/admin/login');
        }

        $adminID = $this->session->get('adminID');
        $adminModel = new AdminModel();
        $admin = $adminModel->find($adminID);

        if ($admin) {
            $admin['password'] = str_repeat('*', 8); // Hide password
            return view('admin/profile', ['admin' => $admin]);
        }

        return $this->failNotFound('Admin not found');
    }

    public function updateProfile()
    {
        // $this->checkLogin();

        $adminID = $this->session->get('adminID');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $result = $adminModel->updateProfile($adminID, $name, $email, $password);

        if ($result) {
            return $this->respond(['message' => 'Profile updated successfully']);
        }

        return $this->failNotFound('Admin not found');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login');
    }
    public function getAllCustomer()
    {
        $customerModel = new CustomerModel();
        
        // Ambil keyword pencarian dari query string
        $keyword = $this->request->getGet('search') ?? '';

        // Cari berdasarkan keyword
        $customers = $customerModel->searchCustomers($keyword);  

        return view('admin/customers', ['customers' => $customers, 'search' => $keyword]);  // Kirim data ke view
    }

    // Fungsi untuk mengambil pelanggan berdasarkan ID
    public function getCustomerByID($customerID)
    {
        $customerModel = new CustomerModel();
        $customer = $customerModel->find($customerID);  // Menarik data pelanggan berdasarkan ID
        return view('admin/customer_details', ['customer' => $customer]);  // Kirim data ke view
    }
    public function manageRooms()
    {
        $roomModel = new RoomModel();
        $room = $roomModel->getAllRooms();
        return view('admin/manage_rooms', ['room' => $room]);
    }

    public function updateRoom($roomID)
    {
        $roomTypeID = $this->request->getPost('roomTypeID');
        $floorNumber = $this->request->getPost('floorNumber');
        $availability = $this->request->getPost('availability') === '1';

        $roomModel = new RoomModel();
        $roomModel->updateRoom($roomID, [
            'roomTypeID' => $roomTypeID,
            'floorNumber' => $floorNumber,
            'availability' => $availability,
        ]);

        return redirect()->to('/admin/manageRooms')->with('success', 'Room updated successfully.');
    }

    public function deleteRoom($roomID)
    {
        $roomModel = new RoomModel();
        $roomModel->deleteRoom($roomID);

        return redirect()->to('/admin/manageRooms')->with('success', 'Room deleted successfully.');
    }
    public function editRoom($roomID)
    {
        $roomModel = new RoomModel();
        $room = $roomModel->find($roomID);

        if (!$room) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Room not found');
        }

        return view('admin/edit_room', ['room' => $room]);
    }
    public function addRoom()
    {
        $data = [
            'roomTypeID' => $this->request->getPost('roomTypeID'),
            'floorNumber' => $this->request->getPost('floorNumber'),
            'availability' => $this->request->getPost('availability'),
        ];

        // Validasi (opsional)
        if (!$this->validate([
            'roomTypeID' => 'required',
            'floorNumber' => 'required|integer',
            'availability' => 'required|in_list[0,1]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data ke database (gunakan model sesuai struktur Anda)
        $roomModel = new \App\Models\RoomModel();
        $roomModel->insert($data);

        // Redirect dengan pesan sukses
        return redirect()->to('/admin/manageRooms')->with('message', 'Room successfully added.');
    }

    public function addRoomPage()
    {
        return view('admin/add_room'); // Pastikan file view ada di folder `admin` dengan nama `add_room.php`
    }




}
