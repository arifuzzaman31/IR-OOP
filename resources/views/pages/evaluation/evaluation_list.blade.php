@extends('layout.app')

@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading row">
            <div class="col-md-8">
                <h5 class="">Ebook Evaluation: {{ $ebook->title }}</h5>
                <h6>Cummulative Evaluation Score: {{ $cummultive_score = (count($evaluations) > 0) ?  $evaluation_total_marks/(count($evaluations)) : 0 }} </h6>
                <h6>Cummulative Evaluation Title: {{ (count($evaluations) > 0) ? CustomHelper::cu_evaluation_title($cummultive_score) : "Failed" }}</h6>
            </div>
            <div class="col-md-4 text-right">
                <h6>Category: {{ $ebook_templete->title }}</h6>
                <h6>Grand Total: {{ $evaluation_total_marks }} / {{ 100*count($evaluations) }} Marks</h6>
            </div>
        </div>
        <div class="widget-body">
            <div class="table-responsive">
                <table class="table table-striped datatable datatable_custom">
                    <thead>
                        <tr>
                            <th class="text-left">
                                <div class="th-content">ID</div>
                            </th>
                            <th>
                                <div class="th-content">Date</div>
                            </th>
                            <th>
                                <div class="th-content">Jury</div>
                            </th>
                            <th>
                                <div class="th-content text-center">Total Mark</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Evaluation</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach($evaluations as $item)
                        <tr>
                            <td class="text-left">{{ $count++ }}</td>
                            <td>{{ date("d-m-Y", strtotime($item['created_at']))  }}</td>
                            <td>{{ $item['jury_mave']->firstname . ' ' . $item['jury_mave']->lastname }}</td>
                            <td class="text-center">{{ $item['total_mark'] }}/100</td>
                            <td class="text-left">
                                @foreach($item['evaluation'] as $eval)
                                @foreach($ebook_templete_structure as $stu_item)
                                @if($stu_item['form_name'] ==$eval['field'])
                                <p class="ebook_evaluation_title" data-eval-field="{{ $eval['field'] }}">
                                    {{ $stu_item['evaluation_query'] }}
                                </p>
                                <p>Mark: {{$eval['ebook_mark'] .' out of '. $stu_item['mark'] }}</p>
                                @endif
                                @endforeach
                                <p>Comment: {{$eval['ebook_comment']}}</p>
                                <br>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach

                        @if (auth()->user()->role_id ==1 || auth()->user()->role_id ==2)
                        @foreach($juries as $jury)
                        @if (App\Helpers\CustomHelper::jury_evaluated_check($ebook->id, $jury->id) == true)
                        <tr>
                            <td class="text-left">{{ $count++ }}</td>
                            <td></td>
                            <td>{{$jury->firstname . ' ' . $jury->lastname}}</td>
                            <td></td>
                            <td class="text-left">Pending</td>
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
