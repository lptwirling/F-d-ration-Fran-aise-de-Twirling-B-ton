<?php

/*
   $Id: CRUDL.class.php,v 1 01/07/2006 01:58:19 mosaic Exp $
   +-----------------------------------------------------------------------+
   |                  OSC-evolution Open Source E-commerce                 |
   +-----------------------------------------------------------------------+
   | Copyright (c) 2006 OSC-evolution                                      |
   |                                                                       |
   | http://www.osc-evolution.com                                          |
   |                                                                       |
   | Portions Copyright (c) 2003 osCommerce                                |
   +-----------------------------------------------------------------------+
   | This source file is subject to version 2.0 of the GPL license,        |
   | available at the following url:                                       |
   | http://www.osc-evolution.com/license/2_0.txt.                         |
   +-----------------------------------------------------------------------+
*/

class _CRUDL {
	public $_from;
	public $_table;

	private $_out;
	private $_appli;

	public function __construct( $id, $appli = array() )
	{
		if ( !empty( $id ) ) {
			$appli['where'][] = $this->getTableAlias() . '.' . $this->getTableKey() . " = " . (int)$id . "";

			$list = $this->listes( $appli );

			if ( count( $list ) > 0 ) {
				foreach ( $list as $items ) {
					if ( count( $items ) > 0 ) {
						foreach ( $items as $k => $v ) {
							$this->$k = $v;
						}
					}
				}
			}
		}
	}

	private function getTableVal () {
		return $this->_table['val'];
	}

	private function getTableAlias ()
	{
		return $this->_table['alias'];
	}

	private function getTableKey ()
	{
		return $this->_table['key'];
	}

	private function constructFrom ()
	{
		$i = 0;

		$class = strtolower( get_class( $this ) );

		$thisVal = $this->getTableVal();
		$thisAlias = $this->getTableAlias();
		$thisKey = $this->getTableKey();

		$defaut_alias = ( isset( $thisAlias ) ? $thisAlias : $class[0] );
		$defaut_val = ( isset( $thisVal ) ? $thisVal : $class );

		$out[$i]['alias'] = $defaut_alias;
		$out[$i]['table'] = $defaut_val;

		$i++;

		if ( is_array( $this->_appli['from'] ) ) {
			$froms = array_unique( $this->_appli['from'] );

			foreach ( $froms as $from ) {
				list( $table, $alias ) = explode( ' ', $from );

				$out[$i]['alias'] = $alias;
				$out[$i]['table'] = $table;

				$i++;
			}
		}
		elseif ( is_string( $this->_appli['from'] ) ) {
			if ( !empty( $this->_appli['from'] ) ) {
				list( $table, $alias ) = explode( ' ', $this->_appli['from'] );

				$out[$i]['alias'] = $alias;
				$out[$i]['table'] = $table;
			}
		}

		return $out;
	}

	private function getSelect ()
	{
		$froms = $this->constructFrom();
		if ( count( $froms ) ) {
			$out = '';
			foreach ( $froms as $from ) {
				$out .= $from['alias'].'.*, ';
			}
		}

		if ( is_array( $this->_appli['select'] ) ) {
			$selects = array_unique( $this->_appli['select'] );

			$out = '';
			foreach ( $selects as $select ) {
				$out .= $select.", ";
			}
		}
		elseif ( is_string( $this->_appli['select'] ) ) {
			if ( !empty( $this->_appli['select'] ) ) {
				$out = $this->_appli['select'].", ";
			}
		}

		$out = 'SELECT '.trim( $out, ', ' );

		return $out;
	}

	private function getFrom ()
	{
		$froms = $this->constructFrom();
		if ( count( $froms ) ) {
			$out = ' FROM ';

			foreach ( $froms as $from ) {
				$out .= $from['table'].' AS '.$from['alias'].", ";
			}
		}

		$out = trim( $out, ', ' );

		return ' '.$out;
	}

	private function getWhere ()
	{
		if ( is_array( $this->_appli['where'] ) ) {
			$this->_appli['where'] = array_unique( $this->_appli['where'] );

			$out = '';
			foreach ( $this->_appli['where'] as $where ) {
				if ( !empty( $where ) ) {
					$out .= $where.' AND ';
				}
			}
		}
		elseif ( is_string( $this->_appli['where'] ) ) {
			if ( !empty( $this->_appli['where'] ) ) {
				$out = $this->_appli['where'];
			}
		}

		if ( !empty( $out ) ) {
			$out = ' WHERE '.trim( $out, ' AND ' );
		}

		if ( $out == ' WHERE ' ) {
			$out = '';
		}

		return $out;
	}

	private function getOrderby ()
	{
		return ( !empty( $this->_appli['orderby'] ) ? ' ORDER BY '.$this->_appli['orderby'] : '' );
	}

	private function getLimit ()
	{
		return ( !empty( $this->_appli['limit'] ) ? ' TOP '.$this->_appli['limit'] : '' );
	}

	private function getGroupby ()
	{
		if ( is_array( $this->_appli['groupby'] ) ) {
			$this->_appli['groupby'] = array_unique( $this->_appli['groupby'] );

			$out = ' GROUP BY ';
			foreach ( $this->_appli['groupby'] as $groupby ){
				$out .= $groupby.', ';
			}

			$out = ' '.trim( $out, ', ' );
		}
		elseif ( is_string( $this->_appli['groupby'] ) ) {
			if ( !empty( $this->_appli['groupby'] ) ) {
				$out = ' GROUP BY '.$this->_appli['groupby'];
			}
		}

		return $out;
	}

	private function getHaving ()
	{
		if ( is_array( $this->_appli['having'] ) ) {
			$this->_appli['having'] = array_unique( $this->_appli['having'] );

			$out = ' HAVING ';
			foreach ( $this->_appli['having'] as $having ){
				$out .= $having.', ';
			}

			$out = ' '.trim( $out, ', ' );
		}
		elseif ( is_string( $this->_appli['having'] ) ) {
			if ( !empty( $this->_appli['having'] ) ) {
				$out = ' HAVING '.$this->_appli['having'];
			}
		}

		return $out;
	}

	public function getQuery ( $appli )
	{
		$this->_appli = $appli;

		//echo $this->getSelect().$this->getFrom().$this->getWhere().$this->getOrderby().$this->getLimit().$this->getGroupby().$this->getHaving().'<br />';
		return $this->getSelect().$this->getFrom().$this->getWhere().$this->getGroupby().$this->getHaving().$this->getOrderby();
		//return $this->getSelect().$this->getFrom().$this->getWhere().$this->getGroupby().$this->getHaving().$this->getOrderby().$this->getLimit();
	}

	public function add ( $array )
	{
		global $SQL;

		if ( count( $array ) > 0 ) {
			$head = '`'.join( '`, `', array_keys( $array ) ).'`';
			$values = '\''.join( '\', \'', array_values( $array ) ).'\'';
		}

		$mysql_query = $SQL->prepare( "INSERT INTO ".$this->getTableVal()." ( $head ) VALUES( $values )" );

		if ( !is_object( $mysql_query ) ) {
			echo "INSERT INTO ".$this->getTableVal()." ( $head ) VALUES( $values )".'<br />';exit;
		}
		else {
			$mysql_query->execute();
		}

		$id = $SQL->lastInsertId();

		return $id;
	}

	public function delete ( $id )
	{
		global $SQL;

		$mysql_query = $SQL->prepare( "DELETE FROM ".$this->getTableVal()." WHERE ".$this->getTableKey()." = '" . (int)$id . "'" );
		$mysql_query->execute();
	}

	public function delete_where ( $params )
	{
		global $SQL;

		if ( is_array( $params ) ) {
			$params = array_unique( $params );

			$out_where = '';
			foreach ( $params as $where ) {
				if ( !empty( $where ) ) {
					$out_where .= $where.' AND ';
				}
			}
		}
		elseif ( is_string( $params ) ) {
			if ( !empty( $params ) ) {
				$out_where = $params;
			}
		}

		if ( !empty( $out_where ) ) {
			$out_where = trim( $out_where, ' AND ' );

			$out_where = ' WHERE '.$out_where;
		}

		if ( $out_where == ' WHERE ' ) {
			$out_where = '';
		}

		$mysql_query = $SQL->prepare( "DELETE FROM ".$this->getTableVal()." ".$out_where );
		$mysql_query->execute();
	}

	public function save ( $id, $array )
	{
		global $SQL;

		if ( count( $array ) > 0 ) {
			$update = 'SET ';

			foreach ($array as $k => $v ) {
				if ( $v == '++' ) {
					$update .= '`'.$k.'` = '.$k.' + 1'.', ';
				}
				elseif ( $v == '--' ) {
					$update .= '`'.$k.'` = '.$k.' - 1'.', ';
				}
				else {
					$update .= '`'.$k.'` = \''.$v.'\', ';
				}
			}

			$update = trim( $update, ', ' );
		}

		$sql = "UPDATE `".$this->getTableVal()."` ".$update." WHERE ".$this->getTableKey()." = '$id'";

		$mysql_query = $SQL->prepare( $sql );
		$mysql_query->execute();

		$id = $SQL->lastInsertId();

		return $id;
	}

	public function verif_exist ( $where )
	{
		$appli['where'] = $where;
		$appli['limit'] = 1;

		$listes = $this->listes( $appli );

		if ( count( $listes ) > 0 ) {
			$return = $listes[0][$this->getTableKey()];
		}
		else {
			$return = false;
		}

		return $return;
	}

	public function getPublic ()
	{
		$req = mysql_query( "SHOW FIELDS FROM ".$this->getTableVal() );
		while ( $rep = mysql_fetch_assoc( $req ) ) {
			echo 'public $'.$rep['Field'].';<br />';
		}

		exit;
	}

	public function listes( $appli = array(), $sortie = '', $field = '' )
	{
		global $SQL;

		$this->_out = $sortie;

		$sql = $this->getQuery( $appli );

		$mysql_query = $SQL->prepare( $sql );

		if ( !is_object( $mysql_query ) ) {
			echo "<u>\$sql</u>: <b>".$sql.'</b><br />';exit;
		}
		else {
			$mysql_query->execute();
		}

		if ( $this->_out == 'count' ) {
			return count( $mysql_query->fetchAll() );
		}
		elseif ( $this->_out == 'pipe' ) {
			if ( mysql_num_rows( $mysql_query ) > 0 ) {
				while ( $lists = mysql_fetch_assoc( $mysql_query ) ) {
					$lists_array[] = $lists[$field];
				}

				return array2pipe( $lists_array );
			}
		}
		elseif ( $this->_out == 'extract' ) {
			$liste = $mysql_query->fetchAll( PDO::FETCH_ASSOC );

			return $liste[0][$field];
		}
		elseif ( $this->_out == 'array' && $field != '' ) {
			if ( mysql_num_rows( $mysql_query ) > 0 ) {
				while ( $lists = mysql_fetch_assoc( $mysql_query ) ) {
					$lists_array[] = $lists[$field];
				}

				return $lists_array;
			}
		}
		else {
			return $mysql_query->fetchAll( PDO::FETCH_ASSOC );
		}
	}

	public function complete ( $id, $field, $complete, $type = '' )
	{
		$name_class = get_class($this);
		$Class = new $name_class($id);

		$old_val_field = $Class->$field;

		if ( isPipe( $old_val_field ) ) {
			echo 'isPipe';exit;
			$new_val_field = addPipe( $complete, $old_val_field );
		}
		elseif ( $type == 'cumul' ) {
			$new_val_field = $old_val_field + $complete;
		}
		else {
			echo 'else';exit;
			$new_val_field = $old_val_field.$complete;
		}

		$array[$field] = $new_val_field;

		$this->save( $id, $array );
	}
}