<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MemberController extends Controller
{
    /**
     * Admin: List all members
     */
    public function index()
    {
        return Inertia::render('Admin/AdminMembers', [
            'members' => Member::latest()->get()
        ]);
    }

    /**
     * Admin: Store new member
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:members,phone',
            'points' => 'nullable|integer|min:0'
        ]);

        $member = Member::create($validated);

        return response()->json([
            'success' => true,
            'member' => $member
        ]);
    }

    /**
     * Admin: Update member details or points
     */
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|unique:members,phone,' . $id,
            'points' => 'nullable|integer'
        ]);

        $member->update($validated);

        return response()->json([
            'success' => true,
            'member' => $member
        ]);
    }

    /**
     * Admin: Redeem free menu (9 points each)
     */
    public function redeem(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $request->validate([
            'count' => 'required|integer|min:1'
        ]);

        $deductPoints = $request->count * 9;

        if ($member->points < $deductPoints) {
            return response()->json([
                'success' => false,
                'message' => 'Poin tidak cukup untuk redeem.'
            ], 422);
        }

        $member->decrement('points', $deductPoints);

        return response()->json([
            'success' => true,
            'member' => $member
        ]);
    }

    /**
     * Admin: Delete member
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Public/Public Search: Find member by phone
     */
    public function search(Request $request)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        $member = Member::where('phone', $request->phone)->first();

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Member tidak ditemukan.'
            ], 44);
        }

        return response()->json([
            'success' => true,
            'member' => $member
        ]);
    }
}
