

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Beri Ulasan untuk <?php echo e($reservasi->id); ?></h2>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('reviews.store')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="reservation_id" value="<?php echo e($reservasi->id); ?>">

        <div class="form-group mb-3">
            <label for="rating">Rating</label>
            <select name="rating" id="rating" class="form-control" required>
                <option value="">-- Pilih Rating --</option>
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <option value="<?php echo e($i); ?>" <?php echo e(old('rating') == $i ? 'selected' : ''); ?>>
                        <?php echo e($i); ?> ★
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="ulasan">Ulasan</label>
            <textarea name="ulasan" id="ulasan" class="form-control" rows="4" required><?php echo e(old('ulasan')); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\penginapansaya\penginapansaya\resources\views/reviews.blade.php ENDPATH**/ ?>