<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Artist $artist
 * @var \Cake\Collection\CollectionInterface|string[] $images
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Artists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="artists form content">
            <?= $this->Form->create($artist) ?>
            <fieldset>
                <legend><?= __('Add Artist') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('bio');
                    echo $this->Form->control('twitter');
                    echo $this->Form->control('facebook');
                    echo $this->Form->control('instagram');
                    echo $this->Form->control('image_id', ['options' => $images]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
