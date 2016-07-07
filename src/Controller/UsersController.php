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

    public function login()
    {
        if($this->request->is('post'))
        {
            $user = $this->Auth->identify();
            if($user)
            {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            else
            {
                $this->Flash->error('Datos son invalidos, por favor intente nuevamente', ['key' => 'auth']);
            }
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function home()
    {
        $this->render();
    }

    public function index()
    {
        $users = $this->paginate($this->Users);
        $this->set('users', $users);
    }

    public function view($name)
    {
        echo "Detalle de usuario " . $name;
        exit();
    }

    public function add()
    {
        $user = $this->Users->newEntity();

        if($this->request->is('post'))
        {
            $user = $this->Users->patchEntity($user, $this->request->data);

            if($this->Users->save($user))
            {
                $this->Flash->success('El usuario ha sido creado correctamente.');
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
            else
            {
                $this->Flash->error('El usuario no pudo ser creado. Por favor, intente nuevamente.');
            }
        }

        $this->set(compact('user'));
    }
}
