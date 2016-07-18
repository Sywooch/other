<?php $this->renderPartial("//partials/task_stickers", array('model'=>$model)); ?>
<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="page-header">
            </h2><?php echo $model->name; ?></h2>
        </div>
		<!--<div id="scheme1"></div>-->
		
		
        <p class="lead">Информация по задаче:</p>
        <dl class="dl-horizontal">
            <dt>Задача</dt>
            <dd><?php echo $model->taskTemplate->name; ?></dd>
            <dt>Описание</dt>
            <dd><?php echo $model->taskTemplate->description; ?></dd>
            <dt>Условия приемки</dt>
            <dd><?php echo $model->conditions; ?></dd>
            <?php if(!$model->subTasks): ?>
            <dt>Дата выполнения</dt>
            <dd><?php echo $model->deadline; ?> <?php echo $model->dayLast(); ?></dd>
            <?php endif; ?>
            <?php if($model->manager): ?>
            <dt>PM</dt>
            <dd>
                <b><a href="<?php echo $model->manager->link; ?>"><?php echo $model->manager->print_name; ?></a></b>
            </dd>
            <?php endif; ?>

            <?php if($model->team): ?>
            <dt>Бригада</dt>
            <dd>
                <b><a href="<?php echo $model->team->link; ?>"><?php echo $model->team->print_name; ?></a></b></td>
            </dd>
            <?php endif; ?>

            <dt>Статус</dt>
            <dd><div class="b-status <?php echo $model->status; ?>"><?php echo $model->print_status; ?></div></dd>

            <?php $this->renderPartial("//partials/button_list", array('model'=>$model, 'buttons'=>$buttons)); ?>

        </dl>
		
<?php if($model->taskTemplate->unit): ?>
<div class="hidden-xs hidden-xs-csv">
    <?php /*$this->renderPartial("//partials/mini_file_list_old", array(
        'class'=>'User',
        'list'=>$user->userFiles,
        'model'=>$user,
        'upload'=>true,
        'file_type' => FileType::NO_TYPE,
        'task_template'=>false,
    ));*/ ?>
</div>
<?php endif; ?>		
		
	
        <!-- <table class="table">
            <tbody>
                <?php if($model->manager): ?>
                <tr>
                    <td>Управляющий</td>
                    <td><b><a href="<?php echo $model->manager->link; ?>"><?php echo $model->manager->print_name; ?></a></b></td>
                </tr>
                <?php endif; ?>
                <?php if($model->team): ?>
                <tr>
                    <td>Бригада</td>
                    <td><b><a href="<?php echo $model->team->link; ?>"><?php echo $model->team->print_name; ?></a></b></td>
                </tr>
                <?php endif; ?>
                <?php if(count($model->candidates)) foreach ($model->candidates as $user): ?>
                <tr>
                    <td>Кандидат</td>
                    <td><b><a href="<?php echo $user->link; ?>"><?php echo $user->print_name; ?></a></b></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table> -->
        <?php if(!$model->taskTemplate->unit): ?>
        <div class="visible-md-block visible-lg-block">
            <?php $this->renderPartial("//partials/mini_file_list_old", array(
                'class' => 'Task',
                'list'=>$model->taskFiles,
                'model'=>$model,
                'task_template'=>$model->taskTemplate,
                'upload'=>false
            )); ?>
        </div>
        <?php endif; ?>
        <div class="visible-md-block visible-lg-block">
            <?php $this->renderPartial("//partials/comment_list", array(
                'list'=>$model->taskComments,
                'task'=>$model,
                'write'=>Yii::app()->user->checkAccess("createComment")
            )); ?>
        </div>

    </div>
    <div class="col-xs-12 col-md-8">
        <?php $this->renderPartial("//partials/site_info", array('model'=>$model->site, 'without_files'=>true)); ?>
    </div>
    <?php if(!$model->taskTemplate->unit): ?>
    <div class="col-xs-6 visible-xs-block visible-sm">
        <?php $this->renderPartial("//partials/mini_file_list_old", array(
            'class' => 'Task',
            'list'=>$model->taskFiles,
            'model'=>$model,
            'task_template'=>$model->taskTemplate,
            'upload'=>false
        )); ?>
    </div>
    <?php endif; ?>
    <?php if(!$model->subTasks): ?>
    <div class="col-xs-6 visible-xs-block visible-sm">
        <?php $this->renderPartial("//partials/comment_list", array(
            'list'=>$model->taskComments,
            'task'=>$model,
            'write'=>true
        )); ?>
    </div>
    <?php endif; ?>

</div>

<script src="/frontend/js/helper_task.js"></script>