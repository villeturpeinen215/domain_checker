<?php
// src/Model/Table/DomainsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class DomainsTable extends Table
{

    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }


}