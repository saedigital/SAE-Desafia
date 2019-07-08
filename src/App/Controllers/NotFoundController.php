<?php

namespace App\Controllers;

class NotFoundController extends BaseController 
{
    public function indexAction()
    {
        $data = [
            'message' => 'Route not found',
        ];

        return $data;
    }
}
