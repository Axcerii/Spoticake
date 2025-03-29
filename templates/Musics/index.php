<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Music> $musics
 */
?>
<div class="musics index content">
    <?= $this->Html->link(__('New Music'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Musics') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('duration') ?></th>
                    <th><?= $this->Paginator->sort('spotify_id') ?></th>
                    <th><?= $this->Paginator->sort('album_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($musics as $music): ?>
                <tr>
                    <td><?= $this->Number->format($music->id) ?></td>
                    <td><?= h($music->title) ?></td>
                    <td><?= h($music->duration) ?></td>
                    <td><?= h($music->spotify_id) ?></td>
                    <td><?= $music->hasValue('album') ? $this->Html->link($music->album->title, ['controller' => 'Albums', 'action' => 'view', $music->album->id]) : '' ?></td>
                    <td><?= h($music->created) ?></td>
                    <td><?= h($music->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $music->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $music->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $music->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $music->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>