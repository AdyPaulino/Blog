<!-- File: src/Template/Tags/index.ctp -->

<h1>Blog tags</h1>
<p><?= $this->Html->link('Add Tag', ['action' => 'add']) ?></p><p><?= $this->Html->link('Logout', ['controller'=> 'users','action' => 'logout']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

<!-- Here's where we loop through our $tags query object, printing out tag info -->

    <?php foreach ($tags as $tag): ?>
    <tr>
        <td><?= $tag->id ?></td>
        <td>
            <?= $this->Html->link($tag->description, ['action' => 'view', $tag->id]) ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $tag->id],
                ['confirm' => 'Are you sure?'])
            ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $tag->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>