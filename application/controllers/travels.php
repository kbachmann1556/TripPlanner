<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class travels extends CI_Controller {

	public function index()
	{
		$this->load->view('login_reg');
	}

	public function register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("name", "Name", "trim|required|min_length[3]");
		$this->form_validation->set_rules("username", "Username", "trim|required|is_unique[users.username]|min_length[3]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|matches[password]");
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data['errors'] = validation_errors();
			$this->load->view('login_reg');
		}
		else
		{
			$user_details = array(
				"name" => $this->input->post('name'),
				"username" => $this->input->post('username'),
				"password" => $this->input->post('password')
				);
			$this->process->add_user($user_details);
			$this->session->set_flashdata("register_success", "You have successfully registered! You may now log in!");
			redirect('/');
		}
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->process->get_user_username($username);
		if($user && $user['password'] == $password)
		{
			$user_data = array(
				'id' => $user['id'],
				'name' => $user['name'],
				'username' => $user['username']
				);
			$this->session->set_userdata('user_data', $user_data);
			redirect('/travel_dash');
		}
		else
		{
			$this->session->set_flashdata("login_error", "Invalid email or password");
			redirect('/');
		}
	}

	public function travel_dash()
	{
		$user = $this->session->userdata('user_data');
		$user_plans = $this->process->get_user_plans($user['id']);
		$other_plans = $this->process->get_other_plans($user['id']);
		$this->load->view('travel_dash', array("user" => $user,"user_plans" => $user_plans,"other_plans" => $other_plans));
	}

	public function add_plan_page()
	{
		$user = $this->session->userdata('user_data');
		$this->load->view('add_plan', array("user" => $user));
	}

	public function add_trip()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("destination", "Destination", "trim|required");
		$this->form_validation->set_rules("description", "Description", "trim|required");
		$this->form_validation->set_rules("leave_date", "Travel Date From", "trim|required");
		$this->form_validation->set_rules("return_date", "Travel Date To", "trim|required");
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data['errors'] = validation_errors();
			$user = $this->session->userdata('user_data');
			$this->load->view('add_plan', array("user" => $user));
		}
		else if (strtotime($this->input->post('leave_date')) < now() || strtotime($this->input->post('leave_date')) > strtotime($this->input->post('return_date'))) 
		{
			$this->session->set_flashdata("date_error", "Not valid dates for a trip");
			redirect('/add_plan_page');
		}
		else
		{
			$trip_details = array(
				"destination" => $this->input->post('destination'),
				"description" => $this->input->post('description'),
				"leave_date" => $this->input->post('leave_date'),
				"return_date" => $this->input->post('return_date'),
				"created_by" => $this->input->post('created_by')
				);
			$this->process->add_trip($trip_details);
			
			$user = $this->session->userdata('user_data');
			$trip = $this->process->get_new_trip_id();
			$trip_user = array("user_id" => $user['id'],"plan_id" => $trip);
			$this->process->update_users_has_plans($trip_user);

			
			$this->session->set_flashdata("trip_success", "You have successfully added your trip!");
			redirect('/travel_dash');
		}
	}

	public function destination_page($id)
	{
		$trip = $this->process->get_trip_id($id);
		$creator = $this->process->get_trip_creator($trip['created_by']);
		$users = $this->process->get_users_of_trip($id,$creator['id']);
		$this->load->view('destination', array("trip" => $trip, "users" => $users,"creator" => $creator));
	}

	public function join_trip($id)
	{
		$user = $this->session->userdata('user_data');
		$trip_user = array("user_id" => $user['id'],"plan_id" => $id);
		$this->process->update_users_has_plans($trip_user);
		redirect('/travel_dash');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
