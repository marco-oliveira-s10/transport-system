// src/app/services/abastecimento.service.ts
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

export interface Abastecimento {
  id?: number;
  dataHora: string;
  placa: string;
  quilometragem: number;
  valorTotal: number;
}

export interface PageResponse {
  content: Abastecimento[];
  totalPages: number;
  totalElements: number;
}

@Injectable({
  providedIn: 'root'
})
export class AbastecimentoService {
  private apiUrl = 'http://localhost:8080/api/abastecimentos';

  constructor(private http: HttpClient) { }

  getAbastecimentos(page: number, size: number, placa?: string): Observable<PageResponse> {
    let url = `${this.apiUrl}?page=${page}&size=${size}`;
    if (placa) {
      url += `&placa=${placa}`;
    }
    return this.http.get<PageResponse>(url);
  }

  saveAbastecimento(abastecimento: Abastecimento): Observable<Abastecimento> {
    return this.http.post<Abastecimento>(this.apiUrl, abastecimento);
  }

  deleteAbastecimento(id: number): Observable<void> {
    return this.http.delete<void>(`${this.apiUrl}/${id}`);
  }
}