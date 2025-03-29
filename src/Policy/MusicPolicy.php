<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Music;
use Authorization\IdentityInterface;

/**
 * Music policy
 */
class MusicPolicy
{
    /**
     * Check if $user can add Music
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Music $music
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Music $music)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can edit Music
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Music $music
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Music $music)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can delete Music
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Music $music
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Music $music)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can view Music
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Music $music
     * @return bool
     */
    public function canView(IdentityInterface $user, Music $music)
    {
        return true;
    }
}
