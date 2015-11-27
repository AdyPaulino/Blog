<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $user = $this->Auth->user();
        if (parent::isAuthorized($user)) {
            $comments = $this->Comments->find('all')->contain(['Articles']);      
        } else {
           $comments = $this->Comments->find('all')->contain(['Articles'])->where(['approved' => 1]);
        }
         $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Articles']
        ]);
        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            
            if ($id != null){
                $comment->article_id = $id;
                if ($this->Comments->save($comment)) {
                    $this->Flash->success(__('Your comment has been saved.'));
                    return $this->redirect(['action' => 'index', 'controller'=>'articles']);
                }
            } else {
                $this->Flash->error(__('Unable to add your comment. You should try to add a comment via Article'));
                 return $this->redirect(['action' => 'index', 'controller'=>'articles']);
            }
            $this->Flash->error(__('Unable to add your comment.'));
        }
        $this->set('comment', $comment);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id);
        $user = $this->Auth->user();
        if (parent::isAuthorized($user)) {
            if ($this->request->is(['post', 'put'])) {
                $this->Comments->patchEntity($comment, $this->request->data);

                if ($this->Comments->save($comment)) {
                    $this->Flash->success(__('Your comment has been updated.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Unable to update your comment.'));
            }
        }

        $this->set('comment', $comment);
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user)
    {

         // All registered users can add comments
        if ($this->request->action === 'add') {
            return true;
        }
        
        return parent::isAuthorized($user);
    }
}
