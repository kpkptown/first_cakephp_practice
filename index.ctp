<?php
$this->assign('title','Blog Posts');
?>

<h1>
    Blog Posts
</h1>
<h4>
<?= $this->Html->link('Add New',['action'=>'add']); ?>
</h4>
<ul>
    <?php foreach ($posts as $post) : ?>
        <li>
            <?= $this->Html->link($post->title,['action'=>'view',$post->id]); ?>
            <?= $this->Html->link('[Edit]',['action'=>'edit',$post->id]); ?>
            <?=
                $this->Form->postLink(
                    '[delete]',
                    ['action'=>'delete',$post->id],
                    ['confirm'=>'Are you sure?']
                );
            ?>
        </li>

    <?php endforeach; ?>
</ul>