<?php

require_once "Conn.php";

class Dashboard  extends Conn
{
    public function openDashboard()
    {
        include_once "../app/Views/dashboard/index.php";
    }
}