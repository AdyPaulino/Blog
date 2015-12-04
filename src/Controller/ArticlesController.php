<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $articles = $this->Articles->find('all')->contain(['Authors', 'Comments', 'Tags']);        
        $this->set(compact('articles'));
        
        //Tags
        $query = $this->Articles->find()->contain(['Tags']);
        $reducer = function ($output, $value) {
            //if there are tags
            if (isSet($value[0]->id)){
                //leave only one of each
                if (!in_array($value[0], $output)) {
                    $output[] = $value[0];
                }
            }
            return $output;
        };

        //removing tags from Articles
        $uniqueTags = $query->all()
            ->extract('tags')
            ->reduce($reducer, []);
        
        $this->set('tags', $uniqueTags); 
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        
        //only admin can see all the comments
        $user = $this->Auth->user();
        if (parent::isAuthorized($user)) {
        
            $article = $this->Articles->get($id, [
                'contain' => ['Authors', 'Comments', 'Tags']
            ]);
        } else {
            $article = $this->Articles->get($id, [
            'contain' => ['Authors', 'Tags', 'Comments' => function ($q) {
               return $q
                    ->select(['body', 'article_id', 'title', 'id'])
                    ->where(['Comments.approved' => true]);
                }]
            ]);
        }
        
        $this->set('article', $article);
        $this->set('_serialize', ['article']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            // Added this line
            $article->user_id = $this->Auth->user('id');
            
            if ($this->Articles->save($article)) {
                
                foreach ($this->request->data['tags'] as $value) { 
                    $tag2 = $this->Articles->Tags->findById($value)->first();
                    $this->Articles->Tags->link($article, [$tag2]);
                }
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.')); 
        }
        
        //Tags
        $this->loadModel('Tags');
        $tags = $this->Tags->find('all');
        
        $tagArray = array();
        
        foreach ($tags as $key => $value) { 
            $tagArray[$value['id']] = $value['description'];
        }
        
        $this->set('tags', $tagArray); 
        
        $this->set('article', $article);
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
                'contain' => ['Authors', 'Comments', 'Tags']
        ]);
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->data);
            $article->user_id = $this->Auth->user('id');
            if ($this->Articles->save($article)) {
                
                 foreach ($this->request->data['tags'] as $value) { 
                    $tag2 = $this->Articles->Tags->findById($value)->first();
                    $this->Articles->Tags->link($article, [$tag2]);
                }
                
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }
        
         //All Tags
        $this->loadModel('Tags');
        $tags = $this->Tags->find('all');
        
        $tagArray = array();
        
        foreach ($tags as $key => $value) { 
            $tagArray[$value['id']] = $value['description'];
        }
        
        $this->set('tags', $tagArray); 
        
        //Selected tags
        
        $selectedTags = array();
        foreach ($article->tags as $value) { 
            $selectedTags[] = $value['id'];
        }
        
        $this->set('selectedTags', $selectedTags);

        $this->set('article', $article);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if ($this->request->action === 'add') {
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $articleId = (int)$this->request->params['pass'][0];
            if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
