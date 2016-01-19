<!-- start: OFF-SIDEBAR -->
<div id="off-sidebar" class="sidebar">
  <div class="sidebar-wrapper">
    <ul class="nav nav-tabs nav-justified">
      <li class="active">
        <a href="#off-users" aria-controls="off-users" role="tab" data-toggle="tab">
          <i class="ti-comments"></i>
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="off-users">
        <div id="users" toggleable active-class="chat-open">
          <div class="users-list">
            <div class="sidebar-content perfect-scrollbar">
              <h5 class="sidebar-title">On-line</h5>
              <ul class="media-list">
              <?php foreach($users->result() as $u):?>
                <li class="media">
                  <a data-toggle-class="chat-open" data-toggle-target="#users" href="#">
                    <i class="fa fa-circle status-online"></i>
                    <?php 
                      $photo_link = base_url().'uploads/'.$u->id.'/'.$u->photo;
                      $file_headers = @get_headers($photo_link);
                      $photo_chat = ($file_headers[0] != 'HTTP/1.1 404 Not Found') ? $photo_link : assets_url('assets/images/no-image-mid.png');
                      //$photo_chat = (!empty($u->photo)) ? base_url('uploads/'.$u->id.'/80x80/'.$u->photo): assets_url('assets/images/no-image.png');?>
                    <img alt="..." height="40px" width="40px" src="<?=$photo_chat?>" class="media-object">
                    <div class="media-body">
                      <h4 class="media-heading"><?= $u->username?></h4>
                      <span> &nbsp; </span>
                    </div>
                  </a>
                </li>
              <?php endforeach;?>
              </ul>
            </div>
          </div>
          <div class="user-chat">
            <div class="chat-content">
              <div class="sidebar-content perfect-scrollbar">
                <a class="sidebar-back pull-left" href="#" data-toggle-class="chat-open" data-toggle-target="#users"><i class="ti-angle-left"></i> <span>Back</span></a>
                <ol class="discussion">
                  <li class="messages-date">
                    Senin, Jan 17, 23:39
                  </li>
                  <li class="self">
                    <div class="message">
                      <div class="message-name">
                        <?= $sess_name ?>
                      </div>
                      <div class="message-text">
                        tes
                      </div>
                      <div class="message-avatar">
                        <img src="<?=$photo_chat?>" alt="">
                      </div>
                    </div>
                  </li>
                  <li class="other">
                    <div class="message">
                      <div class="message-name">
                        User 2
                      </div>
                      <div class="message-text">
                        tes2
                      </div>
                      <div class="message-avatar">
                        <img src="<?=$photo_chat?>" alt="">
                      </div>
                    </div>
                  </li>
                </ol>
              </div>
            </div>
            <div class="message-bar">
              <div class="message-inner">
                <div class="message-area">
                  <textarea placeholder="Message"></textarea>
                </div>
                <a class="link" href="#">
                  Send
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end: OFF-SIDEBAR -->