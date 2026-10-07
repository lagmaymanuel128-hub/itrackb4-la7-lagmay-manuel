<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DishController extends Controller
{
    // Part A: reads the dishes from the JSON file (instead of a written-out array)
    private function getDishes()
    {
        return json_decode(file_get_contents(storage_path('app/dishes.json')), true);
    }

    // Part A: writes the dishes array back to the JSON file
    private function saveDishes(array $dishes)
    {
        file_put_contents(
            storage_path('app/dishes.json'),
            json_encode($dishes, JSON_PRETTY_PRINT)
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = $this->getDishes();
        return view('dishes.index', ['dishes' => $dishes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Part C: validate first. If a rule fails, Laravel stops here
        // and sends the visitor back to the form with the errors.
        $validated = $request->validate([
            'name'            => 'required|max:100',
            'main_ingredient' => 'required|max:150',
            'origin'          => 'required|in:Naga City,Camarines Sur,Albay,Camarines Norte',
        ]);

        // Part B: add the new dish with the next free id, then save the file
        $dishes = $this->getDishes();
        $newId = empty($dishes) ? 1 : max(array_keys($dishes)) + 1;
        $dishes[$newId] = $validated;
        $this->saveDishes($dishes);

        // Part E: redirect to a route name (not a view) with a one-time message
        return redirect()->route('dishes.index')->with('success', 'Dish added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dishes = $this->getDishes();
        if (!isset($dishes[$id])) {
            abort(404);
        }
        return view('dishes.show', ['dish' => $dishes[$id], 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Extra method (not one of the seven): featured dish.
     */
    public function featured()
    {
        $dishes = $this->getDishes();
        return view('dishes.show', ['dish' => $dishes[1], 'id' => 1]);
    }

    /**
     * Extra method (not one of the seven): filter dishes by origin.
     */
    public function filter($origin = null)
    {
        $dishes = $this->getDishes();
        if ($origin !== null) {
            $filtered = [];
            foreach ($dishes as $id => $dish) {
                if ($dish['origin'] === $origin) {
                    $filtered[$id] = $dish;
                }
            }
            $dishes = $filtered;
        }
        return view('dishes.filter', ['dishes' => $dishes, 'origin' => $origin]);
    }
}