<!-- File: src/Template/Comments/index.ctp -->

<h1>Blog comments</h1>
<p><?= $this->Html->link('Logout', ['controller'=> 'users','action' => 'logout']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Article</th>
        <th>Title</th>
        <th>Approved</th>
        <th>Actions</th>
    </tr>

<!-- Here's where we loop through our $comments query object, printing out comment info -->

    <?php foreach ($comments as $comment): ?>
    <tr>
        <td><?= $comment->id ?></td>
         <td>
            <?= $comment->article->title ?>
        </td>
        <td>
            <?= $this->Html->link($comment->title, ['action' => 'view', $comment->id]) ?>
        </td>
        <td>
            <?= $comment->approved ?>
        </td>
       
        <td>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $comment->id],
                ['confirm' => 'Are you sure?'])
            ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $comment->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>