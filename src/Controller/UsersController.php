<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function index()
    {
        echo "Listado de usuarios";
        exit();
    }

    public function view($name)
    {
        echo "Detalle de usuario " . $name;
        exit();
    }

    public function add()
    {
        echo "agregar usuario";
        exit();
    }
}
