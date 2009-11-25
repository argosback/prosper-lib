<?php
namespace Prosper;

class OvrimosAdapter extends BaseAdapter {
	
	/**
   * @see BaseAdapter#connect()
   */
	function connect() {
		$this->connection = ovrimos_connect($this->hostname, $this->schema, $this->username, $this->password);
	}
	
	/**
	 * Clean up, destroy the connection
	 */
	function __destruct() {
		ovrimos_close($this->connection());
	}
	
	/**
	 * @see BaseAdapter#platform_execute($sql, $mode)
	 */
	function platform_execute($sql, $mode) {
		return ovrimos_exec($this->connection(), $sql);
	}
	
	/**
	 * @see BaseAdapter#affected_rows($set)
	 */
	function affected_rows($set) {
		return ovrimos_num_rows($set);
	}
	
	/**
	 * @see BaseAdapter#fetch_assoc($set)
	 */
	function fetch_assoc($set) {
		if(ovrimos_fetch_row($set)) {
			$limit = ovrimos_num_fields($set);
			for($i = 0; $i < $limit; ++$i) {
				$result[ovrimos_field_name($set, $i)] = ovrimos_result($set, $i);
			}
		}
		return $result;
	}
	
	/**
	 * @see BaseAdapter#cleanup($set)
	 */
	function cleanup($set) {
		ovrimos_free_result($set);
	}
	
}