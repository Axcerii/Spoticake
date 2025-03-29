<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Follows Controller
 *
 * @property \App\Model\Table\FollowsTable $Follows
 */
class FollowsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Follows->find()
            ->contain(['Users']);
        $follows = $this->paginate($query);

        $this->set(compact('follows'));
    }

    /**
     * View method
     *
     * @param string|null $id Follow id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $follow = $this->Follows->get($id, contain: ['Users']);
        $this->set(compact('follow'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $follow = $this->Follows->newEmptyEntity();
        if ($this->request->is('post')) {
            $follow = $this->Follows->patchEntity($follow, $this->request->getData());
            if ($this->Follows->save($follow)) {
                $this->Flash->success(__('The follow has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The follow could not be saved. Please, try again.'));
        }
        $users = $this->Follows->Users->find('list', limit: 200)->all();
        $this->set(compact('follow', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Follow id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $follow = $this->Follows->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $follow = $this->Follows->patchEntity($follow, $this->request->getData());
            if ($this->Follows->save($follow)) {
                $this->Flash->success(__('The follow has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The follow could not be saved. Please, try again.'));
        }
        $users = $this->Follows->Users->find('list', limit: 200)->all();
        $this->set(compact('follow', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Follow id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $follow = $this->Follows->get($id);
        if ($this->Follows->delete($follow)) {
            $this->Flash->success(__('The follow has been deleted.'));
        } else {
            $this->Flash->error(__('The follow could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Permet aux utilisateurs non connectés d’accéder à certaines actions
        $this->Authentication->allowUnauthenticated(['login', 'register']);

        // Charge l’utilisateur authentifié pour l’Authorization
        $this->Authorization->authorizeModel($this->Users);
    }
}
