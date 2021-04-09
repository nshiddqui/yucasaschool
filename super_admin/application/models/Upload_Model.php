<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function insert_post_to_db($post_title,$post_content,$img_name,$save_type){
        $post_data = array(
            'title'=>$post_title,
            'author'=>'Edurama Admin',
            'content'=>$post_content,
            'status'=>$save_type,
            'img_url'=>$img_name
        );

        if($this->db->insert('post',$post_data)){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_posts_from_db(){
        $this->db->select('id,title,author,status,publish_date');
        $query = $this->db->get('post');
        $posts_data = $query->result_array();
        return $posts_data;
    }

    public function delete_post($post_id){
        $this->db->where('id', $post_id);
        if($this->db->delete('post')){
            return true;
        }
        else{
            return false;
        }
    }

    public function change_post_status($post_id,$save_type){
        $this->db->where('id', $post_id);
        if($this->db->update('post', array('status' => $save_type))){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_single_post_data($post_id){
        $this->db->select('*');
        $this->db->where('id', $post_id);
        $query = $this->db->get('post');
        $post_data = $query->row();
        return $post_data;
    }


    public function update_post_by_id($post_id,$post_title,$img_name="",$post_content,$save_type){
        if(strlen($img_name) <= 1){
            $post_data = array(
                'title'=>$post_title,
                'author'=>'Edurama Admin',
                'content'=>$post_content,
                'status'=>$save_type
            );
           
            $this->db->where('id', $post_id);
            if($this->db->update('post', $post_data)){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $post_data = array(
                'title'=>$post_title,
                'author'=>'Edurama Admin',
                'content'=>$post_content,
                'status'=>$save_type,
                'img_url'=>$img_name
            );
           
            $this->db->where('id', $post_id);
            if($this->db->update('post', $post_data)){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function insert_client_to_db($school_name,$client_name,$client_testimonial,$client_img){
        $post_data = array(
            'school_name'=>$school_name,
            'client_name'=>$client_name,
            'client_testimonial'=>$client_testimonial,
            'img_url'=>$client_img
        );

        if($this->db->insert('clients',$post_data)){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_clients_from_db(){
        $this->db->select('*');
        $query = $this->db->get('clients');
        $clients_data = $query->result_array();
        return $clients_data;
    }


    public function change_client_status($client_id,$status){
        $this->db->where('id', $client_id);
        if($this->db->update('clients', array('status' => $status))){
            return true;
        }
        else{
            return false;
        }
    }

    public function delete_client($client_id){
        $this->db->where('id', $client_id);
        if($this->db->delete('clients')){
            return true;
        }
        else{
            return false;
        }
    }


    public function get_single_client_data($client_id){
        $this->db->select('*');
        $this->db->where('id', $client_id);
        $query = $this->db->get('clients');
        $post_data = $query->row();
        return $post_data;
    } 

	public function get_single_admin_data($user_id){
        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_login');
        $post_data = $query->row();
        return $post_data;
    }

    public function get_admin_profile_data(){
        $this->db->select('*');
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('user_login');
        $post_data = $query->row();
        return $post_data;
    }
	
	
   public function get_admin_user_data(){
        $this->db->select('*');      
        $query = $this->db->get('user_login');
        $post_data = $query->result_array();
        return $post_data;
    }

    public function update_client_by_id($client_id,$school_name,$client_name,$client_testimonial,$img_name=""){
        if(strlen($img_name) <= 1){
            $client_data = array(
                'school_name'=>$school_name,
                'client_name'=>$client_name,
                'client_testimonial'=>$client_testimonial
            );
           
            $this->db->where('id', $client_id);
            if($this->db->update('clients', $client_data)){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $client_data = array(
                'school_name'=>$school_name,
                'client_name'=>$client_name,
                'client_testimonial'=>$client_testimonial,
                'img_url'=>$img_name
            );
           
            $this->db->where('id', $client_id);
            if($this->db->update('clients', $client_data)){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function update_home_video($video_name,$img_name){

        $client_data = array(
            'home_video'=>$video_name,
            'backdrop_image'=>$img_name
        );
        
        $this->db->where('id', "1");
        if($this->db->update('home_banner', $client_data)){
            return true;
        }

        else{
            return false;
        }
        
    }


    public function get_home_video_data(){
        $this->db->select('*');
        $this->db->where('id', 1);
        $query = $this->db->get('home_banner');
        $home_video_data = $query->row();
        return $home_video_data;
    }


    public function add_new_feature($feature_title,$img_name){
        $feature_data = array(
            'feature_title'=>$feature_title,
            'feature_icon'=>$img_name
        );

        if($this->db->insert('package_features',$feature_data)){
            return true;
        }
        else{
            return false;
        }
    }


    public function get_package_list(){
        $this->db->select('*');
        $query = $this->db->get('package');
        $posts_data = $query->result_array();
        return $posts_data;
    }

    public function get_feature_list(){
        $this->db->select('*');
        $query = $this->db->get('package_features');
        $features_data = $query->result_array();
        return $features_data;
    }
    public function get_school_data(){
        $this->db->select('*');
        $query = $this->db->get('school_list');
        $features_data = $query->result_array();
        return $features_data;
    }
    
    public function delete_feature($feature_id){
        $this->db->where('id', $feature_id);
        if($this->db->delete('package_features')){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_single_package_data($package_id){
        $this->db->select('*');
        $this->db->where('id', $package_id);
        $query = $this->db->get('package');
        $package_data = $query->row();
        return $package_data;
    }

    public function get_single_package_features($package_id){
        $this->db->select('feature_id');
        $this->db->where('package_id', $package_id);
        $query = $this->db->get('package_feature_relation');
        $features_data = $query->result_array();
        $fetaures_list = array();
        
        foreach($features_data as $feature ){
            $this->db->select('*');
            $this->db->where('id', $feature['feature_id']);
            $query = $this->db->get('package_features');
            $feature_data = $query->row();
            array_push($fetaures_list,$feature_data);
        }
        return $fetaures_list;
    }

    public function get_feature_list_not_in_package($package_id){
        $this->db->select('feature_id');
        $this->db->where('package_id', $package_id);
        $query = $this->db->get('package_feature_relation');
        $features_data = $query->result_array();
        $feature_id =array();

        foreach($features_data as $feature){
            array_push($feature_id, $feature['feature_id'] );
        }

        $this->db->select('*');
        $this->db->where_not_in('id', $feature_id);
        $query = $this->db->get('package_features');
        $feature_data = $query->result_array();;       
        return $feature_data;
    }

    


    public function remove_feature_from_package($package_id,$feature_id){
        $this->db->where(array('feature_id'=>$feature_id,"package_id"=>$package_id));
        if($this->db->delete('package_feature_relation')){
            return true;
        }
        else{
            return false;
        }
    }

    public function add__feature__to__package($package_id,$feature_id){
        $feature_data = array(
            'package_id'=>$package_id,
            'feature_id'=>$feature_id
        );

        if($this->db->insert('package_feature_relation',$feature_data)){
            return true;
        }
        else{
            return false;
        }
    }


    public function update_package_by_id($package_id,$package_name,$package_tagline,$package_price){
        
        $post_data = array(
            'package_name'=>$package_name,
            'package_title'=>$package_tagline,
            'package_price'=>$package_price
        );
        
        $this->db->where('id', $package_id);
        if($this->db->update('post', $package_id)){
            return true;
        }
        else{
            return false;
        }
        
    }
    
}
