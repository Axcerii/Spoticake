<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Musics Controller
 *
 * @property \App\Model\Table\MusicsTable $Musics
 */
class MusicsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Musics->find()
            ->contain(['Albums']);
        $musics = $this->paginate($query);
        $this->set(compact('musics'));
    }

    /**
     * View method
     *
     * @param string|null $id Music id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $music = $this->Musics->get($id, contain: ['Albums']);
        $this->set(compact('music'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $music = $this->Musics->newEmptyEntity();
        $this->Authorization->authorize($music);
        if ($this->request->is('post')) {
            $music = $this->Musics->patchEntity($music, $this->request->getData());
            if ($this->Musics->save($music)) {
                $this->Flash->success(__('The music has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The music could not be saved. Please, try again.'));
        }
        $albums = $this->Musics->Albums->find('list', limit: 200)->all();
        $this->set(compact('music', 'albums'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Music id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $music = $this->Musics->get($id, contain: []);
        $this->Authorization->authorize($music);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $music = $this->Musics->patchEntity($music, $this->request->getData());
            if ($this->Musics->save($music)) {
                $this->Flash->success(__('The music has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The music could not be saved. Please, try again.'));
        }
        $albums = $this->Musics->Albums->find('list', limit: 200)->all();
        $this->set(compact('music', 'albums'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Music id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $music = $this->Musics->get($id);
        $this->Authorization->authorize($music);
        if ($this->Musics->delete($music)) {
            $this->Flash->success(__('The music has been deleted.'));
        } else {
            $this->Flash->error(__('The music could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Permet aux utilisateurs non connectés d’accéder à certaines actions
        $this->Authentication->allowUnauthenticated(['index', 'view']);

        $this->Authorization->skipAuthorization();
    }
}
