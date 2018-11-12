@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
            <div class="content_exercises col-md-12 col-sm-8 col-xs-8 col-sm-offset-2 col-xs-offset-2" style="font-size: 20px;">
                @foreach($questions as $question)
                    <div class="form-group">
                        <div class="input-group">
                            <span>Câu{{$question->name}}</span>
                            <span> {{$question->content}}</span>
                        </div>
                        <div class="input-group">
                            <input type="radio" value="a"  <?php if($question->answer=='a')echo "checked"; ?>  name="{{$question->name}}">{{$question->a}}
                        </div>
                        <div class="input-group">
                            <input type="radio" value="b" <?php if($question->answer=='b')echo "checked"; ?> name="{{$question->name}}">{{$question->b}}
                        </div>
                        <div class="input-group">
                            <input type="radio" value="c" <?php if($question->answer=='c')echo "checked"; ?> name="{{$question->name}}">{{$question->c}}
                        </div>
                        <div class="input-group">
                            <input type="radio" value="d" <?php if($question->answer=='d')echo "checked"; ?> name="{{$question->name}}">{{$question->d}}
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@endsection