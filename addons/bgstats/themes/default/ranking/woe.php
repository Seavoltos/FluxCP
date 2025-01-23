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

<h2><?php echo Flux::message('WoERanklabel') ?></h2>
<?php if ($chars): ?>

<p class="toggler"><a href="javascript:toggleSearchForm()">Buscar...</a></p>
<form action="<?php echo $this->url ?>" method="get" class="search-form">
	<?php echo $this->moduleActionFormInputs($params->get('module'), $params->get('action')) ?>
	<p>
        <label for="char_name">Buscar por nombre:</label>
		<input type="text" name="char_name" id="char_name" value="<?=htmlspecialchars($params->get('char_name'))?>" />


		<input type="submit" value="Buscar" />
		<input type="button" value="Reset" onclick="reload()" />
	</p>
</form>

<?php echo $paginator->infoText() ?>

	<table class="horizontal-table">
		<tr>
			<th>Ranking</th>
			<th colspan="2"><?php echo $paginator->sortableColumn('name', 'Personaje') ?></th>
			<th><?php echo $paginator->sortableColumn('points', 'Puntos') ?></th>
			<th><?php echo $paginator->sortableColumn('class', 'Clase') ?></th>
			<th><?php echo $paginator->sortableColumn('base_level', 'Level') ?></th>
			<th><?php echo $paginator->sortableColumn('job_level', 'Job') ?></th>
			<th colspan="2"><?php echo htmlspecialchars(Flux::message('GuildNameLabel')) ?></th>
			
		</tr>
		<?php $i=0; foreach ($chars as $char): $i++;?>
		<tr style="text-align: center;">
			<td width="24">
				#<?php echo number_format($i) ?>
			</td>
			<td>
			<img src="./addons/bgstats/images/jobs/<?=htmlspecialchars($char->class)?>.gif">
			</td>
			<td>
				<a title="Ver estadísticas" href="<?=$this->url('bgstats', 'player_woe', array('player_id' => $char->char_id))?>"><?=htmlspecialchars($char->name)?></a>
			</td>
			<td>
				<?php echo number_format($char->points) ?>
			</td>
			<td>
				<?php if ($job=$this->jobClassText($char->class)): ?>
				<?php echo htmlspecialchars($job) ?>
				<?php else: ?>
				<span class="not-applicable">Desconocido</span>
				<?php endif ?>
			</td>
			<td>
				<?php echo number_format($char->base_level) ?>
			</td>
			<td>
				<?php echo number_format($char->job_level) ?>
			</td>
			<td>
				<?php if ($this->emblem($char->guild_id)): ?>
					<img src="<?php echo $this->emblem($char->guild_id) ?>" title="<? echo htmlspecialchars($char->g_name); ?>" />
				<?php endif ?>
			</td>
			<td>
				<?php if ($char->g_name): ?>
					<?php echo htmlspecialchars($char->g_name) ?>
				<?php else: ?>
					No
				<?php endif ?>
			</td>
		</tr>
		<?php endforeach ?>
	</table>
<?php echo $paginator->getHTML() ?>
<?php else: ?>
<p>Nadie fue encontrado en <?php echo htmlspecialchars($server->serverName) ?>. <a href="javascript:history.go(-1)">Volver</a>.</p>
<?php endif ?>