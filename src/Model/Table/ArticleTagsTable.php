<?php
namespace App\Model\Table;

use App\Model\Entity\Tag;
use App\Model\Entity\Article;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArticleTag Model
 *
 */
class ArticleTagsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Articles');
        $this->belongsTo('Tags');
    
    }
    
}
