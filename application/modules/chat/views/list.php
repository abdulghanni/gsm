<div class="sidebar-content perfect-scrollbar">
  <h5 class="sidebar-title">On-line</h5>
  <ul class="media-list">
  <?php foreach($users->result() as $u):?>
    <li class="media">
      <a id="chat-detail" href="javascript:void(0)" title="Edit" onclick='showChatDetail("<?=$u->id?>")'>
        <i class="fa fa-circle status-online"></i>
        <?php 
          $photo_link = base_url().'uploads/'.$u->id.'/'.$u->photo;
          $file_headers = @get_headers($photo_link);
          $photo_chat = ($file_headers[0] != 'HTTP/1.1 404 Not Found' && !empty($u->photo)) ? $photo_link : assets_url('assets/images/no-image-mid.png');
          //$photo_chat = (!empty($u->photo)) ? base_url('uploads/'.$u->id.'/80x80/'.$u->photo): assets_url('assets/images/no-image.png');?>
        <img alt="<?=$u->username?>" height="25px" width="25px" src="<?=$photo_chat?>" class="media-object">
        <div class="media-body">
          <h4 class="media-heading"><?= $u->username?></h4>
          <?php $unread_single = GetAllSelect('chat', 'is_read', array('is_read'=>'where/0', 'receiver_id'=>'where/'.sessId(), 'sender_id'=>'where/'.$u->id))->num_rows();?>
          <?php echo ($unread_single!= 0) ? '<span class="badge" id="msgs-badge">'.$unread_single.'</span>' : '' ?>
        </div>
      </a>
    </li>
  <?php endforeach;?>
  </ul>
</div>