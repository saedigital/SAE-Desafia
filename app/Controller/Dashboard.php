<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 15:20
 */

namespace App\Controller;


class Dashboard extends AbstractController
{

    public function menu() {
        return $this->render('menu.php', get_defined_vars());
    }
}