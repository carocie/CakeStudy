<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;

class ArticlesTable extends Table{
    public function initialize(array $config){
        $this->addBehavior('Timestamp');
    }

    public function beforeSave($event, $entity, $options){
        $sluggedTitle = Text::slug($entity->title);
        $entity->slug = substr($sluggedTitle,0,191);
        
    }
}

