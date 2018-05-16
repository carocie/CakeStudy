<?php

namespace App\Controller;

class ArticlesController extends AppController{

    public function initialize(){
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function index(){
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }

    public function view($slug = null){
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }

    public function add(){
        $article = $this->Articles->newEntity();
        if($this->request->is('post')){
            $article = $this->Articles->patchEntity($article,$this->request->getData());
            
            //ひとまず決め打ち
            $article->user_id = 1;

            if($this->Articles->save($article)){
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article'));
        }
        $this->set('article',$article);
    }

    public function edit($slug){
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if($this->request->is(['post','put'])){
            $this->Articles->patchEntity($article,$this->request->getData());
            if($this->Articles->save($article)){
                $this->Flush->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flush->error(__('Unable to update your article'));
        }
        $this->set('article',$article);
    }

}
