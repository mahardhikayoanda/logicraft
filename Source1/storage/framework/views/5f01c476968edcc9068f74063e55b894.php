

<?php $__env->startSection('content'); ?>
<h2>Edit Reservasi</h2>

<form method="POST" action="<?php echo e(route('reservasi.update', $reservasi->id)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-2">
        <label>Nama Tamu</label>
        <input type="text" name="nama_tamu" class="form-control" value="<?php echo e($reservasi->nama_tamu); ?>">
    </div>
    <div class="mb-2">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo e($reservasi->email); ?>">
    </div>
    <div class="mb-2">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control" value="<?php echo e($reservasi->no_hp); ?>">
    </div>
    <div class="mb-2">
        <label>Check-in</label>
        <input type="date" name="tanggal_checkin" class="form-control" value="<?php echo e($reservasi->tanggal_checkin); ?>">
    </div>
    <div class="mb-2">
        <label>Check-out</label>
        <input type="date" name="tanggal_checkout" class="form-control" value="<?php echo e($reservasi->tanggal_checkout); ?>">
    </div>
    <div class="mb-2">
        <label>Tipe Kamar</label>
        <select name="tipe_kamar" class="form-control">
            <option <?php echo e($reservasi->tipe_kamar == 'Deluxe' ? 'selected' : ''); ?>>Deluxe</option>
            <option <?php echo e($reservasi->tipe_kamar == 'Standar' ? 'selected' : ''); ?>>Standar</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success mt-2">Simpan Perubahan</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\penginapansaya\penginapansaya\resources\views/resepsionis/edit_reservasi.blade.php ENDPATH**/ ?>