<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 */
class TagsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $tags = $this->Tags->find('all');      
        $this->set(compact('tags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => ['Articles']
        ]);
        $this->set('tag', $tag);
        $this->set('_serialize', ['tag']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tag = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->data);

            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('Your tag has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your tag.'));
        }
        $this->set('tag', $tag);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tag = $this->Tags->get($id);
        $user = $this->Auth->user();
        if (parent::isAuthorized($user)) {
            if ($this->request->is(['post', 'put'])) {
                $this->Tags->patchEntity($tag, $this->request->data);

                if ($this->Tags->save($tag)) {
                    $this->Flash->success(__('Your tag has been updated.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Unable to update your tag.'));
            }
        }

        $this->set('tag', $tag);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user)
    {
        
        return parent::isAuthorized($user);
    }
    
    public function display($id = null)
    {
        //Tag
        $tag = $this->Tags->get($id);
        $this->set('tag', $tag);
        $this->set('_serialize', ['tag']);
        
        //Articles
        $this->loadModel('Articles');
        $query = $this->Articles->find()->contain(['Authors']);
        $query->matching('Tags', function ($q) use ($id) {
            return $q->where(['Tags.id' => $id]);
        });
        
        $this->set('articles', $query->toArray()); 
    }
}
