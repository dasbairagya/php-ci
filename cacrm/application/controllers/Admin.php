<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    // default function, redirects to login page if no admin logged in yet
    public function index() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    // global search function for client, team member, client project, team task, note, support ticket
    function search($search_key = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ( $_POST ) {
            redirect(base_url() . 'index.php?admin/search/' . $this->input->post('search_key') , 'refresh');
        }

        $page_data['search_key']    =   $search_key;
        $page_data['page_name']     =   'search';
        $page_data['page_title']    =   get_phrase('search_result');
        $this->load->view('backend/index', $page_data);

    }

    //reloads the search result body after ajax success
    function reload_search_result_body() {
        $page_data['search_key']    =   $this->input->post('search_key');
        $this->load->view('backend/admin/search_result', $page_data);
    }

    // admin dashboard
    function dashboard() {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
         


        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    // manage client, add, edit and delete
    function client($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create')
            $this->crud_model->create_client();

        if ($param1 == 'edit')
            $this->crud_model->update_client($param2);

        if ($param1 == 'delete')
            $this->crud_model->delete_client($param2);

        $page_data['page_name'] = 'client';
        $page_data['page_title'] = get_phrase('manage_client');
        $this->load->view('backend/index', $page_data);
    }

    // reloads the client list body
    function reload_client_list() {
        $this->load->view('backend/admin/client_list');
    }
    
    // approval options by admin for clients
    function pending_client($task = "", $client_pending_id = "")
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        if ($task == "approve")
        {
            $this->crud_model->approve_pending_client_info($client_pending_id);
            $this->session->set_flashdata('flash_message' , get_phrase('data_approved_successfuly'));
            redirect('admin/pending_client');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_pending_client_info($client_pending_id);
        }
        
        $page_data['page_name']     = 'pending_client';
        $page_data['page_title']    = get_phrase('manage_pending_client');
        $this->load->view('backend/index', $page_data);
    }
    
    // reloads the pending client list
    function reload_pending_client_list()
    {
        $this->load->view('backend/admin/pending_client_list');
    }

    // manage company, add, edit and delete
    function company($param1 = '' , $param2 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') {
            $this->crud_model->create_company();
        }

        if ($param1 == 'edit') {
            $this->crud_model->edit_company($param2);
        }

        if ($param1 == 'delete') {
            $this->crud_model->delete_company($param2);
        }

        $page_data['page_name']     = 'company';
        $page_data['page_title']    = get_phrase('company');
        $this->load->view('backend/index', $page_data);
    }

    //reloads the assignservice
     function assignservice($param1 = '' , $param2 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
          if ($param1 == 'delete'){
             
            $this->crud_model->delete_service($param2);
        }
       
      

        $page_data['page_name']     = 'assignservice';
        $page_data['page_title']    = get_phrase('assignservice');
        $this->load->view('backend/index', $page_data);
    }

      function reload_assignservice() {
        $this->load->view('backend/admin/assignservice');
    }

    //reloads the company list
    function reload_company_list()
    {
        $this->load->view('backend/admin/company_list');
    }

    // admin management (create new administrator or owner, add or edit or delete admin)
    function admins($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') {
            $this->crud_model->create_admin();
        }

        if ($param1 == 'edit') {
            $this->crud_model->edit_admin($param2);
        }

        if ($param1 == 'delete')
            $this->crud_model->delete_admin($param2);

        $page_data['page_name']     = 'admins';
        $page_data['page_title']    = get_phrase('manage_admins');
        $this->load->view('backend/index', $page_data);
    }

    // reloads the admin list after ajax success
    function reload_admin_list() {
        $this->load->view('backend/admin/admin_list');
    }

    // manage staffs or team members
    function staff($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        if ($param1 == 'create')
            $this->crud_model->create_staff();

        if ($param1 == 'edit')
            $this->crud_model->update_staff($param2);

        if ($param1 == 'delete')
            $this->crud_model->delete_staff($param2);

        $page_data['page_name'] = 'staff';
        $page_data['page_title'] = get_phrase('manage_staff');
        $this->load->view('backend/index', $page_data);
    }

    // reloads the staff list
    function reload_staff_list() {
        $this->load->view('backend/admin/staff_list');
    }

    //manage account roles (staff account permissions)
    function account_role($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        if ($param1 == 'create')
            $this->crud_model->create_account_role();

        if ($param1 == 'edit')
            $this->crud_model->update_account_role($param2);

        if ($param1 == 'delete')
            $this->crud_model->delete_account_role($param2);

        $page_data['page_name'] = 'account_role';
        $page_data['page_title'] = get_phrase('manage_account_role');
        $this->load->view('backend/index', $page_data);
    }

    // reloads the account role list after ajax success
    function reload_account_role_list() {
        $this->load->view('backend/admin/account_role_list');
    }

    // project room : wall, files, tasks, milestones,notes
    function projectroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        // projectroom wall
        if ($param1 == 'wall') {
            $page_data['room_page']    = 'project_wall';
            $page_data['project_code'] = $param2; 
        }

        // projectroom files
        else if ($param1 == 'file') {
            $page_data['room_page']    = 'project_file';
            $page_data['project_code'] = $param2;
        }  
        
        // projectroom tasks
        else if ($param1 == 'bug') {
            $page_data['room_page'] = 'project_bug';
            $page_data['project_code'] = $param2;
        }

        // projectroom tasks
        else if ($param1 == 'task') {
            $page_data['room_page'] = 'project_task';
            $page_data['project_code'] = $param2;
        }

        // projectroom timesheet
        else if ($param1 == 'timesheet') {
            $page_data['room_page'] = 'project_timesheet';
            $page_data['project_code'] = $param2;
        }

        // project milestones
        else if ($param1 == 'payment') {
            $page_data['room_page'] = 'project_payment';
            $page_data['project_code'] = $param2;
        }

        // projectroom notes
        else if ($param1 == 'note') {
            $page_data['room_page'] = 'project_note';
            $page_data['project_code'] = $param2;
        }

        // projectroom overview
        else if ($param1 == 'overview') {
            $page_data['room_page'] = 'project_overview';
            $page_data['project_code'] = $param2;
        }
        
        // projectroom expense
        else if ($param1 == 'expense') {
            $page_data['room_page'] = 'project_expense';
            $page_data['project_code'] = $param2;
        }

        // edit project 
        else if ($param1 == 'edit') {
            $page_data['room_page'] = 'project_edit';
            $page_data['project_code'] = $param2;
        }

        $page_data['page_name']   = 'project_room'; 
        $page_data['page_title']  = get_phrase('project_room');
        $page_data['page_title'] .=  " : " . $this->db->get_where('project',array('project_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

    // projectroom wall discussion messages
    function project_message($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'add') {
            $this->crud_model->create_project_message($param2);  // param2 = project_code
        }

        if ($param1 == 'download') {
            $this->crud_model->download_project_message_file($param2);
        }
        if ($param1 == 'download_document') {
            $this->crud_model->download_project_document($param2);
        }
    }

    // reloads the projectroom wall discussion body after ajax success
    function reload_projectroom_wall($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/admin/project_wall' , $page_data);
    }

    // projectroom files
    function project_file($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'upload')
        {
            $this->crud_model->upload_project_file($param2); // param2 = project_code
        }

        else if ($param1 == 'dropzone_upload') {
            $this->crud_model->dropzone_upload($param2); // param2 = project_code
        }

        else if ($param1 == 'dropbox_upload') {
            $this->crud_model->dropbox_upload($param2); // param2 = project_code

        }

        else if ($param1 == 'download')
            $this->crud_model->download_project_file($param2); // param2 = project_file_id
        else if($param1 == 'downloadrequireddocument')
            $this->crud_model->download_req_document($param2); // param2 = project_file_id
        else if ($param1 == 'delete')
            $this->crud_model->delete_project_file($param2); // param2 = project_file_id
    }

    // reloads the projectroom file list
    function reload_projectroom_file_list($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/admin/project_file_list' , $page_data);
    }

    // projectroom tasks
    function project_task($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') 
        {
            $this->crud_model->create_project_task($param2);  // param2 = project_id
        } 
        else if ($param1 == 'edit') 
        {
            $this->crud_model->update_project_task($param2); // param2 = project_task_id
        } 
        else if ($param1 == 'delete') 
        {
            $this->crud_model->delete_project_task($param2); // param2 = project_task_id
        }
    }
    
    // projectroom bug
    function project_bug($param1 = '', $param2 = '', $param3 = '') 
    {
        /*if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }*/

        if ($param1 == 'create') 
        {
            $this->crud_model->create_project_bug($param2);  // param2 = project_code
        } 
        else if ($param1 == 'edit') 
        {
            $this->crud_model->update_project_bug($param2); // param2 = project_bug_id
        } 
        else if ($param1 == 'delete') 
        {
            $this->crud_model->delete_project_bug($param2); // param2 = project_bug_id
        }
    }
     // projectroom bug
    function project_expense($param1 = '', $param2 = '', $param3 = '') 
    {
        /*if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }*/

        if ($param1 == 'create') 
        {
            $this->crud_model->create_project_expense($param2);  // param2 = project_code
        } 
        else if ($param1 == 'edit') 
        {
            $this->crud_model->update_project_expense($param2); // param2 = project_expense_id
        } 
        else if ($param1 == 'delete') 
        {
            $this->crud_model->delete_project_expense($param2); // param2 = project_expense_id
        }
    }


    // reloads the projectroom task body 
    function reload_projectroom_task($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/admin/project_task' , $page_data);
    }
    
    // reloads the projectroom bug body 
    function reload_projectroom_bug($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/admin/project_bug' , $page_data);
    }

    // reloads the projectroom task body 
    function reload_projectroom_expense($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/admin/project_expense' , $page_data);
    }
    // projectroom notes
    function project_note($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'save')
            $this->crud_model->save_project_note($param2); // param2 = project_code
    }

    // reloads the projectroom notes body
    function reload_projectroom_note($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/admin/project_note' , $page_data);
    }

    // projectroom payment/milestones
    function project_milestone($param1 = '' , $param2 = '' , $param3 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'add') {
            $this->crud_model->add_project_milestone($param2); // param2 = project code
        }

        if ($param1 == 'edit') {
            $this->crud_model->edit_project_milestone($param2); // param2 = project milestone id
        }

        if ($param1 == 'delete') {
            $this->crud_model->delete_project_milestone($param2); // param2 = project milestone id
        }

        if ($param1 == 'take_manual_payment') {
            $this->crud_model->take_project_milestone_manual_payment($param2); // param2 = project milestone id
        }
    }

    // function for emailing the milestone invoice to the associated client
    function email_milestone_invoice($project_milestone_id) {
        
        $this->load->helper(array('dompdf', 'file'));
        
        $page_data['project_milestone_id']      =   $project_milestone_id;
        $html   =   $this->load->view('backend/admin/project_milestone_view_pdf' , $page_data , true);
        
        // generate pdf by dompdf
        $data = pdf_create($html, '', false);
        write_file('uploads/invoice.pdf', $data);
        $invoice_number =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->invoice_number;
        $client_id      =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->client_id;
        $client_email   =   $this->db->get_where('client' , array('client_id' => $client_id))->row()->email;
        
        // send the invoice to client email
        $this->email_model->do_email('' , 'invoice #'.$invoice_number , $client_email , NULL , 'uploads/invoice.pdf');
    }

    // reloads the projectroom payment body
    function reload_projectroom_payment($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/admin/project_payment' , $page_data);
    }

    // projectroom timesheet
    function project_timer($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'edit') {
            $this->crud_model->update_project_timer($param2, $param3);  // param2 = timer_status 0stop 1start, param3 = project_id
        }

        if ($param1 == 'delete') {
            $this->crud_model->delete_project_timer($param2); // param2 = project timesheet id
        }
    }

    // reloads the timer
    function reload_projectroom_timer($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/admin/project_timesheet' , $page_data);
    }

    // create new project, edit, delete, mark as archived
    function project($param1 = '', $param2 = '') {
        

        if ($param1 == 'create') {
           $project_code = $this->crud_model->create_project();
            // $project_code = $this->crud_model->save_service();
            $this->session->set_flashdata('flash_message' , get_phrase('project_created_successfully'));
            redirect(base_url() . 'index.php?admin/projectroom/wall/' . $project_code , 'refresh');
        }


        if ($param1 == 'edit') {
            $this->crud_model->update_project($param2);
            $this->session->set_flashdata('flash_message' , get_phrase('project_updated'));
            redirect(base_url() . 'index.php?admin/projectroom/edit/' . $param2 , 'refresh');
        }

        if ($param1 == 'delete')
            $this->crud_model->delete_project($param2);

        if ($param1 == 'mark_as_archive') {
            $this->db->where('project_code' , $param2);
            $this->db->update('project' , array('project_status' => 0));
        }

        if ($param1 == 'remove_from_archived') {
            $this->db->where('project_code' , $param2);
            $this->db->update('project' , array('project_status' => 1));
        }


        $page_data['page_name'] = 'project';
        $page_data['page_title'] = get_phrase('manage_service');
        $this->load->view('backend/index', $page_data);
    }

    function project_add() {
        
        $page_data['page_name'] = 'project_add';
        $page_data['page_title'] = get_phrase('create_new_service');
        $this->load->view('backend/index', $page_data);
    }

    function reload_project_list() {
        $this->load->view('backend/admin/project_list');
    }

    // manage project quotes sent by clients
    function project_quote($param1 = '', $param2 = '') 
    {
        if ($this->session->userdata('admin_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        if ($param1 == "archive")
        {
            $this->crud_model->archive_project_quote($param2);
            $this->session->set_flashdata('flash_message' , get_phrase('data_archived_successfuly'));
            redirect('admin/project_quote');
        }
        
        if ($param1 == "unarchive")
        {
            $this->crud_model->unarchive_project_quote($param2);
            $this->session->set_flashdata('flash_message' , get_phrase('data_unarchived_successfuly'));
            redirect('admin/project_quote');
        }

        if ($param1 == 'delete')
            $this->crud_model->delete_project_quote($param2);

        $page_data['page_name']     = 'project_quote';
        $page_data['page_title']    = get_phrase('manage_service_quote');
        $this->load->view('backend/index', $page_data);
    }
    function project_quote_view($quote_id = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $page_data['quote_id']   = $quote_id;
        $page_data['page_name']  = 'project_quote_view';
        $page_data['page_title'] = get_phrase('service_quote');
        $this->load->view('backend/index', $page_data);
    }
    function project_quote_post_reply($quote_id = '') {
        $this->crud_model->post_quote_reply($quote_id);
    }
    function reload_quote_message_view_body($quote_id = '') {
        $page_data['quote_id'] = $quote_id;
        $this->load->view('backend/admin/project_quote_view_body', $page_data);
    }
    function reload_project_quote_list() 
    {
        $this->load->view('backend/admin/project_quote_list');
    }

    // task create, manage, edit, delete, fileupload, subtask, reminder, staff assign
    function team_task($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') {
            $team_task_id = $this->crud_model->add_new_team_task();
            redirect(base_url() . 'index.php?admin/team_task_view/' . $team_task_id , 'refresh');
        }

        if ($param1 == 'edit') {
            $this->crud_model->edit_team_task($param2);
        }

        if ($param1 == 'mark_archived') {
            $this->db->where('team_task_id' , $param2);
            $this->db->update('team_task' , array('task_status' => 0));
            $this->session->set_flashdata('flash_message' , get_phrase('task_archived'));
            redirect(base_url() . 'index.php?admin/team_task_archived' , 'refresh');
        }

        if ($param1 == 'remove_from_archive') {
            $this->db->where('team_task_id' , $param2);
            $this->db->update('team_task' , array('task_status' => 1));
            $this->session->set_flashdata('flash_message' , get_phrase('removed_from_archive'));
            redirect(base_url() . 'index.php?admin/team_task' , 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('team_task_id' , $param2);
            $this->db->delete('team_task');
            $this->session->set_flashdata('flash_message' , get_phrase('task_deleted'));
            redirect(base_url() . 'index.php?admin/team_task' , 'refresh');
        }

        $page_data['page_name']     = 'team_task';
        $page_data['page_title']    = get_phrase('running_team_tasks');
        $this->load->view('backend/index', $page_data);
    }

    // archived team tasks
    function team_task_archived($param1 = '' , $param2 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']     = 'team_task_archived';
        $page_data['page_title']    = get_phrase('archived_team_tasks');
        $this->load->view('backend/index', $page_data);
    }

    // function for saving team task notes
    function save_task_note($team_task_id = '') {
        $data['task_note']  =   $this->input->post('task_note');
        $this->db->where('team_task_id' , $team_task_id);
        $this->db->update('team_task' , array('task_note' => $data['task_note']));
    }

    // loads the view file for team task
    function team_task_view($team_task_id = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']    =   'team_task_view';
        $page_data['team_task_id'] =   $team_task_id;
        $page_data['page_title']   =   get_phrase('team_task');
        $this->load->view('backend/index' , $page_data);
    }

    // function for uploading, dowloading or deleting a team task file
    function team_task_file($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'upload')
            $this->crud_model->upload_team_task_file($param2); 

        else if ($param1 == 'download')
            $this->crud_model->download_team_task_file($param2); 

        else if ($param1 == 'delete')
            $this->crud_model->delete_team_task_file($param2); 
    }

    function reload_team_task_information($team_task_id = '') {
        $page_data['team_task_id'] =   $team_task_id;
        $this->load->view('backend/admin/team_task_information' , $page_data);
    }

    function reload_team_task_information_archived($team_task_id = '') {
        $page_data['team_task_id'] =   $team_task_id;
        $this->load->view('backend/admin/team_task_information_archived' , $page_data);
    }

    function reload_team_task_tab($team_task_id = '') {
        $page_data['team_task_id'] =   $team_task_id;
        $this->load->view('backend/admin/team_task_tab' , $page_data);
    }

    // calendar schedule add, edit, delete, view
    function calendar($param1 = '', $param2 = '' , $param3 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create_event') {
            $this->crud_model->calendar_event_add();
        }

       

       

        if ($param1 == 'edit') {
            $this->crud_model->calendar_event_edit($param2); // param2 = calendar event id
        }

        if ($param1 == 'delete') {
            $this->crud_model->calendar_event_delete($param2); // param2 = calendar event id
        }

        $page_data['page_name']     = 'calendar';
        $page_data['page_title']    = get_phrase('calendar');
        $this->load->view('backend/index', $page_data);
    }

    // reloads the event calendar body
    function reload_event_calendar_body() {
        $this->load->view('backend/admin/calendar_body');
    }





     // reminder schedule add, edit, delete, view
    function reminder($param1 = '', $param2 = '' , $param3 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

       

         if ($param1 == 'create_reminder') {
            $this->crud_model->calendar_reminder_add();
        }

        if ($param1 == 'edit') {
            $this->crud_model->calendar_reminder_edit($param2); // param2 = calendar event id
        }

       

        if ($param1 == 'delete') {
            $this->crud_model->calendar_reminder_delete($param2); // param2 = calendar event id
        }

        $page_data['page_name']     = 'reminder';
        $page_data['page_title']    = get_phrase('reminder');
        $this->load->view('backend/index', $page_data);
    }

    // reloads the reminder body
    function reload_event_reminder_body() {
        $this->load->view('backend/admin/reminder_body');
    }





    // private messaging
    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        
        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name'] = $param1;
        $page_data['page_name'] = 'message';
        $page_data['page_title'] = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }
    
   
    // note lists, ajax based ( similar to ios note )
    function note($param1 = '', $param2 = '' , $param3 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'save') {
            $this->crud_model->save_note($param2); // param2 = note id
        }

        if ($param1 == 'delete') {
            $this->crud_model->delete_note($param2); // param2 = note id
        }

        $page_data['page_name']     = 'note';
        $page_data['page_title']    = get_phrase('notes');
        $this->load->view('backend/index', $page_data);
    }
       // note lists, ajax based ( similar to ios note )
       // @Vikram Singh 
      //Date created 25/11/16
    function document($param1 = '', $param2 = '' , $param3 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        // if ($param1 == 'save') {
        //     $this->crud_model->save_note($param2); // param2 = note id
        // }

        if ($param1 == 'savedocument') {
            $this->crud_model->delete_note($param2); // param2 = note id
        }

        $page_data['page_name']     = 'document';
        $page_data['page_title']    = get_phrase('document');
        $this->load->view('backend/index', $page_data);
    }
    //
     function required_document($param1 = '', $param2 = '' , $param3 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        // if ($param1 == 'save') {
        //     $this->crud_model->save_note($param2); // param2 = note id
        // }

        // if ($param1 == 'delete') {
        //     $this->crud_model->delete_note($param2); // param2 = note id
        // }

        $page_data['page_name']     = 'required_document';
        $page_data['page_title']    = get_phrase('required_document');
        $this->load->view('backend/index', $page_data);
    }


    // create note and reply the created note_id, to reload via ajax and activate that blank note
    function create_note() {
        $this->crud_model->create_note();
    }

    // reloads the note body after ajax success
    function reload_notes_tab_body($note_id = '') {
        $note_data['active_note_id'] = $note_id;
        $this->load->view('backend/admin/notes_tab_body' , $note_data);
    }

    // accounting of client payment
    function accounting_client_payment($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']     = 'accounting_client_payment';
        $page_data['page_title']    = get_phrase('client_payments');
        $this->load->view('backend/index', $page_data);
    }

    // accounting of expenses
    function accounting_expense($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'add') {
            $this->crud_model->expense_add();
        }

        if ($param1 == 'edit') {
            $this->crud_model->expense_edit($param2); // param2 = payment id
        }

        if ($param1 == 'delete') {
            $this->crud_model->expense_delete($param2); // param2 = payment id
        }

        $page_data['page_name']     = 'accounting_expense';
        $page_data['page_title']    = get_phrase('manage_expenses');
        $this->load->view('backend/index', $page_data);
    }

    function reload_expense_list() {
        $this->load->view('backend/admin/expense_list');
    }

    // expense categories
    function accounting_expense_category($param1 = '' , $param2 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'add') {
            $this->crud_model->expense_category_add();
        }

        if ($param1 == 'edit') {
            $this->crud_model->expense_category_edit($param2); // param2 = expense category id
        }

        if ($param1 == 'delete') {
            $this->crud_model->expense_category_delete($param2); // param2 = expense category id
        }

        $page_data['page_name']     = 'accounting_expense_category';
        $page_data['page_title']    = get_phrase('expense_category');
        $this->load->view('backend/index', $page_data);

    }

    function reload_expense_category_list() {
        $this->load->view('backend/admin/expense_category_list');
    }

    // reports
    function report($param1 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        if (isset($_POST['date_range'])) {
            $date_range = $this->input->post('date_range');
            $date_range = explode(" - ", $date_range);

            $page_data['timestamp_start']   = strtotime($date_range[0]);
            $page_data['timestamp_end']     = strtotime($date_range[1]);
        } else {
            $page_data['timestamp_start']   = strtotime('-29 days', time());
            $page_data['timestamp_end']     = strtotime(date("m/d/Y"));
        }
        $page_data['page_name']             = 'report';
        $page_data['report_type']           = $param1;

        if ( $param1 == 'project' )
            $page_data['page_title']            = get_phrase('project_income_report');
        else if ( $param1 == 'client' )
            $page_data['page_title']            = get_phrase('client_payment_report');
        else if ( $param1 == 'expense' )
            $page_data['page_title']            = get_phrase('expense_report');
        else if ( $param1 == 'income_expense' )
            $page_data['page_title']            = get_phrase('income_expense_comparison_report');

        $this->load->view('backend/index', $page_data);
    }

    function reload_report_project_body() {
        $date_range = $this->input->post('date_range');
        $date_range = explode(" - ", $date_range);

        $page_data['timestamp_start'] = strtotime($date_range[0]);
        $page_data['timestamp_end'] = strtotime($date_range[1]);
        $this->load->view('backend/admin/report_project_body', $page_data);
    }

    // support tickets management
    function support_ticket($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        if ($param1 == 'create')
            $this->crud_model->create_support_ticket();

        if ($param1 == 'delete')
            $this->crud_model->delete_support_ticket($param2);   //param2 = ticket_code

        if ($param1 == 'assign_staff')
            $this->crud_model->support_ticket_assign_staff($param2); //param2 = ticket_code

        if ($param1 == 'update_status')
            $this->crud_model->support_ticket_update_status($param2); //param2 = ticket_code

        $page_data['page_title'] =   get_phrase('support_ticket');
        $page_data['page_name']  = 'support_ticket';
        $this->load->view('backend/index', $page_data);
    }

    function support_ticket_view($ticket_code = '') {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $page_data['ticket_code'] = $ticket_code;
        $page_data['page_name'] = 'support_ticket_view';
        $page_data['page_title'] = get_phrase('support_ticket');
        $this->load->view('backend/index', $page_data);
    }

    function support_ticket_post_reply($ticket_code = '') {
        $this->crud_model->post_ticket_reply($ticket_code);
    }

    function reload_support_ticket_list( ) {
        $this->load->view('backend/admin/support_ticket_list');
    }

    function reload_support_ticket_view_body($ticket_code = '') {
        $page_data['ticket_code'] = $ticket_code;
        $this->load->view('backend/admin/support_ticket_view_body', $page_data);
    }

    function support_ticket_create() {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $page_data['page_name'] = 'support_ticket_create';
        $page_data['page_title'] = get_phrase('create_new_ticket');
        $this->load->view('backend/index', $page_data);
    }


    // crud for sidebar todo list
    function todo($task = '', $todo_id = '', $swap_with = '') {
        
        if($task == 'add')
            $this->crud_model->add_todo();
        
        if($task == 'reload')
            $this->load->view('backend/todo_body');

        if($task == 'reload_incomplete_todo')
            $this->crud_model->get_incomplete_todo();
        
        if($task == 'mark_as_done')
            $this->crud_model->mark_todo_as_done($todo_id);
        
        if($task == 'mark_as_undone')
            $this->crud_model->mark_todo_as_undone($todo_id);
        
        if($task == 'swap')
            $this->crud_model->swap_todo($todo_id, $swap_with);
        
        if($task == 'delete')
            $this->crud_model->delete_todo($todo_id);
    }

    // system settings
    function system_settings($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'do_update') {
            $this->crud_model->update_system_settings();
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('theme_selected')); 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh'); 
        }
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    // payment settings
    function payment_settings($param1 = '' , $param2 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'update_payment_settings') {

            $data['description'] = $this->input->post('stripe_api_key');
            $this->db->where('type', 'stripe_api_key');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('stripe_publishable_key');
            $this->db->where('type', 'stripe_publishable_key');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type', 'paypal_email');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('system_currency_id');
            $this->db->where('type', 'system_currency_id');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message' , get_phrase('payment_settings_updated'));
            redirect(base_url() . 'index.php?admin/payment_settings' , 'refresh');
        }

        $page_data['page_name'] = 'payment_settings';
        $page_data['page_title'] = get_phrase('payment_settings');
        $this->load->view('backend/index', $page_data);

    }

    // email template settings
    function email_settings($param1 = 1, $param2 = '') {
        

        if ($param1 == 'do_update') {
            $this->crud_model->save_email_template($param2);
            $this->session->set_flashdata('flash_message', get_phrase('email_template_updated'));
            redirect(base_url() . 'index.php?admin/email_settings/' . $param2, 'refresh');
        }

        $page_data['current_email_template_id'] = $param1;
        $page_data['page_name'] = 'email_settings';
        $page_data['page_title'] = get_phrase('email_template_settings');
        $this->load->view('backend/index', $page_data);
    }
    //SMTP settings
     function smtpemailsettings()
     {
	$page_data['page_name'] = 'smtp_email_settings';
        $page_data['page_title'] = get_phrase('smtp_settings');
        $this->load->view('backend/index', $page_data);		
        
     }
     function save_smtp_settings() {
         
         
            foreach($_POST as $key=>$value)
		{
			$this->form_validation->set_rules($key,$key,'required');
		}
		
			
			
				$key = 'smtp_settings';
				$data['description'] 	= json_encode($_POST);	
                                
				$res = $this->crud_model->getvalues($key);
                                
				if($res=='')
				{
					$data['key']	= $key;			
					$this->crud_model->addvalues($data);
				}
				else
					$this->crud_model->updatevalues($key,$data);
				
				if($this->input->post('smtp_email')=='Enable')
				{
					$this->load->helper('file');
					$data = 	'<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");'."\n".''
								 .'$config["protocol"]="smtp";'."\n".''
								 .'$config["smtp_host"]="'.$this->input->post('smtp_host').'";'."\n".''
								 .'$config["smtp_port"]="'.$this->input->post('smtp_port').'";'."\n".''
								 .'$config["smtp_timeout"]="'.$this->input->post('smtp_timeout').'";'."\n".''
								 .'$config["smtp_user"]="'.$this->input->post('smtp_user').'";'."\n".''
								 .'$config["smtp_pass"]="'.$this->input->post('smtp_pass').'";'."\n".''
								 .'$config["charset"]="'.$this->input->post('char_set').'";'."\n".''
								 .'$config["newline"]="'.$this->input->post('new_line').'";'."\n".''
								 .'$config["mailtype"]="'.$this->input->post('mail_type').'";'."\n".'';
 
					if ( ! write_file('./application/config/email.php', $data))
					{
					     $this->session->set_flashdata('msg', '<div class="alert alert-danger">Unable to write file[ROOT/application/config/email.php]</div>');
					}
					else
					{
					     $this->session->set_flashdata('msg', '<div class="alert alert-success">'.get_phrase('data_updated').'</div>');
					}
				}	
				else
				{
					unlink('./application/config/email.php');
				}	
				
								
			

			 redirect(base_url() . 'index.php?admin/smtpemailsettings', 'refresh');	
		
      }
    // language settings
    function manage_language($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile'] = $param2;
        }
        if ($param1 == 'update_phrase') {
            $language = $param2;
            $total_phrase = $this->input->post('total_phrase');
            for ($i = 1; $i < $total_phrase; $i++) {
                //$data[$language]  =   $this->input->post('phrase').$i;
                $this->db->where('phrase_id', $i);
                $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
            }
            redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/' . $language, 'refresh');
        }
        if ($param1 == 'do_update') {
            $language = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT',
                    'null' => FALSE
                )
            );
            $this->dbforge->add_column('language', $fields);

            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        $page_data['page_name'] = 'manage_language';
        $page_data['page_title'] = get_phrase('manage_language');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    // profile settings
    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['name']    = $this->input->post('name');
            $data['email']   = $this->input->post('email');
            $data['phone']   = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $admin_id = $this->session->userdata('login_user_id');

            $this->db->where('admin_id', $admin_id);
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/admin_image/" . $admin_id . '.jpg');

            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('admin', array('admin_id' =>
                        $this->session->userdata('login_user_id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('admin_id', $this->session->userdata('login_user_id'));
                $this->db->update('admin', array('password' => $new_password));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
            $page_data['page_name'] = 'manage_profile';
            $page_data['page_title'] = get_phrase('manage_profile');
            $page_data['edit_data'] = $this->db->get_where('admin', array(
                        'admin_id' => $this->session->userdata('login_user_id')))->result_array();
            $this->load->view('backend/index', $page_data);
    }
	
	function create_saveservice($param1 = '', $param2 = '') {
        

        if ($param1 == 'create') {
           $project_code = $this->crud_model->create_project1(); 

          //  $project_code = $this->crud_model->save_service();
            
             $this->session->set_flashdata('flash_message' , get_phrase('project_created_successfully'));
            redirect(base_url() . 'index.php?admin/projectroom/wall/' . $project_code , 'refresh');
        }


        if ($param1 == 'edit') {
            $this->crud_model->update_project($param2);
            $this->session->set_flashdata('flash_message' , get_phrase('project_updated'));
            redirect(base_url() . 'index.php?admin/projectroom/edit/' . $param2 , 'refresh');
        }

        if ($param1 == 'delete')
            $this->crud_model->delete_project($param2);

        if ($param1 == 'mark_as_archive') {
            $this->db->where('project_code' , $param2);
            $this->db->update('saveservice' , array('project_status' => 0));
        }

        if ($param1 == 'remove_from_archived') {
            $this->db->where('project_code' , $param2);
            $this->db->update('saveservice' , array('project_status' => 1));
        }


        $page_data['page_name'] = 'saveservice';
        $page_data['page_title'] = get_phrase('manage_service');
        $this->load->view('backend/index', $page_data);
    }

    //created services



    function create_service($param1 = '', $param2 = '') {
        
      
        if ($param1 == 'assignservice') {
            $project_code = $this->crud_model->create_service();


       
            
            $this->session->set_flashdata('flash_message' , get_phrase('service_added_successfully'));
            redirect(base_url() . 'index.php?admin/assignservice/' . $project_code , 'refresh');
        }

      

        
       

        


        $page_data['page_name'] = 'saveservice';
       
        $this->load->view('backend/index', $page_data);
    }

     


      function add_task($param1 = '', $param2 = '') 

      {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') {
            $this->crud_model->add_task();
        }
         if ($param1 == 'delete')
            $this->crud_model->delete_task($param2);

       
        $page_data['page_name']  = 'add_task';
        $page_data['page_title'] = get_phrase('add_tasks');
        $this->load->view('backend/index', $page_data);
    }

    function temp(){
        echo  $this->load->view('backend/admin/temp');
    }


      function remind($param1 = '', $param2 = '') 
      {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

       
       
        $page_data['page_name']  = 'remind';
        $page_data['page_title'] = get_phrase('remind');
        $this->load->view('backend/index', $page_data);
     }

    // function get_services()
    // {
        
    //     $data['id']    = $this->input->post('id');
    //     echo $id = $this->input->post('id');
    //     print_r($data['id']);
    //     $services =  $this->crud_model->getServices();
    //     $this->load->view('backend/admin/document', $services);

    // }
    
	
}    