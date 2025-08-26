@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">Expense Calculator</h1>

            <!-- Input Form -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Add Transaction</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description:</label>
                        <input type="text" id="description" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Groceries">
                    </div>
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount:</label>
                        <input type="number" id="amount" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="any" placeholder="0.00">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type:</label>
                        <select id="type" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="income">Income</option>
                            <option value="expense">Expense</option>
                        </select>
                    </div>
                </div>
                <button id="add-btn" class="mt-4 w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Add Transaction</button>
            </div>

            <!-- Summary -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Summary</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-green-100 rounded-md">
                        <p class="font-medium">Total Income:</p>
                        <p id="total-income" class="text-lg font-semibold">0.00</p>
                    </div>
                    <div class="p-4 bg-red-100 rounded-md">
                        <p class="font-medium">Total Expenses:</p>
                        <p id="total-expenses" class="text-lg font-semibold">0.00</p>
                    </div>
                    <div class="p-4 bg-blue-100 rounded-md">
                        <p class="font-medium">Balance:</p>
                        <p id="balance" class="text-lg font-semibold">0.00</p>
                    </div>
                </div>
            </div>

            <!-- Transaction List -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Transaction History</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-3 text-sm font-medium text-gray-700">Description</th>
                                <th class="p-3 text-sm font-medium text-gray-700">Amount</th>
                                <th class="p-3 text-sm font-medium text-gray-700">Type</th>
                                <th class="p-3 text-sm font-medium text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody id="transaction-table" class="divide-y divide-gray-200"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const descriptionInput = document.getElementById('description');
        const amountInput = document.getElementById('amount');
        const typeSelect = document.getElementById('type');
        const addBtn = document.getElementById('add-btn');
        const totalIncomeEl = document.getElementById('total-income');
        const totalExpensesEl = document.getElementById('total-expenses');
        const balanceEl = document.getElementById('balance');
        const transactionTable = document.getElementById('transaction-table');

        let transactions = JSON.parse(localStorage.getItem('transactions')) || [];

        function updateSummary() {
            const income = transactions
                .filter(t => t.type === 'income')
                .reduce((sum, t) => sum + t.amount, 0)
                .toFixed(2);
            const expenses = transactions
                .filter(t => t.type === 'expense')
                .reduce((sum, t) => sum + t.amount, 0)
                .toFixed(2);
            const balance = (income - expenses).toFixed(2);

            totalIncomeEl.textContent = income;
            totalExpensesEl.textContent = expenses;
            balanceEl.textContent = balance;
            balanceEl.classList.toggle('text-green-600', balance >= 0);
            balanceEl.classList.toggle('text-red-600', balance < 0);
        }

        function renderTransactions() {
            transactionTable.innerHTML = '';
            transactions.forEach((transaction, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="p-3 text-sm">${transaction.description}</td>
                    <td class="p-3 text-sm ${transaction.type === 'income' ? 'text-green-600' : 'text-red-600'}">
                        ${transaction.type === 'income' ? '+' : '-'}${transaction.amount.toFixed(2)}
                    </td>
                    <td class="p-3 text-sm">${transaction.type.charAt(0).toUpperCase() + transaction.type.slice(1)}</td>
                    <td class="p-3 text-sm">
                        <button class="text-red-500 hover:text-red-700 delete-btn" data-index="${index}">Delete</button>
                    </td>
                `;
                transactionTable.appendChild(row);
            });

            // Add event listeners to delete buttons
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const index = btn.getAttribute('data-index');
                    transactions.splice(index, 1);
                    localStorage.setItem('transactions', JSON.stringify(transactions));
                    renderTransactions();
                    updateSummary();
                });
            });
        }

        function addTransaction() {
            const description = descriptionInput.value.trim();
            const amount = parseFloat(amountInput.value);
            const type = typeSelect.value;

            if (!description || isNaN(amount) || amount <= 0) {
                alert('Please enter a valid description and amount.');
                return;
            }

            transactions.push({ description, amount, type });
            localStorage.setItem('transactions', JSON.stringify(transactions));

            descriptionInput.value = '';
            amountInput.value = '';
            typeSelect.value = 'income';

            renderTransactions();
            updateSummary();
        }

        addBtn.addEventListener('click', addTransaction);

        // Handle enter key for adding transaction
        amountInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') addTransaction();
        });

        // Initial render
        renderTransactions();
        updateSummary();
    });
</script>
