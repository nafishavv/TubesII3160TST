<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservation'; // Nama tabel di database
    protected $primaryKey = 'reservationID'; // Primary key tabel

    protected $allowedFields = [
        'customerID',
        'roomID',
        'checkInDate',
        'checkOutDate',
        'status',
        'createdAt',
        'totalPrice'
    ]; // Kolom yang dapat dimasukkan atau diperbarui

    protected $useTimestamps = false; // Aktifkan created_at dan updated_at otomatis
    protected $createdField = 'createdAt'; // Kolom untuk created_at
    protected $updatedField = ''; // Kolom untuk updated_at (jika diperlukan)

    /**
     * Buat reservasi baru
     */
    public function createReservation($data)
    {
        return $this->insert($data); // Masukkan data baru ke tabel
    }

    /**
     * 
     */
    public function getReservationsByCustomer($customerID)
    {
        return $this->where('customerID', $customerID)->findAll();
    }

    /**
     * Ambil detail reservasi berdasarkan reservationID
     */
    public function getReservationDetails($reservationID)
    {
        return $this->find($reservationID); // Cari data berdasarkan primary key
    }

    /**
     * Update status reservasi
     */
    public function updateReservationStatus($reservationID, $status)
    {
        return $this->update($reservationID, ['status' => $status]);
    }

    /**
     * Update tanggal check-in dan check-out
     */
    public function updateReservationDate($reservationID, $checkInDate, $checkOutDate)
    {
        return $this->update($reservationID, [
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
        ]);
    }

    /**
     * Hapus reservasi berdasarkan ID
     */
    public function deleteReservation($reservationID)
    {
        return $this->delete($reservationID);
    }

    /**
     * Hitung total harga berdasarkan durasi menginap
     */
    public function getAllRoomsWithTypeInfo()
    {
        return $this->db->table('room')
            ->join('roomType', 'room.roomTypeID = roomType.roomTypeID')
            ->select('room.*, roomType.name, roomType.price')
            ->get()->getResultArray();
    }
    public function calculateTotalPrice($roomID, $checkInDate, $checkOutDate)
    {
        $room = $this->db->table('room')
            ->join('roomType', 'room.roomTypeID = roomType.roomTypeID')
            ->select('roomType.price')
            ->where('room.roomID', $roomID)
            ->get()->getRow();

        $days = (strtotime($checkOutDate) - strtotime($checkInDate)) / (60 * 60 * 24);
        return $room->price * $days;
    }
    public function getAllReservations()
{
    return $this->db->table('reservation')
        ->select('reservation.reservationID, reservation.checkInDate, reservation.checkOutDate, reservation.status, reservation.totalPrice, customer.name AS customerName,customer.customerID AS customerID, room.roomID AS roomID, room.roomTypeID AS roomType')
        ->join('customer', 'customer.customerID = reservation.customerID')
        ->join('room', 'room.roomID = reservation.roomID')
        ->get()->getResultArray();
}
public function updateAvailability($roomID, $availability)
    {
        // Update the availability of the room where roomID matches
        return $this->update($roomID, ['availability' => $availability]);
    }

}
