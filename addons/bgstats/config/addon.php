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
 
return array(

    'BGRankingLimit'    => 20,                            //
    'BGRankingFameLimit'    => 10,                            //
    'BGRankingHideGroupLevel'  => AccountLevel::LOWGM,    //
    
    'BGCharRankingThreshold'  => 0,                       // Number of days the character must have logged in within to be listed in character ranking. (0 = disabled)
    'BGHideTempBannedCharRank'  => false,                 // Hide temporarily banned characters from ranking.
    'BGHidePermBannedCharRank'  => true,                  // Hide permanently banned characters from ranking.'HidePermBannedCharRank'    =>
 
	'MenuItems' => array(
        'BG & WoE' => array(
    			'Statistics'  => array('module' => 'bgstats&action=index'),
    		),
    ),

	'SubMenuItems'	=> array(
		'ranking'		=> array(
			'battleground'		=> 'Battleground',
			'woe'		=> 'WoE'
		),
		'bgstats'		=> array(
			'index'		=> 'Main',
			'general'		=> 'General',
			'ti'		=> 'TI',
			'eos'		=> 'EoS',
			'bossnia'		=> 'Boss',
			'dom'		=> 'Dom',
			'td'		=> 'TD',
			'sc'		=> 'SC',
			'ctf'		=> 'CTF',
			'conquest'	=> 'CQ',
			'rush'		=> 'RU',
			'skills'		=> 'Skills',
			'items'		=> 'Items',
			'monster'		=> 'Monsters',
			'woe'		=> 'War of Emperium'
		),
	),
    
	// Don't touch this.
    'FluxTables' => array(
        'char_bg' => 'char_bg',
        'char_wstats' => 'char_wstats',
    )
)
?>