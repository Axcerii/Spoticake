<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Artists Controller
 *
 * @property \App\Model\Table\ArtistsTable $Artists
 */
class ArtistsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Artists->find();
        $artists = $this->paginate($query);

        $this->Authorization->skipAuthorization();

        $this->set(compact('artists'));
    }

    /**
     * View method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $artist = $this->Artists->get($id, contain: ['Requests', 'Images', 'Albums']);

        $user = $this->Authentication->getIdentity();
        $liked = false;

        if ($user) {
            $favoritesTable = $this->fetchTable('Favorites');
            $liked = $favoritesTable->exists([
                'user_id' => $user->id,
                'post_id' => $artist->id,
                'entity_type' => 'artist'
            ]);
        }

        $this->set(compact('artist', 'liked'));
    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $artist = $this->Artists->newEmptyEntity();
        $user = $this->request->getAttribute('identity');
        if ($this->request->is('post')) {
            $artist = $this->Artists->patchEntity($artist, $this->request->getData());
            if ($this->Artists->save($artist)) {
                $this->Flash->success(__('The artist has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The artist could not be saved. Please, try again.'));
        }
        $images = $this->Artists->Images->find('list', limit: 200)->all();
        $this->set(compact('artist', 'images'));
        $this->Authorization->authorize($artist);
    }

    /**
     * Edit method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $artist = $this->Artists->get($id, contain: []);
        $user = $this->request->getAttribute('identity');
        $this->Authorization->authorize($artist);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $artist = $this->Artists->patchEntity($artist, $this->request->getData());
            if ($this->Artists->save($artist)) {
                $this->Flash->success(__('The artist has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The artist could not be saved. Please, try again.'));
        }
        $images = $this->Artists->Images->find('list', limit: 200)->all();
        $this->set(compact('artist', 'images'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $artist = $this->Artists->get($id);

        $user = $this->request->getAttribute('identity');

        $this->Authorization->authorize($artist);
        
        if ($this->Artists->delete($artist)) {
            $this->Flash->success(__('The artist has been deleted.'));
        } else {
            $this->Flash->error(__('The artist could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Permet aux utilisateurs non connectés d’accéder à certaines actions
        $this->Authentication->allowUnauthenticated(['view', 'index']);

        // Charge l’utilisateur authentifié pour l’Authorization
        $this->Authorization->skipAuthorization();
    }
}
