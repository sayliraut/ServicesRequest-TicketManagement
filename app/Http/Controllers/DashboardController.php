<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
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
        ];

        // consolidate ticket counts in one query
        $ticketSummary = Ticket::selectRaw(
            "COUNT(*) as total, \
             SUM(status = 'open') as open, \
             SUM(status = 'in_progress') as in_progress, \
             SUM(status = 'closed') as closed"
        )->first();

        $stats['total_tickets'] = $ticketSummary->total;
        $stats['open_tickets'] = $ticketSummary->open;
        $stats['in_progress_tickets'] = $ticketSummary->in_progress;
        $stats['closed_tickets'] = $ticketSummary->closed;

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
