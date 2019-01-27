<?php $__env->startSection('content'); ?>
  
  <h1 class="title">Projects</h1>
  <?php if(session('success')): ?>
    <div class="notification is-success">
      <?php echo e(session('success')); ?>

    </div>
  <?php endif; ?>
  <ul>
    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
          <a href="/projects/<?php echo e($project->id); ?>"><?php echo e($project->title); ?></a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>