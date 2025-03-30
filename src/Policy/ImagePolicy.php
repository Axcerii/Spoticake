<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Image;
use Authorization\IdentityInterface;

/**
 * Image policy
 */
class ImagePolicy
{
    /**
     * Check if $user can add Image
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Image $image
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Image $image)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can edit Image
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Image $image
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Image $image)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can delete Image
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Image $image
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Image $image)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can view Image
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Image $image
     * @return bool
     */
    public function canView(IdentityInterface $user, Image $image)
    {
        return $user->role === 'admin';
    }
}
