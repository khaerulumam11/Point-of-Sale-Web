<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h4><?php echo $this->lang->line('Income Statement') ?></h4>
            <hr>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><?php echo $this->lang->line('Total Income') ?><?php echo amountExchange($income['lastbal'], 0, $this->aauth->get_user()->loc) ?></p>
                        <p><?php echo $this->lang->line('This Month Income') ?><?php echo amountExchange($income['monthinc'], 0, $this->aauth->get_user()->loc) ?></p>
                        <p id="param1"></p>
                        <p id="param2"></p>


                    </div>

                </div>

            </div>

        </div>

        <div class="card-body">
            <form method="post" id="product_action" class="form-horizontal">
                <div class="grid_3 grid_4">
                    <h6><?php echo $this->lang->line('Custom Range') ?></h6>
                    <hr>


                    <div class="form-group row">

                        <label class="col-sm-3 col-form-label"
                               for="pay_cat"><?php echo $this->lang->line('Account') ?></label>

                        <div class="col-sm-6">
                            <select name="pay_acc" class="form-control">
                                <option value='0'><?php echo $this->lang->line('All Accounts') ?></option>
                                <?php
                                foreach ($accounts as $row) {
                                    $cid = $row['id'];
                                    $acn = $row['acn'];
                                    $holder = $row['holder'];
                                    echo "<option value='$cid'>$acn - $holder</option>";
                                }
                                ?>
                            </select>


                        </div>
                    </div>


                    <div class="form-group row">

                        <label class="col-sm-3 control-label"
                               for="sdate"><?php echo $this->lang->line('From Date') ?></label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control required"
                                   placeholder="Start Date" name="sdate" id="sdate"
                                   data-toggle="datepicker" autocomplete="false">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-3 control-label"
                               for="edate"><?php echo $this->lang->line('To Date') ?></label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control required"
                                   placeholder="End Date" name="edate"
                                   data-toggle="datepicker" autocomplete="false">
                        </div>
                    </div>


                    <div class="form-group row">

                        <label class="col-sm-3 col-form-label"></label>

                        <div class="col-sm-4">
                            <input type="hidden" name="check" value="ok">
                            <input type="submit" id="calculate_income" class="btn btn-success margin-bottom"
                                   value="<?php echo $this->lang->line('Calculate') ?>"
                                   data-loading-text="Calculating...">
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-2"><?php echo $this->lang->line('Invoice Date') ?></div>
                <div class="col-md-2">
                    <input type="text" name="start_date" id="start_date"
                           class="date30 form-control form-control-sm" autocomplete="off"/>
                </div>
                <div class="col-md-2">
                    <input type="text" name="end_date" id="end_date" class="form-control form-control-sm"
                           data-toggle="datepicker" autocomplete="off"/>
                </div>

                <div class="col-md-2">
                    <input type="button" name="search" id="search" value="Search" class="btn btn-info btn-sm"/>
                </div>

            </div>
            <hr>
            <table id="invoices" class="table table-striped table-bordered  dataex-res-constructor">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('No') ?></th>
                    <th> #</th>
                    <th><?php echo "Product" ?></th>
                    <th><?php echo $this->lang->line('Customer') ?></th>
                    <th><?php echo $this->lang->line('Date') ?></th>
                    <th><?php echo "Payment Method" ?></th>
                    <th><?php echo "Selling Price" ?></th>
                    <th><?php echo "Supplier Price" ?></th>
                    <th><?php echo $this->lang->line('Amount') ?></th>
                    <th><?php echo $this->lang->line('Status') ?></th>
                    <th style="display:none"><?php echo "Referral Number/Rekening Number" ?></th>
                    <th style="display:none"><?php echo "Notes" ?></th>
                    <th class="no-sort"><?php echo $this->lang->line('Settings') ?></th>


                </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                <tr>
                    <th><?php echo $this->lang->line('No') ?></th>
                    <th> #</th>
                    <th><?php echo "Product" ?></th>
                    <th><?php echo $this->lang->line('Customer') ?></th>
                    <th><?php echo $this->lang->line('Date') ?></th>
                    <th><?php echo "Payment Method" ?></th>
                    <th><?php echo "Selling Price" ?></th>
                    <th><?php echo "Supplier Price" ?></th>
                    <th><?php echo $this->lang->line('Amount') ?></th>
                    <th><?php echo $this->lang->line('Status') ?></th>
                    <th style="display:none"><?php echo "Referral Number/Rekening Number" ?></th>
                    <th style="display:none"><?php echo "Notes" ?></th>
                    <th class="no-sort"><?php echo $this->lang->line('Settings') ?></th>

                </tr>
                </tfoot>
            </table>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            draw_data();

            function draw_data(start_date = '', end_date = '') {
                $('#invoices').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'stateSave': true,
                    responsive: true,
                    <?php datatable_lang();?>
                    'order': [],
                    'ajax': {
                        'url': "<?php echo site_url('pos_invoices/ajax_list')?>",
                        'type': 'POST',
                        'data': {
                            '<?=$this->security->get_csrf_token_name()?>': crsf_hash,
                            start_date: start_date,
                            end_date: end_date
                        }
                    },
                    'columnDefs': [
                        {
                            'targets': [0],
                            'orderable': false,
                        },
                    ],
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            footer: true,
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5,6,7,8,9,10,11]
                            }
                        }
                    ],
                });
            }

            $('#search').click(function () {
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                if (start_date != '' && end_date != '') {
                    $('#invoices').DataTable().destroy();
                    draw_data(start_date, end_date);
                } else {
                    alert("Date range is Required");
                }
            });
        });
    </script>
