<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Invoice #<?php echo $invoice['tid'] ?></title>
    <style>
        body {
            color: #2B2000;
            font-family: 'Helvetica';
            background-image:url(<?php
            echo FCPATH . 'userfiles/pos_temp/background_new.png' ?> );
            background-repeat: no-repeat;
  background-size: contain, cover;
        }

        .invoice-box {
            width: 210mm;
            height: 297mm;
            margin: auto;
            padding: 4mm;
            border: 0;
            font-size: 12pt;
            line-height: 14pt;
            color: #000;
        }

        table {
            width: 100%;
            line-height: 16pt;
            text-align: left;
            border-collapse: collapse;
        }

        .plist tr td {
            line-height: 12pt;
        }

        .subtotal {
            page-break-inside: avoid;
        }

        .subtotal tr td {
            line-height: 10pt;
            padding: 6pt;
        }

        .subtotal tr td {
            border: 0px solid #fff;
        }

        .sign {
            text-align: right;
            font-size: 10pt;
            margin-right: 110pt;
        }

        .sign1 {
            text-align: right;
            font-size: 10pt;
            margin-right: 90pt;
        }

        .sign2 {
            text-align: right;
            font-size: 10pt;
            margin-right: 115pt;
        }

        .sign3 {
            text-align: right;
            font-size: 10pt;
            margin-right: 115pt;
        }

        .terms {
            font-size: 9pt;
            line-height: 16pt;
            margin-right: 20pt;
        }

        .invoice-box table td {
            padding: 10pt 4pt 8pt 4pt;
            vertical-align: top;
        }

        .invoice-box table.top_sum td {
            padding: 0;
            font-size: 12pt;
        }

        .party tr td:nth-child(3) {
            text-align: center;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20pt;
        }

        table tr.top table td.title {
            font-size: 45pt;
            line-height: 45pt;
            color: #555;
        }

        table tr.information table td {
            padding-bottom: 20pt;
        }

        table tr.heading td {
            background: #ff8000;
            color: #000;
            padding: 6pt;
        }

        table tr.details td {
            padding-bottom: 20pt;
        }

        .invoice-box table tr.item td {
            border: 1px solid #ddd;
        }

        table tr.b_class td {
            border-bottom: 1px solid #ddd;
        }

        table tr.b_class.last td {
            border-bottom: none;
        }

        table tr.total td:nth-child(4) {
            border-top: 2px solid #fff;
            font-weight: bold;
        }

        .myco {
            width: 400pt;
        }

        .myco2 {
            width: 200pt;
        }

        .myw {
            width: 300pt;
            font-size: 14pt;
            line-height: 14pt;
        }

        .mfill {
            background-color: #eee;
        }

        .descr {
            font-size: 10pt;
            color: #515151;
        }

        .tax {
            font-size: 10px;
            color: #515151;
        }

        .t_center {
            text-align: right;
        }

        .party {
            border: #ccc 1px solid;

        }

        .top_logo {
            max-height: 180px;
            max-width: 250px;
        <?php if(LTR=='rtl') echo 'margin-left: 200px;' ?>
        }

    </style>
</head>
<body dir="<?= LTR ?>">
<div class="invoice-box">
    <br>
    <table class="">
        <tr>
            <td style="width: fit-content;">
            <div>
                
      
     
            <table class="top_sum" style="width:70%; margin-top:8%">
                <tr>
                    <td colspan="3" style="font-size: 38px;color:#fff">
                    <strong><label>I N V O I C E</label></strong>
                    </td>
                </tr>
                <br><br><br><br>
                <tr>
                    <td style="font-size: small;"><?= $general['title'] ?></td>
                    <td style="font-size: small;"><?= "INV/" . '' . $invoice['tid'] ?></td>
                </tr>
                <tr>
                    <td  style="font-size: small;"><?= "Tanggal"?></td>
                    <td  style="font-size: small;"><?php echo dateformat_invoice($invoice['invoicedate']) ?></td>
                </tr>
                <tr>
                    <td style="font-size: small;"><?php echo "Tanggal Jatuh Tempo"?></td>
                    <td style="font-size: small;"><?php echo dateformat_invoice($invoice['invoiceduedate']) ?></td>
                </tr>
            </table>


        </div>

            </td>

            <td style="width: fit-content; text-align:right; font-size:14px">
            <div>
            <h3 ><img src="<?php $loc = location($invoice['loc']);
            echo FCPATH . 'userfiles/company/' . $loc['logo'] ?>"
                style="max-height:70px;"></h3> 
                <br><br>
               <h3><?php $loc = location($invoice['loc']);
                    echo $loc['cname']; ?></h3> 
                    <h2></h2>
                    <h2></h2>
                    <p for="" style="margin-top:2%">
                    <?php echo
                    $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['region'] . ' ' . $loc['postbox'] . '<br>' . $this->lang->line('Phone') . ': ' . $loc['phone'] . '<br> ';
               
                ?>
                    </p>
              
      </div>
            </td>
        </tr>
    
      
      
    </table>
 
    <br><br><br>
    <table class="plist" cellpadding="0" cellspacing="0">
        <tr class="heading">
            <td>
            <strong>Deskripsi</strong>
            </td>
            <td>
            <strong>Kuantitas</strong>
            </td>
            <td >
            <strong>Harga</strong>
            </td>
            <td style="text-align: center;">
            <strong>Diskon</strong>
            </td>
            <td style="text-align: center;">
            <strong>Jumlah</strong>
            </td>
        </tr>
        <?php
        $fill = true;
        $sub_t = 0;
        $sub_t_col = 3;
        $n = 1;
        foreach ($products as $row) {
            $cols = 4;
            if ($fill == true) {
                $flag = ' mfill';
            } else {
                $flag = '';
            }
            $sub_t += $row['price'] * $row['qty'];

            if ($row['serial']) $row['product_des'] .= ' - ' . $row['serial'];
            echo '<tr class="item' . $flag . '">
                            <td>' . $row['product'] . '</td>
                            <td style="width:14%;text-align: center;" >' . +$row['qty'] . $row['unit'] . '</td>
							<td style="width:20%;">' . amountExchange($row['price'], $invoice['multi'], $invoice['loc']) . '</td>
                              ';
                $cols++;
                echo ' <td style="width:16%;">' . amountExchange($row['totaldiscount'], $invoice['multi'], $invoice['loc']) . '</td>';
            echo '<td class="t_center">' . amountExchange($row['subtotal'], $invoice['multi'], $invoice['loc']) . '</td></tr>';

            if ($row['product_des']) {
                $cc = $cols++;

                echo '<tr class="item' . $flag . ' descr">  <td> </td>
                            <td colspan="' . $cc . '">' . $row['product_des'] . '&nbsp;</td>
							
                        </tr>';
            }
            if (CUSTOM) {
                $p_custom_fields = $this->custom->view_fields_data($row['pid'], 4, 1);

                if (is_array($p_custom_fields[0])) {
                    $z_custom_fields = '';

                    foreach ($p_custom_fields as $row) {
                        $z_custom_fields .= $row['name'] . ': ' . $row['data'] . '<br>';
                    }

                    echo '<tr class="item' . $flag . ' descr">  <td> </td>
                            <td colspan="' . $cc . '">' . $z_custom_fields . '&nbsp;</td>
							
                        </tr>';
                }
            }
            $fill = !$fill;
            $n++;
        }

        if ($invoice['shipping'] > 0) {

            $sub_t_col++;
        }
        if ($invoice['tax'] > 0) {
            $sub_t_col++;
        }
        if ($invoice['discount'] > 0) {
            $sub_t_col++;
        }
        ?>


    </table>
    <br> <?php if (is_array(@$i_custom_fields)) {

        foreach ($i_custom_fields as $row) {
            echo $row['name'] . ': ' . $row['data'] . '<br>';
        }
        echo '<br>';
    }
    ?>
    <table class="subtotal">


        <tr>
            <td class="myco2" rowspan="6" style="width: 50%;">
            <br><br><br>
            <h3 style="color: #ff8000;">Tagihan Kepada</h3> <br>
            <p>
            <?php echo '<strong>' . $invoice['name'] . '</strong><br>';
                if ($invoice['company']) echo $invoice['company'] . '<br>';

                echo $invoice['address'] . '<br>' . $invoice['city'] . ', ' . $invoice['region'];
                if ($invoice['country']) echo '<br>' . $invoice['country'];
                if ($invoice['postbox']) echo ' - ' . $invoice['postbox'];
                if ($invoice['phone']) echo '<br>' . $this->lang->line('Phone') . ': ' . $invoice['phone'];
                if ($invoice['email']) echo '<br> ' . $this->lang->line('Email') . ': ' . $invoice['email'];

                if ($invoice['taxid']) echo '<br>' . $this->lang->line('Tax') . ' ID: ' . $invoice['taxid'];
                if (is_array($c_custom_fields)) {
                    echo '<br>';
                    foreach ($c_custom_fields as $row) {
                        echo $row['name'] . ': ' . $row['data'] . '<br>';
                    }
                }
                ?>
                </p>
            </td>
         
        </tr>
        <tr class="f_summary">
            <td ><?php echo "Subtotal" ?></td>
            <td><?php echo amountExchange($sub_t, $invoice['multi'], $invoice['loc']); ?></td>
        </tr>
        <?php if ($invoice['tax'] > 0) {
            echo '<tr>
            <td> ' . $this->lang->line('Total Tax') . ' :</td>
            <td>' . amountExchange($invoice['tax'], $invoice['multi'], $invoice['loc']) . '</td>
        </tr>';
        }
            echo '<tr>
            <td>Total Diskon</td>
            <td>(' . amountExchange($invoice['discount'], $invoice['multi'], $invoice['loc']) . ')</td>
        </tr>';
        echo '<tr>
        <td>Pembayaran Diterima</td>
        <td>' . amountExchange($invoice['pamnt'], $invoice['multi'], $invoice['loc']) . '</td>
    </tr>';
        ?>
        <tr>
            <td>Sisa Tagihan</td>
            <td><?php $rming = $invoice['total'] - $invoice['pamnt'];
    if ($rming < 0) {
        $rming = 0;
    }
    if (@$round_off['other']) {
        $rming = round($rming, $round_off['active'], constant($round_off['other']));
    }
    echo amountExchange($rming, $invoice['multi'], $invoice['loc']);
    echo '</td>
		</tr>
        <tr style="background:#ff8000">
        <td><strong>Total</strong></td>
        <td><strong>' . amountExchange($invoice['total'] , $invoice['multi'], $invoice['loc']) . '</strong></td>
		</table>';
    ?>
    <br><br><br>
 <table class="">
        <tr>
            <td style="width: fit-content; font-size:small">
            <hr>
            <h2 style="color:#ff8000">Pesan</h2><br>
            <p> <strong>Pembayaran via transfer ke <br> GALUH WISNU PAMBAYUN</strong>
            <br>
            BCA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A/C 433.027.022.1 <br>
            BNI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A/C 045.785.940.6 <br>
            MANDIRI &nbsp;&nbsp;&nbsp;&nbsp; A/C 139.001.655.403.6 <br>
           </p>
            </td>
            <td style="width: fit-content;text-align:center">
            <?php 
            echo '
            <div class="sign"> Hormat Kami</div><div class="sign1"><img src="' . FCPATH . 'userfiles/pos_temp/ttd.png" width="160" height="60" border="0" alt=""></div><div class="sign2">(' . $employee['name'] . ')</div><br>
            ';
            ?>
            </td>
        </tr>
    </table>    
</div>
   
</div>
</body>
</html>