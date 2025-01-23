<?php if (!defined('FLUX_ROOT')) exit; ?>
<style>
	.window-margin{
		margin: auto;
	}
</style>


<?php if ($profile): ?>
<?php $sex = ($profile[0]->sex == 'M') ? 1:0; ?>


<h2  style="text-align: center">
	Estadísticas War of Emperium
</h2>

<?php $i=0; foreach ($profile as $woe_profile): $i++;?>
<?php endforeach ?>

<table class = 'window-margin' border="5" cellpadding="0" cellspacing="0" bordercolor="#9EB3C2">
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" bgcolor="#A92207">
				<tr>
					<td width="200" height="400" rowspan="2">
						<img src="./addons/bgstats/images/job/<?=htmlspecialchars($profile[0]->class)?><?=htmlspecialchars($profile[0]->sex)?>.png"><br>
						<center><font size="2" color="#21295C"><b><?php echo $this->jobClassText($profile[0]->class) ?></b></font><br>
						<font color="#21295C">Lv: <?php echo number_format($woe_profile->base_level) ?></font> / <font color="#21295C"><?php echo number_format($woe_profile->job_level) ?></center></font><br>
					</td>
					<td>
						<img src="./addons/bgstats/images/jobs/<?=htmlspecialchars($profile[0]->class)?>.gif"><font color="#21295C"><b><?=htmlspecialchars($profile[0]->name)?></b></font><br><br>
						<font color="#21295C" size="5"><b>
							<?php if ($profile[0]->g_name): ?>
								<img title="Guild <?=$profile[0]->g_name?>" src="<?=$this->emblem($profile[0]->guild_id)?>" />
								<?php if ($auth->actionAllowed('guild', 'view') && $auth->allowedToViewGuild): ?>
									<?php echo $this->linkToGuild($profile[0]->guild_id, $profile[0]->g_name) ?>
								<?php else: ?>
									<?php echo htmlspecialchars($profile[0]->g_name) ?>
								<?php endif ?>
							<?php else: ?>
								<span class="not-applicable">-- No Guild --</span>
							<?php endif ?>
						</b></font>
					</td>
					<td width="150" align="right" valign="middle">
						<a title="Ver sus estadísticas en Battleground" href="<?=$this->url('bgstats', 'player_bg', array('player_id' => $profile[0]->char_id))?>">
							<font size="1" color="#21295C"><b>@WoE<b></font>&nbsp;
						</a>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<center>
						<img src="./addons/bgstats/images/item/small/2733.png"><br>
						<font size="2" color="#A0522D"><b>Puntos</b></font><br>
						<font size="1" color="#4169E1"><b><?php echo number_format($woe_profile->points) ?></b></font><br>
						<font size="2" color="#A0522D"><b>Rank</b></font><br>
						<b>
						<?php for ($i = 0; $i < sizeof($chars); ++$i): ?>
							<?php if ($woe_profile->char_id === $chars[$i]->char_id): ?>
								<?php if ($chars[$i]->points == 0): ?>
									<font size="1" color="#4169E1"><?php echo htmlspecialchars(Flux::message('NoRegistered'))?></font>
								<?php else: ?>
									<font size="4" color="#4169E1">#<?php echo number_format($i+1) ?></font>
								<?php endif ?>
							<?php endif ?>
						<?php endfor ?>
						</b></center>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center" valign="middle">
			<table width="580" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td rowspan="4" align="center" valign="middle">
						<table width="470" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="2" bgcolor="#386FA4" height="15"><font color="#FFFFFF"><center><b>General</b></center></font></td>
											<td colspan="3" bgcolor="#386FA4" height="15"><font color="#FFFFFF"><center><b>Daño</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1214.png"><b> Kill</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7005.png"><b> Death</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1819.png"><b> Top</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1259.png"><b> Total</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/2108.png"><b> Recibido</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($woe_profile->kill_count) ?></center></td>
											<td><center><?php echo number_format($woe_profile->death_count) ?></center></td>
											<td><center><?php echo number_format($woe_profile->top_damage) ?></center></td>
											<td><center><?php echo number_format($woe_profile->damage_done) ?></center></td>
											<td><center><?php echo number_format($woe_profile->damage_received)?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="2" bgcolor="#386FA4" height="15"><font color="#FFFFFF"><center><b>Emperium</b></center></font></td>
											<td colspan="2" bgcolor="#386FA4" height="15"><font color="#FFFFFF"><center><b>Guardian Stone</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1259.png"><b> Daño</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/714.png"><b> Kills</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1259.png"><b> Daño</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7429.png"><b> Kills</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($woe_profile->emperium_damage)?></center></td>
											<td><center><?php echo number_format($woe_profile->emperium_kill)?></center></td>
											<td><center><?php echo number_format($woe_profile->gstone_damage)?></center></td>
											<td><center><?php echo number_format($woe_profile->gstone_kill)?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="2" bgcolor="#386FA4" height="15"><font color="#FFFFFF"><center><b>Guardian</b></center></font></td>
											<td colspan="2" bgcolor="#386FA4" height="15"><font color="#FFFFFF"><center><b>Barricade</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1259.png"><b> Daño</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/750.png"><b> Kills</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1259.png"><b> Daño</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1019.png"><b> Kills</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($woe_profile->guardian_damage)?></center></td>
											<td><center><?php echo number_format($woe_profile->guardian_kill)?></center></td>
											<td><center><?php echo number_format($woe_profile->barricade_damage)?></center></td>
											<td><center><?php echo number_format($woe_profile->barricade_kill)?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="2" bgcolor="#386FA4" height="15"><font color="#FFFFFF"><center><b>Support Skills</b></center></font></td>
											<td colspan="2" bgcolor="#386FA4" height="15"><font color="#FFFFFF"><center><b>Total Healing</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/2277.png"><b> Correctas</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/5203.png"><b> Mal</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/2277.png"><b> Correctas</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/5203.png"><b> Mal</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($woe_profile->support_skills_used)?></center></td>
											<td><center><?php echo number_format($woe_profile->wrong_support_skills_used)?></center></td>
											<td><center><?php echo number_format($woe_profile->healing_done)?></center></td>
											<td><center><?php echo number_format($woe_profile->wrong_healing_done)?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="5" bgcolor="#386FA4" height="15"><font color="#FFFFFF"><center><b>Items</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/504.png"><b> HP</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/505.png"><b> SP</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/715.png"><b> Gems</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/716.png"><b> Gems</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/717.png"><b> Gems</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($woe_profile->hp_heal_potions)?></center></td>
											<td><center><?php echo number_format($woe_profile->sp_heal_potions)?></center></td>
											<td><center><?php echo number_format($woe_profile->yellow_gemstones)?></center></td>
											<td><center><?php echo number_format($woe_profile->red_gemstones)?></center></td>
											<td><center><?php echo number_format($woe_profile->blue_gemstones)?></center></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/676.png"><b> Zeny</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1752.png"><b> Arrow</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7135.png"><b> Bottle</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7136.png"><b> Bottle</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/678.png"><b> Bottle</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($woe_profile->zeny_used) ?></center></td>
											<td><center><?php echo number_format($woe_profile->ammo_used) ?></center></td>
											<td><center><?php echo number_format($woe_profile->acid_demostration) ?></center></td>
											<td><center><?php echo number_format($woe_profile->acid_demostration_fail) ?></center></td>
											<td><center><?php echo number_format($woe_profile->poison_bottles) ?></center></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<p align="center" valign="middle"><a href="javascript:history.go(-1)"><img src="./addons/bgstats/images/skill/al_warp.png"><font size="2"> Volver</font></a>.</p>
<?php else: ?>
<p>No se encontró al jugador en <?php echo htmlspecialchars($server->serverName) ?>. <a href="javascript:history.go(-1)"><img src="./addons/bgstats/images/skill/al_warp.png"> Volver</a>.</p>
<?php endif ?>