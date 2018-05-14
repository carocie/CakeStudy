<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entiry{
    protected $_accessible =[
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}

