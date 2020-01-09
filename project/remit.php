<?php
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  //echo $id;
}

if(isset($_GET['partner_id'])) {
  $partner_id = $_GET['partner_id'];
  //echo $partner_id;
} else {
  $partner_id ="";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ethereum P2P Remittance</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="main.php?id=<?php echo $id;?>">Ethereum P2P Remittance</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
      <div class="input-group">
        <input type="text" class="form-control" aria-describedby="basic-addon2" value ="Your Account: <?php echo $id;?>" readonly="true">
      </div>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="index.php">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->

    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="main.php?id=<?php echo $id;?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Member</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="remit.php?id=<?php echo $id;?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Remittance</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="history.php?id=<?php echo $id;?>">
          <i class="fas fa-fw fa-folder"></i>
          <span>Transaction History</span></a>
      </li>
    </ul>


    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Remit</a>
          </li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Remittance</div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="50%">My Account</th>
                    <th width="50%" colspan="3">Remittance Account</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input class="form-control" id="account" value=<?php echo $id;?> ></td>
                    <td colspan="3"><input class="form-control" id="receiver" value=<?php echo $partner_id;?> ></td>
                  </tr>
                </tbody>

                <thead>
                  <tr>
                    <th>Banance(Ether)</th>
                    <th colspan="3">Password/Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input id="amount" type="number" class="form-control"/></td>
                    <td><input id="pass" type="password" class="form-control"/></td>
                    <td>
                      <a class="btn btn-primary btn-block" id="send_btn">Send</a>
                    </td>
                    <td>
                      <a class="btn btn-primary btn-block" id="cancel_btn">Back</a>
                    </td>
                  </tr>
                </tbody>
                
            </table>
            <table>
              <div id="message"></div>
            </table>

            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © BlockChain 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- ethereum core-->
  <script type="text/javascript" src="./js/lib/web3-light@0.20.6.js"></script>
  <script type="text/javascript" src="./js/app.js"></script>

<script>
    $(document).ready(function(){
			$("#cancel_btn").click(function(){
                window.history.go(-1);
            });

			$("#send_btn").click(function(){

            var receiver = $( '#receiver' ).val();
            var amount = $( '#amount' ).val();
            var pass = $( '#pass' ).val();

            if (receiver == "") {
              alert("Partner Account를 입력해주세요.")
            } else if (amount == ""){
              alert("Banance를 입력해주세요.")
            } else if (pass == ""){
              alert("Password를 입력해주세요.")
            } else {

              const address = document.getElementById('account').value;
              const toAddress = receiver;
              const amount = web3.toWei(document.getElementById('amount').value, 'ether');
              const amount_original = document.getElementById('amount').value;

                if (web3.personal.unlockAccount(address, pass)) 
                {
                  web3.eth.sendTransaction(
                    { from: address, to: toAddress, value: amount },
                    (err, result) => {
                      if (!err) {
                        document.getElementById('message').innerText = ' ';
                        const idiv = document.createElement('div');
                        document.getElementById('message').appendChild(idiv);
                        let input = `
                            Transaction Result: ${result}<br/>
                            <a href="history.php?id=<?php echo $id;?>&partner_id=<?php echo $partner_id;?>&amount=${amount_original}">
                            (click to write a transaction history)
                            </a>
                        `;
                        idiv.innerHTML = input;
                        console.log(`Transaction is sent Successful! ${result} `);
                      } else console.log(err);
                    }
                  );
                }

                //var url = 'main.php?id=<?php echo $id?>'; 
                //$(location).attr('href',url);
            }

            });

    });
</script>

</body>

</html>
