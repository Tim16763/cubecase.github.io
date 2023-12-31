<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="/cards/card.css?22"/>
<div class="playcard playcard-9 active active_arrow_left" data-id="1">
			<div class="shutupandtakemymoney" style="display: block;">
				<img class="shut-light rotate" src="/images/card/buycard_light.png?1">

				<button class="gold tutor_auth" id="gogame">
					Купить 3 попытки за <?php echo e($case->price); ?> руб.
					<span>Испытайте лучший формат открытия кейсов в действии!</span>
				</button>
			</div>
			<div class="playcard-teacher3" style="display: none;">
				Увы! У вас не получилось — откройте ваш гарантированный приз!
			</div>

			<div class="winner-popup" style="display: none;">
				<div class="wp-head1">Вы выиграли!</div>
				<div class="wp-head2"><span></span></div>
				<div class="wp-item"><img src=""/></div>
				<div class="wp-buttons">
					<div>
						<a href="/account/" style="margin-right: 10px;" class="buttonlink gold finish_tutor">
							Получить предмет
						</a>
						<a href="/account/" class="buttonlink gold finish_tutor">
							Продать предмет
						</a>
					</div>
				</div>
				<img class="wp-light" src="/images/card/winner_light.png">
				<div class="wp-light-colored"></div>
				<img class="wp-light-anim" src="/images/card/winner_light_anim.png">
			</div>

			<div class="playcard-inner">
				<div class="scratchcases">
						<div class="scratchcase" id="case-0" data-id="0">
							<div class="item-scratch">
								<div class="picture"></div>
								<div class="descr"></div>
							</div>
            </div>
						<div class="scratchcase" id="case-1" data-id="1">
							<div class="item-scratch">
								<div class="picture"></div>
								<div class="descr"></div>
							</div>
            </div>
						<div class="scratchcase" id="case-2" data-id="2">
							<div class="item-scratch">
								<div class="picture"></div>
								<div class="descr"></div>
							</div>
            </div>
						<div class="scratchcase" id="case-3" data-id="3">
							<div class="item-scratch">
								<div class="picture"></div>
								<div class="descr"></div>
							</div>
            </div>
						<div class="scratchcase" id="case-4" data-id="4">
							<div class="item-scratch">
								<div class="picture"></div>
								<div class="descr"></div>
							</div>
            </div>
						<div class="scratchcase" id="case-5" data-id="5">
							<div class="item-scratch">
								<div class="picture"></div>
								<div class="descr"></div>
							</div>
            </div>
						<div class="scratchcase" id="case-6" data-id="6">
							<div class="item-scratch">
								<div class="picture"></div>
								<div class="descr"></div>
							</div>
            </div>
						<div class="scratchcase" id="case-7" data-id="7">
							<div class="item-scratch">
								<div class="picture"></div>
								<div class="descr"></div>
							</div>
            </div>
						<div class="scratchcase" id="case-8" data-id="8">
							<div class="item-scratch">
								<div class="picture"></div>
								<div class="descr"></div>
							</div>
            </div>
				</div>

				<div class="card-right">
					<img src="/images/card/arrow_extra_right.png?1" class="card-extraarrow-right">
					<div class="card-name"><?php echo e($case->name); ?></div>
					<div class="card-extra">
						<div class="card-extracase">
							
							<div class="scratchcase off" id="case-10" data-id="10">
								<div class="item-scratch">
									<div class="picture">
									</div>
									<div class="descr">
									</div>
								</div>
              </div>
							
						</div>
					</div>
					<div class="card-rules">
						<b>Основные правила:</b>
						<ul>
							<li>Откройте 3 одинаковых предмета и получите его!</li>
							<li>3 попытки + 1 дополнительная по желанию</li>
							<li>Гарантированный выигрыш для каждого!</li>
						</ul>
					</div>
				</div>

				<div class="card-extraerase">
					<img src="/images/card/arrow_extra_left.png?1" class="card-extraarrow-left">
					<button class="button pic large" id="extraerase">
						+1 попытка
						<span class="extraPrice">за <?php echo(floor($case->price/100*10)); ?> руб!</span>
					</button>
					<button class="button-line refill" style="display: none">
						Недостаточно средств — пополните баланс!
					</button>
					<div class="ce-text">
						<div class="ce-item">Можете получить <span id="possible_item"></span></div>
						<div>Испытаете удачу или сразу заберёте гарантированный выигрыш?</div>
					</div>
				</div>
			</div>
		</div>
    <div class="ceys_full full" data-name="<?php echo e($case->name); ?>" data-id="<?php echo e($case->id); ?>">
      <div class="ceys_title">Содержимое кейса</div>
      <div class="item_loop2">
        <?php $__currentLoopData = $demoItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="items">
            <?php if($item->sell_price !== 0): ?>
            <div class="item_price"><?php echo e($item->sell_price); ?></div>
            <?php endif; ?>
            <div class="item_images1">
                <img src="<?php echo e($item->img); ?>" alt="<?php echo e($item->name); ?>"/>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>

<script src="/cards/wScratchPad.min.js"></script>
<script>var case_id = <?php echo e($case->id); ?>;</script>
<script src="/cards/card.js?34"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>