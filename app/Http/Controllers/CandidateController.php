<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\pass;
class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Candidate::select("*")
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'user' => $user
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'abc';
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:candidates,email',
            'image' => 'required|image',
            'gender' => 'required',
            'skills' => 'required'
        ]);

        $skillReq = ($request->skills);
        $splitSkills = explode(",", $skillReq);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        if ($validator->passes()) {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'skills' => $splitSkills,
            ];
            if (($request->file('image')) != null) {
                $imageFile = $request->file('image'); //name="video"
                $imageFileName = $imageFile->getClientOriginalName();
                Storage::putFileAs('public/imagesFolder/', $imageFile, $imageFileName);
                $data['image'] = $imageFileName;
            }
            Candidate::create($data);
            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        return 'abc';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        // dd($candidate->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'skills' => 'required'
        ]);

        $skillReq = ($request->skills);
        $splitSkills = explode(",", $skillReq);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        if ($validator->passes()) {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'skills' => $splitSkills,
            ];
            if (($request->file('image')) != null) {
                $imageFile = $request->file('image'); //name="video"
                $imageFileName = $imageFile->getClientOriginalName();
                Storage::putFileAs('public/imagesFolder/', $imageFile, $imageFileName);
                $data['image'] = $imageFileName;
            }
            // Candidate::create($data);
            // Candidate::update($data);
            Candidate::findOrFail($candidate->id)->update($data);
            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        $data = Candidate::findOrFail($candidate->id)->delete();
        return response()->json($data);
    }
}
