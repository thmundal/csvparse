<?php
Class csv {
	private $raw_data = null;
	private $filename = null;
	private $rows = [];
	private $fields = [];
	private $delim = null;

	public function __construct($filename, $delim = ";") {
		$this->raw_data = file($filename);
		$this->filename = $filename;
		$this->delim = $delim;
	}

	/**
	 * Extracts the first line of the file and discovers the list headers (column names)
	 * @return type
	 */
	private function extractHeaders() {
		$this->fields = explode($this->delim,$this->raw_data[0]);
		return $this->fields;
	}

	public function toArray() {
		$this->extractHeaders();

		for($i=1;$i<sizeof($this->raw_data);$i++) {
			$row = explode($this->delim, $this->raw_data[$i]);
			$newrow = [];

			for($e=0;$e<sizeof($this->fields);$e++) {
				$newrow[$this->fields[$e]] = $row[$e];
			}
			$this->rows[] = $newrow;
		}
	}

	public function html_table() {
		echo "<table><tr>";
		foreach($this->fields as $k=>$v)
			echo "<td>".$v."</td>";
		echo "</tr>";

		foreach($this->rows as $row) {
			echo "<tr>";
			foreach($this->fields as $k=>$field) {
				echo "<td>".$row[$field]."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
}
?>