<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Album'), ['action' => 'edit', $album->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Album'), ['action' => 'delete', $album->id], ['confirm' => __('Are you sure you want to delete # {0}?', $album->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Albums'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Album'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="albums view content">
            <h3><?= h($album->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($album->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Genre') ?></th>
                    <td><?= h($album->genre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Artiste') ?></th>
                    <td> <?= h($album->artist->name) ?> </td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td> <img style="width: 25rem;" src="<?= h($album->image->url) ?>" alt="Album Cover"> </td>
                </tr>
                <tr>
                    <th><?= __('Spotify Id') ?></th>
                    <td>
                        <iframe style="border-radius:12px;" src="https://open.spotify.com/embed/album/<?= h($album->spotify_id) ?>?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($album->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Published') ?></th>
                    <td><?= h($album->published) ?></td>
                </tr>
                <tr>
                    <th> Favourites </th>
                        <td>
                        <?= $this->Html->link(
                                $liked ? '❤️ Unlike' : '🤍 Like',
                                ['controller' => 'Favorites', 'action' => 'toggle', $album->id, 'album'],
                                ['class' => 'btn btn-sm ' . ($liked ? 'btn-danger' : 'btn-outline-danger')]
                            ); 
                        ?>
                        </td>
                    </th>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($album->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($album->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visibility') ?></th>
                    <td><?= $album->visibility ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Musics') ?></h4>
                <?php if (!empty($album->musics)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Duration') ?></th>
                            <th><?= __('Spotify Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($album->musics as $music) : ?>
                        <tr>
                            <td><?= h($music->id) ?></td>
                            <td><?= h($music->title) ?></td>
                            <td><?= h($music->duration) ?></td>
                            <td><?= h($music->spotify_id) ?></td>
                            <td><?= h($music->album_id) ?></td>
                            <td><?= h($music->created) ?></td>
                            <td><?= h($music->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Musics', 'action' => 'view', $music->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Musics', 'action' => 'edit', $music->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Musics', 'action' => 'delete', $music->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $music->id),
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