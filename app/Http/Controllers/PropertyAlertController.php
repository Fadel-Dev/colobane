<?php

namespace App\Http\Controllers;

use App\Models\PropertyAlert;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PropertyAlertController extends Controller
{
    public function index()
    {
        return Inertia::render('Profile/Alerts', [
            'alerts' => auth()->user()->propertyAlerts()->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'nullable|string',
            'region' => 'nullable|string',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
        ]);

        auth()->user()->propertyAlerts()->create($validated);

        return back()->with('message', 'Alerte configurée avec succès !');
    }

    public function destroy(PropertyAlert $alert)
    {
        if ($alert->user_id !== auth()->id()) {
            abort(403);
        }

        $alert->delete();

        return back()->with('message', 'Alerte supprimée.');
    }

    public function toggle(PropertyAlert $alert)
    {
        if ($alert->user_id !== auth()->id()) {
            abort(403);
        }

        $alert->update(['is_active' => !$alert->is_active]);

        return back();
    }
}
