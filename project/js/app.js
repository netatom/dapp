typeof web3 !== 'undefined'
  ? (web3 = new Web3(web3.currentProvider))
  : (web3 = new Web3(new Web3.providers.HttpProvider('http://127.0.0.1:8545')));

if (web3.isConnected()) {
  console.log('connected');
} else {
  console.log('not connected');
  exit;
}

// 잔고를 출력합니다.
function refreshBalance() {
  // tablePlace를 초기화하고 계좌수 만큼 테이블의 행을 생성합니다.
  document.getElementById('tablePlace').innerText = '';
  const idiv = document.createElement('div');
  document.getElementById('tablePlace').appendChild(idiv);
  const list = web3.eth.accounts;
  let total = 0;
  let input = '<table>';

  // 잔액 출력
  list.map(el => {
    const tempB = parseFloat(web3.fromWei(web3.eth.getBalance(el), 'ether'));
    input += `
      <tr>
        <td>
          ${el}
        </td>
        <td>
          ${tempB} Eth
        </td>
      </tr>
      `;
    total += tempB;
  });

  input += `
    <tr>
      <td>
        <strong>Total </strong>
      </td>
      <td>
        <strong><font color='red'>${total} Eth</font></strong>
      </td>
    </tr>
  `;
  idiv.innerHTML = input;
  web3.eth.filter('latest').watch(() => {
    refreshBalance();
  });
}

function createNewAccount(prePassword) {
  console.log('New Account');
  web3.personal.newAccount(prePassword); // 여기서 newAccount는 계정의 패스워드가 된다.
  web3.eth.filter('latest').watch(() => {
    refreshBalance();
  });
}

// 송금
function send() {
  const address = document.getElementById('accounts').value;
  const toAddress = document.getElementById('receiver').value;
  const amount = web3.toWei(document.getElementById('amount').value, 'ether');

  if (
    web3.personal.unlockAccount(address, document.getElementById('pass').value)
  ) {
    web3.eth.sendTransaction(
      { from: address, to: toAddress, value: amount },
      (err, result) => {
        if (!err) {
          document.getElementById('message').innerText = ' ';
          const idiv = document.createElement('div');
          document.getElementById('message').appendChild(idiv);
          let input = `
            <p>
              Result: ${result}
            </p>
          `;
          idiv.innerHTML = input;
          console.log(`Transaction is sent Successful! ${result} `);
        } else console.log(err);
      }
    );
  }
}
