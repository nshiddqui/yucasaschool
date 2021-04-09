<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Creativeitem
 *	date		: 14 september, 2017
 *	Ekattor School Management System Pro
 *	http://codecanyon.net/user/Creativeitem
 *	http://support.creativeitem.com
 */

class Upload extends CI_Controller{

    function __construct(){
        parent::__construct();// you have missed this line.
        $this->load->library('upload');
        $this->load->database();
        $this->load->model('Upload_Model');
    }

    // Function to add new post
    public function add_new_post(){
        // Get Data
        $post_title = $this->input->post('post_title');
        $post_content = $this->input->post('post_content');
        $img_name = $_FILES['post_img']['name'];

        $save_type =  $this->input->post('save_type');

        $config = array(
            'upload_path' => "uploads/blog/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => FALSE,
            'max_size' => "1048576"
            // 'max_height' => "768",
            // 'max_width' => "1024"
        );
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
       
        if($this->upload->do_upload('post_img')){
            // Insert Post to DB
           
            if($this->Upload_Model->insert_post_to_db($post_title,$post_content,$img_name,$save_type)){
                echo "success";
            }
            else{
                echo "failure";
            }
        }

        else{
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors();
        }
    }

    public function change_post_status(){
        $save_type =  $this->input->post('save_type');
        $post_id =  $this->input->post('post_id');

        // echo  $post_id;die;
        if($this->Upload_Model->change_post_status($post_id,$save_type)){
            echo "success";
        }
        else{
            echo "fail";
        }
    }

    public function delete_post(){
        $post_id =  $this->input->post('post_id');

        if($this->Upload_Model->delete_post($post_id)){
            echo "success";
        }
        else{
            echo "fail";
        }
    }


    // Function to add new post
    public function update_post(){
        // Get Data
        $post_title = $this->input->post('post_title');
        $post_content = $this->input->post('post_content');
        $post_id = $this->input->post('post_id');
        $save_type =  $this->input->post('save_type');
        
        // IF NEW IMAGE SELECTED
        if(!empty($_FILES['post_img']['name'])){
            $img_name = $_FILES['post_img']['name'];
            // echo strlen($img_name); die;
            $config = array(
            'upload_path' => "uploads/blog/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => FALSE,
            'max_size' => "1048576"
                // 'max_height' => "768",
                // 'max_width' => "1024"
            );
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
           
            if($this->upload->do_upload('post_img')){
                // Insert Post to DB
               
                if($this->Upload_Model->update_post_by_id($post_id,$post_title,$img_name,$post_content,$save_type)){
                    echo "success";
                }
                else{
                    echo "failure";
                }
            }

            else{
                $error = array('error' => $this->upload->display_errors());
                echo $this->upload->display_errors();
            }
        }

        // IF NEW IS NOT IMAGE SELECTED
        else{

            if($this->Upload_Model->update_post_by_id($post_id,$post_title,$img="",$post_content,$save_type)){
                    echo "success";
            }
            else{
                echo "failure";
            }
        }
 
    }


    // Function to add new client
    public function add_new_client(){
        // Get Data
        $school_name = $this->input->post('school_name');
        $client_name = $this->input->post('client_name');
        $client_testimonial = $this->input->post('client_testimonial');
        $client_img = $_FILES['client_img']['name'];
        

        $config = array(
            'upload_path' => "uploads/clients/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => FALSE,
            'max_size' => "1048576"
            // 'max_height' => "768",
            // 'max_width' => "1024"
        );
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
       
        if($this->upload->do_upload('client_img')){
            // Insert Post to DB
           
            if($this->Upload_Model->insert_client_to_db($school_name,$client_name,$client_testimonial,$client_img)){
                echo "success";
            }
            else{
                echo "failure";
            }
        }

        else{
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors();
        }
    }

    // CHANGE CLIENT STATUS
    public function change_client_status(){
        $status =  $this->input->post('status');
        $client_id =  $this->input->post('client_id');
       
        if($this->Upload_Model->change_client_status($client_id,$status)){
            echo "success";
        }
        else{
            echo "fail";
        }
    }

    // DELETE CLIENT
    public function delete_client(){
        $client_id =  $this->input->post('client_id');

        if($this->Upload_Model->delete_client($client_id)){
            echo "success";
        }
        else{
            echo "fail";
        }
    }

    // UPDATE CLIENT

    // Function to add new post
    public function update_client(){
        // Get Data
        $school_name = $this->input->post('school_name');
        $client_name = $this->input->post('client_name');
        $client_testimonial = $this->input->post('client_testimonial');
        $client_img = $_FILES['client_img']['name'];
        $client_id = $this->input->post('client_id');
       
        // IF NEW IMAGE SELECTED

        if(!empty($_FILES['client_img']['name'])){
            
            $img_name = $_FILES['client_img']['name'];
            // echo strlen($img_name); die;
            $config = array(
            'upload_path' => "uploads/clients/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => FALSE,
            'max_size' => "1048576"
                // 'max_height' => "768",
                // 'max_width' => "1024"
            );
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
           
            if($this->upload->do_upload('client_img')){
                // Insert Post to DB
               
                if($this->Upload_Model->update_client_by_id($client_id,$school_name,$client_name,$client_testimonial,$img_name)){
                    echo "success";
                }
                else{
                    echo "failure";
                }
            }

            else{
                $error = array('error' => $this->upload->display_errors());
                echo $this->upload->display_errors();
            }
        }

        // IF NEW IS NOT IMAGE SELECTED
        else{
            
            if($this->Upload_Model->update_client_by_id($client_id,$school_name,$client_name,$client_testimonial,$img_name="")){
                    echo "success";
            }
            else{
                echo "failure";
            }
        }
 
    }


    // Function to add new post
    public function update_home_video(){
        // Get Data
        $video_name = $_FILES['home__video']['name'];
        $img_name = $_FILES['home__video__backdrop']['name'];

        $config = array(
            'upload_path' => "assets/home/",
            'allowed_types' => "gif|jpg|png|jpeg|mp4",
            'overwrite' => FALSE,
            'max_size' => "1048576"
            // 'max_height' => "768",
            // 'max_width' => "1024"
        );
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
       
        if($this->upload->do_upload('home__video') && $this->upload->do_upload('home__video__backdrop')){
            // Insert Post to DB
           
            if($this->Upload_Model->update_home_video($video_name,$img_name)){
                echo "success";
            }
            else{
                echo "failure";
            }
        }

        else{
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors();
        }
    }
    

    // ADD NEW FEATURE

    // Function to add new post
    public function add_new_fetaure(){
        // Get Data
        $feature_title = $this->input->post('feature__title');
        $img_name = $_FILES['feature__icon']['name'];

        $config = array(
            'upload_path' => "uploads/features/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => FALSE,
            'max_size' => "1048576"
            // 'max_height' => "768",
            // 'max_width' => "1024"
        );
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
       
        if($this->upload->do_upload('feature__icon')){
            // Insert Post to DB
           
            if($this->Upload_Model->add_new_feature($feature_title,$img_name)){
                echo "success";
            }
            else{
                echo "failure";
            }
        }

        else{
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors();
        }
    }

    function get_feature_list(){
        $feature_list = $this->Upload_Model->get_feature_list();
       
        $feature_list_html =" ";
        foreach($feature_list as $feature){ 
            $feature_icon = $feature['feature_icon'];
            $feature_title = $feature['feature_title'];
            $feature_id = $feature['id'];
            $base_url = base_url();
            $feature_list_html .= "<li>
                <img class='feature__icon' src='$base_url/uploads/features/$feature_icon' alt=''>$feature_title 
                <a href='' class='remove__feature btn btn-danger float-right' feature_id='$feature_id'>Remove</a></li>";

            
        }
        echo json_encode($feature_list_html);

    }



    // DELETE FEATURE
    public function delete_feature(){
        $feature_id =  $this->input->post('feature_id');

        if($this->Upload_Model->delete_feature($feature_id)){
            echo "success";
        }
        else{
            echo "fail";
        }
    }

    // REMOVE FEATURE FROM PACKAGE
    public function remove_feature_from_package(){
        $feature_id =  $this->input->post('feature_id');
        $package_id =  $this->input->post('package_id');

        if($this->Upload_Model->remove_feature_from_package($package_id, $feature_id)){
            echo "success";
        }
        else{
            echo "fail";
        }
    }


    function get_feature_not_in_package($package_id){
        $feature_list = $this->Upload_Model->get_feature_list_not_in_package($package_id);
       
        $feature_list_not_in_package =" ";
        foreach($feature_list as $feature){ 
            $feature_icon = $feature['feature_icon'];
            $feature_title = $feature['feature_title'];
            $feature_id = $feature['id'];
            $base_url = base_url();
            $feature_list_not_in_package .= "<li>
            <p><img class='feature__icon' src='$base_url/uploads/features/$feature_icon' alt=''>$feature_title</p>
            <p class='text-left'>
                <a href='' class='add__to__package btn btn-success' feature_id='$feature_id' package_id='$package_id'>Add To This Package</a>
            </p></li>";

            
        }
        echo json_encode($feature_list_not_in_package);

    }



    // Function to add new post
    public function add__feature__to__package(){
        
        // Get Data
        $feature_id = $this->input->post('feature_id');
        $package_id = $this->input->post('package_id');
      
        if($this->Upload_Model->add__feature__to__package($package_id,$feature_id)){
            echo "success";
        }
        else{
            echo "failure";
        }

    }



    function get_package_feature($package_id){
        $feature_list = $this->Upload_Model->Upload_Model->get_single_package_features($package_id);
       
        $feature_list_html =" ";
        foreach($feature_list as $feature){ 
            $feature_icon = $feature->feature_icon;
            $feature_title = $feature->feature_title;
            $feature_id = $feature->id;
            $base_url = base_url();
            $feature_list_html .= "<li>
                <img class='feature__icon' src='$base_url/uploads/features/$feature_icon' alt=''>$feature_title 
                <a href='' class='remove__feature__from__package btn btn-danger float-right' feature_id='$feature_id' package_id='$package_id'>Remove</a></li>";

            
        }
        echo json_encode($feature_list_html);

    }


    // Function to add new post
    public function save_package_data(){
        // Get Data
        $package_id = $this->input->post('package_id');
        $package_name = $this->input->post('package_name');
        $package_tagline = $this->input->post('package_tagline');
        $package_price =  $this->input->post('package_price');
        
        if($this->Upload_Model->update_package_by_id($package_id,$package_name,$package_tagline,$package_price)){
                echo "success";
        }
        else{
            echo "failure";
        }
    }
    



}