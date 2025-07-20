let currentMonth = '';
let currentYear = '';
let expenses = {};
let salaries = {};

function setMonth() {
  const month = document.getElementById('monthSelect').value;
  const yearInput = document.getElementById('yearInput').value;
  const salaryInput = document.getElementById('salaryInput').value;

  const year = parseInt(yearInput);
  const salary = parseInt(salaryInput);

  if (!yearInput || isNaN(year) || year < 1900 || year > 2100) {
    alert('Please enter a valid 4-digit year (e.g., 2025)');
    return;
  }

  if (!salaryInput || isNaN(salary) || salary < 0) {
    alert('Please enter a valid salary amount');
    return;
  }

  currentMonth = month;
  currentYear = year;
  const key = `${month}-${year}`;

  salaries[key] = salary;
  if (!expenses[key]) expenses[key] = [];

  renderSummary();
  renderTable();
}

function addExpense() {
  const category = document.getElementById('categorySelect').value;
  const amountInput = document.getElementById('amountInput').value;
  const amount = parseInt(amountInput);
  const key = `${currentMonth}-${currentYear}`;
  const date = new Date().toISOString().split('T')[0]; // YYYY-MM-DD format

  if (!amountInput || isNaN(amount) || amount <= 0) {
    alert('Please enter a valid numeric amount greater than 0');
    return;
  }

  if (!expenses[key]) expenses[key] = [];

  const totalSpent = expenses[key].reduce((sum, e) => sum + e.amount, 0);
  const prev = getPreviousKey(currentMonth, currentYear);
  const prevSavings = getSavings(prev.key);

  const available = salaries[key] + prevSavings;

  if (totalSpent + amount > available) {
    alert('⚠️ It overlimits your budget!');
  }

  expenses[key].push({ date, category, amount });
  renderTable();
  renderSummary();
}

function renderTable() {
  const tbody = document.querySelector('#expenseTable tbody');
  const thead = document.querySelector('#expenseTable thead');
  tbody.innerHTML = '';
  const key = `${currentMonth}-${currentYear}`;

  if (expenses[key]?.length > 0) {
    thead.style.display = ''; // Show header
    expenses[key].forEach((e, i) => {
      const row = `<tr>
        <td>${e.date}</td>
        <td>${e.category}</td>
        <td>${e.amount}</td>
        <td><button onclick="deleteExpense(${i})" class="delete-btn">Delete</button></td>
      </tr>`;
      tbody.innerHTML += row;
    });
  } else {
    thead.style.display = 'none'; // Hide header if no expenses
  }

  document.getElementById('expenseTitle').innerText = `Expenses for ${key}`;
}

function deleteExpense(index) {
  const key = `${currentMonth}-${currentYear}`;
  expenses[key].splice(index, 1);
  renderTable();
  renderSummary();
}

function renderSummary() {
  const key = `${currentMonth}-${currentYear}`;
  const totalSpent = expenses[key]?.reduce((sum, e) => sum + e.amount, 0) || 0;

  const prev = getPreviousKey(currentMonth, currentYear);
  const prevSpent = expenses[prev.key]?.reduce((sum, e) => sum + e.amount, 0) || 0;
  const prevSalary = salaries[prev.key] || 0;
  const prevSavings = prevSalary - prevSpent;

  document.getElementById('prevMonthSummary').innerHTML = `
    <h3>Previous Month (${prev.key})</h3>
    <p>Salary: ₹${prevSalary}</p>
    <p>Spent: ₹${prevSpent}</p>
    <p>Saved: ₹${prevSavings}</p>
  `;

  document.getElementById('summaryCard').innerHTML = `
    <h3>Current Month (${key})</h3>
    <p>Salary: ₹${salaries[key]}</p>
    <p>Previous Savings: ₹${prevSavings}</p>
    <p>Total Spent: ₹${totalSpent}</p>
    <p>Remaining: ₹${salaries[key] + prevSavings - totalSpent}</p>
  `;
}

function getSavings(key) {
  const salary = salaries[key] || 0;
  const spent = expenses[key]?.reduce((sum, e) => sum + e.amount, 0) || 0;
  return salary - spent;
}

function getPreviousKey(month, year) {
  const months = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
  ];
  let idx = months.indexOf(month);
  let newYear = parseInt(year);

  if (idx === 0) {
    idx = 11;
    newYear--;
  } else {
    idx--;
  }

  return { key: `${months[idx]}-${newYear}` };
}

function downloadExcel() {
  const rows = [['Date', 'Month', 'Category', 'Amount']];
  for (const key in expenses) {
    expenses[key].forEach(e => {
      rows.push([e.date, key, e.category, e.amount]);
    });
  }

  const csv = rows.map(r => r.join(',')).join('\n');
  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const url = URL.createObjectURL(blob);
  const link = document.createElement("a");
  link.href = url;
  link.download = "expenses.csv";
  link.click();
}
