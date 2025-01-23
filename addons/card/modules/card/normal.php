<?php
if (!defined('FLUX_ROOT')) exit;

	$title    = 'Card Normales';
	
	$bind = array();
	$sqlpartial = '';
	$chars = array();
	
	$card_name  = $params->get('card_name');
	if ($card_name)
		$sqlpartial .= " where `nc`.card_name like '%{$card_name}%'";
	
	$sortable = array('drop_date' => 'desc');
	
	$sql  = "SELECT count(distinct nc.id) AS total FROM {$server->logsDatabase}.`dropped_normal_card_log` AS nc {$sqlpartial}";
	$sth  = $server->connection->getStatement($sql);
	
	$sth->execute($bind);
	
	$paginator = $this->getPaginator($sth->fetch()->total);
	$paginator->setSortableColumns($sortable);
	
	$col  = "nc.*,count(nc.id)";
	
	$sql  = $paginator->getSQL("SELECT $col FROM {$server->logsDatabase}.`dropped_normal_card_log` AS nc {$sqlpartial} group by `nc`.id");
	$sth  = $server->connection->getStatement($sql);
	
	$sth->execute($bind);
	$chars = $sth->fetchAll();
?>