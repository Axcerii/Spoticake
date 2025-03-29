<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 * @var string[]|\Cake\Collection\CollectionInterface $images
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $album->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $album->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Albums'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="albums form content">
            <?= $this->Form->create($album) ?>
            <fieldset>
                <legend><?= __('Edit Album') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('spotify_id');
                    echo $this->Form->control('published');
                    echo $this->Form->control('artist_id', ['options' => $artists]);
                    echo $this->Form->control('genre');
                    echo $this->Form->control('image_id', ['options' => $images]);
                    echo $this->Form->control('visibility');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
