<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="POS - Bootstrap Admin Template">
  <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
  <meta name="author" content="Dreamguys - Bootstrap Admin Template">
  <meta name="robots" content="noindex, nofollow">
  <title>Dreams Pos admin template</title>

  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <link rel="stylesheet" href="assets/css/animate.css">

  <link rel="stylesheet" href="assets/plugins/owlcarousel/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/plugins/owlcarousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/st.css">
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

  <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

  <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div id="global-loader">
    <div class="whirly-loader"> </div>
  </div>
  <div class="main-wrappers">
    <?php include "includes/header.php"; ?>
    <div class="page-wrapper ms-0">
      <div class="content">
        <div class="row">
          <div class="col-lg-8 col-sm-12 tabs_wrapper">
            <div class="page-header ">
              <div class="page-title">
                <h4>Categories</h4>
                <h6>Manage your purchases</h6>
              </div>
            </div>
            <ul class="tabs owl-carousel owl-theme owl-product border-0">
    <?php
    // Inclure le fichier de connexion à la base de données
    require "conn.php";

    // Requête SQL pour sélectionner les catégories
    $sql = "SELECT `id`, `category_photo`, `category_name`, `category_code` FROM `category` WHERE 1";

    // Exécuter la requête SQL
    $result = $conn->query($sql);

    // Vérifier si des données ont été trouvées
    if ($result->num_rows > 0) {
        // Afficher les catégories dans la liste
        while ($row = $result->fetch_assoc()) {
            echo "<li id='" . $row["category_code"] . "'>";
            echo "<div class='product-details'>";
            echo "<img src='" . $row["category_photo"] . "' alt='img'>";
            echo "<h6 class='category-item' data-category-id='" . $row["id"] . "'>" . $row["category_name"] . "</h6>";
            echo "</div>";
            echo "</li>";
        }
    } else {
        // Aucune catégorie trouvée
        echo "<li><div class='product-details'>Aucune catégorie trouvée</div></li>";
    }

    // Fermer la connexion à la base de données
    $conn->close();
    ?>
</ul>

<div class="tabs_container">
    <div class="tab_content active" data-tab="fruits">
        <div class="row" id="product-list">
            <?php
            // Inclure le fichier de connexion à la base de données
            require "conn.php";

            // Requête SQL pour sélectionner tous les produits par défaut
            $sql = "SELECT `id`, `photo`, `product_name`, `price` FROM `product`";

            // Si un ID de catégorie est fourni, filtrer les produits par catégorie
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
                $sql = "SELECT `id`, `photo`, `product_name`, `price` FROM `product` WHERE `category_id` = $category_id";
            }

            // Exécuter la requête SQL
            if ($result = $conn->query($sql)) {
                // Vérifier si des produits ont été trouvés
                if ($result->num_rows > 0) {
                    // Afficher chaque produit dans un élément de liste
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-lg-3 col-sm-6 d-flex'>";
                        echo "<div class='productset flex-fill active'>";
                        echo "<div class='productsetimg'>";
                        echo "<img src='" . htmlspecialchars($row["photo"]) . "' alt='img'>";
                        echo "<h6>Qty: 5.00</h6>"; // Vous devrez remplacer cela par la quantité réelle du produit si elle est disponible dans votre base de données
                        echo "<div class='check-product'>";
                        echo "<i class='fa fa-check'></i>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='productsetcontent'>";
                        echo "<h5>" . htmlspecialchars($row["product_name"]) . "</h5>";
                        echo "<h4>" . htmlspecialchars($row["price"]) . "</h4>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    // Aucun produit trouvé
                    echo "<div class='col'><div class='productset'><p>Aucun produit trouvé</p></div></div>";
                }

                // Libérer le résultat de la mémoire
                $result->free();
            } else {
                echo "<div class='col'><div class='productset'><p>Erreur de requête: " . $conn->error . "</p></div></div>";
            }

            // Fermer la connexion à la base de données
            $conn->close();
            ?>
        </div>
    </div>
</div>

          </div>
          <div class="col-lg-4 col-sm-12 ">
            <div class="order-list">
              <div class="orderid">
                <h4>Order List</h4>
                <h5>Transaction id : #65565</h5>
              </div>
              <div class="actionproducts">
                <ul>
                  <li>
                    <a href="javascript:void(0);" class="deletebg confirm-text"><img src="assets/img/icons/delete-2.svg" alt="img"></a>
                  </li>
                  <li>
                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                      <img src="assets/img/icons/ellipise1.svg" alt="img">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" data-popper-placement="bottom-end">
                      <li>
                        <a href="#" class="dropdown-item">Action</a>
                      </li>
                      <li>
                        <a href="#" class="dropdown-item">Another Action</a>
                      </li>
                      <li>
                        <a href="#" class="dropdown-item">Something Elses</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
// Inclure le fichier de connexion à la base de données
 <?php
  require "conn.php";

// Requête SQL pour sélectionner les clients
$sql2 = "SELECT `customer_id`, `customer_name` FROM `customer` WHERE 1";

// Exécuter la requête SQL
$result2 = $conn->query($sql2);

// Tableau pour stocker les clients récupérés
$customers = [];

// Vérifier si des données ont été trouvées
if ($result2 && $result2->num_rows > 0) {
    // Parcourir les résultats et stocker les clients dans le tableau
    while ($row = $result2->fetch_assoc()) {
        $customers[] = $row;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<div class="card card-order">
    <div class="card-body">
        <div class="col-lg-12">
            <div class="select-split">
                <div class="select-group w-100">
                    <select class="select">
                        <option>Sélectionner un client</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?= $customer["customer_id"] ?>"><?= $customer["customer_name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12"></div>
    </div>
</div>

              <div class="split-card">
              </div>
              <div class="card-body pt-0">
                <div class="totalitem">
                  <h4>Total items : 4</h4>
                  <a href="javascript:void(0);">Clear all</a>
                </div>
                <div class="product-table">
                  <ul class="product-lists">
                    <li>
                      <div class="productimg">
                        <div class="productimgs">
                          <img src="assets/img/product/product30.jpg" alt="img">
                        </div>
                        <div class="productcontet">
                          <h4>Pineapple
                            <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><img src="assets/img/icons/edit-5.svg" alt="img"></a>
                          </h4>
                          <div class="productlinkset">
                            <h5>PT001</h5>
                          </div>
                          <div class="increment-decrement">
                            <div class="input-groups">
                              <input type="button" value="-" class="button-minus dec button">
                              <input type="text" name="child" value="0" class="quantity-field">
                              <input type="button" value="+" class="button-plus inc button ">
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>3000.00 </li>
                    <li><a class="confirm-text" href="javascript:void(0);"><img src="assets/img/icons/delete-2.svg" alt="img"></a></li>
                  </ul>
                  <ul class="product-lists">
                    <li>
                      <div class="productimg">
                        <div class="productimgs">
                          <img src="assets/img/product/product34.jpg" alt="img">
                        </div>
                        <div class="productcontet">
                          <h4>Green Nike
                            <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><img src="assets/img/icons/edit-5.svg" alt="img"></a>
                          </h4>
                          <div class="productlinkset">
                            <h5>PT001</h5>
                          </div>
                          <div class="increment-decrement">
                            <div class="input-groups">
                              <input type="button" value="-" class="button-minus dec button">
                              <input type="text" name="child" value="0" class="quantity-field">
                              <input type="button" value="+" class="button-plus inc button ">
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>3000.00 </li>
                    <li><a class="confirm-text" href="javascript:void(0);"><img src="assets/img/icons/delete-2.svg" alt="img"></a></li>
                  </ul>
                  <ul class="product-lists">
                    <li>
                      <div class="productimg">
                        <div class="productimgs">
                          <img src="assets/img/product/product35.jpg" alt="img">
                        </div>
                        <div class="productcontet">
                          <h4>Banana
                            <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><img src="assets/img/icons/edit-5.svg" alt="img"></a>
                          </h4>
                          <div class="productlinkset">
                            <h5>PT001</h5>
                          </div>
                          <div class="increment-decrement">
                            <div class="input-groups">
                              <input type="button" value="-" class="button-minus dec button">
                              <input type="text" name="child" value="0" class="quantity-field">
                              <input type="button" value="+" class="button-plus inc button ">
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>3000.00 </li>
                    <li><a class="confirm-text" href="javascript:void(0);"><img src="assets/img/icons/delete-2.svg" alt="img"></a></li>
                  </ul>
                  <ul class="product-lists">
                    <li>
                      <div class="productimg">
                        <div class="productimgs">
                          <img src="assets/img/product/product31.jpg" alt="img">
                        </div>
                        <div class="productcontet">
                          <h4>Strawberry
                            <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><img src="assets/img/icons/edit-5.svg" alt="img"></a>
                          </h4>
                          <div class="productlinkset">
                            <h5>PT001</h5>
                          </div>
                          <div class="increment-decrement">
                            <div class="input-groups">
                              <input type="button" value="-" class="button-minus dec button">
                              <input type="text" name="child" value="0" class="quantity-field">
                              <input type="button" value="+" class="button-plus inc button ">
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>3000.00 </li>
                    <li><a class="confirm-text" href="javascript:void(0);"><img src="assets/img/icons/delete-2.svg" alt="img"></a></li>
                  </ul>
                </div>
              </div>
              <div class="split-card">
              </div>
              <div class="card-body pt-0 pb-2">
                <div class="setvalue">
                  <ul>
                    <li>
                      <h5>Subtotal </h5>
                      <h6>55.00$</h6>
                    </li>
                    <li>
                      <h5>Tax </h5>
                      <h6>5.00$</h6>
                    </li>
                    <li class="total-value">
                      <h5>Total </h5>
                      <h6>60.00$</h6>
                    </li>
                  </ul>
                </div>
              
                <div class="btn-totallabel">
                  <h5>Checkout</h5>
                  <h6>60.00$</h6>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="calculator" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Define Quantity</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="calculator-set">
            <div class="calculatortotal">
              <h4>0</h4>
            </div>
            <ul>
              <li>
                <a href="javascript:void(0);">1</a>
              </li>
              <li>
                <a href="javascript:void(0);">2</a>
              </li>
              <li>
                <a href="javascript:void(0);">3</a>
              </li>
              <li>
                <a href="javascript:void(0);">4</a>
              </li>
              <li>
                <a href="javascript:void(0);">5</a>
              </li>
              <li>
                <a href="javascript:void(0);">6</a>
              </li>
              <li>
                <a href="javascript:void(0);">7</a>
              </li>
              <li>
                <a href="javascript:void(0);">8</a>
              </li>
              <li>
                <a href="javascript:void(0);">9</a>
              </li>
              <li>
                <a href="javascript:void(0);" class="btn btn-closes"><img src="assets/img/icons/close-circle.svg" alt="img"></a>
              </li>
              <li>
                <a href="javascript:void(0);">0</a>
              </li>
              <li>
                <a href="javascript:void(0);" class="btn btn-reverse"><img src="assets/img/icons/reverse.svg" alt="img"></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="holdsales" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hold order</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="hold-order">
            <h2>4500.00</h2>
          </div>
          <div class="form-group">
            <label>Order Reference</label>
            <input type="text">
          </div>
          <div class="para-set">
            <p>The current order will be set on hold. You can retreive this order from the pending order button. Providing a reference to it might help you to identify the order more quickly.</p>
          </div>
          <div class="col-lg-12">
            <a class="btn btn-submit me-2">Submit</a>
            <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Order</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Product Price</label>
                <input type="text" value="20">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Product Price</label>
                <select class="select">
                  <option>Exclusive</option>
                  <option>Inclusive</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label> Tax</label>
                <div class="input-group">
                  <input type="text">
                  <a class="scanner-set input-group-text">
                    %
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Discount Type</label>
                <select class="select">
                  <option>Fixed</option>
                  <option>Percentage</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Discount</label>
                <input type="text" value="20">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Sales Unit</label>
                <select class="select">
                  <option>Kilogram</option>
                  <option>Grams</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <a class="btn btn-submit me-2">Submit</a>
            <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Customer Name</label>
                <input type="text">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Email</label>
                <input type="text">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Phone</label>
                <input type="text">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Country</label>
                <input type="text">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>City</label>
                <input type="text">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Address</label>
                <input type="text">
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <a class="btn btn-submit me-2">Submit</a>
            <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="delete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Order Deletion</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="delete-order">
            <img src="assets/img/icons/close-circle1.svg" alt="img">
          </div>
          <div class="para-set text-center">
            <p>The current order will be deleted as no payment has been <br> made so far.</p>
          </div>
          <div class="col-lg-12 text-center">
            <a class="btn btn-danger me-2">Yes</a>
            <a class="btn btn-cancel" data-bs-dismiss="modal">No</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="recents" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Recent Transactions</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="tabs-sets">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="purchase-tab" data-bs-toggle="tab" data-bs-target="#purchase" type="button" aria-controls="purchase" aria-selected="true" role="tab">Purchase</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" aria-controls="payment" aria-selected="false" role="tab">Payment</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="return-tab" data-bs-toggle="tab" data-bs-target="#return" type="button" aria-controls="return" aria-selected="false" role="tab">Return</button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="purchase" role="tabpanel" aria-labelledby="purchase-tab">
                <div class="table-top">
                  <div class="search-set">
                    <div class="search-input">
                      <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                    </div>
                  </div>
                  <div class="wordset">
                    <ul>
                      <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                      </li>
                      <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                      </li>
                      <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table datanew">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Reference</th>
                        <th>Customer</th>
                        <th>Amount </th>
                        <th class="text-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>INV/SL0101</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>INV/SL0101</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>INV/SL0101</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>INV/SL0101</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>INV/SL0101</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>INV/SL0101</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>INV/SL0101</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="payment" role="tabpanel">
                <div class="table-top">
                  <div class="search-set">
                    <div class="search-input">
                      <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                    </div>
                  </div>
                  <div class="wordset">
                    <ul>
                      <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                      </li>
                      <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                      </li>
                      <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table datanew">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Reference</th>
                        <th>Customer</th>
                        <th>Amount </th>
                        <th class="text-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0101</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0102</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0103</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0104</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0105</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0106</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0107</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="return" role="tabpanel">
                <div class="table-top">
                  <div class="search-set">
                    <div class="search-input">
                      <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                    </div>
                  </div>
                  <div class="wordset">
                    <ul>
                      <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                      </li>
                      <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                      </li>
                      <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table datanew">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Reference</th>
                        <th>Customer</th>
                        <th>Amount </th>
                        <th class="text-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0101</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0102</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0103</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0104</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0105</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0106</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2022-03-07 </td>
                        <td>0107</td>
                        <td>Walk-in Customer</td>
                        <td>$ 1500.00</td>
                        <td>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/eye.svg" alt="img">
                          </a>
                          <a class="me-3" href="javascript:void(0);">
                            <img src="assets/img/icons/edit.svg" alt="img">
                          </a>
                          <a class="me-3 confirm-text" href="javascript:void(0);">
                            <img src="assets/img/icons/delete.svg" alt="img">
                          </a>
                        </td>
                      </tr>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Écouteur d'événements pour les clics sur les éléments de catégorie
        $(".category-item").click(function () {
            // Récupérer l'ID de la catégorie
            var categoryId = $(this).data("category-id");

            // Recharger la page avec l'ID de catégorie en tant que paramètre GET
            window.location.href = "pos.php?cat egory_id=" + categoryId;
        });
    });
</script>
  <script src="assets/js/jquery-3.6.0.min.js"></script>

  <script src="assets/js/feather.min.js"></script>

  <script src="assets/js/jquery.slimscroll.min.js"></script>

  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/dataTables.bootstrap4.min.js"></script>

  <script src="assets/plugins/select2/js/select2.min.js"></script>

  <script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>

  <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
  <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

  <script src="assets/js/script.js"></script>
</body>

</html>