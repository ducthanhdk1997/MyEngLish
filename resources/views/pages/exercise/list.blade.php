@extends('admin.admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">

        <h2>Danh sách bài tập mới</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Lớp</th>
                <th>Tên bài tập</th>
                <th>DeadLine</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
<!--            --><?php
//            for($i=0;$i<$sobaitap;$i++)
//            {
//                $class_id = $lstNewExerClass[$i]['IDClass'];
//                for($j=0;$j<count($class);$j++)
//                {
//                    if($class[$j]['IDClass']==$class_id)
//                    {
//                        echo '<tr>
//                            <td>'.$class[$j]['ClassName'].'</td>
//                            <td>'.$lstBTM[$i]['Name'].'</td>
//                            <td>'.$lstNewExerClass[$i]['Dealine'].'</td>
//                            <td><a href="/TTCM/Exercise?id='.$lstBTM[$i]['ID'].'"><i class="fa fa-pencil"></i> Làm</a></td>
//                          </tr>';
//                    }
//                }
//
//            }
//            ?>
            </tbody>
        </table>
    </div>
@endsection()