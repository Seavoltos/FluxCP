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

if (!defined('FLUX_ROOT')) exit; ?>

<h2>Battleground <?php echo Flux::message('Skilllabel') ?></h2>
<?php if ($chars): ?>
<p class="toggler"><a href="javascript:toggleSearchForm()">Buscar...</a></p>
<form action="<?php echo $this->url ?>" method="get" class="search-form">
	<?php echo $this->moduleActionFormInputs($params->get('bgstats'), $params->get('general')) ?>
	<p>
		<label for="jobclass">Filtrar por clase:</label>
		<select name="jobclass" id="jobclass">
			<option value=""<?php if (is_null($jobClass)) echo 'selected="selected"' ?>>All</option>
		<?php foreach ($classes as $jobClassIndex => $jobClassName): ?>
			<option value="<?php echo $jobClassIndex ?>"
				<?php if (!is_null($jobClass) && $jobClass == $jobClassIndex) echo ' selected="selected"' ?>>
				<?php echo htmlspecialchars($jobClassName) ?>
			</option>
		<?php endforeach ?>
		</select>
		 <label for="char_name">Buscar por nombre:</label>
		<input type="text" name="char_name" id="char_name" value="<?=htmlspecialchars($params->get('char_name'))?>" />
		<input type="submit" value="Filter" />
		<input type="button" value="Reset" onclick="reload()" /
	</p>
</form>

<?php echo $paginator->infoText() ?>

<table class="horizontal-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('RankLabel')) ?></th>
		<th colspan="2"><?php echo htmlspecialchars(Flux::message('CharacterNameLabel')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('JobClassLabel')) ?></th>
		<th colspan="2"><?php echo htmlspecialchars(Flux::message('GuildNameLabel')) ?></th>
		<th><?php echo $paginator->sortableColumn('healing_done',htmlspecialchars(Flux::message('HealDone'))) ?></th>
		<th><?php echo $paginator->sortableColumn('wrong_healing_done',htmlspecialchars(Flux::message('WrongHealDone'))) ?></th>
		<th><?php echo $paginator->sortableColumn('support_skills_used',htmlspecialchars(Flux::message('SupportS'))) ?></th>
		<th><?php echo $paginator->sortableColumn('wrong_support_skills_used',htmlspecialchars(Flux::message('WrongSupportS'))) ?></th>
		<th><?php echo $paginator->sortableColumn('sp_used',htmlspecialchars(Flux::message('SPUsed'))) ?></th>
		<th><?php echo $paginator->sortableColumn('spiritb_used',htmlspecialchars(Flux::message('SpiritbUsed'))) ?></th>
		<th><?php echo $paginator->sortableColumn('zeny_used',htmlspecialchars(Flux::message('ZenyUsed'))) ?></th>
	</tr>
	<?php $topRankType = !is_null($jobClass) ? $className : 'character' ?>
	<?php $i=0; foreach ($chars as $char): $i++;?>
	<tr<?php if (!isset($char)) echo ' class="empty-row"'; if ($i === 0) echo ' class="top-ranked" title="<strong>'.htmlspecialchars($char->name).'</strong> '.htmlspecialchars(Flux::message('TopRankedLabel')).' '.$topRankType.'!"' ?>>
		<td align="right"><?php echo number_format($i) ?></td>
		<?php if (isset($char)): ?>
		<td>
			<a title="Ver estadísticas" href="<?=$this->url('bgstats', 'player_bg', array('player_id' => $char->char_id))?>">
			<img src="./addons/bgstats/images/jobs/<?=htmlspecialchars($char->class)?>.gif"></a>
		</td>
		<td><strong>
			<?php if ($auth->actionAllowed('character', 'view') && $auth->allowedToViewCharacter): ?>
				<?php echo $this->linkToCharacter($char->char_id, $char->name) ?>
			<?php else: ?>
				<a title="Ver estadísticas" href="<?=$this->url('bgstats', 'player_bg', array('player_id' => $char->char_id))?>"><?php echo htmlspecialchars($char->name) ?></a>
			<?php endif ?>
		</strong></td>
		<td><?php echo $this->jobClassText($char->class) ?></td>
		<?php if ($char->g_name): ?>
		<?php if ($char->guild_emblem_len): ?>
		<td><img src="<?php echo $this->emblem($char->guild_id) ?>" /></td>
		<?php endif ?>
		<td <?php if (!$char->guild_emblem_len) echo ' colspan="2"' ?>>
			<?php if ($auth->actionAllowed('guild', 'view') && $auth->allowedToViewGuild): ?>
				<?php echo $this->linkToGuild($char->guild_id, $char->g_name) ?>
			<?php else: ?>
				<?php echo htmlspecialchars($char->g_name) ?>
			<?php endif ?>
		</td>
		<?php else: ?>
		<td colspan="2"><span class="not-applicable">No</span></td>
		<?php endif ?>
		<td><?php echo number_format($char->healing_done) ?></td>
		<td><?php echo number_format($char->wrong_healing_done) ?></td>
		<td><?php echo number_format($char->support_skills_used) ?></td>
		<td><?php echo number_format($char->wrong_support_skills_used) ?></td>
		<td><?php echo number_format($char->sp_used) ?></td>
		<td><?php echo number_format($char->spiritb_used) ?></td>
		<td><?php echo number_format($char->zeny_used) ?></td>
		<?php else: ?>
		<td colspan="8"></td>
		<?php endif ?>
	</tr>
	<?php endforeach ?>
</table>

<?php echo $paginator->getHTML() ?>

<?php else: ?>
<p>Nadie fue encontrado en <?php echo htmlspecialchars($server->serverName) ?>. <a href="javascript:history.go(-1)">Volver</a>.</p>
<?php endif ?>