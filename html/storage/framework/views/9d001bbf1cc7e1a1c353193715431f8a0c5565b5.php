

<?php $__env->startSection('content'); ?>
    <script src="/adminAsset/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="wraper container">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="profile-detail card-box">
                            <div>
                                <img src="<?php echo e($item->img); ?>" class="img-circle" alt="profile-image">

                                <h4>Стоимость: <?php echo e($item->sell_price); ?> р.</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="card-box">
                            <form class="form-horizontal group-border-dashed" action="/admin/saveItem" novalidate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Название предмета</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="<?php echo e($item->name); ?>" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Стоимость предмета</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" required="" value="<?php echo e($item->sell_price); ?>" name="sell_price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Изображение предмета</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="<?php echo e($item->img); ?>" name="img">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Шанс выпадения</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" required="" value="<?php echo e($item->chance); ?>" name="chance">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Выигрыш</label>
                                    <div class="col-sm-6">
                                        <select multiple data-role="tagsinput" name="keys[]">
                                            <?php $__currentLoopData = json_decode($item->key); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item1); ?>"><?php echo e($item1); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo e($item->id); ?>">
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                        <button type="submit" class="btn btn-primary">
                                            Сохранить
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