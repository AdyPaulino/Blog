<!-- File: src/Template/Comments/edit.ctp -->

<h1>Edit Comment</h1>
<?php
    echo $this->Form->create($comment);
    echo $this->Form->input('title');
    echo $this->Form->input('body', ['rows' => '3']);
    echo $this->Form->input('approved', array(
        'type' => 'checkbox',
        'between' => '<span>',
        'after' => '</span>'
    ));
    echo $this->Form->button(__('Save Comment'));
    echo $this->Form->end();
?>