<!-- start: TOP NAVBAR -->
<header class="navbar navbar-default navbar-static-top">
  <!-- start: NAVBAR HEADER -->
  <div class="navbar-header">
    <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
      <i class="ti-align-justify"></i>
    </a>
    <a class="navbar-brand" href="#">
      <img height="50" width="150" style="margin-left:25px" src="<?=assets_url('assets/images/logo.png')?>" alt="Agani"/>
    </a>
    <a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
      <i class="ti-align-justify"></i>
    </a>
    <a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <i class="ti-view-grid"></i>
    </a>
  </div>
  <!-- end: NAVBAR HEADER -->
  <!-- start: NAVBAR COLLAPSE -->
  <div class="navbar-collapse collapse">
    <ul class="nav navbar-right">
      <!-- start: MESSAGES DROPDOWN -->
      <li class="dropdown">
        <a href class="dropdown-toggle" data-toggle="dropdown">
          <span class="dot-badge partition-red"></span> <i class="ti-comment"></i> <span>Pesan</span><span class="badge" id="msgs-badge"><?php echo '19' ?></span>
        </a>
        <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
          <li>
            <span class="dropdown-header"> Unread messages</span>
          </li>
          <li>
            <div class="drop-down-wrapper ps-container">
              <ul>
                <li class="unread">
                  <a href="javascript:;" class="unread">
                    <div class="clearfix">
                      <div class="thread-image">
                        <img height="50px" width="50px" src="<?=$photo_profile?>" alt="">
                      </div>
                      <div class="thread-content">
                        <span class="author">User</span>
                        <span class="preview">Test</span>
                        <span class="time"> Just Now</span>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="view-all">
            <a href="<?=base_url('message')?>">
              Lihat Semua
            </a>
          </li>
        </ul>
      </li>
      <!-- end: MESSAGES DROPDOWN -->
      <!-- start: ACTIVITIES DROPDOWN -->
      <li class="dropdown">
        <a href class="dropdown-toggle" data-toggle="dropdown">
          <i class="ti-check-box"></i> <span>Notifikasi</span><span class="badge" id="notif-badge"><?php echo $notification_num ?></span>
        </a>
        <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
          <?php if($notification->num_rows()>0):?>
          <li>
            <div class="drop-down-wrapper ps-container">
              <div class="list-group no-margin">
                <?php foreach($notification->result() as $n):
                  $photo_link = getValue('photo', 'users', array('id'=>'where/'.$n->sender_id));
                  $photo_link = base_url().'uploads/'.$n->sender_id.'/'.$photo_link;
                  $file_headers = @get_headers($photo_link);
                  $sender_photo = ($file_headers[0] != 'HTTP/1.1 404 Not Found') ? $photo_link : assets_url('assets/images/no-image-mid.png');
                ?>
                <a class="media list-group-item notif-list" href="#" id="<?=$n->id?>">
                  <img class="img-circle" height="40px" width="40px" alt="..." src="<?=$sender_photo?>">
                  <span class="media-body block no-margin"> <?= $n->judul ?> 
                  <small class="block text-black">No: <?= $n->no?>, <?=getName($n->sender_id)?></small>
                  <small class="block text-grey"><?= timeago($n->sent_on)?></small> 
                  </span>
                </a>
              <?php endforeach; ?>
              </div>
            </div>
          </li>
        <?php else:?>
          <li>
            <span class="dropdown-header"> Tidak ada notifikasi baru</span>
          </li>
        <?php endif;?>
        
          <li class="view-all">
            <a href="<?=base_url('notification')?>">
              Lihat Semua
            </a>
          </li>
        </ul>
      </li>
      <!-- end: ACTIVITIES DROPDOWN -->
      <!-- start: LANGUAGE SWITCHER -->
      <!--
      <li class="dropdown">
        <a href class="dropdown-toggle" data-toggle="dropdown">
          <i class="ti-world"></i> <?php $site_lang = $this->session->userdata('site_lang');$lang = (!empty($site_lang)) ? $site_lang : lang('indonesian');echo $lang ?>
        </a>
        <ul role="menu" class="dropdown-menu dropdown-light fadeInUpShort">
          <li>
            <a href="<?= base_url().'auth/switchLanguage/indonesian/'?>" class="menu-toggler">
              Indonesia
            </a>
          </li>
          <li>
            <a href="<?= base_url().'auth/switchLanguage/english/'?>" class="menu-toggler">
              English
            </a>
          </li>
        </ul>
      </li>
      -->
      <!-- start: LANGUAGE SWITCHER -->
      <!-- start: USER OPTIONS DROPDOWN -->
      <li class="dropdown current-user">
        <a href class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?=$photo_profile?>" alt="<?= $sess_name ?>"> <span class="username"><?= $sess_name ?> <i class="ti-angle-down"></i></span>
        </a>
        <ul class="dropdown-menu dropdown-dark">
          <li>
            <a href="<?= base_url('users/edit_user/'.sessId())?>">
              My Profile
            </a>
          </li>
          <!--
          <li>
            <a href="login_lockscreen.html">
              Lock Screen
            </a>
          </li>
          -->
          <li>
            <a href="<?= base_url('auth/logout')?>">
              Log Out
            </a>
          </li>
        </ul>
      </li>
      <!-- end: USER OPTIONS DROPDOWN -->
    </ul>
    <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
    <div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
      <div class="arrow-left"></div>
      <div class="arrow-right"></div>
    </div>
    <!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
  </div>
  <a class="dropdown-off-sidebar" data-toggle-class="app-offsidebar-open" data-toggle-target="#app" data-toggle-click-outside="#off-sidebar">
    &nbsp;
  </a>
  <!-- end: NAVBAR COLLAPSE -->
</header>
<!-- end: TOP NAVBAR -->