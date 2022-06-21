<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\QuestionAnswer;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaan = Question::all();
        return view('backend.pertanyaan.index', ['pertanyaan' => $pertanyaan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jawaban = [
            [
                'nilai' => 'A',
                'bobot' => 4
            ],
            [
                'nilai' => 'B',
                'bobot' => 3
            ],
            [
                'nilai' => 'C',
                'bobot' => 2.5
            ],
            [
                'nilai' => 'D',
                'bobot' => 2
            ],
            [
                'nilai' => 'E',
                'bobot' => 1
            ]
        ];

        return view('backend.pertanyaan.create', ['jawaban' => $jawaban]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $jawaban = $request->get('jawaban');
            $pertanyaan = $request->get('pertanyaan');

            $question = new Question();
            $question->name = $pertanyaan;
            $question->save();

            $dataJawaban = Question::dataJawaban();

            foreach ($jawaban as $key => $value) {
                $answer = new QuestionAnswer();
                $answer->question_id = $question->id;
                $answer->status = $dataJawaban[$key]['nilai'];
                $answer->name = $value;
                $answer->score = $dataJawaban[$key]['bobot'];
                $answer->save();
            }

            return redirect()->route('pertanyaan.index')->with('success', 'Data pertanyaan berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertanyaan = Question::findOrFail($id);
        return view('backend.pertanyaan.detail', ['pertanyaan' => $pertanyaan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = Question::findOrFail($id);
        return view('backend.pertanyaan.edit', ['pertanyaan' => $pertanyaan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $jawaban = $request->get('jawaban');
            $pertanyaan = $request->get('pertanyaan');
            $jawaban_id = $request->get('jawaban_id');

            $question =  Question::findOrFail($id);
            $question->name = $pertanyaan;
            $question->save();

            foreach ($jawaban as $key => $value) {
                $answer =  QuestionAnswer::findOrFail($jawaban_id[$key]);
                $answer->name = $value;
                $answer->save();
            }

            return redirect()->route('pertanyaan.index')->with('success', 'Data pertanyaan berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
