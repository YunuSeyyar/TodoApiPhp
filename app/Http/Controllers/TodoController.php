<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $todo = Todo::create($validated);
        return response($todo);
    }

    // (R)Tüm Todoları Listeleme
    public function index()
    {
        $todos = Todo::get();
        return response()->json($todos);
    }

    // (U)Todo Güncelleme
    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id); // 2 sorgu 1. var mı? 2. çekmek
        //$todo = Todo::where('completed', 1)->get();

        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $todo->update($validated); // 3. sorgu

        /*
        $todo->update([
            "name" => $request->name
        ]);
        */


        /*

            Todo::where('id', $id)->update(...);
        */
        return response()->json($todo);
    }

    public function delete($id){

    }

    // (D)Todo Silme
    public function destroy($id)
    {
        $todo = Todo::find($id);
    if ($todo) {
        $todo->delete();
        return response()->json($todo);
    }
    return response()->json(404);
    }

    public function restore($id)
    {
        $todo = Todo::withTrashed()->find($id);
    if ($todo) {
        $todo->restore();
        return response()->json($todo);
    }
    return response()->json(404);
    }

}
