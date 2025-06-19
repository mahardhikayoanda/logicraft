

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3>Tambah Reservasi</h3>

    <form method="POST" action="#">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="tamu_id" class="form-label">Nama Tamu</label>
            <select name="tamu_id" class="form-select" required>
                <option value="">-- Pilih Tamu --</option>
                <?php $__currentLoopData = $tamus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tamu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tamu->id); ?>"><?php echo e($tamu->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kamar" class="form-label">Nomor Kamar</label>
            <input type="text" name="kamar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_checkin" class="form-label">Tanggal Check-in</label>
            <input type="date" name="tanggal_checkin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_checkout" class="form-label">Tanggal Check-out</label>
            <input type="date" name="tanggal_checkout" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?php echo e(route('resepsionis.dashboard')); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\penginapansaya\penginapansaya\resources\views/resepsionis/tambah_pemesanan.blade.php ENDPATH**/ ?>