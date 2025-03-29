<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Artist;
use Authorization\IdentityInterface;

/**
 * Artist policy
 */
class ArtistPolicy
{
    /**
     * Check if $user can add Artist
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Artist $artist
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Artist $artist)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can edit Artist
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Artist $artist
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Artist $artist)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can delete Artist
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Artist $artist
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Artist $artist)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can view Artist
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Artist $artist
     * @return bool
     */
    public function canView(IdentityInterface $user, Artist $artist)
    {
        return true;
    }
}
