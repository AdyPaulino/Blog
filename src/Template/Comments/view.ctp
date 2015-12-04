<!-- File: src/Template/Comments/view.ctp -->

<h1><?= h($comment->title) ?></h1>
<p><?= h($comment->body) ?></p>
<p>Article title: <?= $comment->article->title ?></p>