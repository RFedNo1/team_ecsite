<?php $__env->startSection('content'); ?>
<h1>Create Project</h1>
  <form action="/projects" method="POST">
    <?php echo e(csrf_field()); ?>

    <div>
    <input type="text" name="title" placeholder="Project title" class="input <?php echo e($errors->has('title') ? 'is-danger' : ''); ?>" value="<?php echo e(old('title')); ?>">
    </div>
    <div>
      <textarea name="description" placeholder="Project description" class="textarea <?php echo e($errors->has('description') ? 'is-danger' : ''); ?>"><?php echo e(old('description')); ?></textarea>
    </div>
    <div>
      <button type="submit" class="button is-link">Create Project</button>
    </div>
  </form>
  <?php if($errors->any()): ?>
    <div class="notification is-danger">
      <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>  
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul> 
    </div>
  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>