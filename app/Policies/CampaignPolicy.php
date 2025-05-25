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
        // Hanya pemilik campaign yang bisa mengubah campaign
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
        // Hanya pemilik campaign yang bisa menghapus campaign
        // Tambahkan kondisi jika campaign dalam keadaan tertentu tidak boleh dihapus
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
        // Jika menggunakan soft delete, tentukan siapa yang bisa mengembalikan campaign yang terhapus
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
        // Jika menggunakan soft delete, tentukan siapa yang bisa menghapus campaign secara permanen
        return $user->id === $campaign->user_id && $user->isAdmin();
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
