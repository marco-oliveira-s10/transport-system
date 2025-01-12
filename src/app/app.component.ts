// src/app/app.component.ts
import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { AbastecimentoComponent } from './components/abastecimento/abastecimento.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, AbastecimentoComponent],
  template: `<app-abastecimento></app-abastecimento>`
})
export class AppComponent {
  title = 'sistema-abastecimentos';
}