<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?= $main_title?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?= $title;?></span>
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
                    <a href="<?= base_url($module.'/'.$file_name.'/input')?>" class="btn btn-green add-row">
                        <?= lang('add') ?> <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-full-width" id="table">
                    <thead>
                        <tr>
                            <th width="5%" align="center">No.</th>
                            <th width="10%"><?php echo 'No. Pembelian';?></th>
                            <th width="15%"><?php echo 'No. PO';?></th>
                            <th width="15%"><?php echo 'Supplier';?></th>
                            <th width="5%" class="text-center"><?php echo 'Tanggal Faktur';?></th>
                            <th width="5%" class="text-center"><?php echo 'Tanggal pengiriman';?></th>
                            <th width="5%" class="text-center"><?php echo 'Metode Pembayaran';?></th>
                            <th width="15%"><?php echo 'Dikirim Ke';?></th>
                            <th width="10%" class="text-center"><?php echo lang('action');?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>