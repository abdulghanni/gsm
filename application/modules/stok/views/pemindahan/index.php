<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?php echo 'pemindahan Stok';?></h1>
        </div>
        <ol class="breadcrumb">
            <li>
                <span><?php echo 'pemindahan';?></span>
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
                    <a href="<?=base_url('stok/pemindahan/input')?>">
                        <button class="btn btn-green add-row">
                            <?= lang('add') ?> <i class="fa fa-plus"></i>
                        </button>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-full-width" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="5%" align="center">No.</th>
                            <th width="15%">No. Transaksi</th>
                            <th width="20%">Tgl. Transaksi</th>
                            <th width="25%">Gudang Asal</th>
                            <th width="25%">Gudang Tujuan</th>
                            <th width="20%"><?php echo "action";?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>