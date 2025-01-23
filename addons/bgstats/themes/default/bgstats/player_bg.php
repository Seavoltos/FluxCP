<?php if (!defined('FLUX_ROOT')) exit; ?>
<style>
	.window-margin{
		margin: auto;
	}
</style>


<?php if ($profile): ?>

<h2  style="text-align: center">
	Estadísticas Battleground
</h2>

<?php $i=0; foreach ($profile as $bg_profile): $i++;?>
<?php endforeach ?>

<table class = 'window-margin' border="5" cellpadding="0" cellspacing="0" bordercolor="#9EB3C2">
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" bgcolor="#A92207">
				<tr>
					<td width="200" height="400" rowspan="2">
						<img src="./addons/bgstats/images/job/<?=htmlspecialchars($profile[0]->class)?><?=htmlspecialchars($profile[0]->sex)?>.png"><br>
						<center><font size="2" color="#21295C"><b><?php echo $this->jobClassText($profile[0]->class) ?></b></font><br>
						<font color="#21295C">Lv: <?php echo number_format($bg_profile->base_level) ?></font> / <font color="#21295C"><?php echo number_format($bg_profile->job_level) ?></center></font><br>
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
						<a title="Ver sus estadísticas en War of Emperium Stats" href="<?=$this->url('bgstats', 'player_woe', array('player_id' => $profile[0]->char_id))?>">
							<font size="3" color="#21295C"><b>@BG<b></font>&nbsp;
						</a>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<center>
						<img src="./addons/bgstats/images/item/small/2733.png"><br>
						<font size="2" color="#A0522D"><b>Puntos</b></font><br>
						<font size="1" color="#4169E1"><b><?php echo number_format($bg_profile->points) ?></b></font><br>
						<font size="2" color="#A0522D"><b>Rank</b></font><br>
						<b>
						<?php for ($i = 0; $i < sizeof($chars); ++$i): ?>
							<?php if ($bg_profile->char_id === $chars[$i]->char_id): ?>
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
											<td colspan="3" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>General</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7517.png"><b> Ganados</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/674.png"><b> Empatados</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/673.png"><b> Perdidos</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->win) ?></center></td>
											<td><center><?php echo number_format($bg_profile->tie) ?></center></td>
											<td><center><?php echo number_format($bg_profile->lost) ?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="3" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>General</b></center></font></td>
											<td colspan="3" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Daño</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1214.png"><b> Kill</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7005.png"><b> Death</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/2444.png"><b> Quits</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1819.png"><b> Top</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1259.png"><b> Total</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/2108.png"><b> Recibido</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->kill_count) ?></center></td>
											<td><center><?php echo number_format($bg_profile->death_count) ?></center></td>
											<td><center><?php echo number_format($bg_profile->deserter) ?></center></td>
											<td><center><?php echo number_format($bg_profile->top_damage) ?></center></td>
											<td><center><?php echo number_format($bg_profile->damage_done) ?></center></td>
											<td><center><?php echo number_format($bg_profile->damage_received) ?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="3" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Tierra EoS</b></center></font></td>
											<td colspan="2" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Tierra TI</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7253.png"><b> Flags</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7423.png"><b> Bases</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/658.png"><b> Resultados</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7005.png"><b> Skulls</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/658.png"><b> Resultados</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->eos_flags) ?></center></td>
											<td><center><?php echo number_format($bg_profile->eos_bases) ?></center></td>
											<td><center><font color="#4169E1"><b>W</b></font><?php echo number_format($bg_profile->eos_wins) ?><font color="#4169E1"><b>T</b></font><?php echo number_format($bg_profile->eos_tie) ?><font color="#4169E1"><b>L</b></font><?php echo number_format($bg_profile->eos_lost)?></center></td>
											<td><center><?php echo number_format($bg_profile->skulls) ?></center></td>
											<td><center><font color="#4169E1"><b>W</b></font><?php echo number_format($bg_profile->ti_wins) ?><font color="#4169E1"><b>T</b></font><?php echo number_format($bg_profile->ti_tie) ?><font color="#4169E1"><b>L</b></font><?php echo number_format($bg_profile->ti_lost)?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="4" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Tierra Bossnia</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/750.png"><b> Boss Damage</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/751.png"><b> Boss Killed</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7253.png"><b> Flags</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/658.png"><b> Resultados</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->boss_damage) ?></center></td>
											<td><center><?php echo number_format($bg_profile->boss_killed) ?></center></td>
											<td><center><?php echo number_format($bg_profile->boss_flags) ?></center></td>
											<td><center><font color="#4169E1"><b>W</b></font><?php echo number_format($bg_profile->boss_wins) ?><font color="#4169E1"><b>T</b></font><?php echo number_format($bg_profile->boss_tie) ?><font color="#4169E1"><b>L</b></font><?php echo number_format($bg_profile->boss_lost)?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="3" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Tierra Domination</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/5374.png"><b> Offensive Kills</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/5170.png"><b> Defensive Kills</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/658.png"><b> Resultados</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->dom_off_kills) ?></center></td>
											<td><center><?php echo number_format($bg_profile->dom_def_kills) ?></center></td>
											<td><center><font color="#4169E1"><b>W</b></font><?php echo number_format($bg_profile->dom_wins) ?><font color="#4169E1"><b>T</b></font><?php echo number_format($bg_profile->dom_tie) ?><font color="#4169E1"><b>L</b></font><?php echo number_format($bg_profile->dom_lost)?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="3" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Flavius TDM</b></center></font></td>
											<td colspan="2" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Flavius CTF</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1214.png"><b> Kills</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7005.png"><b> Deaths</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/658.png"><b> Resultados</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7253.png"><b> Flags</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/658.png"><b> Resultados</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->td_kills) ?></center></td>
											<td><center><?php echo number_format($bg_profile->td_deaths) ?></center></td>
											<td><center><font color="#4169E1"><b>W</b></font><?php echo number_format($bg_profile->td_wins) ?><font color="#4169E1"><b>T</b></font><?php echo number_format($bg_profile->td_tie) ?><font color="#4169E1"><b>L</b></font><?php echo number_format($bg_profile->td_lost)?></center></td>
											<td><center><font color="#4169E1"><b>T</b></font><?php echo number_format($bg_profile->ctf_taken) ?><font color="#4169E1"><b>C</b></font><?php echo number_format($bg_profile->ctf_captured) ?><font color="#4169E1"><b>D</b></font><?php echo number_format($bg_profile->ctf_droped)?></center></td>
											<td><center><font color="#4169E1"><b>W</b></font><?php echo number_format($bg_profile->ctf_wins) ?><font color="#4169E1"><b>T</b></font><?php echo number_format($bg_profile->ctf_tie) ?><font color="#4169E1"><b>L</b></font><?php echo number_format($bg_profile->ctf_lost)?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="4" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Flavius Stone Control</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/2335.png"><b> Stole</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/12105.png"><b> Capture</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/640.png"><b> Droped</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/658.png"><b> Resultados</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->sc_stole) ?></center></td>
											<td><center><?php echo number_format($bg_profile->sc_captured) ?></center></td>
											<td><center><?php echo number_format($bg_profile->sc_droped) ?></center></td>
											<td><center><font color="#4169E1"><b>W</b> </font><?php echo number_format($bg_profile->sc_wins) ?> <font color="#4169E1"><b>T</b></font><?php echo number_format($bg_profile->sc_tie) ?><font color="#4169E1"><b>L</b></font><?php echo number_format($bg_profile->sc_lost)?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="6" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Conquest & Rush</b></center></font></td>
										</tr>
										<tr>
											<td colspan="3"><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/658.png"><b> Conquest</b></center></font></td>
											<td colspan="3"><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/658.png"><b> Rush</b></center></font></td>
										</tr>
										<tr>
											<td colspan="3"><center><font color="#4169E1"><b>W</b> </font><?php echo number_format($bg_profile->cq_wins) ?> <font color="#4169E1"> <font color="#4169E1"><b>L</b> </font><?php echo number_format($bg_profile->cq_lost)?></center></td>
											<td colspan="3"><center><font color="#4169E1"><b>W</b> </font><?php echo number_format($bg_profile->ru_wins) ?> <font color="#4169E1"> <font color="#4169E1"><b>L</b> </font><?php echo number_format($bg_profile->ru_lost)?></center></td>
										</tr>
										<tr>
											<td colspan="2"><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/714.png"><b> Emperium</b></center></font></td>
											<td colspan="2"><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1019.png"><b> Barricade</b></center></font></td>
											<td colspan="2"><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7429.png"><b> G.Stone</b></center></font></td>
										</tr>
										<tr>
											<td colspan="2"><center><?php echo number_format($bg_profile->emperium_kill) ?></center></td>
											<td colspan="2"><center><?php echo number_format($bg_profile->barricade_kill) ?></center></td>
											<td colspan="2"><center><?php echo number_format($bg_profile->gstone_kill) ?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="2" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Support Skills</b></center></font></td>
											<td colspan="2" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Total Healing</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/2277.png"><b> Correctas</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/5203.png"><b> Equivocadas</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/2277.png"><b> Correctas</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/5203.png"><b> Equivocadas</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->support_skills_used) ?></center></td>
											<td><center><?php echo number_format($bg_profile->wrong_support_skills_used) ?></center></td>
											<td><center><?php echo number_format($bg_profile->healing_done) ?></center></td>
											<td><center><?php echo number_format($bg_profile->wrong_healing_done) ?></center></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="470" border="0" cellpadding="0" cellspacing="1">
										<tr>
											<td colspan="3" bgcolor="#474973" height="15"><font color="#FFFFFF"><center><b>Items</b></center></font></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/504.png"><b> HP</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/505.png"><b> SP</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/676.png"><b> Zeny</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->hp_heal_potions) ?></center></td>
											<td><center><?php echo number_format($bg_profile->sp_heal_potions) ?></center></td>
											<td><center><?php echo number_format($bg_profile->zeny_used) ?></center></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/715.png"><b> Gems</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/716.png"><b> Gems</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/717.png"><b> Gems</b></center></font></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->yellow_gemstones) ?></center></td>
											<td><center><?php echo number_format($bg_profile->red_gemstones) ?></center></td>
											<td><center><?php echo number_format($bg_profile->blue_gemstones) ?></center></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/1752.png"><b> Arrow</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/678.png"><b> Bottle</b></center></font></td>
											<td></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->ammo_used) ?></center></td>
											<td><center><?php echo number_format($bg_profile->poison_bottles) ?></center></td>
											<td></td>
										</tr>
										<tr>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7135.png"><b> Bottle</b></center></font></td>
											<td><font color="#4169E1"><center><img src="./addons/bgstats/images/item/small/7136.png"><b> Bottle</b></center></font></td>
											<td></td>
										</tr>
										<tr>
											<td><center><?php echo number_format($bg_profile->acid_demostration) ?></center></td>
											<td><center><?php echo number_format($bg_profile->acid_demostration_fail) ?></center></td>
											<td></td>
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