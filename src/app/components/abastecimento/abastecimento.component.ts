// src/app/components/abastecimento/abastecimento.component.ts
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { Abastecimento, AbastecimentoService, PageResponse } from '../../services/abastecimento.service';

@Component({
    selector: 'app-abastecimento',
    standalone: true,
    imports: [
        CommonModule,
        FormsModule,
        ReactiveFormsModule,
        HttpClientModule
    ],
    providers: [AbastecimentoService],
    templateUrl: './abastecimento.component.html',
    styleUrl: './abastecimento.component.css'
})
export class AbastecimentoComponent implements OnInit {
    abastecimentos: Abastecimento[] = [];
    form: FormGroup;
    currentPage = 0;
    pageSize = 5;
    totalPages = 0;
    showForm = false;
    darkMode = false;

    constructor(
        private service: AbastecimentoService,
        private fb: FormBuilder
    ) {
        this.form = this.fb.group({
            dataHora: ['', Validators.required],
            placa: ['', [Validators.required, Validators.pattern(/^[A-Z]{3}-\d{4}$|^[A-Z]{3}\d[A-Z]\d{2}$/)]],
            quilometragem: ['', Validators.required],
            valorTotal: ['', Validators.required]
        });
    }

    ngOnInit() {
        this.loadAbastecimentos();
        this.initDarkMode();
    }

    getPagesArray(): number[] {
        return Array.from({ length: this.totalPages }, (_, i) => i);
    }

    loadAbastecimentos(placa: string = '') {
        this.service.getAbastecimentos(this.currentPage, Number(this.pageSize), placa)
            .subscribe({
                next: (data: PageResponse) => {
                    this.abastecimentos = data.content;
                    this.totalPages = data.totalPages;
                },
                error: () => alert('Erro ao carregar dados')
            });
    }

    onSubmit() {
        if (this.form.valid) {
            this.service.saveAbastecimento(this.form.value)
                .subscribe({
                    next: () => {
                        this.loadAbastecimentos();
                        this.showForm = false;
                        this.form.reset();
                        alert('Abastecimento salvo com sucesso!');
                    },
                    error: () => alert('Erro ao salvar abastecimento')
                });
        }
    }

    deleteAbastecimento(id: number) {
        if (confirm('Deseja realmente excluir este abastecimento?')) {
            this.service.deleteAbastecimento(id)
                .subscribe({
                    next: () => {
                        this.loadAbastecimentos();
                        alert('Abastecimento excluído com sucesso!');
                    },
                    error: () => alert('Erro ao excluir abastecimento')
                });
        }
    }

    changePage(page: number) {
        if (page >= 0 && page < this.totalPages) {
            this.currentPage = page;
            this.loadAbastecimentos();
        }
    }

    toggleDarkMode() {
        this.darkMode = !this.darkMode;
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('darkMode', String(this.darkMode));
    }

    private initDarkMode() {
        const isDarkMode = localStorage.getItem('darkMode') === 'true';
        if (isDarkMode) {
            this.darkMode = true;
            document.body.classList.add('dark-mode');
        }
    }
}