

<?php $__env->startSection('content'); ?>
    <script src="/adminAsset/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="wraper container">
                <div class="row">
                    <div class="col-lg-9 col-md-8">
                        <div class="card-box">
                            <form class="form-horizontal group-border-dashed" action="/admin/addCategoryPost" novalidate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Название Категории</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" placeholder="Random кейсы" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                        <button type="submit" class="btn btn-primary">
                                            Создать
                                        </button>
                                        <button type="reset" class="btn btn-default m-l-5">
                                            Отмена
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>