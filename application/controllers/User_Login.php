<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('login');
	}



	public function show_login_page()
	{
		if ($this->session->has_userdata('user_id')) {
			$id = $this->session->userdata('user_id');
			$acct_type = $this->session->userdata('acct_type');
			
			if ($acct_type == "user") {
				redirect('Project_Officer');
			} else if ($acct_type == "admin") {
				redirect('Admin');
			} else {
				$this->load->view('login');
			}
		} else {
			$this->load->view('login');
		}
	}

	public function dashboard()
	{
		$this->load->view('dashboard');
	}

	public function login_process()
	{
		if ($this->input->post()) {

			$postedData = $this->security->xss_clean($this->input->post());
			//To create encrypted password use
			$username = $postedData['username'];
			$password = $postedData['password'];

			$status = $this->db->select('acct_type, full_name')->where('username', $username)->get('security_info')->row_array();
			
			if (!empty($status)) {
				$query = $this->db->where('username', $username)->where('acct_type', $status['acct_type'])->get('security_info')->row_array();
				$hash = $query['password'];

				if (!empty($query)) {
					if (password_verify($password, $hash)) {
						$this->session->set_userdata('user_id', $query['id']);
						$this->session->set_userdata('acct_type', $query['acct_type']);
						$this->session->set_userdata('full_name', $query['full_name']);
						$this->session->set_userdata('username', $query['username']);
						$this->session->set_flashdata('success', 'Login successfully');

						$this->db->set('status', 'online');
						$this->db->where('id', $query['id']);
						$this->db->update('security_info');

						redirect('User_Login/show_login_page');
					} else {
						$this->session->set_flashdata('failure', 'Invalid Password');
						redirect('User_Login/show_login_page');
					}
					//print_r($query); exit; 
				} else {
					$this->session->set_flashdata('failure', 'Invalid Username');
					redirect('User_Login/show_login_page');
				}
			}
			$this->session->set_flashdata('failure', 'Invalid Username');
			redirect('User_Login/show_login_page');
		}
	}

	public function edit_profile()
	{
		$data['userdata'] = $this->db->where('id', $this->session->userdata('user_id'))->get('security_info')->row_array();
		$this->load->view('edit_profile', $data);
	}

	public function edit_profile_process()
	{
		$fullname =  $_POST['fullname'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		// $acct_type = $_POST['status'];
		$id = $this->session->userdata('user_id');

		$name = $this->db->where('id', $id)->get('security_info')->row_array();
		//echo $name['username'];exit;

		$cond  = ['ID' => $id];
		$data_update = [
			'username' => $username,
			'full_name' => $fullname,
			'email' => $email,
			'phone' => $phone,
			'address' => $address,
			'acct_type' => 'user'
		];

		$this->db->where($cond);
		$update = $this->db->update('security_info', $data_update);

		$this->session->set_userdata('username', $username);

		if ($update) {
			$this->session->set_flashdata('success', 'Profile Updated successfully');
			redirect('User_Login/edit_profile');
		} else {
			$this->session->set_flashdata('failure', 'Something went wrong, try again.');
			redirect('User_Login/edit_profile');
		}
	}

	public function change_password()
	{
		$this->load->view('change_password');
	}

	public function change_password_process()
	{
		if ($this->input->post()) {
			$postData = $this->security->xss_clean($this->input->post());

			$new_password = password_hash($postData['new_password'], PASSWORD_DEFAULT);
			// $confirm_password = password_hash($postData['confirm_password'], PASSWORD_DEFAULT);
			$id = $this->session->userdata('user_id');

			$cond  = ['ID' => $id];
			$insert_array = array(
				//'username' => $username,
				'password' => $new_password,

			);

			$this->db->where($cond);
			$update = $this->db->update('security_info', $insert_array);

			if (!empty($update)) {
				$this->session->set_flashdata('success', 'password Changed successfully');
				redirect('User_Login/change_password');
			} else {
				$this->session->set_flashdata('failure', 'Something went wrong, try again.');
				redirect('User_Login/change_password');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->db->set('status', 'offline');
		$this->db->where('id', $this->session->userdata('user_id'));
		$this->db->update('security_info');
		redirect('User_Login');
	}
}
