<!-- File: src/Template/Comments/add.ctp -->

<h1>Add Comment</h1>
<?php
    echo $this->Form->create($comment);
    echo $this->Form->input('title');
    echo $this->Form->input('body', ['rows' => '3']);
    echo $this->Form->button(__('Save Comment'));
    echo $this->Form->end();
?>