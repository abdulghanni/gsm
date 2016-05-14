<div class="wrap-messages">
	<div id="inbox" class="inbox">
		<!-- start: EMAIL LIST -->
		<div class="col email-list">
			<div class="wrap-list">
				<div class="wrap-options">
					<div class="messages-search">
						<form>
							<input type="text" value="Notifikasi" class="form-control text-center">
						</form>
					</div>
				</div>
				<ul class="messages-list perfect-scrollbar">
				<?php if($all_notification->num_rows()>0){
						foreach($all_notification->result() as $n):
						  $photo_link = getValue('photo', 'users', array('id'=>'where/'.$n->sender_id));
		                  $photo_link = base_url().'uploads/'.$n->sender_id.'/'.$photo_link;
		                  $file_headers = @get_headers($photo_link);
		                  $sender_photo = ($file_headers[0] != 'HTTP/1.1 404 Not Found') ? $photo_link : assets_url('assets/images/no-image-mid.png');
		                  $bg = ($n->is_read == 0) ? "bg-yellow" : 'bg-grey';
		                  $is_read = ($n->is_read == 0) ? "notif-item" : 'notif-detail';
							?>
					<li class="messages-item <?=$bg?>" id="item-<?=$n->id?>">
						<a href="#" class="<?=$is_read?>" href="#" id="<?=$n->id?>">
							<span class="messages-item-star" title="Mark as starred"><i class="fa fa-star"></i></span>
							<img class="messages-item-avatar bordered border-primary" alt="John Stark" src="<?=$sender_photo?>">
							<span class="messages-item-from"><?=getFullName($n->sender_id)?></span>
							<div class="messages-item-time">
								<span class="text"><?=$n->sent_on?></span>
							</div>
							<span class="messages-item-subject"> <?= $n->judul ?></span>
							<span class="messages-item-content"></span>
						</a>
					</li>
				<?php endforeach;}?>
				</ul>
			</div>
		</div>
		<!-- end: EMAIL LIST -->
		<!-- start: EMAIL READER -->
		<div class="email-reader perfect-scrollbar" id="notif-detail">
		<?php if($all_notification->num_rows()>0){?>
			<div>
				<div class="message-header">
					<img class="message-item-avatar" alt="<?=getFullName($last_notif->sender_id)?>" src="<?=$sender_photo?>">
					<div class="message-time">
						<?=$last_notif->sent_on?>
					</div>
					
					<div class="message-from">
						<?=getFullName($last_notif->sender_id)?>
					</div>
					<div class="message-to">
						To: <?=getFullName($last_notif->receiver_id)?>
					</div>
				</div>
				<div class="message-subject">
					<?=$last_notif->judul?>
				</div>
				<div class="message-content">
					<p>
						<?=$last_notif->isi?>
					</p>
				</div>
			</div>
		</div>
		<?php } ?>
		<!-- end: EMAIL READER -->
	</div>
</div>