<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{

	protected $table = '';
	protected $column_search;
	protected $column_order;
	protected $order;
	protected $search;
	protected $select;
	protected $group_by;
	protected $tablequery = '';

	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query($filter = null, $group_by = null)
	{

		$this->db->select($this->tablequery, FALSE);

		$i = 0;
		if ($this->column_search) {
			# code...

			foreach ($this->column_search as $item) // loop column 
			{
				if (isset($_POST['search']['value'])) // if datatable send POST for search
				{

					if ($i === 0) // first loop
					{
						$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
						$this->db->like($item, $_POST['search']['value']);
					} else {
						$this->db->or_like($item, $_POST['search']['value']);
					}

					if (count($this->column_search) - 1 == $i) //last loop
						$this->db->group_end(); //close bracket
				}
				$i++;
			}
		}

		/* if ($filter) {
			$this->db->where($filter);
		} */
		if ($filter) {
			foreach ($filter as $key => $value) {
				if (is_array($value)) {
					// Jika nilai filter berupa array (untuk multiple select)
					$this->db->group_start(); // Mulai grup kondisi
					foreach ($value as $sub_value) {
						$this->db->or_where($key, $sub_value);
					}
					$this->db->group_end(); // Akhiri grup kondisi
				} else {
					// Filter biasa
					$this->db->where($key, $value);
				}
			}
		}
		if (isset($this->group_by)) {
			$this->db->group_by($this->group_by);
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			if (is_array($order)) {
				$this->db->order_by(key($order), $order[key($order)]);
			} else {
				$this->db->order_by($order, false);
			}
		}
	}


	public function get_datatables($query = null, $col_order, $col_search, $order, $filter = Null, $group_by = null)
	{
		//$this->db = $this->load->database($db, TRUE);
		$this->column_order = $col_order;
		$this->column_search = $col_search;
		$this->tablequery = $query;
		$this->order = $order;
		$this->group_by = $group_by;
		$this->_get_datatables_query($filter, $group_by);
		if (isset($_POST["length"]) && $_POST["length"] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered($query, $filter = null, $group_by = null)
	{
		$this->tablequery = $query;
		$this->_get_datatables_query($filter, $group_by);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllQueryFiltered($query, $filter)
	{
		$this->db->select($query, FALSE);
		$this->db->where($filter)->get();
		//log_message('debug','countAllQueryFiltered = '.$this->db->last_query());
		return $this->db->count_all_results();
	}
}

/* End of file: MY_Model.php */