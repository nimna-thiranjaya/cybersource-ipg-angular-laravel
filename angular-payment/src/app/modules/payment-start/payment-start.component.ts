import { Component } from '@angular/core';
import { EncriptionService } from '../../shared/services/encription.service';
import { PaymentService } from 'src/app/shared/services/payment.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-payment-start',
  templateUrl: './payment-start.component.html',
  styleUrls: ['./payment-start.component.scss'],
})
export class PaymentStartComponent {
  //   data: any = {
  //     amount: 100,
  //     currency: 'USD',
  //     description: 'Payment for something',
  //     name: 'John Doe',
  //     reference: '1234567890',
  //   };

  //   constructor(private encryptionService: EncriptionService) {}

  //   ngOnInit(): void {
  //     let signature = this.encryptionService.generateSignature(this.data);

  //     this.data.signature = signature;
  //   }

  //   onMakePayment() {
  //     //genarate hash for data

  //     let encryptedData = this.encryptionService.encryptData(this.data);

  //     let ecodedData = encodeURIComponent(encryptedData);

  //     let url = 'http://127.0.0.1:8000/payment?data=' + ecodedData;

  //     window.open(url, '_self');
  //   }
  // }

  paymentData: any;
  controls: any;
  validationErrors: { [key: string]: string } = {};
  isFormValid = false;
  constructor(private paymentService: PaymentService, private router: Router) {}

  ngOnInit(): void {
    this.paymentData = this.paymentService.initPayment();
    this.getPaymentData();
  }

  getPaymentData() {
    this.paymentData.amount = '220.00';
    this.paymentData.reference_number = '1234567890';
    this.paymentData.bill_to_forename = 'John';
    this.paymentData.bill_to_surname = 'Doe';
    this.paymentData.bill_to_email = 'exmple@gmail.com';
    this.paymentData.bill_to_phone = '0771234567';
    // this.paymentData.bill_to_address_line1 = 'No 1, Galle Road';
    // this.paymentData.bill_to_address_city = 'Colombo';
    // this.paymentData.bill_to_address_state = 'CA';
    // this.paymentData.bill_to_address_country = 'US';
    this.paymentData.bill_to_address_postal_code = '00100';

    this.encryptData(this.paymentData, true);

    this.paymentData.card_number = '4242424242424242';
    this.paymentData.card_expiry_date = '12-2024';

    this.controls = Object.keys(this.paymentData).map((key) => {
      return {
        key: key,
        value: this.paymentData[key],
      };
    });
  }

  encryptData(formData: any, isValid: any): void {
    formData.signature = this.paymentService.encrypt(formData, isValid);
  }

  //Validations
  validateCardType() {
    if (!this.paymentData.card_type) {
      this.validationErrors['card_type'] = 'This field required!';
    } else {
      delete this.validationErrors['card_type'];
    }
  }

  validateCardNumber() {
    const cardNumber = this.paymentData.card_number;

    if (!cardNumber) {
      this.validationErrors['card_number'] = 'This field required!';
    } else {
      const cardNumberPattern = /^[0-9]{16}$/;

      if (!cardNumberPattern.test(cardNumber)) {
        this.validationErrors['card_number'] = 'This field is invalid!';
      } else {
        delete this.validationErrors['card_number'];
      }
    }
  }

  validateCardExpiryDate() {
    const cardExpiryDate = this.paymentData.card_expiry_date;

    if (!cardExpiryDate) {
      this.validationErrors['card_expiry_date'] = 'This field required!';
    } else {
      const expiryDatePattern = /^(0[1-9]|1[0-2])-(19|20)\d{2}$/;

      if (!expiryDatePattern.test(cardExpiryDate)) {
        this.validationErrors['card_expiry_date'] = 'This field is invalid!';
      } else {
        delete this.validationErrors['card_expiry_date'];
      }
    }
  }

  // paymentStart() {
  //   console.log('Payment Start');
  //   this.shoppingCartService
  //     .PaymentWaitResponse(this.paymentData.reference_number)
  //     .subscribe((result: any) => {
  //       if (result.IsSuccessful) {
  //         console.log(
  //           '/payment-response?data=' +
  //             encodeURIComponent(JSON.stringify(result.DataSet))
  //         );
  //         this.router.navigate(['/payment-response'], {
  //           queryParams: {
  //             data: encodeURIComponent(JSON.stringify(result.DataSet)),
  //           },
  //         });
  //       } else {
  //         this.messageService.showErrorAlert(result.Message);
  //       }
  //     });
  // }

  checkFormValidity() {
    this.validateCardType();
    this.validateCardNumber();
    this.validateCardExpiryDate();

    // Check if there are no validation errors
    this.isFormValid = Object.keys(this.validationErrors).length === 0;
  }

  onDataChanged() {
    this.checkFormValidity();
  }
}
