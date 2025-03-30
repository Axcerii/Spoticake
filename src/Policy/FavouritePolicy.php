<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Favourite;
use Authorization\IdentityInterface;

/**
 * Favourite policy
 */
class FavouritePolicy
{
    /**
     * Check if $user can add Favourite
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Favourite $favourite
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Favourite $favourite)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can edit Favourite
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Favourite $favourite
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Favourite $favourite)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can delete Favourite
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Favourite $favourite
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Favourite $favourite)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can view Favourite
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Favourite $favourite
     * @return bool
     */
    public function canView(IdentityInterface $user, Favourite $favourite)
    {
        return $user->role === 'admin';
    }

    public function canToggle(IdentityInterface $user, Favourite $favourite) {
        return true;
    }
    
}
