<?php

namespace App\Controllers;

use App\Models\RoomTypeModel;
use CodeIgniter\Controller;

class RoomTypeController extends Controller
{
    protected $roomTypeModel;
    protected $session;

    public function __construct()
    {
        $this->roomTypeModel = new RoomTypeModel();
        $this->session = session();
    }

    private function checkAdminSession()
    {
        if (!$this->session->get('is_admin')) {
            return redirect()->to('/login')->with('error', 'Access denied');
        }
    }

    public function index()
    {
        $this->checkAdminSession();
        $roomType = $this->roomTypeModel->getAllRoomTypes();
        return view('roomType/index', ['roomType' => $roomType]);
    }

    public function addView()
    {
        $this->checkAdminSession();
        return view('roomType/add');
    }

    public function add()
    {
        $this->checkAdminSession();

        $data = $this->request->getPost();
        $this->roomTypeModel->insert($data);

        return redirect()->to('/roomType')->with('message', 'Room type added successfully');
    }

    public function editView($roomTypeID)
    {
        $this->checkAdminSession();
        $roomType = $this->roomTypeModel->getRoomTypeInfo($roomTypeID);

        return view('roomType/edit', ['roomType' => $roomType]);
    }

    public function update($roomTypeID)
    {
        $this->checkAdminSession();

        $data = $this->request->getPost();
        $this->roomTypeModel->update($roomTypeID, $data);

        return redirect()->to('/roomType')->with('message', 'Room type updated successfully');
    }

    public function delete($roomTypeID)
    {
        $this->checkAdminSession();

        $this->roomTypeModel->delete($roomTypeID);

        return redirect()->to('/roomType')->with('message', 'Room type deleted successfully');
    }
}
