<?php

class _SQL {
	static public function query ( $sql ) {
		global $SQL;

		$mysql_query = $SQL->prepare( $sql );
		$mysql_query->execute();
	}

	static public function fields ( $table ) {
		global $SQL;

		$stmt = $SQL->query("SELECT * FROM $table");

		$i = 0;

		$fields = array();
		while ( $column = $stmt->getColumnMeta( $i++ ) ) {
			$fields[] = $column['name'];
		}

		return $fields;
	}
}