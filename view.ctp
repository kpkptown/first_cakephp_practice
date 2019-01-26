<?php
$this->assign('title','Blog Detail');
?>

<h1>
    <?= h($post->title); ?>
</h1>


<p><?= nl2br(h($post->body)); ?></p>

<?php if(count($post->comments)) : ?>
<h4>Comments <span>(<?= count($post->comments); ?>)</span></h4>
<ul>
<?php foreach($post->comments as $comment) : ?>
    <li>
        <?= h($comment->body); ?>        <!-- h()でHTMLエスケープ処理を行う：ユーザーが入力した値を表示したい時。 -->
        <?=
                $this->Form->postLink(
                    '[delete]',
                    ['controller'=>'Comments','action'=>'delete',$comment->id],
                    ['confirm'=>'Are you sure?']
                );
            ?>
    </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>


<h4>New Comment</h4>
<?= $this->Form->create(null,[
    'url' => ['controller'=>'Comments','action'=>'add']
]); ?>                                   <!--  create([モデル],[連想配列]) -->
<?= $this->Form->input('body'); ?>       <!-- フォームヘルパー -->
<?= $this->Form->hidden('post_id',['value'=>$post->id]); ?>
<?= $this->Form->button('Add'); ?>
<?= $this->Form->end(); ?>

<h5>
    <?= $this->Html->link('Back',['action'=>'index']); ?>
</h5>
