<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics
     */
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'total_categories' => Category::count(),
            'active_categories' => Category::where('is_active', 1)->count(),
            'total_tickets' => Ticket::count(),
            'open_tickets' => Ticket::where('status', 'open')->count(),
            'in_progress_tickets' => Ticket::where('status', 'in_progress')->count(),
            'closed_tickets' => Ticket::where('status', 'closed')->count(),
        ];

        // User-specific stats
        if (in_array($user->role, ['admin', 'agent'])) {
            $stats['assigned_tickets'] = Ticket::where('agent_id', $user->id)->count();
            $stats['unassigned_tickets'] = Ticket::whereNull('agent_id')->count();
        } else {
            $stats['my_tickets'] = Ticket::where('user_id', $user->id)->count();
            $stats['my_open_tickets'] = Ticket::where('user_id', $user->id)->where('status', 'open')->count();
        }

        return view('dashboard', compact('stats'));
    }
}
