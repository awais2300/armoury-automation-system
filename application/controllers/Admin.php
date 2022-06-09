<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');

            $this->load->view('Admin/admin');
        } else {
            $this->load->view('Admin/login');
        }
    }

    public function add_users()
    {
        $this->load->view('Admin/create_user');
    }


    public function login_process()
    {
        if ($this->input->post()) {
            $postedData = $this->security->xss_clean($this->input->post());
            $username = $postedData['username'];
            $password = $postedData['password'];
            $query = $this->db->where('username', $username)->where('acct_type', 'admin')->get('security_info')->row_array();
            $hash = $query['password'];

            if (!empty($query)) {
                if (password_verify($password, $hash)) {
                    $this->session->set_userdata('user_id', $query['id']);
                    $this->session->set_userdata('status', $query['type']);
                    $this->session->set_userdata('username', $query['username']);
                    $this->session->set_flashdata('success', 'Login successfully');
                    redirect('Admin');
                } else {
                    $this->session->set_flashdata('failure', 'No such user exist. Kindly create New User using Admin panel');
                    redirect('Admin');
                }
                //print_r($query); exit; 
            } else {
                $this->session->set_flashdata('failure', 'Login failed');
                redirect('Admin');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Admin');
    }

    public function add_user()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $username = $postData['username'];
            $password = password_hash($postData['password'], PASSWORD_DEFAULT);
            $status = $postData['status'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $name = $_POST['name'];

            $insert_array = array(
                'username' => $username,
                'password' => $password,
                'acct_type' => 'user',
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'full_name' => $name
            );

            $insert = $this->db->insert('security_info', $insert_array);

            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Data Submitted successfully');
                redirect('Admin/add_users');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
                redirect('Admin/add_users');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Admin/add_users');
        }
    }

    public function view_activity_log()
    {
        if ($this->session->has_userdata('user_id')) {
            // $data['activity_log'] = $this->db->get('activity_log')->result_array();
            $data['weapon_records'] = $this->db->get('weapons')->result_array();
            $data['weapon_allocation_records'] = $this->db->get('weapon_allocation_records')->result_array();
            $this->load->view('Admin/activity_log', $data);
        }
    }

    public function show_user_list()
    {
        $data['users_list'] = $this->db->where_not_in('acct_type', 'admin')->get('security_info')->result_array();
        $this->load->view('Admin/user_list', $data);
    }

    public function show_total_weapon()
    {
        $data['weapon_list'] = $this->db->get('weapon_ammo_record')->result_array();
        $this->load->view('Admin/weapon_ammo_record', $data);
    }

    public function delete_user($user_id = NULL)
    {

        // $update_array = array(
        //     'is_active' => 'no'
        // );

        // $cond  = ['id' => $user_id];
        // $this->db->where($cond);
        // $update = $this->db->update('security_info', $update_array);

        $this->db->where('id', $user_id);
        $update = $this->db->delete('security_info');

        if (!empty($update)) {
            $this->session->set_flashdata('success', 'Account Deleted Successfully');
            redirect('Admin/show_user_list');
        } else {
            $this->session->set_flashdata('failure', 'Error');
            redirect('Admin/show_user_list');
        }
    }

    public function save_weapon_ammo_record()
    {

        $id = $_POST['id'];
        $weapon_name = $_POST['weapon_name'];
        $total_weapon = $_POST['total_weapon'];
        $total_ammo = $_POST['total_ammo'];
        $record_type = $_POST['record_type'];

        $insert_array = array(
            'weapon_name' => $weapon_name,
            'total_weapon' => $total_weapon,
            'total_ammo' => $total_ammo
        );
        $insert = $this->db->insert('weapon_ammo_record', $insert_array);
    }

    public function update_weapon_ammo_record()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $id = $postData['id_update'];
            $total_weapon_update = $postData['total_weapon_update'];
            $total_ammo_update = $postData['total_ammo_update'];



            $cond  = [
                'id' => $id,
            ];
            $data_update = [
                'total_weapon' => $total_weapon_update,
                'total_ammo' => $total_ammo_update
            ];

            $this->db->where($cond);
            $insert =  $this->db->update('weapon_ammo_record', $data_update);


            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Data Updated successfully');
                redirect('Admin/show_total_weapon');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Admin');
        }
    }
}
