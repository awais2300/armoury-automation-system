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
            $data['activity_log'] = $this->db->get('activity_log')->result_array();
            $this->load->view('Admin/activity_log', $data);
        }
    }
}
