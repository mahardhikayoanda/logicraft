

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Dashboard Resepsionis</h2>

    <a href="<?php echo e(route('reservasi.tambah')); ?>" class="btn btn-primary mt-3">Tambah Reservasi</a>
    <a href="<?php echo e(route('reservasi.index')); ?>" class="btn btn-outline-primary mt-3">Lihat Daftar Reservasi</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success mt-3"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\penginapansaya\penginapansaya\resources\views/resepsionis/dashboard.blade.php ENDPATH**/ ?>