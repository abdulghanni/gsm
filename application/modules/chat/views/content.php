<div class="chat-content">
  <div class="sidebar-content perfect-scrollbar">
    <a class="sidebar-back pull-left" id="chat-list" href="javascript:void(0)" title="Back" onclick='showChatList()'><i class="ti-angle-left"></i> <span>Back</span></a>
    <ol class="discussion">
    <?php if($message->num_rows()>0): 
            foreach($message->result() as $m){?>
      <li class="messages-date">
        <?=timeago($m->sent_on)?>
      </li>
      <li class="<?=($m->sender_id==sessId()?'self':'other')?>">
        <div class="message">
          <div class="message-name">
            <?= getName($m->sender_id) ?>
          </div>
          <div class="message-text">
            <?=$m->message?>
          </div>
          <div class="message-avatar">
            <img src="<?=$photo_chat?>" alt="">
          </div>
        </div>
      </li>
      <?php }else:?>
      No Message
    <?php endif;?>
    </ol>
  </div>
</div>