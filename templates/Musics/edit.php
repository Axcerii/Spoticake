<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Music $music
 * @var string[]|\Cake\Collection\CollectionInterface $albums
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $music->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $music->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Musics'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="musics form content">
            <?= $this->Form->create($music) ?>
            <fieldset>
                <legend><?= __('Edit Music') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('duration');
                    echo $this->Form->control('spotify_id');
                    echo $this->Form->control('album_id', ['options' => $albums]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
