<h5><?php echo $product['product_name'] . ' (' . $product['title'] . ')'; ?></h5>

<table class="table">
    <?php echo '<tr><td>' . $product['product_name'] . '</td><td>Code : ' . $product['product_code'] . '</td><td> ' . $this->lang->line('Stock') . ' : ' . $product['qty'] . '<br><br><a href="' . base_url() . 'products/edit?id=' . $product['pid'] . '" class="btn btn-primary btn-sm"><span class="icon-pencil"></span> ' . $this->lang->line('Edit') . '</a>  <div class="btn-group">
                                    <button type="button" class="btn btn-blue dropdown-toggle   btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-print"></i>  ' . $this->lang->line('Print') . '                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="' . base_url() . 'products/barcode?id=' . $product['pid'] . '" target="_blank"> ' . $this->lang->line('BarCode') . '</a>

                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item" href="' . base_url() . 'products/posbarcode?id=' . $product['pid'] . '" target="_blank"> ' . $this->lang->line('BarCode') . ' - Compact</a>
                                          <div class="dropdown-divider"></div>
                                             <a class="dropdown-item" href="' . base_url() . 'products/label?id=' . $product['pid'] . '" target="_blank"> ' . $this->lang->line('Product') . ' Label</a>

                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item" href="' . base_url() . 'products/poslabel?id=' . $product['pid'] . '" target="_blank"> Label - Compact</a>

                                    </div>
                                </div>   <a class="btn btn-pink  btn-sm" href="' . base_url() . 'products/report_product?id=' . $product['pid'] . '" target="_blank"> <span class="icon-pie-chart2"></span> ' . $this->lang->line('Sales') . '</a> </td></tr>'; ?>
</table>

<h5>Data Pembelian</h5>

            <form id="chart_custom" style="margin-top:2%">
                    <div id="custom_c">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput"><?php echo $this->lang->line('From Date') ?></label>
                                    <input type="date" class="form-control required date30"
                                           placeholder="Start Date" name="sdate"
                                           data-toggle="datepicker" autocomplete="false">
                                </fieldset>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="helpInputTop"><?php echo $this->lang->line('To Date') ?></label>
                                    <input type="date" class="form-control required"
                                           placeholder="End Date" name="edate"
                                           data-toggle="datepicker" autocomplete="false">
                                </fieldset>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12 mb-1" style="margin-top: 1%;"><span class="mt-2"><br></span>
                                <fieldset class="form-group">
                                    <input type="hidden" name="p"
                                           value="custom">
                                    <button type="button" id="custom_update_chart"
                                            class="btn btn-blue-grey">Apply
                                    </button>
                                </fieldset>
                            </div>

                        </div>

                    </div>
                </form>
<table id="productstable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
       width="100%">
    <thead>
    <tr>
        <th>No</th>
        <th>Customer Name</th>
        <th>Purchase Date</th>
        <th>Payment Method</th>
        <th>Qty</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
      <?php
        $no = $this->input->post( 'start' );
      foreach ($purchase_list as $row) {
        $no++;
          echo '<tr>
          <td>' . $no . '</td>
           <td>' .$row['name'] .'</td>
             <td>' .$row['invoicedate'] . '</td>
          <td>' . $row['pmethod'] . '</td>
          <td>' . $row['qty'] . '</td>';
          if ($row['status'] == "paid") {
            echo '<td>Paid</td></tr>';
          } else if ($row['status'] == "partial") {
              echo '<td>Partial</td></tr>';
          }else if ($row['status'] == "due") {
              echo '<td>Due</td></tr>';
          } else {
              echo '<td>Cancel</td></tr>';
          }
      } ?>
    </tbody>

    <tfoot>
    <tr>
        <th>No</th>
        <th>Customer Name</th>
        <th>Purchase Date</th>
        <th>Payment Method</th>
        <th>Qty</th>
        <th>Status</th>
    </tr>
    </tfoot>
</table>

<h5>Data Supplier</h5>

<table id="productstable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
       width="100%">
    <thead>
    <tr>
        <th>No</th>
        <th>Supplier Name</th>
        <th>Stock Quantity</th>
          <th>Order Date</th>
    </tr>
    </thead>
    <tbody>
      <?php
        $no = $this->input->post( 'start' );
      foreach ($supplier as $row) {
        $no++;
         $newDate = date("d F Y", strtotime($row['invoicedate']));
          echo '<tr>
          <td>' . $no . '</td>
           <td>' .$row['name'] .'</td>
             <td>' .$row['qty'] . '</td>
                <td>' .$newDate . '</td>
      </tr>';
      } ?>
    </tbody>

    <tfoot>
    <tr>
      <th>No</th>
      <th>Supplier Name</th>
      <th>Stock Quantity</th>
      <th>Order Date</th>
    </tr>
    </tfoot>
</table>

<?php if ($product_variations) {

    echo '<h6>' . $this->lang->line('Products') . ' ' . $this->lang->line('Variations') . '</h6>';
    ?>

    <table class="table table-striped table-bordered">
        <?php
        foreach ($product_variations as $product_variation) {
            echo '<tr><td><a href="' . base_url() . 'products/edit?id=' . $product_variation['pid'] . '" class="btn btn-primary btn-sm"><span class="icon-pencil"></span> ' . $this->lang->line('Edit') . '</a>  <div class="btn-group">
                                    <button type="button" class="btn btn-blue dropdown-toggle   btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-print"></i>  ' . $this->lang->line('Print') . '                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="' . base_url() . 'products/barcode?id=' . $product_variation['pid'] . '" target="_blank"> ' . $this->lang->line('BarCode') . '</a>

                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item" href="' . base_url() . 'products/posbarcode?id=' . $product_variation['pid'] . '" target="_blank"> ' . $this->lang->line('BarCode') . ' - Compact</a>
                                          <div class="dropdown-divider"></div>
                                             <a class="dropdown-item" href="' . base_url() . 'products/label?id=' . $product_variation['pid'] . '" target="_blank"> ' . $this->lang->line('Product') . ' Label</a>

                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item" href="' . base_url() . 'products/poslabel?id=' . $product_variation['pid'] . '" target="_blank"> Label - Compact</a>

                                    </div>
                                </div>   <a class="btn btn-pink  btn-sm" href="' . base_url() . 'products/report_product?id=' . $product_variation['pid'] . '" target="_blank"> <span class="icon-pie-chart2"></span> ' . $this->lang->line('Sales') . '</a>  ' . $product_variation['product_name'] . '</td><td>Code : ' . $product_variation['product_code'] . '</td><td> ' . $this->lang->line('Stock') . ' : ' . $product_variation['qty'] . ' </td></tr>';
        } ?>
    </table>
<?php } ?>

<?php if ($product_warehouse) {
    echo '<h6> ' . $this->lang->line('Warehouse') . '</h6>';
    ?>
    <table class="table table-striped table-bordered">
        <?php
        foreach ($product_warehouse as $product_variation) {
            echo '<tr><td><a href="' . base_url() . 'products/edit?id=' . $product_variation['pid'] . '" class="btn btn-primary btn-sm"><span class="icon-pencil"></span> ' . $this->lang->line('Edit') . '</a> <div class="btn-group">
                                    <button type="button" class="btn btn-blue dropdown-toggle   btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-print"></i>  ' . $this->lang->line('Print') . '                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="' . base_url() . 'products/barcode?id=' . $product_variation['pid'] . '" target="_blank"> ' . $this->lang->line('BarCode') . '</a>

                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item" href="' . base_url() . 'products/posbarcode?id=' . $product_variation['pid'] . '" target="_blank"> ' . $this->lang->line('BarCode') . ' - Compact</a>
                                          <div class="dropdown-divider"></div>
                                             <a class="dropdown-item" href="' . base_url() . 'products/label?id=' . $product_variation['pid'] . '" target="_blank"> ' . $this->lang->line('Product') . ' Label</a>

                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item" href="' . base_url() . 'products/poslabel?id=' . $product_variation['pid'] . '" target="_blank"> Label - Compact</a>

                                    </div>
                                </div>   <a class="btn btn-pink  btn-sm" href="' . base_url() . 'products/report_product?id=' . $product_variation['pid'] . '" target="_blank"> <span class="icon-pie-chart2"></span> ' . $this->lang->line('Sales') . '</a> ' . $product_variation['product_name'] . '</td><td>Code : ' . $product_variation['product_code'] . '</td><td>' . $product_variation['title'] . '</td><td> ' . $this->lang->line('Stock') . ' : ' . $product_variation['qty'] . '  </td></tr>';
        } ?>
    </table>
<?php } ?>
<hr>


<script type="text/javascript">
     
        $(document).on('click', "#custom_update_chart", function (e) {
            e.preventDefault();
            $.ajax({
                url: baseurl + 'products/view_over',
                dataType: 'json',
                method: 'POST',
                data: $('#chart_custom').serialize() + '&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash(); ?>',
                success: function (data) {
                    draw_c(data);
                }
            });

        });

    </script>
