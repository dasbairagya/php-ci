<?php 
    $current_project = $this->db->get_where('project' , array(
        'project_code' => $project_code
    ))->result_array();
    foreach ($current_project as $row):
?>
<div class="col-md-7">
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
<?php endforeach;?>
