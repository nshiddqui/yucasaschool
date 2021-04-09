<?php $activeTab = "noticeboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Noticeboard</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/extra_curricular_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
   
        <!------CONTROL TABS END------>


        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <div class="row">

                    <div class="col-md-12">

                        <ul class="nav nav-tabs bordered"> <!-- available classes "bordered", "right-aligned" -->
                            <li class="active">
                                <a href="#running" data-toggle="tab">
                                    <span><i class="entypo-home"></i>
                                        <?php echo get_phrase('running'); ?></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#archived" data-toggle="tab">
                                    <span><i class="entypo-archive"></i>
                                        <?php echo get_phrase('archived'); ?></span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <br>
                            <div class="tab-pane active" id="running">

                                <?php include 'running_noticeboard.php'; ?>

                            </div>
                            <div class="tab-pane" id="archived">

                                <?php include 'archived_noticeboard.php'; ?>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <!----TABLE LISTING ENDS--->

        </div>
    </div>
</div>
</div>
