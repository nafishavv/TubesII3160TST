<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'reservationID';
    protected $allowedFields = [
        'userID', 'roomID', 'checkInDate', 'checkOutDate', 'status', 'createdAt'
    ];
    protected $useTimestamps = true;

    // Fungsi untuk membuat reservasi baru
    public function createReservation($userID, $roomID, $checkInDate, $checkOutDate)
    {
        $data = [
            'userID' => $userID,
            'roomID' => $roomID,
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
            'status' => 'pending',
            'createdAt' => date('Y-m-d H:i:s')
        ];

        return $this->save($data);
    }

    // Fungsi untuk mendapatkan semua reservasi berdasarkan userID
    public function getReservationByUser($userID)
    {
        return $this->where('userID', $userID)->findAll();
    }

    // Fungsi untuk mendapatkan detail reservasi berdasarkan ID
    public function getReservationDetails($reservationID)
    {
        return $this->find($reservationID);
    }

    // Fungsi untuk memperbarui status reservasi
    public function updateReservationStatus($reservationID, $status)
    {
        return $this->update($reservationID, ['status' => $status]);
    }

    // Fungsi untuk menghapus reservasi
    public function cancelReservation($reservationID)
    {
        return $this->delete($reservationID);
    }
}
