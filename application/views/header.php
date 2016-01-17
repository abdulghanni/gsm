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
          <span class="dot-badge partition-red"></span> <i class="ti-comment"></i> <span>MESSAGES</span>
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
                        <img src="<?=assets_url('assets/images/avatar-2.jpg')?>" alt="">
                      </div>
                      <div class="thread-content">
                        <span class="author">Nicole Bell</span>
                        <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                        <span class="time"> Just Now</span>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:;" class="unread">
                    <div class="clearfix">
                      <div class="thread-image">
                        <img src="<?=assets_url('assets/images/avatar-3.jpg')?>" alt="">
                      </div>
                      <div class="thread-content">
                        <span class="author">Steven Thompson</span>
                        <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                        <span class="time">8 hrs</span>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:;">
                    <div class="clearfix">
                      <div class="thread-image">
                        <img src="<?=assets_url('assets/images/avatar-4.jpg')?>" alt="">
                      </div>
                      <div class="thread-content">
                        <span class="author">Kenneth Ross</span>
                        <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                        <span class="time">14 hrs</span>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="view-all">
            <a href="#">
              See All
            </a>
          </li>
        </ul>
      </li>
      <!-- end: MESSAGES DROPDOWN -->
      <!-- start: ACTIVITIES DROPDOWN -->
      <li class="dropdown">
        <a href class="dropdown-toggle" data-toggle="dropdown">
          <i class="ti-check-box"></i> <span>ACTIVITIES</span>
        </a>
        <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
          <li>
            <span class="dropdown-header"> You have new notifications</span>
          </li>
          <li>
            <div class="drop-down-wrapper ps-container">
              <div class="list-group no-margin">
                <a class="media list-group-item" href="">
                  <img class="img-circle" alt="..." src="<?=assets_url('assets/images/avatar-1.jpg')?>">
                  <span class="media-body block no-margin"> Use awesome animate.css <small class="block text-grey">10 minutes ago</small> </span>
                </a>
                <a class="media list-group-item" href="">
                  <span class="media-body block no-margin"> 1.0 initial released <small class="block text-grey">1 hour ago</small> </span>
                </a>
              </div>
            </div>
          </li>
          <li class="view-all">
            <a href="#">
              See All
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
          <img src="<?=$photo?>" alt="abdul"> <span class="username"><?= $sess_name ?> <i class="ti-angle-down"></i></span>
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
  <!-- end: NAVBAR COLLAPSE -->
</header>
<!-- end: TOP NAVBAR -->