<?php $__env->startSection('content'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".knob").knob();
        });
    </script>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Статистика</h4>
                    <p class="text-muted page-title-alt">Навигация для мобильных устройств</p>

                    <li class="has_sub">
                        <a href="/admin" class="waves-effect"><i class="ti-home"></i> <span> Статистика </span> <span class="menu-arrow"></span></a>
                    </li>
                    <li class="has_sub">
                        <a href="/admin/settings" class="waves-effect"><i class="ti-light-bulb"></i><span> Настройки </span> <span class="menu-arrow"></span></a>
                    </li>
                    <li class="has_sub ms-hover">
                        <a href="/admin/users" class="waves-effect"><i class="ti-spray"></i> <span> Пользователи </span> </a>
                    </li>
                    <li class="has_sub ms-hover">
                        <a href="/admin/cases" class="waves-effect"><i class="ti-spray"></i> <span> Кейсы </span> </a>
                    </li>
                    <li class="has_sub ms-hover">
                        <a href="/admin/items" class="waves-effect"><i class="ti-spray"></i> <span> Предметы </span> </a>
                    </li>
                    <li class="has_sub ms-hover">
                        <a href="/admin/lastOpen" class="waves-effect"><i class="ti-spray"></i> <span> Последние открытия </span> </a>
                    </li>
                    <li class="has_sub ms-hover">
                        <a href="/admin/crafts" class="waves-effect"><i class="ti-spray"></i> <span> Крафты </span> </a>
                    </li>
                    <li class="has_sub ms-hover">
                        <a href="/admin/lastOrders" class="waves-effect"><i class="ti-spray"></i> <span> Последние пополнения </span> </a>
                    </li>
                    <li class="has_sub ms-hover">
                        <a href="/admin/promocode" class="waves-effect"><i class="ti-spray"></i> <span> Промокоды </span> </a>
                    </li>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-info pull-left">
                                <i class="md md-attach-money text-info"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b class="counter"><?php echo e($all_win); ?></b></h3>
                                <p class="text-muted">Выиграли пользователи</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-info pull-left">
                                <i class="md md-attach-money text-info"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b class="counter"><?php echo e($all_box); ?></b></h3>
                                <p class="text-muted">Открыли кейсов</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-info pull-left">
                                <i class="md md-attach-money text-info"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b class="counter"><?php echo e($allOrder); ?></b></h3>
                                <p class="text-muted">Внесли пользователи</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-box">
                            <a href="/admin/lastOpen" class="pull-right btn btn-default btn-sm waves-effect waves-light">Больше</a>
                            <h4 class="text-dark header-title m-t-0">Последние открытия</h4>
                            <p class="text-muted m-b-30 font-13">
                                Последние 7 кейсов
                            </p>

                            <div class="table-responsive" style="min-height: 300px; max-height: 300px;  overflow:  hidden; ">
                                <table class="table table-actions-bar">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Кейс</th>
                                        <th>Пользователь</th>
                                        <th>Выиграл</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $live7Open; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $live): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($live->id); ?></td>
                                            <td><?php echo e($live->case->name); ?></td>
                                            <td><a href="/admin/user/<?php echo e($live->user->id); ?>"><?php echo e($live->user->name); ?></a></td>
                                            <td><?php echo e($live->item->name); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card-box">
                            <a href="#" class="pull-right btn btn-default btn-sm waves-effect waves-light">Больше</a>
                            <h4 class="m-t-0 m-b-20 header-title"><b>Последние пополнения</b></h4>
                            <div class="nicescroll mx-box" style="overflow: hidden; outline: none; min-height: 345px; max-height: 345px;" tabindex="5000">
                                <ul class="list-unstyled transaction-list m-r-5">
                                    <?php $__currentLoopData = $last9Order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <i class="ti-download text-success"></i>
                                            <a href="/admin/user/<?php echo e($order->user->id); ?>">
                                                <span class="tran-text"><?php echo e($order->user->name); ?></span>
                                            </a>
                                            <span class="pull-right text-success tran-price">+<?php echo e($order->amount); ?> р.</span>
                                            <span class="pull-right text-muted"><?php echo e($order->updated_at); ?></span>
                                            <span class="clearfix"></span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>
                            </div>
                        </div>
                </div>

            </div> <!-- container -->

        </div> <!-- content -->
        <footer class="footer text-right">
            © 2017-2018. All rights reserved. by ToXaHo. Designed by MinecraftCase.ru
        </footer>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>