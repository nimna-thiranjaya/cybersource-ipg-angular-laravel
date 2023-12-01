import { Component } from '@angular/core';
import { EncriptionService } from '../../shared/services/encription.service';

@Component({
  selector: 'app-payment-start',
  templateUrl: './payment-start.component.html',
  styleUrls: ['./payment-start.component.scss'],
})
export class PaymentStartComponent {
  data: any = {
    amount: 100,
    currency: 'USD',
    description: 'Payment for something',
    name: 'John Doe',
    reference: '1234567890',
  };

  constructor(private encryptionService: EncriptionService) {}

  ngOnInit(): void {
    let signature = this.encryptionService.generateSignature(this.data);

    this.data.signature = signature;
  }

  onMakePayment() {
    //genarate hash for data

    let encryptedData = this.encryptionService.encryptData(this.data);

    let ecodedData = encodeURIComponent(encryptedData);

    let url = 'http://127.0.0.1:8000/payment?data=' + ecodedData;

    window.open(url, '_self');
  }
}
