<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle">Purchase Order</h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?php echo lang('order');?></span>
            </li>
            <li class="active">
                <span>Index</span>
            </li>
        </ol>
    </div>
</section>
<div class="container-fluid container-fullw bg-white">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-md-12 space20">
              <a href="<?= base_url('purchase/order/input')?>" class="btn btn-green add-row">
                  <?= lang('add') ?> <i class="fa fa-plus"></i>
              </a>
          </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="table" style="width: 100%;">
            <thead>
                <tr>
                  <th rowspan="2" scope="col" width="1%" class="text-center">No</th>
                  <th rowspan="2" scope="col" width="10">NO P.O</th>
                  <th rowspan="2" scope="col" width="10">Supplier</th>
                  <th rowspan="2" scope="col" width="10">Tgl Kirim&nbsp;&nbsp;&nbsp;</th>
                  <th rowspan="2" scope="col" width="10">Dikirim Ke</th>
                  <th rowspan="2" scope="col" width="10">Created by</th>
                  <th colspan="4" scope="col" width="20" class="text-center">Status</th>
                  <th rowspan="2" scope="col" width="10" class="text-center">Action&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>
                <tr>
                  <th scope="col" class="text-center" width="5%">PR</th>
                  <th scope="col" class="text-center" width="5%">GA</th>
                  <th scope="col" class="text-center" width="5%">Mgr</th>
                  <th scope="col" class="text-center" width="5%">Dir</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>