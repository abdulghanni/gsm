<!-- start: PAGE TITLE -->
<section id="page-title">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mainTitle"><?= $main_title?></h1>
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
                    <a href="<?= base_url($module.'/'.$file_name.'/input')?>" class="btn btn-green add-row">
                        <?= lang('add') ?> <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-full-width" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th align="center">No.</th>
                            <th><?php echo 'No. SO';?></th>
                            <th><?php echo 'Customer';?></th>
                            <th class="text-center"><?php echo 'Tanggal SO';?></th>
                            <th><?php echo 'Dikirim Dari';?></th>
                            <th>Created by</th>
                            <th><?php echo 'Status';?></th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>