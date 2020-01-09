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

if(isset($_GET['amount'])) {
  $amount = $_GET['amount'];
  //echo $amount;
} else {
  $amount ="";
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
      <li class="nav-item">
        <a class="nav-link" href="remit.php?id=<?php echo $id;?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Remittance</span></a>
      </li>
      <li class="nav-item active">
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
            <a href="#">Transaction</a>
          </li>
          <li class="breadcrumb-item active">History</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Transaction</div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="30%">My Account</th>
                    <th width="30%">Remittance Account</th>
                    <th width="30%">Banance(Ether)</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <input type="hidden" id="next_no" value="">
                    <td><input class="form-control" id="account" value="<?php echo $id;?>" readonly="true"></td>
                    <td><input class="form-control" id="receiver" value="<?php echo $partner_id;?>" readonly="true"></td>
                    <td><input class="form-control" id="amount" value="<?php echo $amount;?>" readonly="true"></td>
                    <td>
                        <?php if (!empty($amount)) {
                          echo '<a class="btn btn-primary btn-block" id="write_btn">Write</a>';
                        } 
                        ?>
                    </td>
                  </tr>
                </tbody>
            </table>

            <table class="table table-bordered" id="logtable" width="100%" cellspacing="0">
                  <tr>
                    <th width="10%">NO</th>
                    <th width="30%">My Account</th>
                    <th width="30%">Remittance Account</th>
                    <th width="10%">Banance(Eth)</th>
                    <th width="20%">Date</th>
                  </tr>
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

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  
  <!-- ethereum core-->
  <script type="text/javascript" src="./js/lib/web3-light@0.20.6.js"></script>
  <script type="text/javascript" src="./js/abi.js"></script>
  <script type="text/javascript" src="./js/app.js"></script>

  <script>
    const contractAddress = '0x03ab2F0dCE687016010215111891c648482E701C'; 
    // remix 에서 Deployed Contracts address
    // remix 에서는 depoly되면 아래에 contractAddress가 생김
    const smartContract = web3.eth.contract(abi).at(contractAddress);
  </script>
<script>
    $(document).ready(function(){
      
			$("#write_btn").click(function(){
              const pronumber = document.getElementById('next_no').value;
              const proname = document.getElementById('account').value; // my account 
              const proname2 = document.getElementById('receiver').value; // my remittance Account
              const proloc = document.getElementById('amount').value; // amount
              const account = document.getElementById('account').value; // 인증을 위한 account

                smartContract.addProStru(
                  pronumber,
                  proname,
                  proname2,
                  proloc,
                  { from: account, gas: 2000000 },
                  (err, result) => {
                    if (!err) alert('트랜잭션이 성공적으로 전송되었습니다.\n' + result);
                  }
                );

            });

            
    });

    function showList() {
      const table = document.getElementById('logtable');
      const length = smartContract.getNumOfProducts();
      smartContract.product().watch((err, res) => {
        if (!err) {
          console.dir(res);
          const row = table.insertRow();
          const cell1 = row.insertCell(0);
          const cell2 = row.insertCell(1);
          const cell3 = row.insertCell(2);
          const cell4 = row.insertCell(3);
          const cell5 = row.insertCell(4);
          cell1.innerHTML = res.args.number.c[0];
          cell2.innerHTML = res.args.productName;
          cell3.innerHTML = res.args.productName2;
          cell4.innerHTML = res.args.location;
          cell5.style.width = '60%';
          cell5.innerHTML = new Date(res.args.timestamp.c[0]);
        }
      });
      for (let i = 0; i < length; i++) {
        const product = smartContract.getProductStruct(i);
        const toString = product.toString();
        const strArray = toString.split(',');
        const timestamp = new Date(strArray[3] * 10);
        const row = table.insertRow();
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);
        const cell5 = row.insertCell(4);
        cell1.innerHTML = strArray[0];
        cell2.innerHTML = strArray[1];
        cell3.innerHTML = strArray[2];
        cell4.innerHTML = strArray[3];
        cell5.style.width = '60%';
        cell5.innerHTML = timestamp;
        var no = i+1;
      }
      console.log(no);
      if (isNaN(no)){
        var no = 1;
      } else {
        var no = no+1;
      }
      const last_no = no;
      console.log(last_no);
      $("#next_no").val(last_no);
    }
    $(function() {
      showList();
    });


</script>

</body>

</html>
