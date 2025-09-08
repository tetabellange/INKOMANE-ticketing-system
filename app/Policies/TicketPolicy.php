<?php
namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

 
    public function view(User $user, Ticket $ticket)
    {
        
        if ($user->id === $ticket->customer_id) {
            return true;
        }

        
        if ($user->id === $ticket->agent_id) {
            return true;
        }

        
        if ($user->hasRole('Admin')) {
            return true;
        }

        return false; 
    }

    
    public function update(User $user, Ticket $ticket)
    {
        
        return $user->id === $ticket->agent_id || $user->hasRole('Admin');
    }
}
