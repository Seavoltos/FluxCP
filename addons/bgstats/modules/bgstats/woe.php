<?php
/**
 *
 * Battleground Statistics
 *
 * @author		Easycore
 * @copyright	Copyright (c) 2019
 * 
 * You are not allowed to redestribute my work.
 */
	$title    = 'Overall WoE Statistics';
	$bind = array();
	$sqlpartial = '';
	$classes  = Flux::config('JobClasses')->toArray();
	$jobClass = $params->get('jobclass');
	$chars = array();
	
	if (trim($jobClass) === '') {
		$jobClass = null;
	}

	if (!is_null($jobClass) && !array_key_exists($jobClass, $classes)) {
		$this->deny();
	}
	
	$hideGroupLevel = Flux::config('HideFromWhosOnline');
	$groups = AccountLevel::getGroupID($hideGroupLevel, '<');
	
	if(!empty($groups)) {
		$ids = implode(', ', array_fill(0, count($groups), '?'));
		$sqlpartial .= " where login.group_id IN ($ids) ";
		$bind = array_merge($bind, $groups);
	}
	
	$char_name  = $params->get('char_name');
	if ($char_name) 
	{
		$sqlpartial .= " and `c`.name like '%{$char_name}%'";
	}
	if (!is_null($jobClass)) {
		$sqlpartial .= " AND `c`.class = '{$jobClass}' ";
	}
	$sortable = array(
		'top_damage' => 'desc',
		'damage_done',
		'damage_received',
        'kill_count',
        'death_count',
		'healing_done',
		'wrong_healing_done',
		'support_skills_used',
		'wrong_support_skills_used',
		'sp_used',
		'spiritb_used',
		'zeny_used',
		'hp_heal_potions',
		'sp_heal_potions',
		'yellow_gemstones',
		'red_gemstones',
		'blue_gemstones',
		'poison_bottles',
		'ammo_used'
	);
	
	$sql  = "SELECT count(distinct cb.char_id) AS total FROM {$server->charMapDatabase}.`char_wstats` AS cb left join {$server->charMapDatabase}.`char` as c on `c`.char_id=`cb`.char_id left join {$server->charMapDatabase}.`guild` as g on `c`.guild_id=`g`.guild_id left join login ON `login`.account_id =`c`.account_id {$sqlpartial}";
	
	$sth  = $server->connection->getStatement($sql);
	
	$sth->execute($bind);
	
	$paginator = $this->getPaginator($sth->fetch()->total);
	$paginator->setSortableColumns($sortable);
	
	$col  = "cb.*,count(cb.char_id) ,c.*,g.name as g_name, g.emblem_len AS guild_emblem_len";
	
	$sql  = $paginator->getSQL("SELECT $col FROM {$server->charMapDatabase}.`char_wstats` AS cb left join {$server->charMapDatabase}.`char` as c on `c`.char_id=`cb`.char_id left join {$server->charMapDatabase}.`guild` as g on `c`.guild_id=`g`.guild_id left join login ON `login`.account_id =`c`.account_id {$sqlpartial} group by `cb`.char_id");
	
	$sth  = $server->connection->getStatement($sql);
	
	$sth->execute($bind);
	$chars = $sth->fetchAll();
?>
