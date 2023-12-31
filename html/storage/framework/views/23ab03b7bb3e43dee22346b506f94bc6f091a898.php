

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
                                <img src="<?php echo e($case->img); ?>" class="img-circle" alt="profile-image">

                                <h4><?php echo e($case->name); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="card-box">
                            <form class="form-horizontal group-border-dashed" action="/admin/saveCase" novalidate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Название кейса</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="<?php echo e($case->name); ?>" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Старая стоимость кейса</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="<?php echo e($case->oldp); ?>" name="oldp">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Стоимость кейса</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="<?php echo e($case->price); ?>" name="price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ссылка на изображение</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="<?php echo e($case->img); ?>" name="img">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Предметы в кейсе</label>
                                    <div class="col-sm-6">
                                        <select class="select2 select2-multiple" multiple="multiple" multiple name="items[]" data-placeholder="Выберите предметы ...">
                                            <?php if($case->items == '' || $case->items == 'null'): ?>
                                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $itemsCase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemCase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($item->id == $itemCase): ?>
                                                            <option selected value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-3 control-label">Категории</label>
                                    <div class="col-sm-6">
                                        <select name="category">
                                            <?php $__currentLoopData = $categoryes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($item1->id == $case->category): ?> selected <?php endif; ?> value="<?php echo e($item1->id); ?>"><?php echo e($item1->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo e($case->id); ?>">
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