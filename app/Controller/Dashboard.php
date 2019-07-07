<?php
/**
 * Created by PhpStorm.
 * User: PauloVital
 * Date: 07/07/2019
 * Time: 12:51
 */

namespace Vital\Controller;

require_once (__DIR__ .'/../Models/Dashboard.php');

class Dashboard
{
    private $dashboard;

    public function __construct()
    {
        $this->dashboard = new \Dashboard();
    }

    public function dashboard()
    {
        $this->dashboard->openDashboard();
    }
}