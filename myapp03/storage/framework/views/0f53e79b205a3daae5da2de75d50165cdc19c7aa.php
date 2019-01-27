<?php $__env->startSection('content'); ?>
    <h1 class="title"><?php echo e($project->title); ?></h1>
    <div class="content">
      <?php echo e($project->description); ?>

      <p><a href="/projects/<?php echo e($project->id); ?>/edit">Edit Project</a></p>
    </div>

    <?php if($project->tasks->count()): ?>
      <div>
        <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div>
            <form action="/tasks/<?php echo e($task->id); ?>" method="POST">
              <?php echo method_field('PATCH'); ?>
              <?php echo csrf_field(); ?>
              <label class="checkbox <?php echo e($task->completed ? 'is-complete' : ''); ?>" for="completed">
                <input type="checkbox" name="completed" id="completed" onChange="this.form.submit()" <?php echo e($task->completed ? 'checked' : ''); ?>>
                <?php echo e($task->description); ?>

              </label>
            </form>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>