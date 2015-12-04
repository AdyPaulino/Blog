<!-- File: src/Template/Articles/edit.ctp -->

<h1>Edit Article</h1>
<?php
    echo $this->Form->create($article);
    echo $this->Form->input('title');
    echo $this->Form->input('body', ['rows' => '3']);
?>
<h2>Tags</h2>
<?php
    echo $this->Form->input('tags', 
                            array('label' => false,
                                'type' => 'select',
                                'multiple'=>'checkbox',
                                'options' => $tags,
                                'value'=> $selectedTags)); 
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();

?>