<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Albums Controller
 *
 * @property \App\Model\Table\AlbumsTable $Albums
 */
class AlbumsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Albums->find();
        $albums = $this->paginate($query);

        $this->Authorization->skipAuthorization();

        $this->set(compact('albums'));
    }

    /**
     * View method
     *
     * @param string|null $id Album id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $album = $this->Albums->get($id, [
            'contain' => ['Musics'],
        ]);

        $user = $this->Authentication->getIdentity();
        $liked = false;

        if ($user) {
            $favoritesTable = $this->fetchTable('Favorites');
            $liked = $favoritesTable->exists([
                'user_id' => $user->id,
                'post_id' => $album->id,
                'entity_type' => 'album'
            ]);
        }

        $this->set(compact('album', 'liked'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $album = $this->Albums->newEmptyEntity();

        $user = $this->request->getAttribute('identity');
        $this->Authorization->authorize($album);
        

        if ($this->request->is('post')) {
            $album = $this->Albums->patchEntity($album, $this->request->getData());
            if ($this->Albums->save($album)) {
                $this->Flash->success(__('The album has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The album could not be saved. Please, try again.'));
        }
        $images = $this->Albums->Images->find('list', limit: 200)->all();
        $artists = $this->Albums->Artists->find('list')->all();

        $this->set(compact('album', 'images', 'artists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Album id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $album = $this->Albums->get($id, contain: []);

        $user = $this->request->getAttribute('identity');
        $this->Authorization->authorize($album);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $album = $this->Albums->patchEntity($album, $this->request->getData());
            if ($this->Albums->save($album)) {
                $this->Flash->success(__('The album has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The album could not be saved. Please, try again.'));
        }
        $images = $this->Albums->Images->find('list', limit: 200)->all();
        $artists = $this->Albums->Artists->find('list')->all();

        $this->set(compact('album', 'images', 'artists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Album id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $album = $this->Albums->get($id);

        $user = $this->request->getAttribute('identity');
        
        $this->Authorization->authorize($album);

        if ($this->Albums->delete($album)) {
            $this->Flash->success(__('The album has been deleted.'));
        } else {
            $this->Flash->error(__('The album could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Permet aux utilisateurs non connectés d’accéder à certaines actions
        $this->Authentication->allowUnauthenticated(['view', 'index']);

        $this->Authorization->skipAuthorization();
    }
}
