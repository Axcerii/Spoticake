<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Favorites Controller
 *
 * @property \App\Model\Table\FavoritesTable $Favorites
 */
class FavoritesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Favorites->find()
            ->contain(['Users']);
        $favorites = $this->paginate($query);

        $this->set(compact('favorites'));
    }

    /**
     * View method
     *
     * @param string|null $id Favorite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $favorite = $this->Favorites->get($id, contain: ['Users']);
        $this->set(compact('favorite'));

        $this->Authorization->authorize($favorite);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $favorite = $this->Favorites->newEmptyEntity();

        $this->Authorization->authorize($favorite);

        if ($this->request->is('post')) {
            $favorite = $this->Favorites->patchEntity($favorite, $this->request->getData());
            if ($this->Favorites->save($favorite)) {
                $this->Flash->success(__('The favorite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The favorite could not be saved. Please, try again.'));
        }
        $users = $this->Favorites->Users->find('list', limit: 200)->all();
        $this->set(compact('favorite', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Favorite id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $favorite = $this->Favorites->get($id, contain: []);

        $this->Authorization->authorize($favorite);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $favorite = $this->Favorites->patchEntity($favorite, $this->request->getData());
            if ($this->Favorites->save($favorite)) {
                $this->Flash->success(__('The favorite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The favorite could not be saved. Please, try again.'));
        }
        $users = $this->Favorites->Users->find('list', limit: 200)->all();
        $this->set(compact('favorite', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Favorite id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $favorite = $this->Favorites->get($id);

        $this->Authorization->authorize($favorite);

        if ($this->Favorites->delete($favorite)) {
            $this->Flash->success(__('The favorite has been deleted.'));
        } else {
            $this->Flash->error(__('The favorite could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function toggle($entityId, $entityType)
    {
        $user = $this->Authentication->getIdentity();

        if (!$user) {
            $this->Flash->error(__('Vous devez être connecté pour liker.'));
            return $this->redirect($this->request->referer());
        }

        if (!in_array($entityType, ['album', 'artist'])) {
            $this->Flash->error(__('Type invalide.'));
            return $this->redirect($this->request->referer());
        }

        $favouritesTable = $this->fetchTable('Favorites');

        $favorite = $this->Favorites->find()
            ->where([
                'user_id' => $user->id,
                'post_id' => $entityId,
                'entity_type' => $entityType
            ])
            ->first();

        if ($favorite) {
            $this->Favorites->delete($favorite);
            $this->Flash->success(__('Vous n\'aimez plus cet ' . ($entityType === 'album' ? 'album' : 'artiste') . '.'));
        } else {
            $favorite = $this->Favorites->newEntity([
                'user_id' => $user->id,
                'post_id' => $entityId,
                'entity_type' => $entityType
            ]);
            $this->Favorites->save($favorite);
            $this->Flash->success(__('Vous aimez cet ' . ($entityType === 'album' ? 'album' : 'artiste') . ' !'));
        }

        return $this->redirect($this->request->referer());
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        

        $this->Authorization->skipAuthorization();
    }
}
