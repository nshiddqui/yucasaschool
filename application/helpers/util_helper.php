<?php

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('_d')) {
    function _d($data, $exit = TRUE) {
        if ($exit)
            exit;
    }

}



if (!function_exists('base_path')) {

    function base_path() {
        
        return '/home/damndr94/public_html/college_erp/';
    }

}

if (!function_exists('logged_in_user_id')) {

    function logged_in_user_id() {
        $logged_in_id = 0;
        $CI = & get_instance();
        $type = $CI->session->userdata('login_type');
        if ($CI->session->userdata($type.'_id') && $CI->session->userdata('role_id')):
             $logged_in_id = $CI->session->userdata($type.'_id');
        endif;

        return $logged_in_id;
    }

}

if (!function_exists('logged_in_role_id')) {

    function logged_in_role_id() {
        $logged_in_role_id = 0;
        $CI = & get_instance();
        if ($CI->session->userdata('role_id')):
            $logged_in_role_id = $CI->session->userdata('role_id');
        endif;
        return $logged_in_role_id;
    }

}

if (!function_exists('logged_in_user_type')) {

    function logged_in_user_type() {
        $logged_in_type = 0;
        $CI = & get_instance();
        if ($CI->session->userdata('user_type')):
            $logged_in_id = $CI->session->userdata('user_type');
        endif;
        return $logged_in_type;
    }

}

if (!function_exists('success')) {

    function success($message) {
        $CI = & get_instance();
        $CI->session->set_userdata('success', $message);
        return true;
    }

}

if (!function_exists('error')) {

    function error($message) {
        $CI = & get_instance();
        $CI->session->set_userdata('error', $message);
        return true;
    }

}

if (!function_exists('warning')) {

    function warning($message) {
        $CI = & get_instance();
        $CI->session->set_userdata('warning', $message);
        return true;
    }

}

if (!function_exists('info')) {

    function info($message) {
        $CI = & get_instance();
        $CI->session->set_userdata('info', $message);
        return true;
    }

}

if (!function_exists('get_slug')) {

    function get_slug($slug) {
        if (!$slug) {
            return;
        }

        $char = array("!", "???", "'", ":", ",", "_", "`", "~", "@", "#", "$", "%", "^", "&", "*", "(", ")", "+", "=", "{", "}", "[", "]", "/", ";", '"', '<', '>', '?', "'\'",);
        $slug = str_replace($char, "", $slug);
        return $str = strtolower(str_replace(' ', "-", $slug));
    }

}

if (!function_exists('get_status')) {

    function get_status($status) {
        $ci = & get_instance();
        if ($status == 1) {
            return $ci->lang->line('active');
        } elseif ($status == 2) {
            return $ci->lang->line('in_active');
        } elseif ($status == 3) {
            return $ci->lang->line('trash');
        }
    }

}


if (!function_exists('verify_email_format')) {

    function verify_email_format($email) {
        $email = trim($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return '';
        } else {
            return $email;
        }
    }

}


if (!function_exists('get_classes')) {

    function get_classes() {
        $ci = & get_instance();
        return $ci->db->get('classes')->result();
    }

}

if (!function_exists('get_fee_amount')) {

    function get_fee_amount($income_head_id, $class_id) {
        $ci = & get_instance();
        return $ci->db->get_where('fees_amount', array('class_id'=>$class_id, 'income_head_id'=>$income_head_id))->row();
    }
}

if (!function_exists('get_vehicles')) {

    function get_vehicle_by_ids($ids) {
        $str = '';
        if ($ids) {
            $ci = & get_instance();
            $sql = "SELECT * FROM `vehicles` WHERE `id` IN($ids)";
            $result = $ci->db->query($sql)->result();
            if (!empty($result)) {
                foreach ($result as $obj) {
                    $str .= $obj->number . ',';
                }
            }
        }
        return rtrim($str, ',');
    }

}

if (!function_exists('get_routines_by_day')) {

    function get_routines_by_day($day, $class_id, $section_id) {
        $ci = & get_instance();
        
        $ci->db->select('R.*,S.name AS subject, T.name AS teacher');
        $ci->db->from('routines AS R');
        $ci->db->join('subjects AS S', 'S.id = R.subject_id', 'left');
        $ci->db->join('teachers AS T', 'T.id = R.teacher_id', 'left');
        $ci->db->where('R.day', $day);
        $ci->db->where('R.class_id', $class_id);
        $ci->db->where('R.section_id', $section_id);
        if(logged_in_role_id() == TEACHER){
            $ci->db->where('R.teacher_id', $ci->session->userdata('profile_id'));
        }
        
        $ci->db->order_by("R.id", "ASC");
       return $ci->db->get()->result();
       
        
    }

}

if (!function_exists('get_student_attendance')) {

    function get_student_attendance($student_id, $academic_year_id, $class_id, $section_id, $year, $month, $day) {
        $ci = & get_instance();
        $field = 'day_' . abs($day);
        $ci->db->select('SA.' . $field);
        $ci->db->from('student_attendances AS SA');
        $ci->db->where('SA.student_id', $student_id);
        $ci->db->where('SA.academic_year_id', $academic_year_id);
        $ci->db->where('SA.class_id', $class_id);
        $ci->db->where('SA.section_id', $section_id);
        $ci->db->where('SA.year', $year);
        $ci->db->where('SA.month', $month);
        return @$ci->db->get()->row()->$field;
    }

}

if (!function_exists('get_teacher_attendance')) {

    function get_teacher_attendance($teacher_id, $academic_year_id, $year, $month, $day) {
        $ci = & get_instance();
        $field = 'day_' . abs($day);
        $ci->db->select('TA.' . $field);
        $ci->db->from('teacher_attendances AS TA');
        $ci->db->where('TA.teacher_id', $teacher_id);
        $ci->db->where('TA.academic_year_id', $academic_year_id);
        $ci->db->where('TA.year', $year);
        $ci->db->where('TA.month', $month);
        return @$ci->db->get()->row()->$field;
    }

}

if (!function_exists('get_employee_attendance')) {

    function get_employee_attendance($teacher_id, $academic_year_id, $year, $month, $day) {
        $ci = & get_instance();
        $field = 'day_' . abs($day);
        $ci->db->select('EA.' . $field);
        $ci->db->from('employee_attendances AS EA');
        $ci->db->where('EA.employee_id', $teacher_id);
        $ci->db->where('EA.academic_year_id', $academic_year_id);
        $ci->db->where('EA.year', $year);
        $ci->db->where('EA.month', $month);
        return @$ci->db->get()->row()->$field;
    }

}

if (!function_exists('get_exam_attendance')) {

    function get_exam_attendance($student_id, $academic_year_id, $exam_id, $class_id, $section_id, $subject_id) {
        $ci = & get_instance();
        $ci->db->select('EA.is_attend');
        $ci->db->from('exam_attendances AS EA');
        $ci->db->where('EA.exam_id', $exam_id);
        $ci->db->where('EA.class_id', $class_id);
        $ci->db->where('EA.section_id', $section_id);
        $ci->db->where('EA.student_id', $student_id);
        $ci->db->where('EA.subject_id', $subject_id);
        $ci->db->where('EA.academic_year_id', $academic_year_id);
        return @$ci->db->get()->row()->is_attend;
    }

}

if (!function_exists('get_exam_mark')) {

    function get_exam_mark($student_id, $academic_year_id, $exam_id, $class_id, $section_id, $subject_id) {
        $ci = & get_instance();
        $ci->db->select('M.*');
        $ci->db->from('marks AS M');
        $ci->db->where('M.exam_id', $exam_id);
        $ci->db->where('M.class_id', $class_id);
        $ci->db->where('M.section_id', $section_id);
        $ci->db->where('M.student_id', $student_id);
        $ci->db->where('M.subject_id', $subject_id);
        $ci->db->where('M.academic_year_id', $academic_year_id);
        return $ci->db->get()->row();
    }

}

if (!function_exists('get_exam_attendance')) {

    function get_exam_attendance($student_id, $academic_year_id, $exam_id, $class_id, $section_id, $subject_id) {
        $ci = & get_instance();
        $ci->db->select('M.*');
        $ci->db->from('exam_attendances AS EA');
        $ci->db->where('EA.exam_id', $exam_id);
        $ci->db->where('EA.class_id', $class_id);
        $ci->db->where('EA.section_id', $section_id);
        $ci->db->where('EA.student_id', $student_id);
        $ci->db->where('EA.subject_id', $subject_id);
        $ci->db->where('EA.academic_year_id', $academic_year_id);
        return $ci->db->get()->row();
    }

}

if (!function_exists('get_exam_total_mark')) {

    function get_exam_total_mark($exam_id, $student_id, $academic_year_id, $class_id, $section_id = null) {
        
        $ci = & get_instance();
        $ci->db->select('COUNT(M.id) AS total_subject, SUM(G.point) AS total_point, SUM(M.exam_total_mark) AS exam_mark, SUM(M.obtain_total_mark) AS obtain_mark');
        $ci->db->from('marks AS M');
        $ci->db->join('grades AS G', 'G.id = M.grade_id', 'left');      
        $ci->db->where('M.class_id', $class_id);
        $ci->db->where('M.exam_id', $exam_id);
        if ($section_id) {
            $ci->db->where('M.section_id', $section_id);
        }
        
        $ci->db->where('M.student_id', $student_id);
        $ci->db->where('M.academic_year_id', $academic_year_id);
        return $ci->db->get()->row();
    }
}



if (!function_exists('get_subject_list')) {

    function get_subject_list($exam_id, $class_id, $section_id, $student_id) {
        $ci = & get_instance();
        $ci->db->select('M.*,S.name AS subject, G.point, G.name');
        $ci->db->from('marks AS M');        
        $ci->db->join('subjects AS S', 'S.id = M.subject_id', 'left');
        $ci->db->join('grades AS G', 'G.id = M.grade_id', 'left');
        $ci->db->where('M.class_id', $class_id);
        $ci->db->where('M.section_id', $section_id);
        $ci->db->where('M.student_id', $student_id);
        $ci->db->where('M.exam_id', $exam_id);
        return  $ci->db->get()->result();     
    }

}

if (!function_exists('get_lowet_height_mark')) {

    function get_lowet_height_mark($exam_id, $class_id, $section_id, $subject_id) {
        $ci = & get_instance();
        $ci->db->select('MIN(M.obtain_total_mark) AS lowest, MAX(M.obtain_total_mark) AS height');
        $ci->db->from('marks AS M');       
        $ci->db->where('M.exam_id', $exam_id);
        $ci->db->where('M.class_id', $class_id);
        $ci->db->where('M.section_id', $section_id);
        $ci->db->where('M.subject_id', $subject_id);  
        return  $ci->db->get()->row();
     // echo $ci->db->last_query();
    }

}

if (!function_exists('get_lowet_height_result')) {

    function get_lowet_height_result($exam_id, $class_id, $section_id) {
        $ci = & get_instance();
        $ci->db->select('MIN(ER.total_obtain_mark) AS lowest, MAX(ER.total_obtain_mark) AS height');
        $ci->db->from('exam_results AS ER');       
        $ci->db->where('ER.exam_id', $exam_id);
        $ci->db->where('ER.class_id', $class_id);
        $ci->db->where('ER.section_id', $section_id);
        //$ci->db->where('ER.student_id', $student_id);  
        return  $ci->db->get()->row();
     // echo $ci->db->last_query();
    }

}


if (!function_exists('get_position_in_subject')) {

    function get_position_in_subject($exam_id, $class_id, $section_id, $subject_id, $mark) {
        
        
        $ci = & get_instance();
        $sql = "SELECT id, obtain_total_mark, FIND_IN_SET( obtain_total_mark,(
                SELECT GROUP_CONCAT( obtain_total_mark  ORDER BY obtain_total_mark DESC ) 
                FROM marks WHERE exam_id = $exam_id AND class_id = $class_id AND section_id = $section_id AND subject_id = $subject_id))
                AS rank 
                FROM marks
                WHERE exam_id = $exam_id AND class_id = $class_id AND section_id = $section_id AND subject_id = $subject_id AND  obtain_total_mark = $mark"; 
        
        $rank =  $ci->db->query($sql)->row()->rank; 
        
        if($mark == 0){
            return '--'; 
        }
        
        if($rank == 1){
            return $rank.'st';
        }elseif($rank == 2){
           return $rank.'nd'; 
        }elseif($rank == 3){
           return $rank.'rd'; 
        }else{
            return $rank.'th'; 
        }
    }

}


if (!function_exists('get_position_student_position')) {

    function get_position_student_position($academic_year_id, $class_id, $student_id, $section_id = null) {
        
        $condition = " academic_year_id = $academic_year_id ";
        $condition .= " AND class_id = $class_id";
        $condition .= " AND student_id = $student_id";
        if($section_id){
            $condition .= " AND section_id = $section_id";
        }
        
        $ci = & get_instance();              
        $sql = "SELECT id, avg_grade_point, FIND_IN_SET( avg_grade_point, 
                ( SELECT GROUP_CONCAT( avg_grade_point ORDER BY avg_grade_point DESC )
                FROM final_results ) ) AS rank 
                FROM final_results 
                WHERE $condition";
        
        $result =  $ci->db->query($sql)->row(); 
        
        $rank = '';
        if(!empty($result)){
            $rank = $result->rank;
        }
                       
        if($rank == 1){
            return $rank.'st';
        }elseif($rank == 2){
           return $rank.'nd'; 
        }elseif($rank == 3){
           return $rank.'rd'; 
        }else{
            return $rank.'th'; 
        }
    }

}



if (!function_exists('get_exam_wise_markt')) {

    function get_exam_wise_markt($exam_id, $class_id, $section_id, $student_id) {
        $ci = & get_instance();
        
        $select = 'SUM(M.written_mark) AS written_mark,
                   SUM(M.written_obtain) AS written_obtain,
                   SUM(M.tutorial_mark) AS tutorial_mark,
                   SUM(M.tutorial_obtain) AS tutorial_obtain,
                   SUM(M.practical_mark) AS practical_mark,
                   SUM(M.practical_obtain) AS practical_obtain,
                   SUM(M.viva_mark) AS viva_mark,
                   SUM(M.viva_obtain) AS viva_obtain,
                   COUNT(M.id) AS total_subject,
                   SUM(G.point) AS point,                  
                   G.name';
        
        $ci->db->select($select);
        $ci->db->from('marks AS M');        
        $ci->db->join('grades AS G', 'G.id = M.grade_id', 'left');          
        $ci->db->where('M.class_id', $class_id);
        $ci->db->where('M.section_id', $section_id);
        $ci->db->where('M.student_id', $student_id);
        $ci->db->where('M.exam_id', $exam_id);        
        return $ci->db->get()->row();  
        // $ci->db->last_query();
    }
}

if (!function_exists('get_position_in_subject')) {

    function get_position_in_subject($exam_id, $class_id, $section_id, $subject_id, $mark) {
        
        
        $ci = & get_instance();
        $sql = "SELECT id, obtain_total_mark, FIND_IN_SET( obtain_total_mark,(
                SELECT GROUP_CONCAT( obtain_total_mark  ORDER BY obtain_total_mark DESC ) 
                FROM marks WHERE exam_id = $exam_id AND class_id = $class_id AND section_id = $section_id AND subject_id = $subject_id))
                AS rank 
                FROM marks
                WHERE exam_id = $exam_id AND class_id = $class_id AND section_id = $section_id AND subject_id = $subject_id AND  obtain_total_mark = $mark"; 
        
        $rank =  @$ci->db->query($sql)->row()->rank; 
        
        if($mark == 0){
            return '--'; 
        }
        
        if($rank == 1){
            return $rank.'st';
        }elseif($rank == 2){
           return $rank.'nd'; 
        }elseif($rank == 3){
           return $rank.'rd'; 
        }else{
            return $rank.'th'; 
        }
    }

}

if (!function_exists('get_position_in_exam')) {

    function get_position_in_exam($exam_id, $class_id, $section_id, $mark) {
        
        
        $ci = & get_instance();
        $sql = "SELECT id, total_obtain_mark, FIND_IN_SET( total_obtain_mark,(
                SELECT GROUP_CONCAT( total_obtain_mark  ORDER BY total_obtain_mark DESC ) 
                FROM exam_results WHERE exam_id = $exam_id AND class_id = $class_id AND section_id = $section_id ))
                AS rank 
                FROM exam_results
                WHERE exam_id = $exam_id AND class_id = $class_id AND section_id = $section_id AND total_obtain_mark = $mark"; 
        
        $rank =  @$ci->db->query($sql)->row()->rank; 
        
        if($mark == 0){
            return '--'; 
        }
        
        if($rank == 1){
            return $rank.'st';
        }elseif($rank == 2){
           return $rank.'nd'; 
        }elseif($rank == 3){
           return $rank.'rd'; 
        }else{
            return $rank.'th'; 
        }
    }

}

if (!function_exists('get_position_in_class')) {

    function get_position_in_class($class_id, $mark) {
        
        if($mark == 0){
            return '--'; 
        }
        
        $ci = & get_instance();
        $sql = "SELECT id, avg_grade_point, FIND_IN_SET( avg_grade_point,(
                SELECT GROUP_CONCAT( avg_grade_point  ORDER BY avg_grade_point DESC ) 
                FROM final_results WHERE class_id = $class_id ))
                AS rank 
                FROM final_results
                WHERE class_id = $class_id AND avg_grade_point = $mark"; 
        
        $rank =  @$ci->db->query($sql)->row()->rank; 
        
        
        
        if($rank == 1){
            return $rank.'st';
        }elseif($rank == 2){
           return $rank.'nd'; 
        }elseif($rank == 3){
           return $rank.'rd'; 
        }else{
            return $rank.'th'; 
        }
    }

}



if (!function_exists('get_exam_result')) {

    function get_exam_result($exim_id, $student_id, $academic_year_id, $class_id, $section_id = null) {
        $ci = & get_instance();
        $ci->db->select('ER.*, G.name');
        $ci->db->from('exam_results AS ER');  
        $ci->db->join('grades AS G', 'G.id = ER.grade_id', 'left');  
        $ci->db->where('ER.exam_id', $exim_id);
        $ci->db->where('ER.class_id', $class_id);
        if ($section_id) {
            $ci->db->where('ER.section_id', $section_id);
        }
        $ci->db->where('ER.student_id', $student_id);
        $ci->db->where('ER.academic_year_id', $academic_year_id);
        return $ci->db->get()->row();
    }
}

if (!function_exists('get_exam_final_result')) {

    function get_exam_final_result($student_id, $academic_year_id, $class_id, $section_id = null) {
        $ci = & get_instance();
        $ci->db->select('FR.*');
        $ci->db->from('final_results AS FR');
        $ci->db->where('FR.class_id', $class_id);
        if ($section_id) {
            $ci->db->where('FR.section_id', $section_id);
        }
        $ci->db->where('FR.student_id', $student_id);
        $ci->db->where('FR.academic_year_id', $academic_year_id);
        return $ci->db->get()->row();
    }
}

if (!function_exists('get_enrollment')) {

    function get_enrollment($student_id, $academic_year_id) {
        $ci = & get_instance();
        $ci->db->select('E.*');
        $ci->db->from('enrollments AS E');
        $ci->db->where('E.student_id', $student_id);
        $ci->db->where('E.academic_year_id', $academic_year_id);
        return $ci->db->get()->row();
    }

}

if (!function_exists('get_user_by_role')) {

    function get_user_by_role($role_id, $user_id) {

        $ci = & get_instance();

        if ($role_id == STUDENT) {

            $ci->db->select('S.*, G.name AS parent, E.roll as roll_no, E.section_id, E.class_id, S.email, S.role_id,  C.name AS class_name, SE.name AS section, D.title AS discount');
            $ci->db->from('enroll AS E');
            $ci->db->join('student AS S', 'S.student_id = E.student_id', 'left');
            $ci->db->join('parent AS G', 'G.parent_id = S.parent_id', 'left');
            //$ci->db->join('users AS U', 'U.id = S.user_id', 'left');
            $ci->db->join('class AS C', 'C.class_id = E.class_id', 'left');
            $ci->db->join('section AS SE', 'SE.section_id = E.section_id', 'left');
            $ci->db->join('discounts AS D', 'D.id = S.discount_id', 'left');
            $ci->db->where('S.student_id', $user_id);
            return $ci->db->get()->row();
            
        } elseif ($role_id == TEACHER) {
            $ci->db->select('T.*, U.email, U.role_id, SG.grade_name');
            $ci->db->from('teachers AS T');
            $ci->db->join('users AS U', 'U.id = T.user_id', 'left');
            $ci->db->join('salary_grades AS SG', 'SG.id = T.salary_grade_id', 'left');
            $ci->db->where('T.user_id', $user_id);
            return $ci->db->get()->row();
        } elseif ($role_id == GUARDIAN) {
            $ci->db->select('G.*, U.email, U.role_id');
            $ci->db->from('guardians AS G');
            $ci->db->join('users AS U', 'U.id = G.user_id', 'left');
            $ci->db->where('G.user_id', $user_id);
            return $ci->db->get()->row();
        } elseif ($role_id == PARENTT) {
            $ci->db->select('P.*, P.email');
            $ci->db->from('parent AS P');
           // $ci->db->join('users AS U', 'U.id = G.user_id', 'left');
            $ci->db->where('P.parent_id', $user_id);
            return $ci->db->get()->row();
         } else {
            $ci->db->select('E.*, U.email, U.role_id, D.name AS designation, SG.grade_name');
            $ci->db->from('employees AS E');
            $ci->db->join('users AS U', 'U.id = E.user_id', 'left');
            $ci->db->join('designations AS D', 'D.id = E.designation_id', 'left');
            $ci->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');
            $ci->db->where('E.user_id', $user_id);
            return $ci->db->get()->row();
        }

        $ci->db->last_query();
    }

}


if (!function_exists('get_user_by_id')) {

    function get_user_by_id($user_id,$user_role) {
//echo $user_id;
        $ci = & get_instance();
        if ($user_role == STUDENT) {
            $ci->db->select('S.*,S.student_code, S.email, S.role_id,  C.name AS class_name, SE.name AS section');
            $ci->db->from('enroll AS E');
            $ci->db->join('student AS S', 'S.student_id = E.student_id', 'left');
            $ci->db->join('class AS C', 'C.class_id = E.class_id', 'left');
            $ci->db->join('section AS SE', 'SE.section_id = E.section_id', 'left');
            $ci->db->where('S.student_id', $user_id);
            return $ci->db->get()->row();

        } elseif ($user_role == TEACHER) {
            $ci->db->select('T.*');
            $ci->db->from('teacher AS T');
            $ci->db->where('T.teacher_id', $user_id);
            return $ci->db->get()->row();
        } elseif ($user_role == GUARDIAN) {
            $ci->db->select('G.*, U.email, U.role_id');
            $ci->db->from('guardians AS G');
            $ci->db->join('users AS U', 'U.id = G.user_id', 'left');
            $ci->db->where('G.user_id', $user_id);
            return $ci->db->get()->row();
        } elseif ($user_role == SUPER_ADMIN) {
            $ci->db->select('admin_id as user_id,name,email');
            $ci->db->from('admin');
            $ci->db->where('admin_id', $user_id);
            return $ci->db->get()->row();
         }elseif ($user_role == PARENTT) {
            $ci->db->select('T.*');
            $ci->db->from('parent AS T');
            $ci->db->where('T.parent_id', $user_id);
            return $ci->db->get()->row();
        }elseif ($user_role == DRIVER || $user_role == WARDEN || $user_role == SECURITY_GAURD) {
            $ci->db->select('E.*, U.email, U.role_id');
            $ci->db->from('employees AS E');
            $ci->db->join('designation_users AS U', 'U.designation_users_id = E.user_id', 'left');
            $ci->db->where('E.user_id', $user_id);
            return $ci->db->get()->row();
        }elseif ($user_role == LIBRARIN) {
            $ci->db->select('T.*');
            $ci->db->from('librarian AS T');
            $ci->db->where('T.librarian_id', $user_id);
            return $ci->db->get()->row();
        }elseif ($user_role == ACCOUNTANT) {
            $ci->db->select('A.*');
            $ci->db->from('accountant AS A');
            $ci->db->where('A.accountant_id', $user_id);
            return $ci->db->get()->row();
        }elseif ($user_role == 10) {
            $ci->db->select('S.*,S.student_code, S.email, S.role_id,  C.name AS class_name');
            $ci->db->from('pre_enroll AS E');
            $ci->db->join('pre_student AS S', 'S.pre_student_id = E.student_id', 'left');
            $ci->db->join('class AS C', 'C.class_id = E.class_id', 'left');
            //$ci->db->join('section AS SE', 'SE.section_id = E.section_id', 'left');
            $ci->db->where('S.pre_student_id', $user_id);
            return $ci->db->get()->row();
        }
        elseif ($user_role == 17) {
            $ci->db->select('A.*');
            $ci->db->from('inventory_manager AS A');
            $ci->db->where('A.inventory_manager_id', $user_id);
            return $ci->db->get()->row();
            
        }
        elseif ($user_role == 18) {
            $ci->db->select('A.*');
            $ci->db->from('transport_manager AS A');
            $ci->db->where('A.transport_manager_id', $user_id);
            return $ci->db->get()->row();
            
        }

       
    }

}


if (!function_exists('get_blood_group')) {

    function get_blood_group() {
        $ci = & get_instance();
        return array(
            'A+' => $ci->lang->line('a_positive'),
            'A-' => $ci->lang->line('a_negative'),
            'B+' => $ci->lang->line('b_positive'),
            'B-' => $ci->lang->line('b_negative'),
            'O+' => $ci->lang->line('o_positive'),
            'O-' => $ci->lang->line('o_negative'),
            'AB+' => $ci->lang->line('ab_positive'),
            'AB-' => $ci->lang->line('ab_negative')
        );
    }

}

if (!function_exists('get_visitor_reasons')) {

    function get_visitor_reasons() {
        $ci = & get_instance();
        return array(
            'vendor' => $ci->lang->line('vendor'),
            'guardian' => $ci->lang->line('guardian'),
            'relative' => $ci->lang->line('relative'),
            'friend' => $ci->lang->line('friend'),
            'family' => $ci->lang->line('family'),
            'interview' => $ci->lang->line('interview'),
            'meeting' => $ci->lang->line('meeting'),
            'other' => $ci->lang->line('other')
        );
    }

}

if (!function_exists('get_subject_type')) {

    function get_subject_type() {
        $ci = & get_instance();
        return array(
            'mandatory' => $ci->lang->line('mandatory'),
            'optional' => $ci->lang->line('optional')
        );
    }

}


if (!function_exists('get_result_status')) {

    function get_result_status() {
        $ci = & get_instance();
        return array(
            'passed' => $ci->lang->line('passed'),
            'failed' => $ci->lang->line('failed')
        );
    }
}

if (!function_exists('get_groups')) {

    function get_groups() {
        $ci = & get_instance();
        return array(
            'science' => $ci->lang->line('science'),
            'arts' => $ci->lang->line('arts'),
            'commerce' => $ci->lang->line('commerce')
        );
    }

}


if (!function_exists('get_week_days')) {

    function get_week_days() {
        $ci = & get_instance();
        return array(
            'saturday' => $ci->lang->line('saturday'),
            'sunday' => $ci->lang->line('sunday'),
            'monday' => $ci->lang->line('monday'),
            'tuesday' => $ci->lang->line('tuesday'),
            'wednesday' => $ci->lang->line('wednesday'),
            'thursday' => $ci->lang->line('thursday'),
            'friday' => $ci->lang->line('friday')
        );
    }

}

if (!function_exists('get_months')) {

    function get_months() {
        $ci = & get_instance();
        return array(
            'january' => $ci->lang->line('january'),
            'february' => $ci->lang->line('february'),
            'march' => $ci->lang->line('march'),
            'april' => $ci->lang->line('april'),
            'may' => $ci->lang->line('may'),
            'june' => $ci->lang->line('june'),
            'july' => $ci->lang->line('july'),
            'august' => $ci->lang->line('august'),
            'september' => $ci->lang->line('september'),
            'october' => $ci->lang->line('october'),
            'november' => $ci->lang->line('november'),
            'december' => $ci->lang->line('december')
        );
    }

}

if (!function_exists('get_hostel_types')) {

    function get_hostel_types() {
        $ci = & get_instance();
        return array(
            'boys' => $ci->lang->line('boys'),
            'girls' => $ci->lang->line('girls'),
            'combine' => $ci->lang->line('combine')
        );
    }

}

if (!function_exists('get_room_types')) {

    function get_room_types() {
        $ci = & get_instance();
        return array(
            'ac' => $ci->lang->line('ac'),
            'non_ac' => $ci->lang->line('non_ac')
        );
    }

}


if (!function_exists('get_genders')) {

    function get_genders() {
        $ci = & get_instance();
        return array(
            'male' => $ci->lang->line('male'),
            'female' => $ci->lang->line('female')
        );
    }

}

if (!function_exists('get_paid_types')) {

    function get_paid_status($status) {
        $ci = & get_instance();
        $data = array(
            'paid' => $ci->lang->line('paid'),
            'unpaid' => $ci->lang->line('unpaid'),
            'partial' => $ci->lang->line('partial')
        );
        return $data[$status];
    }

}

if (!function_exists('get_relation_types')) {

    function get_relation_types() {
        $ci = & get_instance();
        return array(
            'father' => $ci->lang->line('father'),
            'mother' => $ci->lang->line('mother'),
            'sister' => $ci->lang->line('sister'),
            'brother' => $ci->lang->line('brother'),
            'uncle' => $ci->lang->line('uncle'),
            'maternal_uncle' => $ci->lang->line('maternal_uncle'),
            'other_relative' => $ci->lang->line('other_relative')
        );
    }

}

if (!function_exists('get_payment_methods')) {

    function get_payment_methods() {
        $ci = & get_instance();

        $methods = array('cash' => $ci->lang->line('cash'), 'cheque' => $ci->lang->line('cheque'));
     
        $ci = & get_instance();
        $ci->db->select('PS.*');
        $ci->db->from('payment_settings AS PS');
        $data = $ci->db->get()->row();
        
        if ($data->paypal_status) {
            $methods['paypal'] = $ci->lang->line('paypal');
        }
        if ($data->stripe_status) {
            $methods['stripe'] = $ci->lang->line('stripe');
        }
        if ($data->payumoney_status) {
            $methods['payumoney'] = $ci->lang->line('payumoney');
        }
        if ($data->ccavenue_status) {
            $methods['ccavenue'] = $ci->lang->line('ccavenue');
        }
        if ($data->paytm_status) {
            $methods['paytm'] = $ci->lang->line('paytm');
        }

        return $methods;
    }

}

if (!function_exists('get_sms_gateways')) {

    function get_sms_gateways() {
        $ci = & get_instance();
        $gateways = array();
        $ci = & get_instance();
        $ci->db->select('SS.*');
        $ci->db->from('sms_settings AS SS');
        $data = $ci->db->get()->row();

        if ($data->clickatell_status) {
            $gateways['clicktell'] = $ci->lang->line('clicktell');
        }
        if ($data->twilio_status) {
            $gateways['twilio'] = $ci->lang->line('twilio');
        }
        if ($data->bulk_status) {
            $gateways['bulk'] = $ci->lang->line('bulk');
        }
        if ($data->msg91_status) {
            $gateways['msg91'] = $ci->lang->line('msg91');
        }
        if ($data->plivo_status) {
            $gateways['plivo'] = $ci->lang->line('plivo');
        }
        if ($data->textlocal_status) {
            $gateways['text_local'] = $ci->lang->line('text_local');
        }
        if ($data->smscountry_status) {
            $gateways['sms_country'] = $ci->lang->line('sms_country');
        }

        return $gateways;
    }

}


if (!function_exists('get_group_by_type')) {

    function get_group_by_type() {
        $ci = & get_instance();
        return array(
            'daily' => $ci->lang->line('daily'),
            'monthly' => $ci->lang->line('monthly'),
            'yearly' => $ci->lang->line('yearly')
        );
    }

}


if (!function_exists('get_template_tags')) {

    function get_template_tags($role_id) {
        $tags = array();
        $tags[] = '[name]';
        $tags[] = '[email]';
        $tags[] = '[phone]';


        if ($role_id == STUDENT) {

            $tags[] = '[class_name]';
            $tags[] = '[section]';
            $tags[] = '[roll_no]';
            $tags[] = '[birthday]';
            $tags[] = '[sex]';
            $tags[] = '[religion]';
            $tags[] = '[blood_group]';
            //$tags[] = '[phone]';
            //$tags[] = '[group]';
            //$tags[] = '[created_at]';
            $tags[] = '[parent_id]';
            
        } else if ($role_id == PARENTT) {
            $tags[] = '[profession]';
        } else if ($role_id == TEACHER) {
            $tags[] = '[responsibility]';
            $tags[] = '[sex]';
            $tags[] = '[blood_group]';
            $tags[] = '[religion]';
            $tags[] = '[dob]';
            $tags[] = '[joining_date]';
        } else {
            $tags[] = '[designation]';
            $tags[] = '[sex]';
            $tags[] = '[blood_group]';
            $tags[] = '[religion]';
            $tags[] = '[dob]';
            $tags[] = '[joining_date]';
        }
          $tags[]   = '[address]';
       /* $tags[] = '[present_address]';
        $tags[] = '[permanent_address]';*/

        return $tags;
    }

}

if (!function_exists('get_formatted_body')) {

    function get_formatted_body($body, $role_id, $user_id) {

        $tags = get_template_tags($role_id);
        $user = get_user_by_role($role_id, $user_id);
       // print_r($user);
        $arr = array('[', ']');

        foreach ($tags as $tag) {
            $field = str_replace($arr, '', $tag);
            
            if($field == 'created_at'){                
                $body = str_replace($tag, date('M-d-Y', strtotime($user->created_at)), $body);                
            }else{
                $body = str_replace($tag, $user->{$field}, $body);
            }            
            
        }

        return $body;
    }
}

if (!function_exists('get_formatted_certificate_text')) {

    function get_formatted_certificate_text($body, $role_id, $user_id) {

        $tags = get_template_tags($role_id);
        $user = get_user_by_role($role_id, $user_id);
              
        $arr = array('[', ']');
        foreach ($tags as $tag) {
            $field = str_replace($arr, '', $tag);
            
            if($field == 'created_at'){                
                $body = str_replace($tag, '<span>'.date('M-d-Y', strtotime($user->created_at)).'</span>', $body);                
            }else{
                $body = str_replace($tag, '<span>'.$user->{$field}.'</span>', $body);
            }            
        }

        return $body;
    }
}



if (!function_exists('get_nice_time')) {

    function get_nice_time($date) {

        $ci = & get_instance();
        if (empty($date)) {
            return "2 months ago"; //"No date provided";
        }

        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();
        $unix_date = strtotime($date);

        // check validity of date
        if (empty($unix_date)) {
            return "2 months ago"; // "Bad date";
        }

        // is it future date or past date
        if ($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = "ago";
        } else {
            $difference = $unix_date - $now;
            $tense = "from now";
        }

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j] .= "s";
        }

        return "$difference $periods[$j] {$tense}";
    }

}



if (!function_exists('get_inbox_message')) {

    function get_inbox_message() {
        $ci = & get_instance();
        $ci->db->select('MR.*, M.*');
        $ci->db->from('message_relationships AS MR');
        $ci->db->join('messages AS M', 'M.id = MR.message_id', 'left');
        $ci->db->where('MR.status', 1);
        $ci->db->where('MR.is_read', 0);
        $ci->db->where('MR.owner_id', logged_in_user_id());
        $ci->db->where('MR.receiver_id', logged_in_user_id());
        return $ci->db->get()->result();
    }

}


if (!function_exists('get_operation_by_module')) {

    function get_operation_by_module($module_id) {
        $ci = & get_instance();
        $ci->db->select('O.*');
        $ci->db->from('operations AS O');
        $ci->db->where('O.module_id', $module_id);
        return $ci->db->get()->result();
    }

}

if (!function_exists('get_permission_by_operation')) {

    function get_permission_by_operation($role_id, $operation_id) {
        $ci = & get_instance();
        $ci->db->select('P.*');
        $ci->db->from('privileges AS P');
        $ci->db->where('P.role_id', $role_id);
        $ci->db->where('P.operation_id', $operation_id);
        return $ci->db->get()->row();
    }

}

if (!function_exists('get_lang')) {

    function get_lang() {
        $ci = & get_instance();
        $ci->lang->line('dashboard');
    }

}

if (!function_exists('get_default_lang_list')) {

    function get_default_lang_list($lang) {
        $lang_lists = array();
        $lang_lists['english'] = 'english';
        $lang_lists['bengali'] = 'bengali';
        $lang_lists['spanish'] = 'spanish';
        $lang_lists['arabic'] = 'arabic';
        $lang_lists['hindi'] = 'hindi';
        $lang_lists['urdu'] = 'urdu';
        $lang_lists['chinese'] = 'chinese';
        $lang_lists['japanese'] = 'japanese';
        $lang_lists['portuguese'] = 'portuguese';
        $lang_lists['russian'] = 'russian';
        $lang_lists['french'] = 'french';
        $lang_lists['korean'] = 'korean';
        $lang_lists['german'] = 'german';
        $lang_lists['italian'] = 'italian';
        $lang_lists['thai'] = 'thai';
        $lang_lists['hungarian'] = 'hungarian';
        $lang_lists['dutch'] = 'dutch';
        $lang_lists['latin'] = 'latin';
        $lang_lists['indonesian'] = 'indonesian';
        $lang_lists['turkish'] = 'turkish';
        $lang_lists['greek'] = 'greek';
        $lang_lists['persian'] = 'persian';
        $lang_lists['malay'] = 'malay';
        $lang_lists['telugu'] = 'telugu';
        $lang_lists['tamil'] = 'tamil';
        $lang_lists['gujarati'] = 'gujarati';
        $lang_lists['polish'] = 'polish';
        $lang_lists['ukrainian'] = 'ukrainian';
        $lang_lists['panjabi'] = 'panjabi';
        $lang_lists['romanian'] = 'romanian';
        $lang_lists['burmese'] = 'burmese';
        $lang_lists['yoruba'] = 'yoruba';
        $lang_lists['hausa'] = 'hausa';

        if (isset($lang_lists[$lang]) && !empty($lang_lists[$lang])) {
            return true;
        } else {
            return FALSE;
        }
    }

}


if (!function_exists('get_timezones')) {
    function get_timezones() {
        $timezones = array(           
            'Pacific/Midway' => "(GMT-11:00) Midway Island",
            'US/Samoa' => "(GMT-11:00) Samoa",
            'US/Hawaii' => "(GMT-10:00) Hawaii",
            'US/Alaska' => "(GMT-09:00) Alaska",
            'US/Pacific' => "(GMT-08:00) Pacific Time (US &amp; Canada)",
            'America/Tijuana' => "(GMT-08:00) Tijuana",
            'US/Arizona' => "(GMT-07:00) Arizona",
            'US/Mountain' => "(GMT-07:00) Mountain Time (US &amp; Canada)",
            'America/Chihuahua' => "(GMT-07:00) Chihuahua",
            'America/Mazatlan' => "(GMT-07:00) Mazatlan",
            'America/Mexico_City' => "(GMT-06:00) Mexico City",
            'America/Monterrey' => "(GMT-06:00) Monterrey",
            'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
            'US/Central' => "(GMT-06:00) Central Time (US &amp; Canada)",
            'US/Eastern' => "(GMT-05:00) Eastern Time (US &amp; Canada)",
            'US/East-Indiana' => "(GMT-05:00) Indiana (East)",
            'America/Bogota' => "(GMT-05:00) Bogota",
            'America/Lima' => "(GMT-05:00) Lima",
            'America/Caracas' => "(GMT-04:30) Caracas",
            'Canada/Atlantic' => "(GMT-04:00) Atlantic Time (Canada)",
            'America/La_Paz' => "(GMT-04:00) La Paz",
            'America/Santiago' => "(GMT-04:00) Santiago",
            'Canada/Newfoundland' => "(GMT-03:30) Newfoundland",
            'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
            'Greenland' => "(GMT-03:00) Greenland",
            'Atlantic/Stanley' => "(GMT-02:00) Stanley",
            'Atlantic/Azores' => "(GMT-01:00) Azores",
            'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
            'Africa/Casablanca' => "(GMT) Casablanca",
            'Europe/Dublin' => "(GMT) Dublin",
            'Europe/Lisbon' => "(GMT) Lisbon",
            'Europe/London' => "(GMT) London",
            'Africa/Monrovia' => "(GMT) Monrovia",
            'Europe/Amsterdam' => "(GMT+01:00) Amsterdam",
            'Europe/Belgrade' => "(GMT+01:00) Belgrade",
            'Europe/Berlin' => "(GMT+01:00) Berlin",
            'Europe/Bratislava' => "(GMT+01:00) Bratislava",
            'Europe/Brussels' => "(GMT+01:00) Brussels",
            'Europe/Budapest' => "(GMT+01:00) Budapest",
            'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
            'Europe/Ljubljana' => "(GMT+01:00) Ljubljana",
            'Europe/Madrid' => "(GMT+01:00) Madrid",
            'Europe/Paris' => "(GMT+01:00) Paris",
            'Europe/Prague' => "(GMT+01:00) Prague",
            'Europe/Rome' => "(GMT+01:00) Rome",
            'Europe/Sarajevo' => "(GMT+01:00) Sarajevo",
            'Europe/Skopje' => "(GMT+01:00) Skopje",
            'Europe/Stockholm' => "(GMT+01:00) Stockholm",
            'Europe/Vienna' => "(GMT+01:00) Vienna",
            'Europe/Warsaw' => "(GMT+01:00) Warsaw",
            'Europe/Zagreb' => "(GMT+01:00) Zagreb",
            'Europe/Athens' => "(GMT+02:00) Athens",
            'Europe/Bucharest' => "(GMT+02:00) Bucharest",
            'Africa/Cairo' => "(GMT+02:00) Cairo",
            'Africa/Harare' => "(GMT+02:00) Harare",
            'Europe/Helsinki' => "(GMT+02:00) Helsinki",
            'Europe/Istanbul' => "(GMT+02:00) Istanbul",
            'Asia/Jerusalem' => "(GMT+02:00) Jerusalem",
            'Europe/Kiev' => "(GMT+02:00) Kyiv",
            'Europe/Minsk' => "(GMT+02:00) Minsk",
            'Europe/Riga' => "(GMT+02:00) Riga",
            'Europe/Sofia' => "(GMT+02:00) Sofia",
            'Europe/Tallinn' => "(GMT+02:00) Tallinn",
            'Europe/Vilnius' => "(GMT+02:00) Vilnius",
            'Asia/Baghdad' => "(GMT+03:00) Baghdad",
            'Asia/Kuwait' => "(GMT+03:00) Kuwait",
            'Africa/Nairobi' => "(GMT+03:00) Nairobi",
            'Asia/Riyadh' => "(GMT+03:00) Riyadh",
            'Asia/Tehran' => "(GMT+03:30) Tehran",
            'Europe/Moscow' => "(GMT+04:00) Moscow",
            'Asia/Baku' => "(GMT+04:00) Baku",
            'Europe/Volgograd' => "(GMT+04:00) Volgograd",
            'Asia/Muscat' => "(GMT+04:00) Muscat",
            'Asia/Tbilisi' => "(GMT+04:00) Tbilisi",
            'Asia/Yerevan' => "(GMT+04:00) Yerevan",
            'Asia/Kabul' => "(GMT+04:30) Kabul",
            'Asia/Karachi' => "(GMT+05:00) Karachi",
            'Asia/Tashkent' => "(GMT+05:00) Tashkent",
            'Asia/Kolkata' => "(GMT+05:30) Kolkata",
            'Asia/Kathmandu' => "(GMT+05:45) Kathmandu",
            'Asia/Yekaterinburg' => "(GMT+06:00) Ekaterinburg",
            'Asia/Almaty' => "(GMT+06:00) Almaty",
            'Asia/Dhaka' => "(GMT+06:00) Dhaka",
            'Asia/Novosibirsk' => "(GMT+07:00) Novosibirsk",
            'Asia/Bangkok' => "(GMT+07:00) Bangkok",
            'Asia/Jakarta' => "(GMT+07:00) Jakarta",
            'Asia/Krasnoyarsk' => "(GMT+08:00) Krasnoyarsk",
            'Asia/Chongqing' => "(GMT+08:00) Chongqing",
            'Asia/Hong_Kong' => "(GMT+08:00) Hong Kong",
            'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
            'Australia/Perth' => "(GMT+08:00) Perth",
            'Asia/Singapore' => "(GMT+08:00) Singapore",
            'Asia/Taipei' => "(GMT+08:00) Taipei",
            'Asia/Ulaanbaatar' => "(GMT+08:00) Ulaan Bataar",
            'Asia/Urumqi' => "(GMT+08:00) Urumqi",
            'Asia/Irkutsk' => "(GMT+09:00) Irkutsk",
            'Asia/Seoul' => "(GMT+09:00) Seoul",
            'Asia/Tokyo' => "(GMT+09:00) Tokyo",
            'Australia/Adelaide' => "(GMT+09:30) Adelaide",
            'Australia/Darwin' => "(GMT+09:30) Darwin",
            'Asia/Yakutsk' => "(GMT+10:00) Yakutsk",
            'Australia/Brisbane' => "(GMT+10:00) Brisbane",
            'Australia/Canberra' => "(GMT+10:00) Canberra",
            'Pacific/Guam' => "(GMT+10:00) Guam",
            'Australia/Hobart' => "(GMT+10:00) Hobart",
            'Australia/Melbourne' => "(GMT+10:00) Melbourne",
            'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
            'Australia/Sydney' => "(GMT+10:00) Sydney",
            'Asia/Vladivostok' => "(GMT+11:00) Vladivostok",
            'Asia/Magadan' => "(GMT+12:00) Magadan",
            'Pacific/Auckland' => "(GMT+12:00) Auckland",
            'Pacific/Fiji' => "(GMT+12:00) Fiji",
        );

        return $timezones;
    }
}


if (!function_exists('get_date_format')) {
    function get_date_format() {
        
        $date = array();
        $date['Y-m-d'] = '2001-03-15';
        $date['d-m-Y'] = '15-03-2018';
        $date['d/m/Y'] = '15/03/2018';
        $date['m/d/Y'] = '03/15/2018';
        $date['m.d.Y'] = '03.10.2018';
        $date['j, n, Y'] = '14, 7, 2018';
        $date['F j, Y'] = 'July 15, 2018';
        $date['M j, Y'] = 'Jul 13, 2018';
        $date['j M, Y'] = '13 Jul, 2018';
        
        return $date;
    }
}

if (!function_exists('check_permission')) {

    function check_permission($action) {

        $ci = & get_instance();
        print_r($ci->session->userdata());
        $role_id = $ci->session->userdata('role_id');
        $operation_slug = $ci->router->fetch_class();
        $module_slug = $ci->router->fetch_module();

        if ($module_slug == '') {
            $module_slug = $operation_slug;
        }

        $module_slug = 'my_' . $module_slug;

        $data = $ci->config->item($operation_slug, $module_slug);

        $result = $data[$role_id];
        if (!empty($result)) {
            $array = explode('|', $result);
            if (!$array[$action]) {
                error($ci->lang->line('permission_denied'));
                redirect('dashboard');
            }
        } else {
            error($ci->lang->line('permission_denied'));
            redirect('dashboard');
        }

        return TRUE;
    }

}

if (!function_exists('has_permission')) {

    function has_permission($action, $module_slug = null, $operation_slug = null) {

        $ci = & get_instance();
        $role_id = '1';

        if ($module_slug == '') {
            $module_slug = $operation_slug;
        }

        $module_slug = 'my_' . $module_slug;
//echo $module_slug;echo $operation_slug;
         $data = $ci->config->item($operation_slug, $module_slug); 
		//print_r($data);
//echo $ci->config->item($operation_slug, $module_slug);
//die();
        $result = $data[$role_id];

        if (!empty($result)) {
            $array = explode('|', $result);
            return $array[$action];
        } else {
            return FALSE;
        }
    }

}

if (!function_exists('create_log')) {

    function create_log($activity = null) {

        $ci   = & get_instance();
        $data = array();
//print_r($ci->session->userdata());die;
          $data['user_id']    = logged_in_user_id();
          $data['role_id']    = logged_in_role_id();
        //echo $data['user_id'];
        $user               = get_user_by_id($data['user_id'],$data['role_id']);
        //var_dump($user);die;
        $data['name']       = $user->name;
        $data['phone']      = $user->email;
        $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data['activity']   = $activity;
        $data['status']     = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $ci->db->insert('activity_logs', $data);
    }

    if (!function_exists('marks_type')) {

        function marks_type() {
            $ci   = & get_instance();
            return $ci->db->get_where('settings',array('type'=>'marks_setting'))->row()->description;
        }
    }


function location($number=0)
{
    $ci =& get_instance();
    $ci->load->database();
     if ($number > 0) {
        $query2 = $ci->db->query("SELECT * FROM geopos_locations WHERE id=$number");
        return $query2->row_array();
    } else {
        $query2 = $ci->db->query("SELECT cname,address,city,region,country,postbox,phone,email,taxid,logo FROM geopos_system WHERE id=1 LIMIT 1");
        return $query2->row_array();
        }

}


// EVENT LIST HELPER
function get_event_list($limit = null){
    $ci = & get_instance();
    $ci->db->select('E.*, R.name');
    $ci->db->from('events AS E');
    $ci->db->join('roles AS R', 'R.id = E.role_id', 'left');
    $ci->db->order_by('E.id', 'DESC');
    if($limit){
      $ci->db->limit($limit);  
    }
    return $ci->db->get()->result();
    
}


// NOTICE LIST HELPER
function get_notice_list($limit = null){
    $ci = & get_instance();
    $ci->db->select('*');
    $ci->db->from('noticeboard');
    if($limit){
      $ci->db->limit($limit);  
    }
    return $ci->db->get()->result();
    
}



// GET ROLE NAME BY ROLE ID
function get_user_role_name_by_id($id){
    $ci = &get_instance();
    $ci->db->select('name');
    $ci->db->from('roles');
    $ci->db->where('id', $id);
    return $ci->db->get()->result();
}

// GET EVENTS IMAGES BY EVENT ID
function get_event_images_by_event_id($event_id){
    $ci = &get_instance();
    $ci->db->select('image');
    $ci->db->from('event_images');
    $ci->db->where('event_id', $event_id);
    return $ci->db->get()->result();
}


if(!function_exists('accounts_format_number')){
    function accounts_format_number($value){
        if($value > 100000){
            $final_val = round($value /100000,2);
            return [$final_val,"In Lakh"];
          }
          elseif ($value > 10000 && $value <100000) {
            $final_val = round($value /1000,2);
            return [$final_val,"In Thousand"];
          }
          else{
            $final_val = round($value,2);
            return [$final_val,"In Hundred"];
        }
    }
}


if (!function_exists('get_employee_type_list')) {

    function get_employee_type_list() {
        $ci = & get_instance();
        return $ci->db->get_where('roles', array('is_employee'=>1))->result();
    }
}

if (!function_exists('get_facebook_settings')) {

    function get_facebook_settings() {
        $ci = & get_instance();
        return $ci->db->get('facebook_settings')->result();
    }
}

if (!function_exists('get_classes_list')) {

    function get_classes_list() {
        $ci = & get_instance();
        $ci->db->from('class');
        $ci->db->order_by("class_id", "asc");
        $query = $ci->db->get(); 
        return $query->result();

    }
}


}