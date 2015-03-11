<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_auth extends CI_Model {

	public $tables = array();

	public function __construct() {
		parent::__construct();

		//initialize db tables data
		$this->tables = $this->config->item('tables', 'ion_auth');
	}

	function get_groups_all() {
		$sql = 'SELECT ' . $this->tables['groups'] . '.*, count(' . $this->tables['roles'] . '.id) AS jml_role
                FROM ' . $this->tables['groups'] . '
                LEFT JOIN ' . $this->tables['permissions'] . ' ON ' . $this->tables['permissions'] . '.group_id = ' . $this->tables['groups'] . '.id
                LEFT JOIN ' . $this->tables['roles'] . ' ON ' . $this->tables['roles'] . '.id = ' . $this->tables['permissions'] . '.role_id
                GROUP BY ' . $this->tables['groups'] . '.id';
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_groups_not_sa() {
		$sql = 'SELECT ' . $this->tables['groups'] . '.*, count(' . $this->tables['roles'] . '.id) AS jml_role
                FROM ' . $this->tables['groups'] . '
                LEFT JOIN ' . $this->tables['permissions'] . ' ON ' . $this->tables['permissions'] . '.group_id = ' . $this->tables['groups'] . '.id
                LEFT JOIN ' . $this->tables['roles'] . ' ON ' . $this->tables['roles'] . '.id = ' . $this->tables['permissions'] . '.role_id
                WHERE ' . $this->tables['groups'] . '.name != "' . $this->config->item('super_admin_group', 'ion_auth') . '"
                GROUP BY ' . $this->tables['groups'] . '.id';
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_roles() {
		$sql = 'SELECT ' . $this->tables['roles'] . '.id, ' . $this->tables['roles'] . '.name,
        ' . $this->tables['roles'] . '.url, ' . $this->tables['roles'] . '.desc, ' . $this->tables['roles'] . '.parent,
        ' . $this->tables['roles_category'] . '.category
        FROM ' . $this->tables['roles'] . '
        JOIN ' . $this->tables['roles_category'] . ' ON ' . $this->tables['roles_category'] . '.id = ' . $this->tables['roles'] . '.category_id
        ORDER BY category_id ASC';
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function create_role($dataInsert) {
		$query = $this->db->insert($this->tables['roles'], $dataInsert);
		return $query;
	}

	function get_role_by_id($id) {
		$sql = 'SELECT * FROM ' . $this->tables['roles'] . ' WHERE id = ?';
		$query = $this->db->query($sql, $id);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update_role($id, $dataUpdate) {
		$this->db->where('id', $id);
		$update = $this->db->update($this->tables['roles'], $dataUpdate);
		return $update;
	}

	function get_roles_category() {
		$sql = 'SELECT * FROM ' . $this->tables['roles_category'] . ' ORDER BY order_number';
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function create_roles_cat($dataInsert) {
		$query = $this->db->insert($this->tables['roles_category'], $dataInsert);
		return $query;
	}

	function get_role_cat_by($id) {
		$sql = 'SELECT * FROM ' . $this->tables['roles_category'] . ' WHERE id = ?';
		$query = $this->db->query($sql, $id);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update_roles_cat($id, $dataUpdate) {
		$this->db->where('id', $id);
		$update = $this->db->update($this->tables['roles_category'], $dataUpdate);
		return $update;
	}

	function get_permissions_by_group_id($id) {
		$sql = 'SELECT * FROM ' . $this->tables['permissions'] . ' WHERE group_id = ?';
		$query = $this->db->query($sql, $id);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update_group($id, $dataUpdate) {
		$this->db->where('id', $id);
		$update = $this->db->update($this->tables['groups'], $dataUpdate);
		return $update;
	}

	function delete_groups_role($id) {
		$this->db->where('group_id', $id);
		$delete = $this->db->delete($this->tables['permissions']);
		return $delete;
	}

	function insert_groups_role($dataInsert) {
		$query = $this->db->insert($this->tables['permissions'], $dataInsert);
		return $query;
	}

	function get_rule($id) {
		$sql = 'SELECT DISTINCT(role_id), ' . $this->tables['roles'] . '.name as role_name,
            ' . $this->tables['roles'] . '.url as role_url,
            max(rule) as user_rule
            FROM ' . $this->tables['permissions'] . '
            LEFT JOIN ' . $this->tables['roles'] . ' on ' . $this->tables['roles'] . '.id = ' . $this->tables['permissions'] . '.role_id
            WHERE group_id IN (
                SELECT group_id FROM ' . $this->tables['users_groups'] . ' WHERE user_id = ?
            )
            GROUP BY role_id';

		$query = $this->db->query($sql, $id);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_rule_url($params) {
		$sql = 'SELECT DISTINCT(role_id),' . $this->tables['roles'] . '.name as role_name,
            ' . $this->tables['roles'] . '.url as role_url,GROUP_CONCAT(rule SEPARATOR ",") as user_rule
            FROM ' . $this->tables['permissions'] . '
            LEFT JOIN ' . $this->tables['roles'] . ' on ' . $this->tables['roles'] . '.id = ' . $this->tables['permissions'] . '.role_id
            WHERE group_id IN (
                SELECT group_id FROM ' . $this->tables['users_groups'] . ' WHERE user_id = ?
            )
            AND ' . $this->tables['roles'] . '.url = ?
            GROUP BY role_id';

		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function delete_user($id) {
		$this->db->where('id', $id);
		$delete = $this->db->delete($this->tables['users']);
		return $delete;
	}

	function delete_group($id) {
		$this->db->where('id', $id);
		$delete = $this->db->delete($this->tables['groups']);
		return $delete;
	}

	function delete_role($id) {
		$this->db->where('id', $id);
		$delete = $this->db->delete($this->tables['roles']);
		return $delete;
	}

	function delete_roles_cat($id) {
		$this->db->where('id', $id);
		$delete = $this->db->delete($this->tables['roles_category']);
		return $delete;
	}

	function get_options($params) {
		$sql = 'SELECT * FROM rc_options WHERE name = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_roles_cat_id_at_roles() {
		$sql = 'SELECT category_id FROM ' . $this->tables['roles'] . '';
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_users_not_sa() {
		$sql = 'SELECT DISTINCT(user_id), ' . $this->tables['users'] . '.*
        FROM ' . $this->tables['users_groups'] . '
        JOIN ' . $this->tables['users'] . ' ON ' . $this->tables['users'] . '.id = ' . $this->tables['users_groups'] . '.user_id
        JOIN ' . $this->tables['groups'] . ' ON ' . $this->tables['groups'] . '.id = ' . $this->tables['users_groups'] . '.group_id
        WHERE user_id NOT IN (
            SELECT user_id
            FROM ' . $this->tables['users_groups'] . '
            JOIN ' . $this->tables['users'] . ' ON ' . $this->tables['users'] . '.id = ' . $this->tables['users_groups'] . '.user_id
            JOIN ' . $this->tables['groups'] . ' ON ' . $this->tables['groups'] . '.id = ' . $this->tables['users_groups'] . '.group_id
            WHERE ' . $this->tables['groups'] . '.name = "' . $this->config->item('super_admin_group', 'ion_auth') . '"
        )';
		return $this->db->query($sql);
	}

	function get_groups_only_and_where_not_sa() {
		$sql = 'SELECT *
                FROM ' . $this->tables['groups'] . '
                WHERE name != "' . $this->config->item('super_admin_group', 'ion_auth') . '"';
		return $this->db->query($sql);
	}

	function site_titleUpdate($site_title) {
		$this->db->where('name', 'site_title');
		$update = $this->db->update($this->tables['options'], $site_title);
		return $update;
	}

	function site_taglineUpdate($site_tagline) {
		$this->db->where('name', 'site_tagline');
		$update = $this->db->update($this->tables['options'], $site_tagline);
		return $update;
	}

	function site_descUpdate($site_desc) {
		$this->db->where('name', 'site_desc');
		$update = $this->db->update($this->tables['options'], $site_desc);
		return $update;
	}

	function site_emailUpdate($site_email) {
		$this->db->where('name', 'admin_email');
		$update = $this->db->update($this->tables['options'], $site_email);
		return $update;
	}

	function group1Update($group1) {
		$this->db->where('name', 'super_admin_group');
		$update = $this->db->update($this->tables['options'], $group1);
		return $update;
	}

	function group2Update($group2) {
		$this->db->where('name', 'admin_group');
		$update = $this->db->update($this->tables['options'], $group2);
		return $update;
	}

	function group3Update($group3) {
		$this->db->where('name', 'default_group');
		$update = $this->db->update($this->tables['options'], $group3);
		return $update;
	}

	function identityUpdate($identity) {
		$this->db->where('name', 'identity');
		$update = $this->db->update($this->tables['options'], $identity);
		return $update;
	}
}
