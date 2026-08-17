<?php

namespace App\Http\Controllers;

use App\Enums\IncidentStatusEnum;
use App\Models\Category;
use App\Models\Incident;
use App\Models\SummarizedIncident;
use Illuminate\Http\Request;
use App\Services\OpenAIService;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Incident::all();
        //$categories = $query->latest()->paginate(10);
        return view('incidents/index', compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('incidents/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, OpenAIService $openAIService)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            //'category_id' => 'required|exists:categories,id',
            'proofs.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp4,mov',
        ]);

        $incident = Incident::create([
            'title' => $request->title,
            'description' => $request->description,
            'date_reported' => now(),
            'status' => IncidentStatusEnum::PENDING,
            //'user_id' => auth()->id(),
            //'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('proofs')) {
            foreach ($request->file('proofs') as $file) {

                $path = $file->store('proofs', 'public');

                $incident->proofs()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getMimeType(),
                    'file_path' => $path,
                ]);
            }
        }

        $aiResult = $openAIService->analyzeIncident(
            $incident->title,
            $incident->description
        );

        $category = Category::where('name', $aiResult['category'])->first();

        $incident->update([
            'category_id' => $category->id,
        ]);

        SummarizedIncident::create([
            'incident_id' => $incident->id,
            'generated_summary' => $aiResult['summary'],
            'predicted_category_id' => $category?->id,
        ]);

        return redirect()->route('incidents.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Incident $incident)
    {
        $incident->load('summarizedIncident');
        return view('incidents/show', compact('incident'));
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
}
