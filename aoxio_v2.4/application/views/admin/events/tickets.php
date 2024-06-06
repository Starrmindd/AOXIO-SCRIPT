<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <?php $this->load->view('admin/include/breadcrumb'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-8 pt-3">
              <div class="ticket_area">
                  <div class="card list_area">
                    <div class="card-header">
                      <h3 class="card-title pt-2"><?php echo trans('tickets') ?></h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap <?php if(count($tickets) > 10){echo "datatable";} ?>">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th><?php echo trans('name') ?></th>
                              <th><?php echo trans('event') ?></th>
                              <th><?php echo trans('price') ?></th>
                              <th><?php echo trans('limit') ?></th>
                              <th><?php echo trans('status') ?></th>
                              <th class="text-right"><?php echo trans('action') ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1; foreach ($tickets as $row): ?>
                              <tr id="row_<?php echo ($row->id); ?>">
                                  
                                <td><?= $i; ?></td>
                                <td><?php echo html_escape($row->name); ?></td>
                                <td><?php echo get_by_id($row->event_id,'events')->name; ?></td>
                                <td>
                                  <p class="p-0 m-0">
                                    <?php if ($row->price == 0): ?>
                                        <?php echo trans('free') ?>
                                    <?php else: ?>
                                      <?php if($this->business->curr_locate == 0){echo $this->business->currency_symbol;} ?>
                                      <?php echo number_format($row->price, $this->business->num_format) ?>
                                      <?php if($this->business->curr_locate == 1){echo $this->business->currency_symbol;} ?>
                                    <?php endif ?>
                                  </p>
                                </td>
                                <td><span class="badge badge-info"><?php echo html_escape($row->limit) ?></span></td>
                                <td>
                                  <?php if ($row->status == 1): ?>
                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> <?php echo trans('active') ?></span>
                                  <?php else: ?>
                                    <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> <?php echo trans('hidden') ?></span>
                                  <?php endif ?>
                                </td> 

                                <td class="actions text-right">
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-tool" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right" role="menu" >
                                        <a data-val="ticket" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/events/delete_ticket/'.html_escape($row->id));?>" class="dropdown-item delete_item"><?php echo trans('delete') ?></a>
                                      </div>
                                  </div>
                                </td>
                              </tr>
                            <?php $i++; endforeach; ?>
                          </tbody>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

