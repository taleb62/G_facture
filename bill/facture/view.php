<?php

include "../../conn.php";
$id = $_GET['id'];

$sql = "SELECT invoice.id_invoice, invoice.total, invoice.invoice_date, customer.customer_name, customer.address FROM invoice, customer WHERE customer.customer_id = invoice.customer_id AND id_invoice=$id";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$sql2 = "SELECT * FROM invoice_products WHERE id='$id'";
$res = mysqli_query($conn, $sql2);


?>



<!DOCTYPE html>
<html>

<head>
  <title>Invoice Template Design</title>
  <link rel="stylesheet" type="text/css" href="view.css">
  <style>
    @media print {
      .print {
        visibility: hidden;
      }

      .wrapper {
        width: 700px;
        margin-right: 90px;
      }
    }
  </style>
</head>

<body>


  <div>
    <button onclick="window.print()" class="print">print</button>
  </div>

  <div class="wrapper">
    <div class="invoice_wrapper">
      <div class="header">
        <div class="logo_invoice_wrap">
          <div class="logo_sec">

          </div>
          <div class="invoice_sec">
            <p class="invoice bold">G_Facture</p>
            <p class="invoice_no">
              <span class="bold">Invoice</span>
              <span><?= $row['id_invoice']; ?></span>
            </p>
            <p class="date">
              <span class="bold">Date</span>
              <span><?= $row['invoice_date']; ?></span>
            </p>
          </div>
        </div>
        <div class="bill_total_wrap">
          <div class="bill_sec">
            <p>A été vendu a</p>
            <p class="bold name"><?= $row['customer_name']; ?></p>
            <span>
              <?= $row['address']; ?>
            </span>
          </div>

        </div>
      </div>
      <div class="body">
        <div class="main_table">
          <div class="table_header">
            <div class="row">
              <div class="col col_no">NO. </div>
              <div class="col col_des"> ITEM NAME</div>
              <div class="col col_price">PRICE</div>
              <div class="col col_qty">QTY</div>
              <div class="col col_total">TOTAL</div>
            </div>
          </div>
          <div class="table_body">

            <!-- list of products -->

            <?php
            while ($row = mysqli_fetch_assoc($res)) {


            ?>
              <div class="row">
                <div class="col col_no">
                  <p><?= $row['id_product'] ?></p>
                </div>
                <div class="col col_des">
                  <p class="bold"></p>
                  <p><?= $row['name']; ?></p>
                </div>
                <div class="col col_price">
                  <p><?= $row['price_of_unit'] ?></p>
                </div>
                <div class="col col_qty">
                  <p><?= $row['qnt']; ?></p>
                </div>
                <div class="col col_total">
                  <p class="total"><?= $row['total_price'] ?></p>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
        <div class="paymethod_grandtotal_wrap">
          <div class="paymethod_sec">
            <p class="bold">Payment Method</p>
            <p>Visa, master Card and We accept Cheque</p>
          </div>
          <div class="grandtotal_sec">
            <p class="bold">
              <span>Grand Total</span>
              <span id="grand_total"></span>
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
    let grand_total = document.querySelector("#grand_total");
    let total = document.querySelectorAll(".total");

    let addtotal = 0;

    total.forEach((ele) => addtotal += +(ele.textContent));
    grand_total.innerHTML = `${addtotal} N-UM`;
  </script>
</body>

</html>