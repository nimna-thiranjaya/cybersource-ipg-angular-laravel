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
    signature: 'From Nimna',
  };

  constructor(private encryptionService: EncriptionService) {}
  onMakePayment() {
    let encryptedData = this.encryptionService.encryptData(this.data);
    console.log('encryptedData', encryptedData);

    let ecodedData = encodeURIComponent(encryptedData);

    let url = 'http://127.0.0.1:8000/payment?data=' + ecodedData;

    console.log(
      'HIIIIIIIIIII',
      this.encryptionService.decryptData(encryptedData)
    );

    window.open(url, '_self');
  }
}
