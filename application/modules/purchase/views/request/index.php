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
                          <th rowspan="2" scope="col" width="5%" class="text-center">No</th>
                          <th rowspan="2" scope="col" width="20">NO P.R</th>
                          <th rowspan="2" scope="col" width="5">Tgl. Digunakan</th>
                          <th rowspan="2" scope="col" width="10">Gudang</th>
                          <th colspan="4" scope="col" width="20" class="text-center">Status</th>
                          <th rowspan="2" scope="col" width="10" class="text-center">Action</th>
                        </tr>
                        <tr>
                          <th scope="col" class="text-center" width="5%">KA.Div</th>
                          <th scope="col" class="text-center" width="5%">GA</th>
                          <th scope="col" class="text-center" width="5%">Mgr</th>
                          <th scope="col" class="text-center" width="5%">Dir</th>
                        </tr>
                        <!--
                        <tr>
                            <th width="5%" align="center">No.</th>
                            <th width="20%"><?php echo 'No. Request';?></th>
                            <th width="20%"><?php echo 'Diajukan Untuk';?></th>
                            <th width="10%" class="text-center"><?php echo 'Tanggal Digunakan';?></th>
                            <th width="15%" class="text-center"><?php echo 'Gudang';?></th>
                            <th width="15%"><?php echo 'Keperluan';?></th>
                            <th width="5%"><?php echo 'Status';?></th>
                            <th width="10%" class="text-center"><?php echo lang('action');?></th>
                        </tr>
                        -->
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>