

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Daftar Reservasi</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Ubah</th>
                <th>Hapus</th>
                <th>Ulasan</th>
                <th>Nama Tamu</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Tipe Kamar</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $reservasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <a href="<?php echo e(route('reservasi.edit', $data->id)); ?>" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <form action="<?php echo e(route('reservasi.destroy', $data->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
                <td>
                    <a href="<?php echo e(route('reviews.store', $data->id)); ?>" class="btn btn-warning">Ulasan</a>
                </td>
                <td><?php echo e($data->nama_tamu); ?></td>
                <td><?php echo e($data->email); ?></td>
                <td><?php echo e($data->no_hp); ?></td>
                <td><?php echo e($data->tanggal_checkin); ?></td> <!-- ✅ Check-in -->
                <td><?php echo e($data->tanggal_checkout); ?></td> <!-- ✅ Check-out -->
                <td><?php echo e($data->tipe_kamar); ?></td>
                <td><?php echo e($data->created_at); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\penginapansaya\penginapansaya\resources\views/resepsionis/daftar_reservasi.blade.php ENDPATH**/ ?>