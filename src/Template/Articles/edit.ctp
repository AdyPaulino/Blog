<!-- File: src/Template/Articles/edit.ctp -->

<h1>Edit Article</h1>
<?php
    echo $this->Form->create($article);
    echo $this->Form->input('title');
    echo $this->Form->input('body', ['rows' => '3']);

    //Tags
    foreach ($article->tags as $tag):
      echo $tag->description ;
    endforeach; 

    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
?>