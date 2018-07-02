<style type="text/css">
    .panel-title, .panel-body{
        font-size: 12px;
    }
    .panel-title .glyphicon{
        font-size: 10px;
    }
    .panel-heading {
        padding: 7px 10px;
    }
    .control-sidebar-light, .control-sidebar-light+.control-sidebar-bg {
    background: #ffff;
    border-left: 1px solid #d2d6de;
    }
</style>

<!--control sidebar -->
<aside class="control-sidebar control-sidebar-light">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-book"></i><span> Terms Reference</span></a></li>
        <!--unused tabs at the moment
      <li><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i class="fa fa-wrench"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        -->
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h4 class="control-sidebar-heading">Time Entry Terms</h4>
        <div class="bs-example">
            <div class="panel-group" id="accordion">
                @foreach(\App\TimeWorkType::get() as $work_type)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $work_type['id'] }}"><span class="glyphicon glyphicon-plus"></span> {{ $work_type['name'] }}</a>
                        </h4>
                    </div>
                    <div id="collapse{{ $work_type['id'] }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>{{ $work_type['description'] }}.</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <p><strong>Note:</strong> Click on the title text to expand or collapse info boxes.</p>
        </div>
      </div>
      <!-- /.tab-pane -->      
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>