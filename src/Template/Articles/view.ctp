<!-- File: src/Template/Articles/view.ctp -->

<p><?= $this->Html->link('Add Comment', ['action' => 'add', 'controller'=>'Comments', $article->id]) ?></p>

<h1><?= h($article->title) ?></h1>
<p><?= h($article->body) ?></p>
<p>Author: <?= $article->author->username ?></p>
<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>

<h2>Comments</h2>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Comment</th>
    </tr>

<?php foreach ($article->comments as $comment): ?>
    <tr>
        <td><?= $comment->id ?></td>
        <td>
            <?= $comment->title ?>
        </td>
        <td>
            <?= $comment->body ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>

<h2>Tags</h2>

<table>
    <tr>
        <th>Description</th>
    </tr>

<?php foreach ($article->tags as $tag): ?>
    <tr>
        <td>
            <?= $tag->description ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>