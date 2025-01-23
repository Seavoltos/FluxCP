<?php
if (!defined('FLUX_ROOT')) exit;

	$title    = 'Card Normales';
	
	$bind = array();
	$sqlpartial = '';
	$chars = array();
	
	$card_name  = $params->get('card_name');
	if ($card_name) 
	{
		$sqlpartial .= " where `mc`.card_name like '%{$card_name}%'";
	}
	$sortable = array('drop_date' => 'desc');
	
	$sql  = "SELECT count(distinct mc.id) AS total FROM {$server->logsDatabase}.`dropped_mvp_card_log` AS mc {$sqlpartial}";
	$sth  = $server->connection->getStatement($sql);
	
	$sth->execute($bind);
	
	$paginator = $this->getPaginator($sth->fetch()->total);
	$paginator->setSortableColumns($sortable);
	
	$col  = "mc.*,count(mc.id)";
	
	$sql  = $paginator->getSQL("SELECT $col FROM {$server->logsDatabase}.`dropped_mvp_card_log` AS mc {$sqlpartial} group by `mc`.id");
	$sth  = $server->connection->getStatement($sql);
	
	$sth->execute($bind);
	$chars = $sth->fetchAll();
?>