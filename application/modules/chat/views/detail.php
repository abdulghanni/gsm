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
<input type="hidden" id="receiver_id" value="<?=$id?>">
<div class="message-bar">
  <div class="message-inner">
    <div class="message-area">
      <textarea placeholder="Message" id="msg"></textarea>
    </div>
    <button type="button" class="list" id="btnSend" title="Back">
      Send
    </button>
  </div>
</div>

<script type="text/javascript">
  function showChatList(){
  $.ajax({
        type: 'POST',
        url: '/gsm/chat/lists/',
        success: function(data) {
            $('#users').html(data);
        }
    });
}

  $("#btnSend").on('click', function(){
    var receiver_id = $("#receiver_id").val();
    msg = $('textarea#msg').val();
    $.ajax({
        type: 'POST',
        url: '/gsm/chat/send/',
        data : {receiver_id : receiver_id, msg : msg},
        success: function(data) {
            $('#users').html(data);
        }
    });
  });
</script>