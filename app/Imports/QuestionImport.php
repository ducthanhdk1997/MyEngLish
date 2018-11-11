<?php

namespace App\Imports;

use App\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpParser\Node\Stmt\Return_;

class QuestionImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Question([
            'name' => $row[0],
            'content' => $row[1],
            'image' => $row[2],
            'a' => $row[3],
            'b' => $row[4],
            'c' => $row[5],
            'd' => $row[6],
            'answer' => $row[7],
            'point' => $row[8],
            'exercise_id' => $row[9]
        ]);
    }
}
