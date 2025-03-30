<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Request> $requests
 */
?>
<div class="requests index content">
    <?= $this->Html->link(__('New Request'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Requests') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $request): ?>
                <tr>
                    <td><?= $this->Number->format($request->id) ?></td>
                    <td><?= $request->hasValue('user') ? $this->Html->link($request->user->name, ['controller' => 'Users', 'action' => 'view', $request->user->id]) : '' ?></td>
                    <td><?php if(h($request->state)){
                        echo '<span style="color:lime;"> Validée ! </span>';
                    }
                    else{
                        echo '<span style="color:red;"> En attente </span>';
                    } ?></td>
                    <td><?= h($request->created) ?></td>
                    <td><?= h($request->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $request->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $request->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $request->id),
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