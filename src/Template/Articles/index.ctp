<!-- File: src/Template/Articles/index.ctp -->

<h1>Blog articles</h1>
<p><?= $this->Html->link('Add Article', ['action' => 'add']) ?></p> <p><?= $this->Html->link('Logout', ['controller'=> 'users','action' => 'logout']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>Author</th>
        <th>Actions</th>
    </tr>

<!-- Here's where we loop through our $articles query object, printing out article info -->

    <?php foreach ($articles as $article): ?>
    <tr>
        <td><?= $article->id ?></td>
        <td>
            <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
        </td>
        <td>
            <?= $article->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $article->author->username ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $article->id],
                ['confirm' => 'Are you sure?'])
            ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $article->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<h1>Articles by Tags</h1>
<table>
    <tr>
        <th>Tag</th>
    </tr>

<?php foreach ($tags as $tag): ?>
    <tr>
        <td>
            <?= $this->Html->link($tag->description, ['controller'=> 'tags', 'action' => 'display', $tag->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>