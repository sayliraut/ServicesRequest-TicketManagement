<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Show the form for creating a new service request
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created service request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subject' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:5000',
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'status' => Ticket::STATUS_OPEN,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Service request created successfully!',
                'ticket_id' => $ticket->id,
            ], 201);
        }

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Service request created successfully!');
    }

    /**
     * Display the user's service requests
     */
    public function index()
    {
        $tickets = Auth::user()->tickets()
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Display a single service request
     */
    public function show(Ticket $ticket)
    {
        // Ensure user owns this ticket or is admin/agent
        if (Auth::id() !== $ticket->user_id && !in_array(Auth::user()->role, ['admin', 'agent'])) {
            abort(403, 'Unauthorized');
        }

        $ticket->load('category', 'comments.user', 'agent');
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Admin: Display all service requests for management
     */
    public function adminIndex()
    {
        $this->authorizeAdmin();

        $tickets = Ticket::with('user', 'category', 'agent')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $stats = [
            'open' => Ticket::where('status', Ticket::STATUS_OPEN)->count(),
            'in_progress' => Ticket::where('status', Ticket::STATUS_IN_PROGRESS)->count(),
            'closed' => Ticket::where('status', Ticket::STATUS_CLOSED)->count(),
            'total' => Ticket::count(),
        ];

        return view('tickets.admin-index', compact('tickets', 'stats'));
    }

    /**
     * Admin: Update ticket status and assign agent
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', [
                Ticket::STATUS_OPEN,
                Ticket::STATUS_IN_PROGRESS,
                Ticket::STATUS_CLOSED,
            ]),
            'agent_id' => 'nullable|exists:users,id',
            'note' => 'nullable|string|max:1000',
        ]);

        $ticket->update([
            'status' => $validated['status'],
            'agent_id' => $validated['agent_id'] ?? $ticket->agent_id,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Ticket updated successfully!',
                'ticket' => $ticket,
            ]);
        }

        return redirect()->back()->with('success', 'Ticket updated successfully!');
    }

    /**
     * Check if user is admin/agent
     */
    private function authorizeAdmin()
    {
        if (!Auth::user() || !in_array(Auth::user()->role, ['admin', 'agent'])) {
            abort(403, 'Only admins/agents can access this');
        }
    }
}
