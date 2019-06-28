<?php
/**
 * Created by PhpStorm.
 * User: arbigaus
 * Date: 2019-06-28
 * Time: 09:04
 */

class Shows extends Model
{
    public function getShows() {
        $array = array();

        $sql = "SELECT * FROM shows";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getShowById($id) {
        $array = array();

        $sql = "SELECT * FROM shows WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function createShow() {
        if (
            isset($_POST['name']) &&
            isset($_POST['date']) &&
            isset($_POST['place']) &&
            isset($_POST['sits']) &&
            isset($_POST['price'])
         ) {
            $name  = addslashes($_POST['name']);
            $date  = addslashes($_POST['date']);
            $place = addslashes($_POST['place']);
            $sits  = addslashes($_POST['sits']);
            $price = addslashes($_POST['price']);

            $sql = "INSERT INTO shows SET name = '$name', date = '$date', place = '$place', ";
            $sql = $sql . "sits = '$sits', price = '$price'";
            $this->db->query($sql);
        }
    }

    public function updateShow() {
        if (
            isset($_POST['edit_id']) &&
            isset($_POST['edit_name']) &&
            isset($_POST['edit_date']) &&
            isset($_POST['edit_place']) &&
            isset($_POST['edit_sits']) &&
            isset($_POST['edit_price'])
        ) {
            $id    = addslashes($_POST['edit_id']);
            $name  = addslashes($_POST['edit_name']);
            $date  = addslashes($_POST['edit_date']);
            $place = addslashes($_POST['edit_place']);
            $sits  = addslashes($_POST['edit_sits']);
            $price = addslashes($_POST['edit_price']);

            $sql = "UPDATE shows SET name = '$name', date = '$date', place = '$place', ";
            $sql = $sql . "sits = '$sits', price = '$price' WHERE id = '$id'";

            $this->db->query($sql);

        }
    }

    public function delShow($id) {
        if(isset($id)){
            $sql = "DELETE FROM shows WHERE id = '$id'";
            $this->db->query($sql);

            $sql = "DELETE FROM booking WHERE show_id = '$id'";
            $this->db->query($sql);

        }
    }

}