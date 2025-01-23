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
 
	if (!defined('FLUX_ROOT')) exit;

	$bind = array();
	$sqlpartial = '';
	
	$hideGroupLevel = Flux::config('HideFromWhosOnline');
	$groups = AccountLevel::getGroupID($hideGroupLevel, '<');
	
	if(!empty($groups)) {
		$ids = implode(', ', array_fill(0, count($groups), '?'));
		$sqlpartial .= " where login.group_id IN ($ids) ";
		$bind = array_merge($bind, $groups);
	}
	
	$player_id  = (int)$params->get('player_id');
	$sqlpartial .= " and `cw`.char_id = ?";
	$bind = array_merge($bind, (array)$player_id);
	
	$sql  = "SELECT cw.*,c.*,g.name as g_name FROM {$server->charMapDatabase}.`char_wstats` AS cw left join {$server->charMapDatabase}.`char` as c on `c`.char_id=`cw`.char_id left join {$server->charMapDatabase}.`guild` as g on `c`.guild_id=`g`.guild_id left join login ON `login`.account_id =`c`.account_id {$sqlpartial}";
	$sth  = $server->connection->getStatement($sql);
	
	$sth->execute($bind);
	$profile = $sth->fetchAll();

	$title = $profile[0]->name." (WoE)";
	
	$bind     = array();

	$col  = "`char`.char_id,`char`.sex, `char`.name AS char_name, `char`.class AS char_class, cw.points,";
	$col .= "`char`.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len";


	$sql  = "SELECT $col FROM {$server->charMapDatabase}.`char_wstats` AS cw ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.`char` ON `char`.char_id = cw.char_id ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.guild ON guild.guild_id = `char`.guild_id ";
	$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = `char`.account_id ";
	$sql .= "WHERE 1 = 1 ";

	if (Flux::config('BGHidePermBannedCharRank')) {
		$sql .= "AND login.state != 5 ";
	}
	if (Flux::config('BGHideTempBannedCharRank')) {
		$sql .= "AND (login.unban_time IS NULL OR login.unban_time = 0) ";
	}

	$groups = AccountLevel::getGroupID((int)Flux::config('BGRankingHideGroupLevel'), '<');
	if(!empty($groups)) {
		$ids   = implode(', ', array_fill(0, count($groups), '?'));
		$sql  .= "AND login.group_id IN ($ids) ";
		$bind  = array_merge($bind, $groups);
	}

	if ($days=Flux::config('BGCharRankingThreshold')) {
		$sql    .= 'AND TIMESTAMPDIFF(DAY, login.lastlogin, NOW()) <= ? ';
		$bind[]  = $days * 24 * 60 * 60;
	}


	$sql .= "GROUP BY `char`.char_id DESC ";
	$sql .= "ORDER BY cw.points DESC, cw.points DESC ";
	$sql .= "LIMIT 99999";
	$sth  = $server->connection->getStatement($sql);

	$sth->execute($bind);

	$chars = $sth->fetchAll();

?>