<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- boxicons -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="facture.css" />
    <title>stock</title>
  </head>
  <body>
      <header>
        <a href="../../dashbord/dash.php"><button>BACK</button></a>
        <h1>G_Facture</h1>
        <div style="opacity: 0"><button>Next</button></div>
      </header>

      <section class="add">

        <a href="../creat_facture.php">
        <button style="width: 350px">Creat Bill</button>
        </a>
        
      </section>

      <section class="clients">
        <div class="head">
        <h2>Bills History</h2>
        </div>
        <table>
          <thead>
            <td>Num facture</td>
            <td>Client</td>
            <td>Total</td>
            <td>Date</td>
            <td>Delete</td>
            <td>View</td>
          </thead>
          <tbody>

            <?php
              include '../../actions/connexion.php';
              $sql="SELECT invoice.id_invoice, invoice.total, invoice.invoice_date, clients.name FROM invoice, clients WHERE clients.id = invoice.client_id";
              $result=mysqli_query($conn, $sql);

              if ($result) {
                while($row=mysqli_fetch_assoc($result)){                  
                  $id=$row['id_invoice']; 
                  $client = $row['name']; 
                  $total = $row['total']; 
                  $date = $row['invoice_date']; 
                  
                      ?>  

              <tr>

                <td><?php echo $id ?></td>

                <td><?php echo $client ?></td>
                <td><?php echo $total ?></td>
                <td><?php echo $date ?></td>
                <!-- <td class="edit">
                <a href="./update facture/update_facture.php?id=<?php echo $id ?>">
                  <i class="bx bx-edit"></i>
                </a>
                </td> -->
                <td class="delete">
                  <a class="del" href="../../actions/delete_bill.php?id=<?php echo $id ?>">
                    <i class="bx bx-trash"></i>
                  </a>
                </td>

                <td class="view" stye="font-size:60px">
                  <a href="view.php?id=<?php echo $id ?>">
                  <i class="bx bx-show" ></i>
                  </a>
                </td>

              </tr>
          <?php }
         } ?> 
          </tbody>


        </table>
      </section>


    <script>


      // confirmation

       del = document.querySelectorAll(".del");
       del.forEach((item) =>{
          item.addEventListener("click", function(e) {
            e.preventDefault();
            const href = this.getAttribute("href");
            swal({
              text : "Are You Sure",
              icon : "warning",
              buttons : true,
              dangerMode : true,

            }).then((result) => {
              console.log(result);
              if (result) {

                setTimeout(() => {document.location.href = href} ,700);
                swal("Invoice Deleted Succefully", {
                icon: "success",
                buttons : false,
                });
              }
            });
       

          });

        });

    </script>
    <script src="../../sweetalert.min.js"></script>
  </body>
</html>