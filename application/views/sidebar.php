<!-- sidebar -->
<?php
$menu=getAll('menu',array('id_parents'=>'where/0','sort'=>'order/asc'))->result();
$idp=GetValue('id_parents','menu',array('filez'=>'where/'.$this->uri->segment(1).'/'.$this->uri->segment(2)));
 ?>
<div class="sidebar app-aside" id="sidebar">
  <div class="sidebar-container perfect-scrollbar">
    <nav>
      <!-- start: MAIN NAVIGATION MENU -->
      <div class="navbar-title">
        <span>Main Navigation</span>
      </div>
      <ul class="main-navigation-menu">
        <?php
			
		
		foreach($menu as $isi){
				$isi->filez=str_replace('base_url()',base_url(),$isi->filez);
				
				?>
			<li  class="<?php echo ($idp==$isi->id ? 'active open' : '' ) ?>">
          <a href="<?php echo $isi->filez ?>">
            <div class="item-content">
              <div class="item-media">
                <i class="<?php echo $isi->icon?>"></i>
				
              </div>
              <div class="item-inner">
				  <span class="title"> <?php echo $isi->title ?> </span><?php if($isi->filez=='#'){?>
					  <i class="icon-arrow"></i>	
					  <?php 
					  }?>
              </div>
            </div>
          </a>
		  <?php if($isi->filez=='#'){
			  
				?>
				<ul class="sub-menu">
					<?php 
						$submenu=getAll('menu',array('id_parents'=>'where/'.$isi->id,'sort'=>'order/asc'))->result();
						
						foreach ($submenu as $sb){
								//echo $this->uri->segment(1).'/'.$this->uri->segment(2);
								?>
					<li class="<?php echo ($this->uri->segment(1).'/'.$this->uri->segment(2) == $sb->filez ? 'active open' : '') ?>">
						<a href="<?php echo base_url().$sb->filez ?>">
							<div class="item-content">
								<div class="item-media">
									<i class="<?php echo $sb->icon?>"></i>
								</div>
								<div class="item-inner">
									<span class="title"> <?php echo $sb->title ?></span><?php if($sb->filez=='#'){?>
										<i class="icon-arrow"></i>	
										<?php 
										}?>
								</div>
							</div>
						</a>
						
						<?php if($sb->filez=='#'){
							
							?>
							<ul class="sub-menu">
								<?php 
									$subsubmenu=getAll('menu',array('id_parents'=>'where/'.$sb->id,'sort'=>'order/asc'))->result();
									
									foreach ($subsubmenu as $sbb){
										//echo $this->uri->segment(1).'/'.$this->uri->segment(2);
									?>
									<li class="<?php echo ($this->uri->segment(1).'/'.$this->uri->segment(2) == $sbb->filez ? 'active open' : '') ?>">
										<a href="<?php echo base_url().$sbb->filez ?>">
											<div class="item-content">
												<div class="item-media">
													<i class="<?php echo $sbb->icon?>"></i>
												</div>
												<div class="item-inner">
													<span class="title"> <?php echo $sbb->title ?></span>
												</div>
											</div>
										</a>
										
									</li>    
								<?php }  ?>
							</ul>
						<?php }?>
					</li>    
						<?php }  ?>
				</ul>
		  <?php }?>
        </li>
		<?php } ?>
               
      </ul>
    </nav>
  </div>
</div>
<!-- / sidebar -->