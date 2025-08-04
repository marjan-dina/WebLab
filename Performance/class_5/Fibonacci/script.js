function fib(n) {
  if (n === 0) return 0;
  if (n === 1) return 1;

  let a = 0, b = 1, temp;
  for (let i = 2; i <= n; i++) {
    temp = a + b;
    a = b;
    b = temp;
  }
  return b;
}

function findFibonacci() {
  const n = parseInt(document.getElementById('number').value);
  const result = fib(n);
  document.getElementById('result').innerText = `Fibonacci number at position ${n} is ${result}`;
}

