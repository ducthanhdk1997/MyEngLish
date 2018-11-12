@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <div class="exerchise">
            <form action="{{route('user.doexercise',$exercises)}}" method="post">
                @csrf
                @foreach($questions as $question)
                    <div class="row question {{$question->name}}">
                        <!-- Question number -->
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 que_num">
                            <p>{{$question->name}}</p>
                        </div>
                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 cont">
                            <div class="que_cont">
                                <p>{{$question->content}}</p>
                            </div>
                            <!-- Answer -->
                            <div class="ans">
                                <div class="row">
                                    <div class=" elem">
                                        <input type="radio" name="question[{{$question->id}}]" value="a" ><span> A.&emsp; </span>{{$question->a}}
                                    </div>
                                    <div class=" elem">
                                        <input type="radio" name="question[{{$question->id}}]" value="b" ><span> B.&emsp; </span>{{$question->b}}
                                    </div>
                                    <div class=" elem">
                                        <input type="radio" name="question[{{$question->id}}]" value="c" ><span> C.&emsp; </span>{{$question->c}}
                                    </div>
                                    <div class=" elem">
                                        <input type="radio" name="question[{{$question->id}}]" value="d" ><span> D.&emsp; </span>{{$question->d}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary" id="nop">Nộp</button>
            </form>
        </div>
    </div>
@endsection()