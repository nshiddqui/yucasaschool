<div class="content-wrapper">
<div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-cube text-danger icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right">Total Schools</p>
                    <div class="fluid-container">
                    <h3 class="font-weight-medium text-right mb-0"><?php echo $number_of_leave_pending = $this->db->get_where('school_list', array('status' =>'1'))->num_rows();?></h3>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-receipt text-warning icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right">Student Registered</p>
                    <div class="fluid-container">
                     
                    <h3 class="font-weight-medium text-right mb-0">4522</h3>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-poll-box text-success icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right">Teachers Registered</p>
                    <div class="fluid-container">
                    <h3 class="font-weight-medium text-right mb-0">652</h3>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-account-location text-info icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right">Parents Registered</p>
                    <div class="fluid-container">
                    <h3 class="font-weight-medium text-right mb-0">3652</h3>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-7 grid-margin stretch-card">
        <!--weather card-->
        <div class="card card-weather">
        <div class="card-body">
            <div class="weather-date-location">
            <h3><?php   echo date("D"); ?></h3>
            <p class="text-gray">
                <span id="demo" class="weather-date">25 October, 2016</span>
                <span class="weather-location">New Delhi, Delhi</span>
            </p>
            </div>
            <div class="weather-data d-flex">
            <div class="mr-auto">
                <h4 class="display-3">21
                <span class="symbol">&deg;</span>C</h4>
                <p>
                Mostly Cloudy
                </p>
            </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="d-flex weakly-weather">
            <div class="weakly-weather-item">
                <p class="mb-0">
                Sun
                </p>
                <i class="mdi mdi-weather-cloudy"></i>
                <p class="mb-0">
                30°
                </p>
            </div>
            <div class="weakly-weather-item">
                <p class="mb-1">
                Mon
                </p>
                <i class="mdi mdi-weather-hail"></i>
                <p class="mb-0">
                31°
                </p>
            </div>
            <div class="weakly-weather-item">
                <p class="mb-1">
                Tue
                </p>
                <i class="mdi mdi-weather-partlycloudy"></i>
                <p class="mb-0">
                28°
                </p>
            </div>
            <div class="weakly-weather-item">
                <p class="mb-1">
                Wed
                </p>
                <i class="mdi mdi-weather-pouring"></i>
                <p class="mb-0">
                30°
                </p>
            </div>
            <div class="weakly-weather-item">
                <p class="mb-1">
                Thu
                </p>
                <i class="mdi mdi-weather-pouring"></i>
                <p class="mb-0">
                29°
                </p>
            </div>
            <div class="weakly-weather-item">
                <p class="mb-1">
                Fri
                </p>
                <i class="mdi mdi-weather-snowy-rainy"></i>
                <p class="mb-0">
                31°
                </p>
            </div>
            <div class="weakly-weather-item">
                <p class="mb-1">
                Sat
                </p>
                <i class="mdi mdi-weather-snowy"></i>
                <p class="mb-0">
                32°
                </p>
            </div>
            </div>
        </div>
        </div>
        <!--weather card ends-->
    </div>
    <div class="col-lg-5 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h2 class="card-title text-primary mb-5">Sales History</h2>
            <div class="wrapper d-flex justify-content-between">
            <div class="side-left">
                <p class="mb-2">The best performance</p>
                <p class="display-3 mb-4 font-weight-light">+45.2%</p>
            </div>
            <div class="side-right">
                <small class="text-muted">2017</small>
            </div>
            </div>
            <div class="wrapper d-flex justify-content-between">
            <div class="side-left">
                <p class="mb-2">Worst performance</p>
                <p class="display-3 mb-5 font-weight-light">-35.3%</p>
            </div>
            <div class="side-right">
                <small class="text-muted">2015</small>
            </div>
            </div>
            <div class="wrapper">
            <div class="d-flex justify-content-between">
                <p class="mb-2">Sales</p>
                <p class="mb-2 text-primary">88%</p>
            </div>
            <div class="progress">
                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 88%" aria-valuenow="88"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </div>
            <div class="wrapper mt-4">
            <div class="d-flex justify-content-between">
                <p class="mb-2">Visits</p>
                <p class="mb-2 text-success">56%</p>
            </div>
            <div class="progress">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 56%" aria-valuenow="56"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <!--<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
        <div class="card-body">
            <div class="row d-none d-sm-flex mb-4">
            <div class="col-4">
                <h5 class="text-primary">Unique Visitors</h5>
                <p>34657</p>
            </div>
            <div class="col-4">
                <h5 class="text-primary">Bounce Rate</h5>
                <p>45673</p>
            </div>
            <div class="col-4">
                <h5 class="text-primary">Active session</h5>
                <p>45673</p>
            </div>
            </div>
            <div class="chart-container">
            <canvas id="dashboard-area-chart" height="80"></canvas>
            </div>
        </div>
        </div>
    </div>
    </div>-->
    
    
 <script>
var d = new Date();
document.getElementById("demo").innerHTML = d;
</script>

    
 
</div>