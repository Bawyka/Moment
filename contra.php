<?php session_start();require "moment.php";if (isset($_POST['func']) and !empty($_POST['func'])){	if (isset($_POST['userid']) and !empty($_POST['userid']))	{		$fbopenid = (int)$_POST['userid'];	}		$moment = new Moment($fbopenid);		$user_id = $moment->getUserIdByOpenFBId($fbopenid);		switch ($_POST['func']) 	{		case "userexists": 						$username = '';						if (isset($_POST['username'])) $username = trim($_POST['username']);								if (empty($user_id)) $moment->addUser($fbopenid,$username);				break;				case "getmoments":			if (count($moment->user->moments)>0)			{							foreach ($moment->user->moments as $m)				{					echo '<li><a href="#">'.$m.'</a><span class="glyphicon glyphicon-remove" style="float:right; color:#fff; cursor:pointer;">x</span></li>'; 				}			}				break;				case "getlabels": 					$metka=trim($_POST['metka']);						$metka_id = $moment->getMomentIdByName($metka);						$labels = $moment->getLabelsOfTheMoment($metka_id,$user_id);									echo json_encode($labels);				break;				case "addmoment":						$new_moment = trim($_POST['moment']);					$moment_id = $moment->addMoment($new_moment);						$moment->assignMomentToUser($moment->user->id,$moment_id);						echo '<a href="#">'.$new_moment.'</a>';				break;				case "remoment":					$remoment = trim($_POST['moment']);									$remoment_id = $moment->getMomentIdByName($remoment);						$moment->removeUserMoment($remoment_id);				break;				case "parse": 					$labels = $_POST['labels'];						// we must to get the moment id aswell			$moment_name = trim($_POST['moment']);						$moment_id = $moment->getMomentIdByName($moment_name);						if (count($labels)>0)			{				foreach ($labels as $lb)				{					$label_id = $moment->addLabel($lb);													$moment->assignUserLabel($moment_id,$label_id);				}								// we need to get already existing label ids in this moment				$server_labels_ids = $moment->getLabelsIds($moment_id);														foreach ($labels as $label)				{					$client_labels_ids[]=$moment->getTagIdByName($label);				}											$diff = array_diff($server_labels_ids,$client_labels_ids);								// if the server hasn't this id 				foreach ($diff as $id)				{					$moment->removeMomentLabel($moment_id,$id);				}								// we need to get already existing label ids in this moment				$server_labels_ids = $moment->getLabelsIds($moment_id);												$peoples = $moment->getPeoplesByTags($server_labels_ids);																				if (!empty($peoples))				{					foreach ($peoples as $p)					{						echo '<a href="#">'.$p->user->username.'</a> in';												echo '<div class="holder">';												foreach ($p->moments  as $m)						{							echo '<div class="moments">';															echo '- <b>'.$m->name.'</b><br />';																if (count($m->labels)>0)								{																	foreach ($m->labels as $label)									{										echo '<span class="label" style="margin-left: 2px">'.$moment->getTag($label).'</span>';									}								}														echo '</div>';						}												echo '</div>';					}				}			}					break;				default: echo "No Comments!";	}}