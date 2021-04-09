
<?php $activeTab = "student_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Student Dashboard</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<?php 
$event_list = get_event_list();
?>

<div class="row mt-2">
    <div class="col-md-7">
        <div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('event_schedule');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5" style="padding-left: 0">
        <div class="">

            <!-- LATEST EVENT LIST  -->
            <div class="panel panel-primary " data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="fa fa-calendar"></i>
                        <?php echo get_phrase('event_list');?>
                    </div>
                </div>
                <div class="panel-body" style="padding:0px;">
                    <div class="calendar-env">
                        <div class="calendar-body">
                            <table class="table table-filter" id="datatableEvents-disabled">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Place</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $event_number = 1;
                                foreach($event_list as $event) {

                                    if($event->role_id == 0){
                                        $event_for ="All";
                                    }
                                    else{
                                        $event_for = get_user_role_name_by_id($event->role_id);
                                        $event_for = json_encode($event_for);
                                    }
                                    $event_images = get_event_images_by_event_id($event->id);
                                   
                                    $event_images = json_encode($event_images);
                                    
                                    ?>

                                  <tr class="event_item"
                                    dash_event = "true",
                                    event_place="<?php echo $event->event_place;?>" 
                                    event_from="<?php echo $event->event_from;?>"
                                    event_to="<?php echo $event->event_to;?>" 
                                    event_note="<?php echo $event->note;?>"
                                    event_for = '<?php echo $event_for;?>'
                                    event_images = '<?php echo $event_images;?>'
                                  >
                                      <td><?php echo $event_number ?></td>
                                      <td><?php echo $event->title;?></td>
                                      <td><?php echo $event->event_from;?></td>
                                      <td><?php echo $event->event_place;?></td>
                                  </tr>
                                  <?php 
                                  $event_number++;
                                    } ?>
                              </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
                        
             
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">



        </div>
    </div>

</div>

<!-- MODAL -->
<div id="modalEvent" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header pb0">
        <h4 class="modal-title" id="event_title">Event information</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <hr>
      <div class="modal-body pt0">
        <p ><strong>Event Location : </strong> <span id="event_location"></span></p>
        <p ><strong>Event Dates : </strong> <span id="event_fdate"></span> to <span id="event_edate"></span></p>
        <p ><strong>Event Description : </strong> <span id="event_description"></span></p>


      </div>
      <div class="modal-footer">
        <!-- <a id="event_url" href="" target="_blank" class="btn btn-default" style="background: #2EC4B6;">Open Link</a> -->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


  <script>
    $(document).ready(function() {

      var calendar = $('#notice_calendar');
        $('#notice_calendar').fullCalendar({
            header: {
            left: 'title,prev,next today',
            center: 'title',
            right: 'month,basicWeek, basicDay'
            },
       
        firstDay: 1,
        droppable: false,
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        events: [
            <?php
                $notices=$this->db->get('events')->result_array();
            
                foreach($notices as $row):
                ?>
                {
                title: "<?php echo $row['title']; $mydate= $row['event_from'];?>",
				<?php $year = date("Y",strtotime($mydate)); ?>
				<?php $month = date("m",strtotime($mydate)); ?>
				<?php $date = date("d",strtotime($mydate)); ?>
                start: new Date(<?php echo $year;?>,<?php echo $month;?>,<?php echo $date;?>),
                end:    new Date(<?php echo $year;?>,<?php echo $month;?>,<?php echo $date;?>),
                event_place:"<?php echo $row['event_place'];?>",
                event_from: "<?php echo $row['event_from'];?>",
                event_to: "<?php echo $row['event_to'];?>",
                event_note: "<?php echo $row['note'];?>"
                },
               

                <?php
                    endforeach
                ?>
                
                
                <?php
                $holiday_leave=$this->db->get('holiday_leave')->result_array();
            
                foreach($holiday_leave as $row):
                ?>
                {
                title: "<?php echo $row['title']; $mydate= $row['date'];?>",
				<?php $year = date("Y",strtotime($mydate)); ?>
				<?php $month = date("m",strtotime($mydate)); ?>
				<?php $date = date("d",strtotime($mydate)); ?>
                start: new Date(<?php echo $year;?>,<?php echo $month;?>,<?php echo $date;?>),
                end:    new Date(<?php echo $year;?>,<?php echo $month;?>,<?php echo $date;?>),
            
                },
               

                <?php
                    endforeach
                ?>
                
                
                
				 
            ],

            eventClick: function(event) {
                console.log(event);
                $('#event_title').text(event.title);
                $('#event_date').text(event.event_from);
                $('#event_location').text(event.event_place);
                $('#event_fdate').text(event.event_from);
                $('#event_edate').text(event.event_to);
                $('#event_description').text(event.event_note);
                $('#event_url').attr("href", event.url);
                $('#modalEvent').modal('show');
                    if (event.url) {
                        if(event.url==''){
                            $('#event_url').css({"display":"none"});
                        }
                     return false;
                   }
                },
                eventRender: function(event, element) {
                    $(element).tooltip({title: event.title});             
                },
                eventLimit: true, // for all non-agenda views
                    views: {
                             agenda: {
                              eventLimit: 2 // adjust to 6 only for agendaWeek/agendaDay
                            },
                        }
                });
    });
  </script>

</div>

  
