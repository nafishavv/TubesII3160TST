<?php

namespace App\Controllers;

use App\Models\RoomModel;

class RoomController extends BaseController {
    protected $roomModel;

    public function __construct() {
        $this->roomModel = new RoomModel();
    }

    public function listRooms() {
        $rooms = $this->roomModel->getAllRooms();
        return view('rooms/list', ['rooms' => $rooms]);
    }

    public function addRoom() {
        // Implementasi untuk menambahkan kamar
    }

    public function updateRoom() {
        // Implementasi untuk update kamar
    }
}
