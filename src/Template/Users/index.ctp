<!-- File: src/Template/Users/index.ctp -->

<h1>Blog users</h1>
<p><?= $this->Html->link('Add User', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>

<!-- Here's where we loop through our $users query object, printing out user info -->

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user->id ?></td>
        <td>
            <?= $this->Html->link($user->username, ['action' => 'view', $user->id]) ?>
        </td>
        <td>
            <?= $user->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $user->id],
                ['confirm' => 'Are you sure?'])
            ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $user->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>