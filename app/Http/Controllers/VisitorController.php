<?php

namespace App\Http\Controllers;

use App\Models\visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $visitors = Visitor::orderBy('created_at', 'desc')
            ->paginate(20);

        return view('visitors/index', [
            'visitors' => $visitors
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('visitors/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'comments' => 'required'
        ]);

        $visitor = new Visitor;
        $visitor->user()->associate(Auth::user());
        $visitor->comments = $request->comments;
        $visitor->save();

        return redirect()->route('visitors.index')
            ->with('success','Signing created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor) {

        return view('visitors.show', [
            'visitor' => $visitor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor) {

        return view('visitors.edit', [
            'visitor' => $visitor
        ]);

    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor) {
        $request->validate([
            'comments' => 'required'
        ]);

        $user_id = Auth::id(); 

        if ($user_id != $visitor->user->id){
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $visitor->comments = $request->comments;
        $visitor->save();

        return redirect()->route('visitors.index')
            ->with('success', 'Signing updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor) {
        $visitor->delete();

        return redirect()->route('visitors.index')
            ->with('success', 'Signing deleted successfully');
    }
}
