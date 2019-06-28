<?php
/**
 * Created by PhpStorm.
 * User: arbigaus
 * Date: 2019-06-28
 * Time: 12:55
 */

class Book extends Model
{
    public function getBooks() {
        $array = array();

        $sql = "SELECT *, booking.id as bookingId, booking.reserved_sits as reservedSits FROM booking LEFT JOIN shows ON booking.show_id = shows.id ";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function createBook() {
        if (
            isset($_POST["name"]) &&
            isset($_POST["show_id"]) &&
            isset($_POST["sits"])
        )
        {
            $name         = addslashes($_POST['name']);
            $showId       = addslashes($_POST['show_id']);
            $reservedSits = addslashes($_POST['sits']);

            $sql = "INSERT INTO booking SET username = '$name', show_id = '$showId', reserved_sits = '$reservedSits'";
            $this->db->query($sql);

            $sqlShows = "UPDATE shows SET reserved_sits = ('$reservedSits' + reserved_sits) WHERE id = '$showId'";
            $this->db->query($sqlShows);

        }
    }

    public function delBook($id) {
        if(isset($id)) {
            $selectedSits = $this->getReservedSits($id);

            $sqlUpdateShows = "UPDATE shows SET reserved_sits = (reserved_sits - '$selectedSits[0]' )";
            $this->db->query($sqlUpdateShows);

            $sql = "DELETE FROM booking WHERE id = '$id'";
            $this->db->query($sql);
        }
    }

    private function getReservedSits($id) {

        $sql = "SELECT reserved_sits FROM booking WHERE id = '$id'";
        $sql = $this->db->query($sql);

        $array = $sql->fetch();

        return $array;
    }

}