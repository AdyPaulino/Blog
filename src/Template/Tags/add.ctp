<!-- File: src/Template/Tags/add.ctp -->

<h1>Add Tag</h1>
<?php
    echo $this->Form->create($tag);
    echo $this->Form->input('description');
    echo $this->Form->button(__('Save Tag'));
    echo $this->Form->end();
?>