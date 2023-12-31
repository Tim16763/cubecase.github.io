

<?php $__env->startSection('content'); ?>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="wraper container">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="profile-detail card-box">
                            <div>
                                <img src="<?php echo e($user->avatar); ?>" class="img-circle" alt="profile-image">

                                <h4><?php echo e($user->name); ?></h4>

                                <ul class="list-inline status-list m-t-20">
                                    <li>
                                        <h3 class="text-primary m-b-5"><?php echo e($user->open_box); ?></h3>
                                        <p class="text-muted">Открыл кейсов</p>
                                    </li>
                                </ul>

                                <?php if($user->profile == 'vk'): ?>
                                    <a href="https://vk.com/id<?php echo e($user->user_id); ?>" target="_blank">
                                        <?php else: ?>
                                            <a href="http://steamcommunity.com/profiles/<?php echo e($user->user_id); ?>/"
                                               target="_blank">
                                                <?php endif; ?>
                                                <button type="button"
                                                        class="btn btn-pink btn-custom btn-rounded waves-effect waves-light">
                                                    Профиль
                                                </button>
                                            </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-9 col-md-8">
                        <div class="card-box">
                            <form class="form-horizontal group-border-dashed" action="/admin/saveUser" novalidate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Имя пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="<?php echo e($user->name); ?>" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Аватарка пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="<?php echo e($user->avatar); ?>" name="avatar">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ссылка на профиль</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="<?php echo e($user->user_id); ?>" name="user_id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Баланс пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="<?php echo e($user->balance); ?>" name="balance">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Реферальный код пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?php echo e($user->affiliate_code); ?>" name="affiliate_code">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Использованный реферальный код</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?php echo e($user->affiliate_use); ?>" name="affiliate_use">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Получил от рефералов</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?php echo e($user->affiliate_profit); ?>" name="affiliate_profit">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Открыл кейсов</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?php echo e($user->open_box); ?>" name="open_box">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Роль</label>
                                    <div class="col-sm-6">
                                        <select class="form-control select2" required name="role">
                                            <?php if($user->role == 'user'): ?>
                                                <option value="user">Пользователь</option>
                                                <option value="youtuber">Ютубер</option>
                                                <option value="admin">Администратор</option>
                                            <?php elseif($user->role == 'youtuber'): ?>
                                                <option value="youtuber">Ютубер</option>
                                                <option value="user">Пользователь</option>
                                                <option value="admin">Администратор</option>
                                            <?php elseif($user->role == 'admin'): ?>
                                                <option value="admin">Администратор</option>
                                                <option value="youtuber">Ютубер</option>
                                                <option value="user">Пользователь</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Зарегистрирован</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" disabled value="<?php echo e($user->created_at); ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
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