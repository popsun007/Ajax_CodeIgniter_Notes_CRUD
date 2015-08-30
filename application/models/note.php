<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Note extends CI_Model
{


	public function add_note($post)
	{
		$now = date("Y-m-d H:i:s");
		$this->db->insert('notes', array(
			'title' => $post,
		 'description' => "Enter description here...", 
		 'created_at' => $now,
		  'updated_at' => $now));
		return $this->db->insert_id();

	}
	public function get_all()
	{
		return $this->db->query("SELECT id, title, description FROM notes")->result_array();
	}
	public function get_one($id)
	{
		return $this->db->query("SELECT id, title, description FROM notes WHERE id=?", array($id))->row_array();
	}
	public function delete($id)
	{
		return $this->db->query("DELETE FROM notes WHERE id=?", array($id));
	}
	public function update($id,$description)
	{
		return $this->db->query("UPDATE notes SET description = ? WHERE id=?", array($description, $id));
	}
}