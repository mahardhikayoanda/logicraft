

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Data Reservasi Berhasil Diubah</h2>

    <h4>🔁 Data Sebelum Diubah:</h4>
    <ul>
        <?php $__currentLoopData = $sebelum; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><strong><?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>:</strong> <?php echo e($value); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <hr>

    <h4>✅ Data Sesudah Diubah:</h4>
    <ul>
        <li><strong>Nama Tamu:</strong> <?php echo e($sesudah->nama_tamu); ?></li>
        <li><strong>Email:</strong> <?php echo e($sesudah->email); ?></li>
        <li><strong>No HP:</strong> <?php echo e($sesudah->no_hp); ?></li>
        <li><strong>Check-in:</strong> <?php echo e($sesudah->tanggal_checkin); ?></li>
        <li><strong>Check-out:</strong> <?php echo e($sesudah->tanggal_checkout); ?></li>
        <li><strong>Tipe Kamar:</strong> <?php echo e($sesudah->tipe_kamar); ?></li>
    </ul>

    <a href="<?php echo e(route('reservasi.index')); ?>" class="btn btn-primary mt-3">Kembali ke Daftar Reservasi</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\penginapansaya\penginapansaya\resources\views/resepsionis/hasil_edit.blade.php ENDPATH**/ ?>