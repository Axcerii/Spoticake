<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Album Entity
 *
 * @property int $id
 * @property string $title
 * @property \Cake\I18n\Date $published
 * @property string $genre
 * @property int $image_id
 * @property bool $visibility
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Image $image
 * @property \App\Model\Entity\Music[] $musics
 * @property \App\Model\Entity\Request[] $requests
 */
class Album extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'title' => true,
        'published' => true,
        'genre' => true,
        'image_id' => true,
        'visibility' => true,
        'created' => true,
        'modified' => true,
        'image' => true,
        'musics' => true,
        'spotify_id'=> true,
        'artist_id' => true
    ];
}
