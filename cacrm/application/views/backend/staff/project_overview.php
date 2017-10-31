<?php 
	$current_project = $this->db->get_where('project' , array(
		'project_code' => $project_code
	))->result_array();
	foreach ($current_project as $row):
?>
<div class="col-md-7">
	
    <!-- project description -->
 <table class="table table-bordered datatable">
    <thead>
        <tr>
            

            </th>
<th><div><?php echo get_phrase('service'); ?></div></th>
<th><div><?php echo get_phrase('start-date'); ?></div></th>
<th><div><?php echo get_phrase('end-date'); ?></div></th>
<th><div><?php echo get_phrase('price'); ?></div></th>
<th><div><?php echo get_phrase('advanceper%'); ?></div></th>
<th><div><?php echo get_phrase('documents'); ?></div></th>
<th><div><?php echo get_phrase('progress_status'); ?></div></th>
</tr>
</thead>
<tbody>

<tr>
    
<td>
   <?php $serviceId =  $row['service_id'];
                     $where = "service_id = "."'".$serviceId."'";
                     $this->db->where($where);
                     $service = $this->db->get('add_service')->row_array(); 
                    // echo $this->db->last_query();
                     echo $service['title'];
                       ?>
</td>

<td>
 <?php echo $row['timestamp_start'];?>
</td>

<td>
  <?php echo $row['timestamp_end'];?>
</td>

<td>
  <?php echo $row['budget'];?>
</td>

<td>
 <?php echo $row['demo_url'];?>
</td>

<td>
   <?php echo $row['document'];?>
</td>

<td>
  
                <?php 
                $status = 'info';
                if ($row['progress_status'] == 100)$status = 'success';
                if ($row['progress_status'] < 50)$status = 'danger';
                ?>
              
                <div class="progress progress-striped <?php if ($row['progress_status']!=100)echo 'active';?> tooltip-primary" 
                    style="height:3px !important; cursor:pointer;"  data-toggle="tooltip"  data-placement="top"
                        title="" data-original-title="<?php echo $row['progress_status'];?>% completed" >
                    <div class="progress-bar progress-bar-<?php echo $status;?>" 
                        role="progressbar" aria-valuenow="<?php echo $row['progress_status'];?>" 
                            aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row['progress_status'];?>%">
                      <span class="sr-only">40% Complete (success)</span>
                    </div>
                </div>
</td>


</tr>
</tbody>
</table>

</div>

<div class="col-md-3">
    

    <!-- client -->
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-user"></i> <?php echo get_phrase('client');?>
            </div>
            <div class="panel-options">
            </div>
        </div>
        <div class="panel-body">
            <?php
                if ($row['client_id'] < 1):
                    ?>
                    <center>
                        <?php echo get_phrase('no_client_added_yet');?>
                    </center>
            <?php endif; ?>

            <table width="100%" border="0">
            <tbody>
                <?php
                if ($row['client_id'] > 0):
                    $client_data = $this->db->get_where('client', array('client_id' => $row['client_id']))->result_array();
                    foreach ($client_data as $row3):
                        ?>
                <tr>
                    <td rowspan="2" width="60">
                        <img src="<?php echo $this->crud_model->get_image_url('client', $row3['client_id']); ?>" 
                            alt="" class="img-circle" width="44">
                    </td>
                    <td>
                        <h4 style="font-weight: 200;"><?php echo $row3['name'];?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if ($row3['skype_id'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('call_skype'); ?>"    
                               href="skype:<?php echo $row3['skype_id']; ?>?chat" style="color:#bbb;">
                                <i class="entypo-skype"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['email'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('send_email'); ?>"    
                               href="mailto:<?php echo $row3['email']; ?>" style="color:#bbb;">
                                <i class="entypo-mail"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['phone'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('call_phone'); ?>"    
                               href="tel:<?php echo $row3['phone']; ?>" style="color:#bbb;">
                                <i class="entypo-phone"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['facebook_profile_link'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('facebook_profile'); ?>"  
                               href="<?php echo $row3['facebook_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                <i class="entypo-facebook"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['twitter_profile_link'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('twitter_profile'); ?>"   
                               href="<?php echo $row3['twitter_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                <i class="entypo-twitter"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['linkedin_profile_link'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('linkedin_profile'); ?>"  
                               href="<?php echo $row3['linkedin_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                <i class="entypo-linkedin"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
            </tbody>
            </table>
        </div>
    </div>

    <!-- staff -->
    <?php 
        $staffs = ( explode(',', $row['staffs']));
        $number_of_staffs = count($staffs) - 1;
    ?>
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-users"></i> Assigned staff
                </div>
            </div>
            <div class="panel-body">

                <?php
                    if ($number_of_staffs < 1):
                        ?>

                        <center>
                            <?php echo get_phrase('no_staffs_assigned_yet');?>
                        </center>
                    <?php endif; ?>

                <?php
                    if ($number_of_staffs > 0):
                        for ($i = 0; $i < $number_of_staffs; $i++):
                            $staff_data = $this->db->get_where('staff', array('staff_id' => $staffs[$i]))->result_array();
                            foreach ($staff_data as $row2):
                                ?>
                                <table width="100%" border="0">
                                    <tr>
                                        <td rowspan="2" width="60">
                                            <img src="<?php echo $this->crud_model->get_image_url('staff', $row2['staff_id']); ?>" 
                                                 alt="" class="img-circle" width="44">
                                        </td>
                                        <td>
                                            <h4 style="font-weight: 200;"><?php echo $row2['name']; ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php if ($row2['skype_id'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('call_skype'); ?>"    
                                                   href="skype:<?php echo $row2['skype_id']; ?>?chat" style="color:#bbb;">
                                                    <i class="entypo-skype"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['email'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('send_email'); ?>"    
                                                   href="mailto:<?php echo $row2['email']; ?>" style="color:#bbb;">
                                                    <i class="entypo-mail"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['phone'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('call_phone'); ?>"    
                                                   href="tel:<?php echo $row2['phone']; ?>" style="color:#bbb;">
                                                    <i class="entypo-phone"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['facebook_profile_link'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('facebook_profile'); ?>"  
                                                   href="<?php echo $row2['facebook_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                                    <i class="entypo-facebook"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['twitter_profile_link'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('twitter_profile'); ?>"   
                                                   href="<?php echo $row2['twitter_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                                    <i class="entypo-twitter"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['linkedin_profile_link'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('linkedin_profile'); ?>"  
                                                   href="<?php echo $row2['linkedin_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                                    <i class="entypo-linkedin"></i>
                                                </a>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <?php
                            endforeach;
                        endfor;
                    endif;
                    ?>
            </div>
        </div>

</div>
<?php endforeach;?>
