<?php $date = date('d-m-Y'); ?>

<div class="row">

    <div class="col-md-12">
        <div class="calendar-env">
            

             <a href="javascript:;" onclick=" showAjaxModal('<?php echo base_url();?>index.php?modal/popup/calendar_reminder_add/<?php echo $date ?>' );" 
               class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
              
                 <?php echo get_phrase('add_reminder'); ?>
            </a>
            <div class="main_data">
                <!-- Calendar Body -->
                <?php include 'reminder_body.php'; ?>
            </div>
        </div>
    </div>

</div>


