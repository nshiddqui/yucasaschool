<?php 
   // $dormitory_students = $this->db->get_where('student' , array('dormitory_id' => $param2))->result_array();

   // $this->db->select('S.*');
   // $this->db->from('room_change_request as R');
   // $this->db->join('student as S','S.student_id=R.student_id');
   // $this->db->join('hostels as H','R.new_hostel_id = H.id');
   // $this->db->join('rooms as RM','R.new_room_id = RM.id');
   // $this->db->where('R.id',$param2);
   // $totaldata = $this->db->get()->row();

   $this->db->select('S.*');
   $this->db->from('student as S');
   $this->db->where('S.dormitory_id',$param2);
   $totaldata = $this->db->get()->result();

?>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td><?php echo get_phrase('name');?></td>
                    <td><?php echo get_phrase('email');?></td>
                    <td><?php echo get_phrase('phone');?></td>
                    <td><?php echo get_phrase('class');?></td>
                </tr>
            </thead>
            <tbody>
           <?php foreach ($totaldata as $key => $value): ?>
              <tr>
                  <td><?php echo $value->student_code;?></td>
                  <td><?php echo $value->name;?></td>
                  <td><?php echo $value->email;?></td>
                  <td><?php echo $value->phone;?></td>
                  <td>
                  <?php  $this->db->select('C.*');
                         $this->db->from('enroll as E');
                         $this->db->join('class as C','C.class_id=E.class_id');
                         $this->db->where('E.student_id',$value->student_id);
                         echo @$this->db->get()->row()->name;
                         ?>
                  </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>