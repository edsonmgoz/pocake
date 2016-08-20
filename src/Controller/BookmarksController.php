<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bookmarks Controller
 *
 * @property \App\Model\Table\BookmarksTable $Bookmarks
 */
class BookmarksController extends AppController
{

    public function isAuthorized($user)
    {
        if(isset($user['role']) and $user['role'] === 'user')
        {
            if(in_array($this->request->action, ['add', 'index', 'edit', 'delete']))
            {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'conditions' => ['user_id' => $this->Auth->user('id')],
            'order' => ['id' => 'desc']
        ];
        $this->set('bookmarks', $this->paginate($this->Bookmarks));
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bookmark = $this->Bookmarks->newEntity();
        if ($this->request->is('post'))
        {
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->data);
            $bookmark->user_id = $this->Auth->user('id');
            if ($this->Bookmarks->save($bookmark))
            {
                $this->Flash->success('El enlace ha sido creado.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('El enlace no pudo ser creado. Por favor,intente nuevamente.');
            }
        }
        $this->set(compact('bookmark'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bookmark id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookmark = $this->Bookmarks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->data);
            if ($this->Bookmarks->save($bookmark)) {
                $this->Flash->success(__('The bookmark has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The bookmark could not be saved. Please, try again.'));
            }
        }
        $users = $this->Bookmarks->Users->find('list', ['limit' => 200]);
        $this->set(compact('bookmark', 'users'));
        $this->set('_serialize', ['bookmark']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookmark = $this->Bookmarks->get($id);
        if ($this->Bookmarks->delete($bookmark)) {
            $this->Flash->success(__('The bookmark has been deleted.'));
        } else {
            $this->Flash->error(__('The bookmark could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
