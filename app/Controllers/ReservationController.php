<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\CustomerModel;
use App\Models\RoomModel;
use CodeIgniter\Controller;

class ReservationController extends Controller
{
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $reservationModel = new ReservationModel();
            $customerID = session()->get('customerID');  // Asumsi sudah ada session user
            $roomID = $this->request->getPost('roomID');
            $checkInDate = $this->request->getPost('checkInDate');
            $checkOutDate = $this->request->getPost('checkOutDate');
            
            $reservationModel->createReservation($customerID, $roomID, $checkInDate, $checkOutDate);
            return redirect()->to('/reservation/list');
        }

        return view('reservation/create');
    }

    public function list()
    {
        $reservationModel = new ReservationModel();
        $customerID = session()->get('customerID');  // Asumsi sudah ada session user
        $reservation = $reservationModel->getReservationByUser($customerID);

        return view('reservation/list', ['reservation' => $reservation]);
    }

    public function cancel($reservationID)
    {
        $reservationModel = new ReservationModel();
        $reservationModel->cancelReservation($reservationID);
        return redirect()->to('/reservation/list');
    }

    public function updateStatus($reservationID, $status)
    {
        $reservationModel = new ReservationModel();
        $reservationModel->updateReservationStatus($reservationID, $status);
        return redirect()->to('/reservation/list');
    }
    
    // Function to get reservations by user ID
    public function listByUser($customerID)
    {
        $reservationModel = new ReservationModel();

        // Get reservations by user ID
        $reservation = $reservationModel->getReservationByUser($customerID);

        if ($reservation) {
            return $this->response->setJSON([
                'status' => 'success',
                'reservation' => $reservation
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No reservations found for this user'
            ]);
        }
    }
    public function reservationPage()
    {
        $reservationModel = new \App\Models\ReservationModel();
        $room = $reservationModel->getAllRoomsWithTypeInfo(); // Buat fungsi untuk join Room dan RoomType

        return view('customer/reservation_page', ['room' => $room]);
    }
    public function makeReservation()
    {
        $reservationModel = new \App\Models\ReservationModel();
        $roomModel = new \App\Models\RoomModel();

        $data = [
            'customerID' => session()->get('customerID'), // Dapatkan user ID dari sesi
            'roomID' => $this->request->getPost('roomID'),
            'checkInDate' => $this->request->getPost('checkInDate'),
            'checkOutDate' => $this->request->getPost('checkOutDate'),
            'status' => 'Confirmed',
            'createdAt' => date('Y-m-d H:i:s'),
            'totalPrice' => $reservationModel->calculateTotalPrice(
                $this->request->getPost('roomID'),
                $this->request->getPost('checkInDate'),
                $this->request->getPost('checkOutDate')
            )
        ];

        $reservationModel->insert($data);
        return redirect()->to('/customer/reservationPage')->with('message', 'Reservation added!');
    }
    public function checkoutPage()
    {
        $reservationModel = new \App\Models\ReservationModel();
        $reservation = $reservationModel->getReservationsByUser(session()->get('customerID'));

        return view('customer/checkout_page', ['reservation' => $reservation]);
    }

    public function confirmCheckout()
    {
        $reservationModel = new \App\Models\ReservationModel();

        $reservation = $reservationModel->getReservationsByUser(session()->get('customerID'));
        foreach ($reservation as $reservation) {
            $reservationModel->updateReservationStatus($reservation['reservationID'], 'Confirmed');
            $roomModel = new \App\Models\RoomModel();
            $roomModel->updateAvailability($reservation['roomID'], 0);
        }

        return redirect()->to('/customer/reservationPage')->with('message', 'Checkout complete!');
    }
    public function viewReservations()
    {
        // Ambil data reservasi, room, dan customer
        $reservationModel = new ReservationModel();
        $customerModel = new CustomerModel();
        $roomModel = new RoomModel();

        // Mengambil semua reservasi
        $reservations = $reservationModel->getAllReservations();

        // Pass data ke view
        return view('admin/view_reservations', [
            'reservations' => $reservations,
            'customers' => $customerModel->findAll(),
            'rooms' => $roomModel->findAll()
        ]);
    }
    // Controller untuk manageAvailability
public function manageAvailability($roomID)
{
    $roomModel = new RoomModel();
    $room = $roomModel->find($roomID);
    return view('admin/manage_availability', ['room' => $room]);
}

// Controller untuk viewCustomer
public function viewCustomer($customerID)
{
    $customerModel = new CustomerModel();
    $customer = $customerModel->find($customerID);
    return view('admin/view_customer', ['customer' => $customer]);
}
public function updateAvailability($roomID)
{
    // Get the selected availability status from the form
    $availability = $this->request->getPost('availability');

    // Update the availability of the room
    $roomModel = new \App\Models\RoomModel();
    $roomModel->updateAvailability($roomID, $availability);

    // Redirect back to the view_reservations.php page
    return redirect()->to('/admin/viewReservations');
}

}
