<!-- File: src/Template/Comments/edit.ctp -->

<h1>Edit Comment</h1>
<?php
    echo $this->Form->create($tag);
    echo $this->Form->input('description');
    echo $this->Form->button(__('Save Tag'));
    echo $this->Form->end();
?>