<!-- File: src/Template/Articles/add.ctp -->

<h1>Add Article</h1>
<?php
    echo $this->Form->create($article);
    echo $this->Form->input('title');
    echo $this->Form->input('body', ['rows' => '3']);

    $toppings = ['Bacon' => 'Bacon', 
                 'Salami' => 'Salami', 
                 'Peperoni' => 'Peperoni', 
                 'Ham' => 'Ham', 
                 'ExtraCheese' => 'Extra Cheese', 
                 'Tomato' => 'Tomato', 
                 'Olives' => 'Olives', 
                 'Broccoli' => 'Broccoli', 
                 'GarlicSauce' => 'Garlic Sauce', 
                 'TomatoSauce' => 'Tomato Sauce'
                ];
    echo $this->Form->input('tags', 
                            array('label' => false,
                                'type' => 'select',
                                'multiple'=>'checkbox',
                                'options' => $toppings)
                                  ); 
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
?>