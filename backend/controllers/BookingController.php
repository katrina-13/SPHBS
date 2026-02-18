<?php

class BookingController {

    public function getBookings() {
        echo json_encode([
            ["id"=>1,"name"=>"Edith","room"=>"Conference","date"=>"2026-02-15"]
        ]);
    }

    public function createBooking() {

        $data = json_decode(file_get_contents("php://input"), true);

        echo json_encode([
            "success" => true,
            "data" => $data
        ]);
    }
}
?>