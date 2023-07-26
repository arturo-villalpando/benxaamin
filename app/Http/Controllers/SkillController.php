<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Models\Skill;

use Illuminate\Http\Request;

use App\Http\Requests\SkillRequest;
use Illuminate\Database\QueryException;

class SkillController extends Controller
{
    /**
     * Display a list of skills
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SkillResource::collection(Skill::latest()->paginate());
    }

    /**
     * Store a new created post
     *
     * @param SkillRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillRequest $skill)
    {
        try {
            $skill = Skill::create($skill->all());
        } catch(QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062 || $errorCode == 7){
                return response([
                    'errors'=>'Duplicate entry'
                ], \Illuminate\Http\Response::HTTP_NOT_FOUND);
            } else {
                return response([
                    'errors'=>$e->getMessage()
                ], \Illuminate\Http\Response::HTTP_NOT_FOUND);
            }
        }

        return new SkillResource($skill);
    }

    /**
     * Display specific skill
     * 
     * @param int $skill
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $skill = Skill::find($id);
        if($skill == null) {
            return response()->json([
                "message" => "Not found"
            ], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }

        return new SkillResource($skill);
    }

    /**
     * Update the specified skill in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'skill' => 'required|string|max:64',
            'score' => 'required|numeric|digits_between:1,5',
        ]);

        $skill = Skill::find($id);
        if($skill == null) {
            return response()->json([
                "message" => "Not Found"
            ], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }
        $skill->update($request->all());

        return new SkillResource($skill);
    }

    /**
     * Remove specific skill
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $skill = Skill::findOrFail($id);
        if ($skill->delete()) {
            return response()->json([
                "message" => "Success"
            ], \Illuminate\Http\Response::HTTP_OK);
        }

        return response()->json([
            "message" => "Not Found"
        ], \Illuminate\Http\Response::HTTP_OK);
    }
}
