
<div>
	<div class="message-header">
		<img class="message-item-avatar" alt="<?=getFullName($notif->sender_id)?>" src="<?=$sender_photo?>">
		<div class="message-time">
			<?=$notif->sent_on?>
		</div>
		
		<div class="message-from">
			<?=getFullName($notif->sender_id)?>
		</div>
		<div class="message-to">
			To: <?=getFullName($notif->receiver_id)?>
		</div>
	</div>
	<div class="message-subject">
		<?=$notif->judul?>
	</div>
	<div class="message-content">
		<p>
			<?=$notif->isi?>
		</p>
	</div>
</div>