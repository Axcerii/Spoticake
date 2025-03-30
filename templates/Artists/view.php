<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Artist $artist
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Artist'), ['action' => 'edit', $artist->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Artist'), ['action' => 'delete', $artist->id], ['confirm' => __('Are you sure you want to delete # {0}?', $artist->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Artists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Artist'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="artists view content">
            <h3><?= h($artist->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($artist->name) ?></td>
                </tr>
                <tr>
                    <th> Favourites </th>
                        <td>
                        <?= $this->Html->link(
                                $liked ? '❤️ Unlike' : '🤍 Like',
                                ['controller' => 'Favorites', 'action' => 'toggle', $artist->id, 'artist'],
                                ['class' => 'btn btn-sm ' . ($liked ? 'btn-danger' : 'btn-outline-danger')]
                            ); 
                        ?>
                        </td>
                    </th>
                </tr>   
                <tr>
                    <th><?= __('Twitter') ?></th>
                    <td><?= h($artist->twitter) ?></td>
                </tr>
                <tr>
                    <th><?= __('Facebook') ?></th>
                    <td><?= h($artist->facebook) ?></td>
                </tr>
                <tr>
                    <th><?= __('Instagram') ?></th>
                    <td><?= h($artist->instagram) ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= $artist->hasValue('image') ? $this->Html->link($artist->image->url, ['controller' => 'Images', 'action' => 'view', $artist->image->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($artist->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($artist->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($artist->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Bio') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($artist->bio)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Requests') ?></h4>
                <?php if (!empty($artist->requests)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Artist Id') ?></th>
                            <th><?= __('Album Id') ?></th>
                            <th><?= __('State') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($artist->requests as $request) : ?>
                        <tr>
                            <td><?= h($request->id) ?></td>
                            <td><?= h($request->user_id) ?></td>
                            <td><?= h($request->artist_id) ?></td>
                            <td><?= h($request->album_id) ?></td>
                            <td><?= h($request->state) ?></td>
                            <td><?= h($request->description) ?></td>
                            <td><?= h($request->created) ?></td>
                            <td><?= h($request->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Requests', 'action' => 'view', $request->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Requests', 'action' => 'edit', $request->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Requests', 'action' => 'delete', $request->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $request->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>