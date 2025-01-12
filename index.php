<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Abastecimentos</title>

    <!-- Links externos obrigatórios -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Variáveis do Bootstrap */
        :root {
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-white: #fff;
            --bs-primary-rgb: 13, 110, 253;
            --bs-dark-rgb: 33, 37, 41;
            --bs-body-bg: #f8f9fa;
            --bs-body-color: #212529;
        }

        /* Reset e Estilos Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background-color: var(--bs-primary) !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 500;
        }

        /* Cards */
        .card {
            background-color: var(--bs-white);
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .card-header {
            background-color: var(--bs-primary);
            color: white;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
            padding: 1rem 1.25rem;
        }

        /* Botões */
        .btn {
            border-radius: 6px;
            padding: 0.5rem 1rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        /* Formulários */
        .form-control {
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
        }

        .input-group-text {
            background-color: var(--bs-primary);
            color: white;
            border: none;
        }

        /* Tabelas */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--bs-primary);
            color: white;
            font-weight: 500;
            padding: 1rem;
            border: none;
        }

        .table tbody tr:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.05);
        }

        /* Modo Escuro */
        .dark-mode {
            --bs-body-bg: #212529;
            --bs-body-color: #f8f9fa;
        }

        .dark-mode .card {
            background-color: #2d3338;
        }

        .dark-mode .table {
            color: #f8f9fa !important;
        }

        .dark-mode .table tbody td {
            color: #f8f9fa !important;
        }

        .dark-mode .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }

        .dark-mode .form-control,
        .dark-mode .form-select {
            background-color: #2d3338 !important;
            border-color: #444;
            color: #f8f9fa !important;
        }

        .dark-mode .form-control::placeholder {
            color: #adb5bd;
        }

        .dark-mode .form-label {
            color: #f8f9fa !important;
        }

        .dark-mode .modal-content {
            background-color: #2d3338;
            color: #f8f9fa;
        }

        .dark-mode .modal-header {
            border-bottom-color: #444;
        }

        .dark-mode .modal-footer {
            border-top-color: #444;
        }

        .dark-mode .btn-close {
            filter: brightness(0) invert(1);
        }

        /* Paginação */
        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            color: var(--bs-primary);
            padding: 0.5rem 0.75rem;
        }

        .page-item.active .page-link {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .dark-mode .page-link {
            background-color: #2d3338;
            border-color: #444;
            color: #f8f9fa;
        }

        .dark-mode .page-link:hover {
            background-color: #3d4449;
            border-color: #444;
            color: #f8f9fa;
        }

        .dark-mode .page-item.disabled .page-link {
            background-color: #212529;
            border-color: #444;
            color: #6c757d;
        }

        /* Loading State */
        .loading {
            position: relative;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
        }

        .dark-mode .loading::after {
            background: rgba(0, 0, 0, 0.7);
        }

        /* Toast */
        .toast-container {
            z-index: 1056;
        }

        .toast {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .dark-mode .toast {
            background-color: #2d3338;
            color: #f8f9fa;
        }

        /* Animações */
        .fade-in {
            animation: fadeIn 0.3s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .table-responsive {
                margin: 0 -1rem;
            }

            .pagination {
                justify-content: center;
            }
        }

        /* Validação de Formulários */
        .invalid-feedback {
            display: block;
            color: var(--bs-danger);
        }

        .dark-mode .invalid-feedback {
            color: #ff6b6b;
        }

        .form-control.is-invalid {
            border-color: var(--bs-danger);
            background-image: none;
        }

        .dark-mode .form-control.is-invalid {
            border-color: #ff6b6b;
        }

        /* Acessibilidade */
        :focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
        }

        .dark-mode :focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <span class="navbar-brand">
                <i class="bi bi-fuel-pump me-2"></i>
                Sistema de Abastecimentos
            </span>
            <button id="darkModeToggle" class="btn btn-link text-light">
                <i class="bi bi-moon"></i>
            </button>
        </div>
    </nav>

    <div class="container">
        <!-- Lista de Abastecimentos -->
        <section id="list-section">
            <div class="card">
                <div class="card-body">
                    <!-- Barra de ferramentas -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" id="placa-filter"
                                    class="form-control" placeholder="Buscar por placa...">
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-primary" onclick="showForm()">
                                <i class="bi bi-plus-lg me-2"></i>
                                Novo Abastecimento
                            </button>
                        </div>
                    </div>

                    <!-- Tabela -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Data/Hora</th>
                                    <th>Placa</th>
                                    <th>Quilometragem</th>
                                    <th>Valor Total</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="abastecimentos-table"></tbody>
                        </table>
                    </div>

                    <!-- Paginação -->
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <select id="page-size" class="form-select">
                                <option value="5">5 por página</option>
                                <option value="10">10 por página</option>
                                <option value="15">15 por página</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <ul id="pagination-controls"
                                class="pagination justify-content-end mb-0"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Formulário -->
        <section id="form-section" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Novo Abastecimento</h5>
                </div>
                <div class="card-body">
                    <form id="abastecimento-form" onsubmit="saveAbastecimento(event)">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data e Hora*</label>
                                <input type="datetime-local" id="dataHora"
                                    class="form-control" required>
                                <div class="invalid-feedback" id="dataHora-error"></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Placa*</label>
                                <input type="text" id="placa" class="form-control"
                                    required placeholder="AAA-1234 ou ABC1D23">
                                <div class="invalid-feedback" id="placa-error"></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quilometragem*</label>
                                <input type="number" id="quilometragem"
                                    class="form-control" required min="0">
                                <div class="invalid-feedback" id="quilometragem-error"></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Valor Total*</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="number" id="valorTotal" class="form-control"
                                        required min="0.01" step="0.01">
                                </div>
                                <div class="invalid-feedback" id="valorTotal-error"></div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary"
                                onclick="hideForm()">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente excluir este abastecimento?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger"
                        onclick="confirmDelete()">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Variáveis globais
        const API_URL = 'http://localhost:8080/api/abastecimentos';
        let currentPage = 0;
        let pageSize = 5;
        let deleteId = null;

        // Inicialização
        document.addEventListener('DOMContentLoaded', () => {
            loadAbastecimentos();
            setupEventListeners();
            initDarkMode();
        });

        // Configuração dos eventos
        function setupEventListeners() {
            // Filtro de placa
            const placaFilter = document.getElementById('placa-filter');
            placaFilter.addEventListener('input', debounce(() => {
                currentPage = 0;
                loadAbastecimentos();
            }, 300));

            // Tamanho da página
            const pageSizeSelect = document.getElementById('page-size');
            pageSizeSelect.addEventListener('change', (e) => {
                pageSize = parseInt(e.target.value);
                currentPage = 0;
                loadAbastecimentos();
            });

            // Modo escuro
            document.getElementById('darkModeToggle').addEventListener('click', toggleDarkMode);
        }

        // Carregar abastecimentos
        async function loadAbastecimentos() {
            try {
                const placa = document.getElementById('placa-filter').value;
                const url = `${API_URL}?page=${currentPage}&size=${pageSize}${placa ? '&placa=' + placa : ''}`;

                const response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Erro ao carregar dados');

                const data = await response.json();
                renderTable(data.content);
                renderPagination(data);
            } catch (error) {
                console.error('Erro:', error);
                showToast('Erro ao carregar dados', 'danger');
            }
        }

        // Renderizar tabela
        function renderTable(items) {
            const tbody = document.getElementById('abastecimentos-table');
            if (!items.length) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">Nenhum abastecimento encontrado</td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = items.map(item => `
                <tr class="fade-in">
                    <td>${formatDate(item.dataHora)}</td>
                    <td>${item.placa}</td>
                    <td>${item.quilometragem}</td>
                    <td>${formatCurrency(item.valorTotal)}</td>
                    <td class="text-center">
                        <button class="btn btn-danger btn-sm" onclick="showDeleteModal(${item.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        // Renderizar paginação
        function renderPagination(data) {
            const controls = document.getElementById('pagination-controls');
            const totalPages = data.totalPages;

            let html = '';

            // Botão Anterior
            html += `
                <li class="page-item ${currentPage === 0 ? 'disabled' : ''}">
                    <button class="page-link" onclick="changePage(${currentPage - 1})" ${currentPage === 0 ? 'disabled' : ''}>
                        <i class="bi bi-chevron-left"></i>
                    </button>
                </li>
            `;

            // Páginas
            for (let i = 0; i < totalPages; i++) {
                html += `
                    <li class="page-item ${currentPage === i ? 'active' : ''}">
                        <button class="page-link" onclick="changePage(${i})">${i + 1}</button>
                    </li>
                `;
            }

            // Botão Próximo
            html += `
                <li class="page-item ${currentPage >= totalPages - 1 ? 'disabled' : ''}">
                    <button class="page-link" onclick="changePage(${currentPage + 1})" 
                            ${currentPage >= totalPages - 1 ? 'disabled' : ''}>
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </li>
            `;

            controls.innerHTML = html;
        }

        // Funções do formulário
        async function saveAbastecimento(event) {
            event.preventDefault();
            if (!validateForm()) return;

            const data = {
                dataHora: document.getElementById('dataHora').value,
                placa: document.getElementById('placa').value.toUpperCase(),
                quilometragem: parseInt(document.getElementById('quilometragem').value),
                valorTotal: parseFloat(document.getElementById('valorTotal').value)
            };

            try {
                const response = await fetch(API_URL, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const responseData = await response.json();

                if (!response.ok) {
                    throw new Error(responseData.message || 'Erro ao salvar');
                }

                hideForm();
                loadAbastecimentos();
                showToast('Abastecimento salvo com sucesso!', 'success');
            } catch (error) {
                console.error('Erro:', error);
                showToast(error.message || 'Erro ao salvar abastecimento', 'danger');
            }
        }

        function validateForm() {
            let isValid = true;
            const fields = ['dataHora', 'placa', 'quilometragem', 'valorTotal'];

            fields.forEach(field => {
                const element = document.getElementById(field);
                const errorElement = document.getElementById(`${field}-error`);
                element.classList.remove('is-invalid');
                errorElement.textContent = '';

                if (!element.value) {
                    element.classList.add('is-invalid');
                    errorElement.textContent = 'Campo obrigatório';
                    isValid = false;
                }
            });

            // Validação da placa
            const placa = document.getElementById('placa').value;
            const placaRegex = /^[A-Z]{3}-\d{4}$|^[A-Z]{3}\d[A-Z]\d{2}$/;
            if (!placaRegex.test(placa)) {
                document.getElementById('placa').classList.add('is-invalid');
                document.getElementById('placa-error').textContent =
                    'Formato inválido. Use AAA-1234 ou ABC1D23';
                isValid = false;
            }

            // Validação da data
            const dataHora = new Date(document.getElementById('dataHora').value);
            if (dataHora > new Date()) {
                document.getElementById('dataHora').classList.add('is-invalid');
                document.getElementById('dataHora-error').textContent =
                    'Data não pode ser futura';
                isValid = false;
            }

            return isValid;
        }

        // Funções do modal de exclusão
        function showDeleteModal(id) {
            deleteId = id;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        async function confirmDelete() {
            if (!deleteId) return;

            try {
                const response = await fetch(`${API_URL}/${deleteId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Erro ao excluir');

                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                modal.hide();
                loadAbastecimentos();
                showToast('Abastecimento excluído com sucesso!', 'success');
            } catch (error) {
                console.error('Erro:', error);
                showToast('Erro ao excluir abastecimento', 'danger');
            }
        }

        // Funções utilitárias
        function showForm() {
            document.getElementById('list-section').style.display = 'none';
            document.getElementById('form-section').style.display = 'block';
            document.getElementById('abastecimento-form').reset();
            clearValidation();
        }

        function hideForm() {
            document.getElementById('form-section').style.display = 'none';
            document.getElementById('list-section').style.display = 'block';
        }

        function clearValidation() {
            const fields = document.querySelectorAll('.is-invalid');
            fields.forEach(field => field.classList.remove('is-invalid'));
            const errors = document.querySelectorAll('.invalid-feedback');
            errors.forEach(error => error.textContent = '');
        }

        function changePage(page) {
            currentPage = page;
            loadAbastecimentos();
        }

        function formatDate(dateString) {
            return new Date(dateString).toLocaleString('pt-BR');
        }

        function formatCurrency(value) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(value);
        }

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function showToast(message, type = 'success') {
            const toast = `
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div class="toast align-items-center text-white bg-${type} border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" 
                                data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', toast);
            const toastElement = document.querySelector('.toast');
            const bsToast = new bootstrap.Toast(toastElement);
            bsToast.show();

            toastElement.addEventListener('hidden.bs.toast', () => {
                toastElement.parentElement.remove();
            });
        }

        // Modo escuro
        function initDarkMode() {
            const darkMode = localStorage.getItem('darkMode') === 'true';
            if (darkMode) {
                document.body.classList.add('dark-mode');
                document.getElementById('darkModeToggle').innerHTML =
                    '<i class="bi bi-sun"></i>';
            }
        }

        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDark);
            this.innerHTML = `<i class="bi bi-${isDark ? 'sun' : 'moon'}"></i>`;
        }
    </script>
</body>

</html>