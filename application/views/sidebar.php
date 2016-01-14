<!-- sidebar -->
<div class="sidebar app-aside" id="sidebar">
  <div class="sidebar-container perfect-scrollbar">
    <nav>
      <!-- start: MAIN NAVIGATION MENU -->
      <div class="navbar-title">
        <span>Main Navigation</span>
      </div>
      <ul class="main-navigation-menu">
        <li class="active open">
          <a href="<?= base_url() ?>">
            <div class="item-content">
              <div class="item-media">
                <i class="ti-home"></i>
              </div>
              <div class="item-inner">
                <span class="title"> <?= lang('dashboard') ?> </span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <div class="item-content">
              <div class="item-media">
                <i class="ti-server"></i>
              </div>
              <div class="item-inner">
                <span class="title"> <?= lang('master') ?></span><i class="icon-arrow"></i>
              </div>
            </div>
          </a>
          <ul class="sub-menu">
          <li>
              <a href="<?= base_url('master/barang')?>">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-bag"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?=lang('item')?></span>
                  </div>
                </div>
              </a>
            </li>    
            <li>
              <a href="<?= base_url('master/gudang')?>">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-home"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?=lang('warehouse')?></span>
                  </div>
                </div>
              </a>
            </li>    
            <li>
              <a href="<?= base_url('master/stok')?>">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-package"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('stock') ?></span>
                  </div>
                </div>
              </a>
            </li>    
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-control-shuffle"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('production') ?></span>
                  </div>
                </div>
              </a>
            </li>    
            <li>
              <a href="<?= base_url('master/supplier')?>">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-share-alt"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('supplier') ?></span>
                  </div>
                </div>
              </a>
            </li>    
            <li>
              <a href="<?= base_url('master/customer')?>">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('customer') ?></span>
                  </div>
                </div>
              </a>
            </li>    
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-announcement"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('salesman') ?></span>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a href="<?= base_url('master/lokasi_gudang')?>">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-map"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?=lang('warehouse_location')?></span>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a href="<?= base_url('master/lokasi_toko')?>">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-map"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?=lang('store_location')?></span>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0)">
            <div class="item-content">
              <div class="item-media">
                <i class="ti-money"></i>
              </div>
              <div class="item-inner">
                <span class="title"> <?= lang('purchase_request') ?></span><i class="icon-arrow"></i>
              </div>
            </div>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('purchase_order') ?></span>
                  </div>
                </div>
              </a>
            </li>    
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('order') ?></span>
                  </div>
                </div>
              </a>
            </li>  
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('receive_order') ?></span>
                  </div>
                </div>
              </a>
            </li> 
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('purchase') ?></span>
                  </div>
                </div>
              </a>
            </li> 
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('purchase_return') ?></span>
                  </div>
                </div>
              </a>
            </li> 
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('purchase_return_without_invoice') ?></span>
                  </div>
                </div>
              </a>
            </li> 
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('debt_payment') ?></span>
                  </div>
                </div>
              </a>
            </li>   
          </ul>
        </li>
        <li>
          <a href="javascript:void(0)">
            <div class="item-content">
              <div class="item-media">
                <i class="ti-money"></i>
              </div>
              <div class="item-inner">
                <span class="title"> <?= lang('sales_order') ?></span><i class="icon-arrow"></i>
              </div>
            </div>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('order') ?></span>
                  </div>
                </div>
              </a>
            </li>    
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('delivery_order') ?></span>
                  </div>
                </div>
              </a>
            </li>   
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('sales') ?></span>
                  </div>
                </div>
              </a>
            </li> 
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('sales_return') ?></span>
                  </div>
                </div>
              </a>
            </li> 
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('sales_return_without_invoice') ?></span>
                  </div>
                </div>
              </a>
            </li> 
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('invoicing') ?></span>
                  </div>
                </div>
              </a>
            </li> 
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('e-faktur') ?></span>
                  </div>
                </div>
              </a>
            </li> 
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('debt_payment') ?></span>
                  </div>
                </div>
              </a>
            </li>  
          </ul>
        </li>
        <li>
          <a href="javascript:void(0)">
            <div class="item-content">
              <div class="item-media">
                <i class="ti-package"></i>
              </div>
              <div class="item-inner">
                <span class="title"> <?= lang('stock') ?></span><i class="icon-arrow"></i>
              </div>
            </div>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('sales_order') ?></span>
                  </div>
                </div>
              </a>
            </li>    
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-id-badge"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('order') ?></span>
                  </div>
                </div>
              </a>
            </li>    
          </ul>
        </li>
        <li>
          <a href="javascript:void(0)">
            <div class="item-content">
              <div class="item-media">
                <i class="ti-stats-up"></i>
              </div>
              <div class="item-inner">
                <span class="title"> <?= lang('report') ?></span><i class="icon-arrow"></i>
              </div>
            </div>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="javascript:;">
                <i class="ti-files"></i><span><?= lang('general')?></span> <i class="icon-arrow"></i>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="#">
                    <?= lang('customer_list') ?>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <?= lang('supplier_list') ?>
                  </a>
                </li>
              </ul>
            </li>   
          </ul>
        </li>
        <li>
          <a href="javascript:void(0)">
            <div class="item-content">
              <div class="item-media">
                <i class="ti-stats-up"></i>
              </div>
              <div class="item-inner">
                <span class="title"> <?= lang('finance_report') ?></span><i class="icon-arrow"></i>
              </div>
            </div>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="javascript:;">
                <i class="ti-files"></i><span><?= lang('general')?></span> <i class="icon-arrow"></i>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="#">
                    <?= lang('customer_list') ?>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <?= lang('supplier_list') ?>
                  </a>
                </li>
              </ul>
            </li>   
          </ul>
        </li>
        <li>
          <a href="javascript:void(0)">
            <div class="item-content">
              <div class="item-media">
                <i class="ti-settings"></i>
              </div>
              <div class="item-inner">
                <span class="title"> <?= lang('setting') ?></span><i class="icon-arrow"></i>
              </div>
            </div>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="<?= base_url('users')?>">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-user"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('users') ?></span>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a href="#">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-money"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?= lang('kurs') ?></span>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a href="<?= base_url('pengaturan/satuan')?>">
                <div class="item-content">
                  <div class="item-media">
                    <i class="ti-ruler-pencil"></i>
                  </div>
                  <div class="item-inner">
                    <span class="title"> <?=lang('unit')?></span>
                  </div>
                </div>
              </a>
            </li>        
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- / sidebar -->