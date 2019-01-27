<?php $__env->startSection('content'); ?>
    <h1 class="title">Edit Project</h1>

    <form action="/projects/<?php echo e($project->id); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PATCH'); ?>
      <div class="field">
        <label class="label" for="title">Title</label>
          <div class="control">
            <input type="text" class="input" name="title" placeholder="Title" value="<?php echo e($project->title); ?>">
          </div>
      </div>
      <div class="field">
        <label class="label" for="">Description</label>
        <div class="control">
          <textarea name="description" class="textarea" id="" cols="30" rows="10"><?php echo e($project->description); ?></textarea>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <button type="submit" class="button is-link">Update Project</button>
        </div>
      </div>
    </form>
    <form action="/projects/<?php echo e($project->id); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <?php echo method_field('DELETE'); ?>
      <div class="field">
        <div class="control">
          <button type="submit" class="button is-danger">Delete Project</button>
        </div>
      </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>