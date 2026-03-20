<?php

namespace App\Http\Controllers;

use App\Models\SurveyQuestion;
use Illuminate\Http\Request;

class SurveyQuestionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_id' => 'required|exists:survey_sections,id',
            'text_en' => 'required|string|max:1000',
            'text_th' => 'required|string|max:1000',
        ]);

        $nextOrder = SurveyQuestion::where('section_id', $validated['section_id'])
            ->max('sort_order') + 1;

        $question = SurveyQuestion::create([
            'section_id' => $validated['section_id'],
            'sort_order' => $nextOrder,
        ]);

        $question->translations()->createMany([
            ['locale' => 'en', 'text' => $validated['text_en']],
            ['locale' => 'th', 'text' => $validated['text_th']],
        ]);

        return back()->with('success', 'Question created successfully');
    }

    public function update(Request $request, SurveyQuestion $surveyQuestion)
    {
        $validated = $request->validate([
            'text_en' => 'required|string|max:1000',
            'text_th' => 'required|string|max:1000',
        ]);

        $surveyQuestion->translations()->updateOrCreate(
            ['locale' => 'en'],
            ['text' => $validated['text_en']]
        );
        $surveyQuestion->translations()->updateOrCreate(
            ['locale' => 'th'],
            ['text' => $validated['text_th']]
        );

        return back()->with('success', 'Question updated successfully');
    }

    public function destroy(SurveyQuestion $surveyQuestion)
    {
        if ($surveyQuestion->answers()->exists()) {
            return back()->with('error', 'Cannot delete question that has survey responses');
        }

        $surveyQuestion->delete();

        return back()->with('success', 'Question deleted successfully');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:survey_questions,id',
            'items.*.sort_order' => 'required|integer|min:1',
        ]);

        foreach ($validated['items'] as $item) {
            SurveyQuestion::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return back();
    }
}
