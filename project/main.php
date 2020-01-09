<?php
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  //echo $id;
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
      <input id="targetID" type="text" class="form-control" aria-describedby="basic-addon2" value ="Your Account: <?php echo $id;?>" readonly="true">
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
      <li class="nav-item active">
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
            <a href="#">Member</a>
          </li>
          <li class="breadcrumb-item active">List</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            Member List</div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="50%">Account</th>
                    <th width="20%">ETH</th>
                    <th>Action</th>
                  </tr>
                </thead>
            </table>

              <div id="tablePlace"></div>

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

  <!-- Demo scripts for this page-->
  <!-- <script src="js/demo/datatables-demo.js"></script> -->
  <!-- <script src="js/demo/chart-area-demo.js"></script> -->

  <!-- ethereum core-->
  <script type="text/javascript" src="./js/lib/web3-light@0.20.6.js"></script>
  <script type="text/javascript" src="./js/app.js"></script>

  <script>
  function refreshAccounts() {
  // tablePlace를 초기화하고 계좌수 만큼 테이블의 행을 생성합니다.
  document.getElementById('tablePlace').innerText = '';
  const idiv = document.createElement('div');
  document.getElementById('tablePlace').appendChild(idiv);
  const list = web3.eth.accounts;
  let total = 0;
  let input = '<table>';
  //console.log(list.map.el);
  // 출력
  list.map(el => {
    const tempB = parseFloat(web3.fromWei(web3.eth.getBalance(el), 'ether'));

     /* change color area*/
    const get_address = document.getElementById('targetID').value;  // targetId value 값
    let my_address = '';
    // i번째는 계정의 첫글자수
    for (let i = 14; i < get_address.length; i++ ) {
      my_address+=get_address[i];
    }
    //console.log(`${b}`);
    console.log(`my_address 는 ${my_address}`);
    let condition = false;
    if (el == my_address) {
      condition = true;
    }

    input += `
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <tbody>
      <tr>
        ${condition ? '<td width="50%" style="color: red;">' : '<td width="50%">'}
          ${el}
        </td>
        <td width="20%">
          ${tempB}
        </td>
        <td>
          <a href="remit.php?id=<?php echo $id;?>&partner_id=${el}">(click to remit through this ID)</a>
        </td>
      </tr>
      </tbody>
    </table>
      `;
    total += tempB;

  });

    idiv.innerHTML = input;
    web3.eth.filter('latest').watch(() => {
    });
  }
  </script>
  
  <script>
    refreshAccounts();
  </script>

</body>

</html>
