<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        // Semua user bisa melihat daftar campaign
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Campaign $campaign)
    {
        // Semua pengunjung, termasuk yang belum login bisa melihat detail campaign
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        // Hanya user yang sudah login yang bisa membuat campaign
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Campaign $campaign)
    {
        // Super admin (admin pertama) dapat mengubah semua campaign
        if ($user->isSuperAdmin()) {
            return true;
        }
        
        // Admin biasa juga dapat mengubah semua campaign
        if ($user->isAdmin()) {
            return true;
        }
        
        // Pemilik campaign dapat mengubah campaign miliknya
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Campaign $campaign)
    {
        // Super admin (admin pertama) dapat menghapus semua campaign
        if ($user->isSuperAdmin()) {
            return true;
        }
        
        // Admin biasa dapat menghapus campaign jika tidak ada donasi
        if ($user->isAdmin()) {
            return $campaign->donations()->count() === 0;
        }
        
        // Pemilik campaign dapat menghapus campaign miliknya jika tidak ada donasi
        return $user->id === $campaign->user_id && $campaign->donations()->count() === 0;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Campaign $campaign)
    {
        // Super admin (admin pertama) dapat mengembalikan semua campaign
        if ($user->isSuperAdmin()) {
            return true;
        }
        
        // Admin biasa juga dapat mengembalikan semua campaign
        if ($user->isAdmin()) {
            return true;
        }
        
        // Pemilik campaign dapat mengembalikan campaign miliknya
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Campaign $campaign)
    {
        // Hanya super admin (admin pertama) yang dapat menghapus secara permanen
        if ($user->isSuperAdmin()) {
            return true;
        }
        
        // Admin biasa hanya bisa menghapus secara permanen jika tidak ada donasi
        if ($user->isAdmin()) {
            return $campaign->donations()->count() === 0;
        }
        
        // Pemilik tidak dapat menghapus secara permanen
        return false;
    }

    /**
     * Determine whether the user can change status of the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function changeStatus(User $user, Campaign $campaign)
    {
        // Hanya pemilik campaign yang bisa mengubah status
        return $user->id === $campaign->user_id;
    }
}
