<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Print Invoice #<?php echo $invoice['tid'] ?></title>
    <style>
        html, body {
            padding: 0;
            width:100px;
            margin-top:-50%;
            font-size: 9pt;
            font-family: "Calibri";
            background-color: #fff;
        }



        #header {
            width: 100%;
        }

        #printbox {
            margin-left:10%;

            text-align: justify;
            margin-top:-5%;
        }

        .header_total tr td {
          width:100%;
            font-size: 9pt;
        }

        .product_row {
    width:100%;
      font-size: 9pt;
        }

        .stamp {
            margin: 5pt;
            padding: 3pt;
            border: 3pt solid #111;
            text-align: center;
            font-size: 10pt;
            color
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body dir="<?= LTR ?>">
<h3 id="logo" class="text-center" style="margin-left:13%; margin-top:-15%"><br><img style="max-height:70px;" src='<?php $loc = location($invoice['loc']);
    echo FCPATH . 'userfiles/company/' . $loc['logo'];
    ?>' alt='Logo'></h3>
<div id='printbox' >
  <table id="header" style ="margin-top:-5%">
    <tr>
      <td colspan="6" style="text-align:center; font-size:12pt"><h3><?= $loc['cname'] ?></h3></td>
    </tr>
    <tr>
      <td colspan="6"  style="text-align:center"><label><?= $loc['address'] ?></label></td>
    </tr>
    <tr>
      <td colspan="6"  style="text-align:center"><label><?= $loc['phone'] ?></label></td>
    </tr>
  </table>
<hr style ="margin-top:1%">
    <table class="inv_info" border : 1px style ="margin-top:-3%">
        <?php   if ($loc['taxid']) {      ?> <tr>
            <td style ="margin-top:-3%">No Nota</td>
            <td style ="margin-top:-3%"><?php echo 'ATP #' . $invoice['tid']; ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td>Tanggal / Waktu</td>
            <td><?php 
            $d=strtotime("+7 hour");
            echo dateformat($invoice['invoicedate']) . ' ' . date('H:i:s',$d) ?><br></td>
        </tr>
        <tr>
            <td><?php echo $this->lang->line('Customer') ?></td>
            <td><?php echo $invoice['name']; ?></td>
        </tr>
        <tr>
            <td>Staff</td>
            <td><?php echo $employee['name']; ?></td>
        </tr>

    </table>
    <hr style ="margin-top:1%"></hr>
    <table id="header" style="margin-top:-5%">
      <tr>
      <?php
      if ($invoice['pmethod'] == "Cash") {
      ?>
                <td colspan="7"  style="text-align:center"><label><?php echo 'Store Pick Up'?></label></td>
      <?php } else if ($invoice['pmethod'] == "Bank") {?>
          <td colspan="7"  style="text-align:center"><label><?php echo 'Transfer Bank' ?></label></td>
        <?php } else { ?>
          <td colspan="7"  style="text-align:center"><label><?php echo $invoice['pmethod'];?></label></td>
            <?php }?>
          </tr>
    </table>
    <hr style="margin-top:0%">

  <table style="margin-top:-5%">
    <tr>
        <td style="text-align:center;font-size:9pt">Deskripsi</td>
        <td style="text-align:center;font-size:9pt"><?php echo $this->lang->line('Qty') ?></td>
        <td style="text-align:center;font-size:9pt">Harga</td>
        <td  style="text-align:center;font-size:9pt">Total Harga</td>
    </tr>
    <tr>
        <td colspan="7">
            <hr style ="margin-top:-1%;margin-bottom:1%">
        </td>
    </tr>
        <?php
        $this->pheight = 0;
        $totalItem = 0;
        foreach ($products as $row) {
            $this->pheight = $this->pheight + 8;
            $totalItem =  $row['qty'] + $totalItem;
            echo '<tr style="margin-top:-2%">
            <td style="font-size:9pt;style="margin-top:-5%"">' . $row['product'] . '</td>
             <td  style="text-align:center;font-size:9pt;style="margin-top:-5%"">' . +$row['qty'] . ' ' . $row['unit'] . '</td>
               <td style="text-align:center;font-size:9pt;style="margin-top:-5%"">' .amountExchange_new($row['price'], $invoice['multi'], $invoice['loc']) . '</td>
            <td style="text-align:center;font-size:9pt;style="margin-top:-5%"">' . amountExchange_new($row['subtotal'], $invoice['multi'], $invoice['loc']) . '</td>
        </tr>';
        } ?>
    </table>
    <hr style ="margin-top:1%">
    <table class="header_total" style ="margin-top:-5%">
        <?php if ($invoice['taxstatus'] == 'cgst') {
            $gst = $row['totaltax'] / 2;
            $rate = $row['tax'] / 2;
            ?>
            <tr>
                <td><b><?php echo $this->lang->line('CGST') ?></b></td>
                <td><b><?php echo amountExchange($gst, $invoice['multi'], $invoice['loc']) ?></b> (<?= $rate ?>%)</td>
            </tr>
            <tr>
                <td><b><?php echo $this->lang->line('SGST') ?></b></td>
                <td><b><?php echo amountExchange($gst, $invoice['multi'], $invoice['loc']) ?></b> (<?= $rate ?>%)</td>
            </tr>
        <?php } else if ($invoice['taxstatus'] == 'igst') {
            ?>
            <tr>
                <td><b><?php echo $this->lang->line('IGST') ?></b></td>
                <td><b><?php echo amountExchange($invoice['tax'], $invoice['multi']) ?></b>
                    (<?= amountFormat_general($row['tax']) ?>%)
                </td>
            </tr>
        <?php } ?>
        <tr style ="margin-top:-10%">
            <td style ="margin-top:-5%">Subtotal</td>
            <td style ="margin-top:-5%"><?php echo amountExchange_new($invoice['subtotal'], $invoice['multi'], $invoice['loc']) ?></td>
        </tr>
        <tr>
            <td>Diskon</td>
            <td><?php echo amountExchange_new($invoice['discount'], $invoice['multi'], $invoice['loc']) ?></td>
        </tr>
        <tr>
            <td><?php echo $this->lang->line('Total') ?></td>
            <td><?php echo amountExchange_new($invoice['total'], $invoice['multi'], $invoice['loc']) ?></td>
        </tr>
        <?php
        if ($invoice['pmethod'] == "Cash") {
        ?>
        <tr>
            <td>Tunai</td>
            <td><?php echo amountExchange_new($invoice['amount'], $invoice['multi'], $invoice['loc']) ?></td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td><?php echo amountExchange_new($invoice['change_amount'], $invoice['multi'], $invoice['loc']) ?></td>
        </tr>
      <?php }?>

      <?php
        if ($invoice['total'] !=$invoice['amount']) {
        ?>
        <tr>
            <td>Tagihan</td>
            <td><?php echo amountExchange_new($invoice['amount']-$invoice['total'], $invoice['multi'], $invoice['loc']) ?></td>
        </tr>
      <?php }?>
  </table>
  <hr style ="margin-top:0%">
    <div style ="margin-top:-3%">
      <?php
      if ($invoice['notes_invoice'] == "") {
      ?>
      <?php } else {?>
        <td colspan="3">
            <label for="" style="font-size:16px">Catatan :</label> <br>
            <label style="margin-top:2%;margin-bottom:5%"><?php echo $invoice['notes_invoice'];?></label>
        </td>
      <?php }?>

  </div>
  <hr style ="margin-top:2%">
    <div class="text-center" style ="margin-top:-3%">  <strong>HEMAT SPESIAL : <?php echo amountExchange_not_point($invoice['discount'], $invoice['multi'], $invoice['loc']) ?></strong>
  </div>
  <hr style ="margin-top:1%">
  <div class="text-center" style ="margin-top:-4%">    <strong>Item: <?php echo intval($invoice['items']); ?></strong></div>
  <?php
      if ($round_off['other']) {
          $final_amount = round($invoice['total'], $round_off['active'], constant($round_off['other']));
          ?>
          <div><?php echo $this->lang->line('Total') ?>(<?php echo $this->lang->line('Round Off') ?>)</div>
          <div class="text-center"><?php echo amountExchange($final_amount, $invoice['multi'], $invoice['loc']) ?>)</div>
          <?php
      }
      ?>


    <hr style ="margin-top:0%">
    <div class="text-center" style ="margin-top:-4%">TERIMAKASIH ATAS KUNJUNGANNYA</div>
</div>
</body>
</html>
