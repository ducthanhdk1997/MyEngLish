@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <div class="x_panel">

            <div class="x_title">
                <h2>Message</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <ul class="messages">
                                @php
                                    $create_at = \Carbon\Carbon::parse($notification->created_at);
                                    $month = [
                                        1 => 'January',
                                        2 => 'February',
                                        3 => 'March',
                                        4 => 'April',
                                        5 => 'May',
                                        6 => 'June',
                                        7 => 'July',
                                        8 => 'August',
                                        9 => 'September',
                                        10 => 'Pctober',
                                        11 => 'Novenber',
                                        12 => 'December',

                                        ]
                                @endphp
                                <li>
                                    <div class="message_date">
                                        <h3 class="date text-info">{{$create_at->day}}</h3>
                                        <h2 class="month">{{$month[$create_at->month]}}</h2>
                                    </div>
                                    <div class="message_wrapper">
                                        <a href=""><h4 class="heading">{{$notification->title}}</h4></a>
                                        <blockquote class="message">{{$notification->content}}</blockquote>
                                    </div>
                                </li>
                            </ul>
                            <!-- end recent activity -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitForm() {
            $('#myform').submit();
        }
    </script>
@endsection

@section('script')
    <script>

    </script>
@endsection()