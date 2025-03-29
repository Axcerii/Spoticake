<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Music $music
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Music'), ['action' => 'edit', $music->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Music'), ['action' => 'delete', $music->id], ['confirm' => __('Are you sure you want to delete # {0}?', $music->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Musics'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Music'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="musics view content">
            <h3><?= h($music->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($music->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Spotify Id') ?></th>
                    <td><?= h($music->spotify_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Album') ?></th>
                    <td><?= $music->hasValue('album') ? $this->Html->link($music->album->title, ['controller' => 'Albums', 'action' => 'view', $music->album->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($music->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Duration') ?></th>
                    <td><?= h($music->duration) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($music->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($music->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>