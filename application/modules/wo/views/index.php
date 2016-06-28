<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?=strtoupper($title)?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?php echo $title;?></span>
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
              <a href="<?= base_url('wo/input')?>" class="btn btn-green add-row">
                  <?= lang('add') ?> <i class="fa fa-plus"></i>
              </a>
          </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="table" style="width: 100%;">
            <thead>
                <tr>
                  <th width="1%" class="text-center">No</th>
                  <th width="10">NO W.O</th>
                  <th width="15">Project</th>
                  <th width="40">Customer</th>
                  <th width="9">Tgl. Dibutuhkan</th>
                  <th width="10">Created by</th>
                  <th width="5">Status</th>
                  <th width="10" class="text-center">Action&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>