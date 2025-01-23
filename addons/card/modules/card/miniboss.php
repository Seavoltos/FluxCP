<?php
if (!defined('FLUX_ROOT')) exit;

	$title    = 'Card Normales';
	
	$bind = array();
	$sqlpartial = '';
	$chars = array();
	
	$card_name  = $params->get('card_name');
	if ($card_name) 
	{
		$sqlpartial .= " where `bc`.card_name like '%{$card_name}%'";
	}
	$sortable = array('drop_date' => 'desc');
	
	$sql  = "SELECT count(distinct bc.id) AS total FROM {$server->logsDatabase}.`dropped_mini_boss_card_log` AS bc {$sqlpartial}";
	$sth  = $server->connection->getStatement($sql);
	
	$sth->execute($bind);
	
	$paginator = $this->getPaginator($sth->fetch()->total);
	$paginator->setSortableColumns($sortable);
	
	$col  = "bc.*,count(bc.id)";
	
	$sql  = $paginator->getSQL("SELECT $col FROM {$server->logsDatabase}.`dropped_mini_boss_card_log` AS bc {$sqlpartial} group by `bc`.id");
	$sth  = $server->connection->getStatement($sql);
	
	$sth->execute($bind);
	$chars = $sth->fetchAll();
?>