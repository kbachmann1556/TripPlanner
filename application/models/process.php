<?php 

class process extends CI_Model
{
	public function add_user($user_details)
	{
		$query = "INSERT INTO users (name, username, password, created_at)
				  VALUES (?,?,?, NOW())";
		$values = array($user_details['name'],$user_details['username'],$user_details['password']);
		$this->db->query($query, $values);
	}

	public function get_user_username($username)
	{
		return $this->db->query("SELECT * FROM users WHERE username = ?", array($username))->row_array();
	}

	public function get_user_plans($id)
	{
		$query = "SELECT plans.destination, plans.description, plans.leave_date, plans.return_date, plans.id
				  FROM users
				  JOIN users_has_plans
				  ON users.id = users_has_plans.user_id
				  JOIN plans
				  ON users_has_plans.plan_id = plans.id
				  WHERE users.id = '{$id}'";
		return $this->db->query($query)->result_array();
	}

	public function get_other_plans($id)
	{
		$query = "SELECT plans.destination, plans.description, plans.leave_date, plans.return_date, plans.id, users.name
				  FROM users
				  JOIN users_has_plans
				  ON users.id = users_has_plans.user_id
				  JOIN plans
				  ON users_has_plans.plan_id = plans.id
				  WHERE users.id != '{$id}' AND users.id = plans.created_by";
		return $this->db->query($query)->result_array();
	}

	public function add_trip($trip_details)
	{
		$query = "INSERT INTO plans (destination, description, leave_date, return_date, created_by)
				  VALUES (?,?,?,?,?)";
		$values = array($trip_details['destination'],$trip_details['description'],$trip_details['leave_date'],$trip_details['return_date'],$trip_details['created_by']);
		$this->db->query($query, $values);
	}

	public function get_new_trip_id()
	{
		return $this->db->insert_id();
	}

	public function update_users_has_plans($trip_user)
	{
		$query = "INSERT INTO users_has_plans (user_id, plan_id)
				  VALUES (?,?)";
		$values = array($trip_user['user_id'],$trip_user['plan_id']);
		$this->db->query($query, $values);
	}

	public function get_trip_id($id)
	{
		return $this->db->query("SELECT * FROM plans WHERE id = ?", array($id))->row_array();
	}

	public function get_trip_creator($id)
	{
		return $this->db->query("SELECT * FROM users WHERE id = ?", array($id))->row_array();
	}

	public function get_users_of_trip($id,$user_id)
	{
		$query = "SELECT users.name
				  FROM plans
				  JOIN users_has_plans
				  ON plans.id = users_has_plans.plan_id
				  JOIN users
				  ON users_has_plans.user_id = users.id
				  WHERE plans.id = '{$id}' AND users.id != '{$user_id}'";
		return $this->db->query($query)->result_array();
	}
}

 ?>