@extends('layouts.app')

@section('content')
    <h3 class="page-title">Reports</h3> 

    {!! Form::open(['method' => 'get']) !!}
        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-2 form-group">
                {!! Form::label('from','From',['class' => 'control-label']) !!}
                {!! Form::text('from', old('from', Request::get('from', date('m/d/Y', strtotime('-30 days')))), ['class' => 'form-control date', 'placeholder' => '']) !!}
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2 form-group">
                {!! Form::label('to','To',['class' => 'control-label']) !!}
                {!! Form::text('to', old('to', Request::get('to', date('m/d/Y'))), ['class' => 'form-control date', 'placeholder' => '']) !!}
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <label class="control-label">&nbsp;</label><br>
                {!! Form::submit('Generate Report',['class' => 'btn btn-primary']) !!} &nbsp;&nbsp;&nbsp;&nbsp; {!! Form::button('Print Report', ['onclick' => 'window.print()', 'class' => 'btn btn-success']) !!}  
            </div>
        </div>
    {!! Form::close() !!}
    <br>
    <div class ="row">
        <div class = "col-sm-12 col-xs-12 col-md-4">
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
        
        <div class = "col-sm-12 col-xs-12 col-md-4">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-warning"></i></span>
                <div class="info-box-content">
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                             <button type="button" style="padding: 1px 3px" class="btn" data-toggle="tooltip" data-placement="left" title="" data-original-title="This calculation assumes a 7.5 hour working day and that all weekdays were working days for the period. A customizable solution is on the roadmap.">
                             <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                             </button>
                        </div>
                    <span class="info-box-text">Uncompensated time</span>
                    <span class="info-box-number">{!! $noncomp_hours !!} hour(s) {!! $noncomp_minutes !!} min(s)</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class = "col-sm-12 col-xs-12 col-md-4">
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
        <div class = "col-sm-12 col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
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
        <div class = "col-sm-12 col-md-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Time by Population</h3>
                    <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!-- <span class="label label-primary">Label</span> -->
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <canvas id="populationChart" </canvas>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <table id="projecttable" class="table table-bordered table-striped">
                            <tr>
                                <th>Time by population</th>
                                <th>Minutes</th>
                                <th>Percent</th>
                            </tr>
                            @foreach($population_type_time as $population_type)
                        <tr>
                            <th>{{ $population_type['name'] }}</th>
                            <td>{{ $population_type['time'] }}</td>
                            <td>{{ number_format( $population_type['time'] / $populationTypeMinutes * 100, 2 ) . '%' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- box-footer -->
            </div>
            <!-- /.box -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Caseload vs. Non-Caseload</h3>
                    <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!-- <span class="label label-primary">Label</span> -->
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <canvas id="caseloadChart" </canvas>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <table id="projecttable" class="table table-bordered table-striped">
                            <tr>
                                <th>Time by caseload type</th>
                                <th>Minutes</th>
                                <th>Percent</th>
                            </tr>
                            @foreach($caseload_time as $caseload)
                        <tr>
                            <th>{{ $caseload['name'] }}</th>
                            <td>{{ $caseload['time'] }}</td>
                            <td>{{ number_format( $caseload['time'] / $caseloadTypeMinutes * 100, 2 ) . '%' }}</td>
                        </tr>
                        @endforeach
                    </table>
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
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
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
        var populationTypeLabels = {!! json_encode($populationTypeLabels)  !!};
        var populationTypeData = {!! json_encode($populationTypeData)  !!};
        var caseloadTypeLabels = {!! json_encode($caseloadTypeLabels)  !!};
        var caseloadTypeData = {!! json_encode($caseloadTypeData)  !!};
        
        var ctx = document.getElementById("worktypeChart").getContext('2d');
        var populationChart = new Chart(ctx, {
            type: 'horizontalBar',
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
                    xAxes: [{
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
        var ctx = document.getElementById("populationChart").getContext('2d');
        var populationChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: populationTypeLabels,
                datasets: [{
                    label: '# of Minutes',
                    data: populationTypeData,
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
        });
        var ctx = document.getElementById("caseloadChart").getContext('2d');
        var caseloadChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: caseloadTypeLabels,
                datasets: [{
                    label: '# of Minutes',
                    data: caseloadTypeData,
                    backgroundColor: [
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
        });
    </script>
@stop
