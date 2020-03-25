<?php
// src/Controller/DomainsController.php

namespace App\Controller;
use Cake\ORM\TableRegistry;


class DomainsController extends AppController
{
    public function index()
    {

        $domains = TableRegistry::getTableLocator()->get('Domains');
        $query = $this->Domains->find();
        $this->set(compact('query'));


    }        
    /*
        $this->loadComponent('Paginator');
        $domains = $this->Paginator->paginate($this->Domains->find());
        $this->set(compact('domains'));
    */
    
    public function add()
    {
        $domain = $this->Domains->newEmptyEntity();
        if ($this->request->is('post')) {
            $domains = $this->Domains->patchEntity($domain, $this->request->getData());

            if ($this->Domains->save($domains)) {
                $this->Flash->success(__('New domain has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your domain.'));
        }
        $this->set('domain', $domain);
    }
    

}