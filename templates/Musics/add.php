<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Music $music
 * @var \Cake\Collection\CollectionInterface|string[] $albums
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Musics'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="musics form content">
            <?= $this->Form->create($music) ?>
            <fieldset>
                <legend><?= __('Add Music') ?></legend>
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
