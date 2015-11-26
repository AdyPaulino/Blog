<!-- File: src/Template/Articles/view.ctp -->

<h1><?= h($article->title) ?></h1>
<p><?= h($article->body) ?></p>
<p><?= $article->author->username ?></p>
<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Body</th>
    </tr>

<?php foreach (debug($article->comment) as $comment): ?>
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