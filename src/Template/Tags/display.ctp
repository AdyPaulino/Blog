<!-- File: src/Template/Tags/display.ctp -->

<h1>Blog articles with tag: <?= $tag->description?></h1>
<p><?= $this->Html->link('Logout', ['controller'=> 'users','action' => 'logout']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>Author</th>
    </tr>

<!-- Here's where we loop through our $articles query object, printing out article info -->

    <?php foreach ($articles as $article): ?>
    <tr>
        <td><?= $article->id ?></td>
        <td>
            <?= $article->title ?>
        </td>
        <td>
            <?= $article->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $article->author->username ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>