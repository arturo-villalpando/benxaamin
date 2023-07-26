<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Skill;

use App\Models\Employee_Skill;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::latest()->paginate());
    }

    /**
     * Store a new created post
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64',
            'email' => 'required|string|unique:employees,email',
            'position' => 'required|string|max:64',
            'birthday' => 'required|date_format:d/m/Y',
            'address' => 'required|string|max:128',
            'address2' => 'nullable|string|max:128',
            'city' => 'required|string|max:64',
            'country' => 'required|string|max:64',
            'cp' => 'required|string|min:5|max:16',
            'skills.*.id' => 'nullable|numeric',
            'skills.*.skill' => 'required|string|max:64',
            'skills.*.score' => 'required|digits_between:1,5'
        ]);

        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->position = $request->input('position');
        $birthday = date_create_from_format('d/m/Y', $request->input('birthday'));
        $employee->birthday = date('m-d-Y', $birthday->getTimestamp());
        $employee->address = $request->input('address');
        $employee->address2 = $request->input('address2');
        $employee->country = $request->input('country');
        $employee->city = $request->input('city');
        $employee->cp = $request->input('cp');

        try {
            $employee->save();
        } catch(QueryException $e) {
            return response([
                'errors'=>$e->getMessage()
            ], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }

        $skills = json_decode($request->input('skills'));
        foreach($skills as $key => $skill) {
            foreach($skill as $name => $score) {
                $skill = Skill::where('skill', $name)->first();
                if(!$skill) {
                    $skill = new Skill;
                    $skill->skill = $name;
                    $skill->score = $score;
                    $skill->save();
                }
                $employee_skill = new Employee_Skill;
                $employee_skill->employee_id = $employee->id;
                $employee_skill->skill_id = $skill->id;
                $employee_skill->save();
            }
        }

        return new EmployeeResource($employee);
    }

    /**
     * Display specific employee
     * 
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $employee = Employee::find($id);
        if($employee == null) {
            return response()->json([
                "message" => "Not found"
            ], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }

        //$skills = $employee->skill;
        //$employee->skills = $skills;

        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Responseƒ
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:64',
            'email' => 'required|string|unique:employees,email',
            'position' => 'required|string|max:64',
            'birthday' => 'required|date_format:d/m/Y',
            'address' => 'required|string|max:128',
            'address2' => 'nullable|string|max:128',
            'city' => 'required|string|max:64',
            'country' => 'required|string|max:64',
            'cp' => 'required|string|min:5|max:16',
            'skills.*.skill' => 'required|string|max:64',
            'skills.*.score' => 'required|digits_between:1,5'
        ]);

        $employee = Employee::find($id);
        if($employee == null) {
            return response()->json([
                "message" => "Not Found"
            ], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }
        $employee->update($request->all());

        return new EmployeeResource($employee);
    }

    /**
     * Remove specific employee
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $employee = Employee::findOrFail($id);
        if ($employee->delete()) {
            return response()->json([
                "message" => "Success"
            ], \Illuminate\Http\Response::HTTP_OK);
        }

        return response()->json([
            "message" => "Not Found"
        ], \Illuminate\Http\Response::HTTP_OK);
    }
}
