<?php
	if (!defined('FLUX_ROOT')) exit;
	$title = 'Card Normales';
	$mobdata = $params->get('card_name');
	$limit = (int)20;

	require_once 'Flux/TemporaryTable.php';
	
	if (trim($mobdata) === '') { $mobdata = null; }
	$char_ids_filter = [];
	// List Items
    if ($server->isRenewal) {
        $fromTables = array("{$server->charMapDatabase}.item_db_re", "{$server->charMapDatabase}.item_db2_re");
    } else {
        $fromTables = array("{$server->charMapDatabase}.item_db", "{$server->charMapDatabase}.item_db2");
    }
    $itemDB = "{$server->charMapDatabase}.items";
    $tempTable = new Flux_TemporaryTable($server->connection, $itemDB, $fromTables);
	
	// Get all group_id based on killer_char_id
	$sql = "SELECT DISTINCT(`id`) FROM {$server->logsDatabase}.`dropped_normal_card_log`";
	$sql_params = array();
	if ($mobdata) {
		$sql .= " WHERE `monster_name`=?";
		$sql_params[] = $mobdata;
	}
	$sth = $server->connection->getStatementForLogs($sql);
	$sth->execute($sql_params);
	$ids = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
	
	$char_ids = array();
	$monsters = array();

	if($mobdata){
		// Players with most cards
		$bind[] = $mobdata;
		$col = "mlog.char_name, mlog.monster_name, count(*) AS count ";
		$sql = "SELECT $col FROM {$server->logsDatabase}.`dropped_normal_card_log` AS mlog ";
		$sql.= "WHERE mlog.monster_name = ? ";
		$sql.= "GROUP BY mlog.char_name ORDER BY count DESC LIMIT $limit";
		$sth = $server->connection->getStatementForLogs($sql);
		$sth->execute($bind);
		$kills = $sth->fetchAll();
		foreach ($kills as $kill) {
			$char_ids[$kill->char_name] = null;
			$monsters[$kill->monster_id] = null;
		}
	} else {
		// Latest x Kills
		$col = "mlog.id, mlog.char_name, mlog.monster_id, mlog.monster_name, mlog.card_name, mlog.drop_map, mlog.drop_date ";
		$sql = "SELECT $col FROM {$server->logsDatabase}.`dropped_normal_card_log` AS mlog ";
		$sql.= "ORDER BY mlog.drop_date DESC LIMIT $limit";
		$sth = $server->connection->getStatementForLogs($sql);
		$sth->execute($char_ids_filter);
		$mobs = $sth->fetchAll();
		foreach ($mobs as $mob) {
			$char_ids[$mob->char_name] = null;
			$monsters[$mob->monster_id] = null;
		}
	}

	if (count($char_ids)) {
		$sql = "SELECT `char_name`,`name`,login.`group_id` FROM {$server->charMapDatabase}.`char` ";
		$sql .= "LEFT JOIN {$server->loginDatabase}.`login` ON `char`.`account_id` = login.`account_id` ";
		$sql .= "WHERE `char_name` IN(".implode(',', array_fill(0, count($char_ids), '?')).")";
		$sth = $server->connection->getStatement($sql);
		$sth->execute(array_keys($char_ids));
		$temp = $sth->fetchAll();
		foreach ($temp as $char) {
			$char_ids[$char->char_name] = array('name' => $char->name, 'group_id' => $char->group_id);
		}
	}

	if (count($monsters)) {
		$sql = "SELECT `id`,`name_english` FROM $tableName WHERE `id` IN(".implode(',', array_fill(0, count($monsters), '?')).")";
		$sth = $server->connection->getStatement($sql);
		$sth->execute(array_keys($monsters));
		$temp = $sth->fetchAll();
		foreach ($temp as $mon) {
			$monsters[$mon->id] = $mon->name_english;
		}
	}

	$temp = null;
