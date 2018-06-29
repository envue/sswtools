@extends('layouts.app')

@section('content')
<style>
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control { 
        background-color: #fff !important; opacity: 1; 
        }
</style>

    <h3 class="page-title">Reports</h3> 

    {!! Form::open(['method' => 'get']) !!}
        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-2 form-group">
                {!! Form::label('from','From',['class' => 'control-label']) !!}
                {!! Form::text('from', old('from', Request::get('from', date('m/d/Y', strtotime('-30 days')))), ['readonly'=>'true','onkeydown'=>'return false', 'class' => 'form-control date', 'placeholder' => '']) !!}
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2 form-group">
                {!! Form::label('to','To',['class' => 'control-label']) !!}
                {!! Form::text('to', old('to', Request::get('to', date('m/d/Y'))), ['readonly'=>'true','onkeydown'=>'return false', 'class' => 'form-control date', 'placeholder' => '']) !!}
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2 form-group">
                {!! Form::label('student','Student',['class' => 'control-label']) !!}
                {!! Form::select('student_id', $students, old('student_id', Request::get('student_id')), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>
            <div class="col-xs-6 col-sm-3 col-md-6">
                <label class="control-label">&nbsp;</label><br>
                {!! Form::submit('Generate Report',['class' => 'btn btn-primary']) !!} &nbsp;&nbsp;&nbsp;&nbsp; {!! Form::button('Print Report', ['onclick' => 'window.print()', 'class' => 'btn btn-success']) !!}  
            </div>
        </div>
    {!! Form::close() !!}
    <br>
    <div class ="row">
        <div class = "col-sm-6 col-xs-12 col-md-6">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Time recorded</span>
                    <span class="info-box-number">{!! $totalhours !!} hour(s) {!! $remaining_minutes !!} min(s)</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        
        <div class = "col-sm-6 col-xs-12 col-md-6">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-aqua"><i class="fa fa-star-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Number of Entries</span>
                    <span class="info-box-number">{!! $entriescount !!}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    
    <div class = "row">
        <div class = "col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-clock-o"></i>
                    <h3 class="box-title">Time by Work Type</h3>
                    <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!-- <span class="label label-primary">Label</span> -->
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <canvas id="worktypeChart" </canvas>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Time by work type</th>
                            <th>Minutes</th>
                            <th>Percent</th>
                        </tr>
                        @foreach($work_type_time as $work_type)
                        <tr>
                            <th>{{ $work_type['name'] }}</th>
                            <td>{{ $work_type['time'] }}</td>
                            <td>{{ number_format( $work_type['time'] / $workTypeMinutes * 100, 2 ) . '%' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- box-footer -->
            </div>
            <!-- /.box -->
        </div>  
    </div>

    <div class="row">
        <div class = "col-sm-12 col-md-12">
            <!-- Time Entries List Box -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-list"></i>
                    <h3 class="box-title">Time Entries List</h3>
                    <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!--span class="label label-primary">Last 30 Days</span>-->
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="time_entries_table" class="table table-bordered table-striped {{ count($time_entries) > 0 ? 'datatable' : '' }}">
                        <thead>
                            <tr>
                                <th>@lang('quickadmin.time-entries.fields.start-time')</th>
                                <th>@lang('quickadmin.time-entries.fields.end-time')</th>
                                <th>@lang('quickadmin.time-entries.fields.work-type')</th>
                                <th>@lang('quickadmin.time-entries.fields.description')</th>
                                <th>@lang('quickadmin.time-entries.fields.notes')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($time_entries) > 0)
                                @foreach ($time_entries as $time_entry)
                                    <tr data-entry-id="{{ $time_entry->id }}">
                                        <td field-key='start_time'>{{ $time_entry->start_time }}</td>
                                        <td field-key='end_time'>{{ $time_entry->end_time }}</td>
                                        <td field-key='work_type'>{{ $time_entry->work_type->name or '' }}</td>
                                        <td field-key='description'>{{ $time_entry->description }}</td>
                                        <td field-key='notes'>{!! $time_entry->notes !!}</td>
                                                    
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="15">@lang('quickadmin.qa_no_entries_in_table')</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>
                <!-- box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

@section('javascript')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        });
    </script>
    <!-- tooltip script -->
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>
    <!-- Chartjs script -->
    <script>
        var workTypeData = {!! json_encode($workTypeData)  !!};
        var workTypeLabels = {!! json_encode($workTypeLabels)  !!};
        
        var ctx = document.getElementById("worktypeChart").getContext('2d');
        var worktypeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: workTypeLabels,
                datasets: [{
                    label: '# of Minutes',
                    data: workTypeData,
                    backgroundColor: [
                        '#3c8dbc',
                        '#dd4b39',
                        '#00a65a',
                        '#00c0ef',
                        '#f39c12',
                        '#0073b7',
                        '#001F3F',
                        '#39CCCC',
                        '#3D9970',
                        '#01FF70',
                        '#FF851B',
                        '#F012BE',
                        '#605ca8',
                        '#D81B60',
                        '#111',
                        '#d2d6de'   
                    ],
                    
                    borderWidth: 1
                }]
            },
            options: {                
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                legend: {
                    display: true,
                    labels: {
                    boxWidth: 0,
                    }
                }
            }
        });
    </script>
    
    <!--Datatables options -->
    <script>
        $('#time_entries_table').DataTable( {
            "paging":   false,
            "ordering": false,
            "searching": false,
            "order": [[ 1, "desc" ]],
            dom: 'Bfrtip',
            buttons: [ 'colvis' ],
        } );
    </script>
@stop
