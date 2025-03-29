<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Image $image
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Image'), ['action' => 'edit', $image->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Image'), ['action' => 'delete', $image->id], ['confirm' => __('Are you sure you want to delete # {0}?', $image->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Images'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Image'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="images view content">
            <h3><?= h($image->url) ?></h3>
            <table>
                <tr>
                    <th><?= __('Url') ?></th>
                    <td><?= h($image->url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($image->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($image->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($image->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Albums') ?></h4>
                <?php if (!empty($image->albums)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Published') ?></th>
                            <th><?= __('Genre') ?></th>
                            <th><?= __('Image Id') ?></th>
                            <th><?= __('Visibility') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($image->albums as $album) : ?>
                        <tr>
                            <td><?= h($album->id) ?></td>
                            <td><?= h($album->title) ?></td>
                            <td><?= h($album->published) ?></td>
                            <td><?= h($album->genre) ?></td>
                            <td><?= h($album->image_id) ?></td>
                            <td><?= h($album->visibility) ?></td>
                            <td><?= h($album->created) ?></td>
                            <td><?= h($album->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Albums', 'action' => 'view', $album->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Albums', 'action' => 'edit', $album->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Albums', 'action' => 'delete', $album->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $album->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Artists') ?></h4>
                <?php if (!empty($image->artists)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Bio') ?></th>
                            <th><?= __('Twitter') ?></th>
                            <th><?= __('Facebook') ?></th>
                            <th><?= __('Instagram') ?></th>
                            <th><?= __('Image Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($image->artists as $artist) : ?>
                        <tr>
                            <td><?= h($artist->id) ?></td>
                            <td><?= h($artist->name) ?></td>
                            <td><?= h($artist->bio) ?></td>
                            <td><?= h($artist->twitter) ?></td>
                            <td><?= h($artist->facebook) ?></td>
                            <td><?= h($artist->instagram) ?></td>
                            <td><?= h($artist->image_id) ?></td>
                            <td><?= h($artist->created) ?></td>
                            <td><?= h($artist->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Artists', 'action' => 'view', $artist->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Artists', 'action' => 'edit', $artist->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Artists', 'action' => 'delete', $artist->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $artist->id),
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